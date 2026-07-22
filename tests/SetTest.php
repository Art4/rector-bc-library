<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests;

use Art4\RectorBcLibrary\Set;
use DomainException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class SetTest extends TestCase
{
    /**
     * Adjust the expected resulte if Rector rules are changed.
     */
    public function testGetTypeDeclarationRulesReturnsCorrectListOfRules(): void
    {
        self::assertSame(
            [
                0 => \Rector\TypeDeclaration\Rector\Closure\AddClosureVoidReturnTypeWhereNoReturnRector::class,
                1 => \Rector\TypeDeclaration\Rector\Function_\AddFunctionVoidReturnTypeWhereNoReturnRector::class,
                2 => \Rector\TypeDeclaration\Rector\Class_\AddTestsVoidReturnTypeWhereNoReturnRector::class,
                3 => \Rector\CodeQuality\Rector\Class_\ReturnIteratorInDataProviderRector::class,
                4 => \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromMockObjectRector::class,
                5 => \Rector\TypeDeclaration\Rector\Class_\TypedPropertyFromCreateMockAssignRector::class,
                6 => \Rector\TypeDeclaration\Rector\ArrowFunction\AddArrowFunctionReturnTypeRector::class,
                7 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector::class,
                8 => \Rector\TypeDeclaration\Rector\ClassMethod\PrivateMethodReturnTypeFromStrictNewArrayRector::class,
                9 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector::class,
                10 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector::class,
                11 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector::class,
                12 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleNumericReturnTypeFromStrictScalarReturnsRector::class,
                13 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector::class,
                14 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleStringReturnTypeFromStrictStringReturnsRector::class,
                15 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleNumericReturnTypeFromStrictReturnsRector::class,
                16 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictTernaryRector::class,
                17 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromReturnDirectArrayRector::class,
                18 => \Rector\Symfony\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector::class,
                19 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromReturnNewRector::class,
                20 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromReturnCastRector::class,
                21 => \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromSymfonySerializerRector::class,
                22 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector::class,
                23 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictTypedPropertyRector::class,
                24 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnNullableTypeRector::class,
                25 => \Rector\TypeDeclaration\Rector\Empty_\EmptyOnNullableObjectToInstanceOfRector::class,
                26 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleTypedPropertyFromStrictConstructorRector::class,
                27 => \Rector\TypeDeclaration\Rector\FunctionLike\AddParamTypeSplFixedArrayRector::class,
                28 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddReturnTypeDeclarationFromYieldsRector::class,
                29 => \Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeBasedOnPHPUnitDataProviderRector::class,
                30 => \Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictSetUpRector::class,
                31 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictNativeCallRector::class,
                32 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddReturnTypeFromTryCatchTypeRector::class,
                33 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictTypedCallRector::class,
                34 => \Rector\TypeDeclaration\Rector\Class_\ChildDoctrineRepositoryClassTypeRector::class,
                35 => \Rector\TypeDeclaration\Rector\ClassMethod\KnownMagicClassMethodTypeRector::class,
                36 => \Rector\TypeDeclaration\Rector\ClassMethod\AddMethodCallBasedStrictParamTypeRector::class,
                37 => \Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByParentCallTypeRector::class,
                38 => \Rector\TypeDeclaration\Rector\ClassMethod\NarrowObjectReturnTypeRector::class,
                39 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnUnionTypeRector::class,
                40 => \Rector\TypeDeclaration\Rector\Closure\AddClosureNeverReturnTypeRector::class,
                41 => \Rector\TypeDeclaration\Rector\FunctionLike\AddClosureParamTypeForArrayMapRector::class,
                42 => \Rector\TypeDeclaration\Rector\FunctionLike\AddClosureParamTypeForArrayReduceRector::class,
                43 => \Rector\TypeDeclaration\Rector\Closure\ClosureReturnTypeRector::class,
                44 => \Rector\TypeDeclaration\Rector\FuncCall\AddArrowFunctionParamArrayWhereDimFetchRector::class,
                45 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictParamRector::class,
                46 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddParamTypeFromPropertyTypeRector::class,
                47 => \Rector\TypeDeclaration\Rector\Class_\MergeDateTimePropertyTypeDeclarationRector::class,
                48 => \Rector\TypeDeclaration\Rector\Class_\PropertyTypeFromStrictSetterGetterRector::class,
                49 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleParamTypeByMethodCallTypeRector::class,
                50 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleObjectParamTypeByMethodCallTypeRector::class,
                51 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleScalarParamTypeByMethodCallTypeRector::class,
                52 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleArrayParamTypeByMethodCallTypeRector::class,
                53 => \Rector\TypeDeclaration\Rector\Class_\TypedPropertyFromContainerGetSetUpRector::class,
                54 => \Rector\TypeDeclaration\Rector\Class_\TypedPropertyFromGetRepositorySetUpRector::class,
                55 => \Rector\TypeDeclaration\Rector\Property\TypedPropertyFromAssignsRector::class,
                56 => \Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationBasedOnParentClassMethodRector::class,
                57 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictFluentReturnRector::class,
                58 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnNeverTypeRector::class,
                59 => \Rector\TypeDeclaration\Rector\Class_\ObjectTypedPropertyFromJMSSerializerAttributeTypeRector::class,
                60 => \Rector\TypeDeclaration\Rector\Class_\ScalarTypedPropertyFromJMSSerializerAttributeTypeRector::class,
                61 => \Rector\TypeDeclaration\Rector\FunctionLike\AddClosureParamTypeFromVariableCallRector::class,
                62 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleStrictArrayParamDimFetchRector::class,
                63 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddParamFromDimFetchKeyUseRector::class,
                64 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddParamStringTypeFromSprintfUseRector::class,
                65 => \Rector\TypeDeclaration\Rector\FuncCall\AddArrayFunctionClosureParamTypeRector::class,
                66 => \Rector\TypeDeclaration\Rector\Class_\TypedPropertyFromDocblockSetUpDefinedRector::class,
                67 => \Rector\TypeDeclaration\Rector\FunctionLike\AddClosureParamTypeFromIterableMethodCallRector::class,
                68 => \Rector\TypeDeclaration\Rector\Class_\TypedStaticPropertyInBehatContextRector::class,
                69 => \Rector\TypeDeclaration\Rector\FuncCall\NarrowArrayAnyAllNullableParamTypeRector::class,
                70 => \Rector\TypeDeclaration\Rector\FuncCall\AddArrayAnyAllClosureParamTypeRector::class,
                71 => \Rector\TypeDeclaration\Rector\Closure\ClosureReturnTypeFromAssertInstanceOfRector::class,
                72 => \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromGetRepositoryDocblockRector::class,
            ],
            Set::getTypeDeclarationRules()
        );
    }

    /**
     * Adjust the expected count if Rector rules are removed.
     */
    public function testWithTypeCoverageLevelReturnsCorrectNumberOfRules(): void
    {
        self::assertCount(
            73,
            Set::withTypeCoverageLevel(73)
        );
    }

    /**
     * Adjust the expected count if Rector rules are added.
     */
    public function testWithTypeCoverageLevelWithTooHighLevelThrowsException(): void
    {
        self::expectException(DomainException::class);
        self::expectExceptionMessage(<<<TEXT
            The "->withRules(\Art4\RectorBcLibrary\Set::withTypeCoverageLevel())" level contains only 73 rules, but you set level to 85. You are using the full set now!

            Time to switch to the more efficient set:

            ->withSets([
                \Art4\RectorBcLibrary\Set::BC_TYPE_DECLARATION
            ])
            TEXT);

        Set::withTypeCoverageLevel(85);
    }

    /**
     * Adjust the expected count if Rector rules are added.
     */
    public function testWithTypeCoverageLevelWithNegativeLevelThrowsException(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Expected a non-negative integer. Got: -1');

        Set::withTypeCoverageLevel(-1);
    }
}
