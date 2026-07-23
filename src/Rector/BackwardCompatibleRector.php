<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Rector;

use Art4\RectorBcLibrary\Guard\BackwardCompatibleClassMethodReturnTypeOverrideGuard;
use Art4\RectorBcLibrary\Guard\BackwardCompatibleParameterTypeOverrideGuard;
use Art4\RectorBcLibrary\Guard\BackwardCompatiblePropertyTypeOverrideGuard;
use PhpParser\Node;
use PhpParser\Node\Expr\ArrowFunction;
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;
use Rector\Config\RectorConfig;
use Rector\Contract\Rector\RectorInterface;
use Rector\Rector\AbstractRector;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class BackwardCompatibleRector extends AbstractRector implements MinPhpVersionInterface
{
    public const GUARD_RETURN_TYPE = 'returnType';
    public const GUARD_PARAM_TYPE = 'paramType';
    public const GUARD_PARAM_TYPE_ON_CLASS = 'paramTypeOnClass';
    public const GUARD_PROPERTY_TYPE = 'propertyType';

    /** @var array<class-string, array{original_rector_class: class-string<RectorInterface>, guard: string}> */
    private static array $ruleConfigs = [];

    private static ?RectorConfig $container = null;

    /** @var BackwardCompatibleClassMethodReturnTypeOverrideGuard */
    private $classMethodReturnTypeOverrideGuard;
    /** @var BackwardCompatibleParameterTypeOverrideGuard */
    private $parameterTypeOverrideGuard;
    /** @var BackwardCompatiblePropertyTypeOverrideGuard */
    private $propertyTypeOverrideGuard;

    public function __construct(
        BackwardCompatibleClassMethodReturnTypeOverrideGuard $classMethodReturnTypeOverrideGuard,
        BackwardCompatibleParameterTypeOverrideGuard $parameterTypeOverrideGuard,
        BackwardCompatiblePropertyTypeOverrideGuard $propertyTypeOverrideGuard
    ) {
        $this->classMethodReturnTypeOverrideGuard = $classMethodReturnTypeOverrideGuard;
        $this->parameterTypeOverrideGuard = $parameterTypeOverrideGuard;
        $this->propertyTypeOverrideGuard = $propertyTypeOverrideGuard;
    }

    /**
     * @param class-string<RectorInterface> $originalRectorClass
     */
    public static function addRuleConfiguration(string $originalRectorClass, string $guard): void
    {
        self::$ruleConfigs[$originalRectorClass] = [
            'original_rector_class' => $originalRectorClass,
            'guard' => $guard,
        ];
    }

    /** @return array<class-string, array{original_rector_class: class-string<RectorInterface>, guard: string}> */
    public static function getRuleConfigurations(): array
    {
        return self::$ruleConfigs;
    }

    public static function clearRuleConfigurations(): void
    {
        self::$ruleConfigs = [];
    }

    public static function setContainer(RectorConfig $container): void
    {
        self::$container = $container;
    }

    public static function clearContainer(): void
    {
        self::$container = null;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Backward-compatible wrapper for Rector type-declaration rules.',
            []
        );
    }

    /** @return array<class-string<Node>> */
    public function getNodeTypes(): array
    {
        return [ClassMethod::class, Class_::class, Function_::class, Closure::class, ArrowFunction::class];
    }

    public function refactor(Node $node): ?Node
    {
        if (self::$container === null) {
            return null;
        }

        foreach (self::$ruleConfigs as $config) {
            $originalRector = $this->resolveOriginalRector($config['original_rector_class']);

            if ($originalRector === null) {
                continue;
            }

            if (! $this->nodeMatchesOriginalTypes($node, $originalRector)) {
                continue;
            }

            $result = $this->processWithGuard($node, $originalRector, $config['guard']);

            if ($result !== null) {
                return $result;
            }
        }

        return null;
    }

    public function provideMinPhpVersion(): int
    {
        return 70400;
    }

    /** @param class-string<RectorInterface> $class */
    private function resolveOriginalRector(string $class): ?RectorInterface
    {
        if (self::$container === null) {
            return null;
        }

        if (! class_exists($class)) {
            return null;
        }

        /** @var RectorInterface $instance */
        $instance = self::$container->make($class);

        return $instance;
    }

    private function nodeMatchesOriginalTypes(Node $node, RectorInterface $originalRector): bool
    {
        foreach ($originalRector->getNodeTypes() as $nodeType) {
            if ($node instanceof $nodeType) {
                return true;
            }
        }

        return false;
    }

    private function processWithGuard(Node $node, RectorInterface $originalRector, string $guard): ?Node
    {
        switch ($guard) {
            case self::GUARD_RETURN_TYPE:
                if ($node instanceof ClassMethod && $this->classMethodReturnTypeOverrideGuard->shouldSkipClassMethod($node)) {
                    return null;
                }

                /** @var ?Node $result */
                $result = $originalRector->refactor($node);

                return $result;

            case self::GUARD_PARAM_TYPE:
                if ($node instanceof ClassMethod) {
                    $this->parameterTypeOverrideGuard->protectParametersIfNeeded($node);
                }

                /** @var ?Node $return */
                $return = $originalRector->refactor($node);

                if ($node instanceof ClassMethod) {
                    $this->parameterTypeOverrideGuard->unprotectParameters($node);
                }

                return $return;

            case self::GUARD_PARAM_TYPE_ON_CLASS:
                if ($node instanceof Class_) {
                    foreach ($node->getMethods() as $method) {
                        $this->parameterTypeOverrideGuard->protectParametersIfNeeded($method);
                    }
                }

                /** @var ?Node $return */
                $return = $originalRector->refactor($node);

                if ($node instanceof Class_) {
                    foreach ($node->getMethods() as $method) {
                        $this->parameterTypeOverrideGuard->unprotectParameters($method);
                    }
                }

                return $return;

            case self::GUARD_PROPERTY_TYPE:
                if ($node instanceof Class_) {
                    $this->propertyTypeOverrideGuard->protectPropertiesIfNeeded($node);
                }

                /** @var ?Node $return */
                $return = $originalRector->refactor($node);

                if ($node instanceof Class_) {
                    $this->propertyTypeOverrideGuard->unprotectProperties($node);
                }

                return $return;
        }

        /** @var ?Node $result */
        $result = $originalRector->refactor($node);

        return $result;
    }
}
