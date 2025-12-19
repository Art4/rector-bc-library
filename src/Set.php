<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary;

final class Set
{
    /**
     * Path to this package's Rector config.
     *
     * Use this constant in consumer projects to import the set:
     *
     *   RectorConfig::configure()
     *     ->withSets([\Art4\RectorBcLibrary\Set::BC_TYPE_DECLARATION])
     *   ;
     */
    public const BC_TYPE_DECLARATION = __DIR__ . '/../config/set/bc-type-declaration.php';

    /**
     * @return array<class-string<\Rector\Contract\Rector\RectorInterface>>
     */
    public static function getTypeDeclarationRules(): array
    {
        $ruleMap = [
            \Rector\TypeDeclaration\Rector\Class_\ReturnTypeFromStrictTernaryRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictTernaryRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanConstReturnsRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanStrictReturnsRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\NumericReturnTypeFromStrictReturnsRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleNumericReturnTypeFromStrictReturnsRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\NumericReturnTypeFromStrictScalarReturnsRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleNumericReturnTypeFromStrictScalarReturnsRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnNullableTypeRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnNullableTypeRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnCastRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromReturnCastRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnDirectArrayRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromReturnDirectArrayRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnNewRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromReturnNewRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictConstantReturnRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictNativeCallRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNewArrayRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedPropertyRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictTypedPropertyRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\StringReturnTypeFromStrictScalarReturnsRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector::class,
            \Rector\TypeDeclaration\Rector\ClassMethod\StringReturnTypeFromStrictStringReturnsRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleStringReturnTypeFromStrictStringReturnsRector::class,
            \Rector\TypeDeclaration\Rector\FunctionLike\AddReturnTypeDeclarationFromYieldsRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddReturnTypeDeclarationFromYieldsRector::class,
            \Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector::class => \Art4\RectorBcLibrary\Rector\BackwardCompatibleTypedPropertyFromStrictConstructorRector::class,
        ];

        $rules = [];

        foreach (\Rector\Config\Level\TypeDeclarationLevel::RULES as $rule) {
            if (\array_key_exists($rule, $ruleMap)) {
                // Replace rule with our backward-compatible wrapper
                $rule = $ruleMap[$rule];
            }

            $rules[] = $rule;
        }

        return $rules;
    }

    /**
     * Raise your type coverage from the safest type rules
     * to more affecting ones, one level at a time
     *
     * Use this method in consumer projects instead of RectorConfig::configure()->withTypeCoverageLevel():
     *
     *   RectorConfig::configure()
     *     ->withRules([\Art4\RectorBcLibrary\Set::withTypeCoverageLevel(0)])
     *   ;
     *
     * @return array<class-string<\Rector\Contract\Rector\RectorInterface>>
     */
    public static function withTypeCoverageLevel(int $level): array
    {
        if ($level < 0) {
            throw new \InvalidArgumentException(
                \sprintf('Expected a non-negative integer. Got: %s', $level)
            );
        }

        $levelRules = \Rector\Configuration\Levels\LevelRulesResolver::resolve($level, self::getTypeDeclarationRules(), __METHOD__);

        $levelRulesCount = \count($levelRules);
        $maxLevelGap = 10;

        if ($levelRulesCount + $maxLevelGap < $level) {
            throw new \DomainException(\sprintf(
                <<<'TEXT'
                    The "->withRules(\%1$s::%2$s())" level contains only %3$d rules, but you set level to %4$s. You are using the full set now!

                    Time to switch to the more efficient set:

                    ->withSets([
                        \%1$s::BC_TYPE_DECLARATION
                    ])
                    TEXT,
                __CLASS__,
                __FUNCTION__,
                $levelRulesCount,
                $level
            ));
        }

        return $levelRules;
    }
}
