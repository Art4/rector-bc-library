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
     * Explicit allowlist of type-declaration rules that are safe to pass through
     * without backward-compatibility wrapping. Each rule has been reviewed and
     * confirmed to be BC-safe (function/closure scope, private-only, test-only,
     * framework-specific, or has its own guard).
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
        return self::REVIEWED_SAFE_RULES;
    }

    /**
     * @var array<class-string<\Rector\Contract\Rector\RectorInterface>>
     */
    private const REVIEWED_SAFE_RULES = [
        // Group A: Function/Closure scope only — no class method/property risk
        \Rector\TypeDeclaration\Rector\Closure\AddClosureVoidReturnTypeWhereNoReturnRector::class,
        \Rector\TypeDeclaration\Rector\Function_\AddFunctionVoidReturnTypeWhereNoReturnRector::class,
        \Rector\TypeDeclaration\Rector\ArrowFunction\AddArrowFunctionReturnTypeRector::class,
        \Rector\TypeDeclaration\Rector\Closure\AddClosureNeverReturnTypeRector::class,
        \Rector\TypeDeclaration\Rector\Closure\ClosureReturnTypeRector::class,
        \Rector\TypeDeclaration\Rector\Closure\ClosureReturnTypeFromAssertInstanceOfRector::class,
        \Rector\TypeDeclaration\Rector\FunctionLike\AddClosureParamTypeForArrayMapRector::class,
        \Rector\TypeDeclaration\Rector\FunctionLike\AddClosureParamTypeForArrayReduceRector::class,
        \Rector\TypeDeclaration\Rector\FuncCall\AddArrowFunctionParamArrayWhereDimFetchRector::class,
        \Rector\TypeDeclaration\Rector\FunctionLike\AddClosureParamTypeFromVariableCallRector::class,
        \Rector\TypeDeclaration\Rector\FunctionLike\AddClosureParamTypeFromIterableMethodCallRector::class,
        \Rector\TypeDeclaration\Rector\FuncCall\AddArrayFunctionClosureParamTypeRector::class,
        \Rector\TypeDeclaration\Rector\FuncCall\AddArrayAnyAllClosureParamTypeRector::class,
        \Rector\TypeDeclaration\Rector\FuncCall\NarrowArrayAnyAllNullableParamTypeRector::class,
        // Group B: Private methods only — no external contract
        \Rector\TypeDeclaration\Rector\ClassMethod\PrivateMethodReturnTypeFromStrictNewArrayRector::class,
        // Group C: Test/infrastructure-specific context (restricted scope)
        \Rector\TypeDeclaration\Rector\Class_\AddTestsVoidReturnTypeWhereNoReturnRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromMockObjectRector::class,
        \Rector\TypeDeclaration\Rector\Class_\TypedPropertyFromCreateMockAssignRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeBasedOnPHPUnitDataProviderRector::class,
        \Rector\TypeDeclaration\Rector\Class_\TypedPropertyFromContainerGetSetUpRector::class,
        \Rector\TypeDeclaration\Rector\Class_\TypedPropertyFromGetRepositorySetUpRector::class,
        \Rector\TypeDeclaration\Rector\Class_\TypedPropertyFromDocblockSetUpDefinedRector::class,
        \Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictSetUpRector::class,
        \Rector\TypeDeclaration\Rector\Class_\TypedStaticPropertyInBehatContextRector::class,
        \Rector\TypeDeclaration\Rector\Class_\ChildDoctrineRepositoryClassTypeRector::class,
        \Rector\Symfony\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector::class,
        // Group D: Property type adders with their own guards (private-only or MakePropertyTypedGuard)
        \Rector\TypeDeclaration\Rector\Class_\MergeDateTimePropertyTypeDeclarationRector::class,
        \Rector\TypeDeclaration\Rector\Class_\PropertyTypeFromStrictSetterGetterRector::class,
        \Rector\TypeDeclaration\Rector\Property\TypedPropertyFromAssignsRector::class,
        \Rector\TypeDeclaration\Rector\Class_\ObjectTypedPropertyFromJMSSerializerAttributeTypeRector::class,
        \Rector\TypeDeclaration\Rector\Class_\ScalarTypedPropertyFromJMSSerializerAttributeTypeRector::class,
        // Group E: Param/Return type adders that are safe (private-only, has own guard, or copies parent)
        \Rector\TypeDeclaration\Rector\ClassMethod\AddMethodCallBasedStrictParamTypeRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\KnownMagicClassMethodTypeRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\NarrowObjectReturnTypeRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationBasedOnParentClassMethodRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromSymfonySerializerRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromGetRepositoryDocblockRector::class,
        \Rector\TypeDeclaration\Rector\FunctionLike\AddParamTypeSplFixedArrayRector::class,
        // Group F: Not type-declaration changes
        \Rector\TypeDeclaration\Rector\Empty_\EmptyOnNullableObjectToInstanceOfRector::class,
        \Rector\CodeQuality\Rector\Class_\ReturnIteratorInDataProviderRector::class,
    ];

    /**
     * @return array<class-string<\Rector\Contract\Rector\RectorInterface>, string>
     */
    public static function getRuleGuardMap(): array
    {
        return [
            \Rector\TypeDeclaration\Rector\Class_\ReturnTypeFromStrictTernaryRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector::class => BackwardCompatibleRector::GUARD_PROPERTY_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\AddParamFromDimFetchKeyUseRector::class => BackwardCompatibleRector::GUARD_PARAM_TYPE_ON_CLASS,
            \Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByParentCallTypeRector::class => BackwardCompatibleRector::GUARD_PARAM_TYPE_ON_CLASS,
            \Rector\TypeDeclaration\Rector\ClassMethod\AddParamStringTypeFromSprintfUseRector::class => BackwardCompatibleRector::GUARD_PARAM_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeFromPropertyTypeRector::class => BackwardCompatibleRector::GUARD_PARAM_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeFromTryCatchTypeRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanConstReturnsRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanStrictReturnsRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\NumericReturnTypeFromStrictReturnsRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\NumericReturnTypeFromStrictScalarReturnsRector::class => BackwardCompatibleRector::GUARD_RETURN_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByMethodCallTypeRector::class => BackwardCompatibleRector::GUARD_PARAM_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ObjectParamTypeByMethodCallTypeRector::class => BackwardCompatibleRector::GUARD_PARAM_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ScalarParamTypeByMethodCallTypeRector::class => BackwardCompatibleRector::GUARD_PARAM_TYPE,
            \Rector\TypeDeclaration\Rector\ClassMethod\ArrayParamTypeByMethodCallTypeRector::class => BackwardCompatibleRector::GUARD_PARAM_TYPE,
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

        try {
            $levelRules = \Rector\Configuration\Levels\LevelRulesResolver::resolve($level, self::getTypeDeclarationRules(), __METHOD__);
        } catch (\InvalidArgumentException $exception) {
            throw new \DomainException($exception->getMessage(), 0, $exception);
        }

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
