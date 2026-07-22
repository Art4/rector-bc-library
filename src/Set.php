<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary;

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;

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
     * Returns the list of original type-declaration rules that pass through
     * without any backward-compatibility wrapping.
     *
     * To get the full set of backward-compatible rules, import the set config:
     *
     *   RectorConfig::configure()
     *     ->withSets([\Art4\RectorBcLibrary\Set::BC_TYPE_DECLARATION])
     *   ;
     *
     * @return array<class-string<\Rector\Contract\Rector\RectorInterface>>
     */
    public static function getTypeDeclarationRules(): array
    {
        $ruleGuardMap = self::getRuleGuardMap();
        $rules = [];

        foreach (\Rector\Config\Level\TypeDeclarationLevel::RULES as $rule) {
            if (! \array_key_exists($rule, $ruleGuardMap)) {
                $rules[] = $rule;
            }
        }

        return $rules;
    }

    /**
     * @return array<class-string<\Rector\Contract\Rector\RectorInterface>, string>
     */
    public static function getRuleGuardMap(): array
    {
        return [
            \Rector\TypeDeclaration\Rector\Class_\ReturnTypeFromStrictTernaryRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector::class => BackwardCompatibleRector::GUARD_PROPERTY_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\AddParamFromDimFetchKeyUseRector::class => BackwardCompatibleRector::GUARD_PARAM_TYPE_ON_CLASS,
            \Rector\TypeDeclaration\Rector\ClassMethod\AddParamStringTypeFromSprintfUseRector::class => BackwardCompatibleRector::GUARD_PARAM_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeFromPropertyTypeRector::class => BackwardCompatibleRector::GUARD_PARAM_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeFromTryCatchTypeRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanConstReturnsRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanStrictReturnsRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\NumericReturnTypeFromStrictReturnsRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\NumericReturnTypeFromStrictScalarReturnsRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByMethodCallTypeRector::class => BackwardCompatibleRector::GUARD_PARAM_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnNullableTypeRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnCastRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnDirectArrayRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnNewRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictConstantReturnRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictFluentReturnRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNewArrayRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictParamRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedPropertyRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ReturnUnionTypeRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\StringReturnTypeFromStrictScalarReturnsRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\StringReturnTypeFromStrictStringReturnsRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\StrictArrayParamDimFetchRector::class => BackwardCompatibleRector::GUARD_PARAM_TYPE,
            \Rector\TypeDeclaration\Rector\FunctionLike\AddReturnTypeDeclarationFromYieldsRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
        ];
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
