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
                8 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector::class,
                9 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector::class,
                10 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector::class,
                11 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleNumericReturnTypeFromStrictScalarReturnsRector::class,
                12 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector::class,
                13 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleStringReturnTypeFromStrictStringReturnsRector::class,
                14 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleNumericReturnTypeFromStrictReturnsRector::class,
                15 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictTernaryRector::class,
                16 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromReturnDirectArrayRector::class,
                17 => \Rector\Symfony\CodeQuality\Rector\ClassMethod\ResponseReturnTypeControllerActionRector::class,
                18 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromReturnNewRector::class,
                19 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromReturnCastRector::class,
                20 => \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromSymfonySerializerRector::class,
                21 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector::class,
                22 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictTypedPropertyRector::class,
                23 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnNullableTypeRector::class,
                24 => \Rector\TypeDeclaration\Rector\Empty_\EmptyOnNullableObjectToInstanceOfRector::class,
                25 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleTypedPropertyFromStrictConstructorRector::class,
                26 => \Rector\TypeDeclaration\Rector\FunctionLike\AddParamTypeSplFixedArrayRector::class,
                27 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddReturnTypeDeclarationFromYieldsRector::class,
                28 => \Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeBasedOnPHPUnitDataProviderRector::class,
                29 => \Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictSetUpRector::class,
                30 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictNativeCallRector::class,
                31 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddReturnTypeFromTryCatchTypeRector::class,
                32 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictTypedCallRector::class,
                33 => \Rector\TypeDeclaration\Rector\Class_\ChildDoctrineRepositoryClassTypeRector::class,
                34 => \Rector\TypeDeclaration\Rector\ClassMethod\KnownMagicClassMethodTypeRector::class,
                35 => \Rector\TypeDeclaration\Rector\ClassMethod\AddMethodCallBasedStrictParamTypeRector::class,
                36 => \Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByParentCallTypeRector::class,
                37 => \Rector\TypeDeclaration\Rector\ClassMethod\NarrowObjectReturnTypeRector::class,
                38 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnUnionTypeRector::class,
                39 => \Rector\TypeDeclaration\Rector\Closure\AddClosureNeverReturnTypeRector::class,
                40 => \Rector\TypeDeclaration\Rector\FunctionLike\AddClosureParamTypeForArrayMapRector::class,
                41 => \Rector\TypeDeclaration\Rector\FunctionLike\AddClosureParamTypeForArrayReduceRector::class,
                42 => \Rector\TypeDeclaration\Rector\Closure\ClosureReturnTypeRector::class,
                43 => \Rector\TypeDeclaration\Rector\FuncCall\AddArrowFunctionParamArrayWhereDimFetchRector::class,
                44 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictParamRector::class,
                45 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddParamTypeFromPropertyTypeRector::class,
                46 => \Rector\TypeDeclaration\Rector\Class_\MergeDateTimePropertyTypeDeclarationRector::class,
                47 => \Rector\TypeDeclaration\Rector\Class_\PropertyTypeFromStrictSetterGetterRector::class,
                48 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleParamTypeByMethodCallTypeRector::class,
                49 => \Rector\TypeDeclaration\Rector\Property\TypedPropertyFromAssignsRector::class,
                50 => \Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationBasedOnParentClassMethodRector::class,
                51 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictFluentReturnRector::class,
                52 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnNeverTypeRector::class,
                53 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleStrictStringParamConcatRector::class,
                54 => \Rector\TypeDeclaration\Rector\Class_\ObjectTypedPropertyFromJMSSerializerAttributeTypeRector::class,
                55 => \Rector\TypeDeclaration\Rector\Class_\ScalarTypedPropertyFromJMSSerializerAttributeTypeRector::class,
                56 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleStrictArrayParamDimFetchRector::class,
                57 => \Art4\RectorBcLibrary\Rector\BackwardCompatibleAddParamFromDimFetchKeyUseRector::class,
                58 => \Rector\TypeDeclaration\Rector\ClassMethod\AddParamStringTypeFromSprintfUseRector::class,
                59 => \Rector\TypeDeclaration\Rector\FuncCall\AddArrayFunctionClosureParamTypeRector::class,
                60 => \Rector\TypeDeclaration\Rector\Class_\TypedPropertyFromDocblockSetUpDefinedRector::class,
                61 => \Rector\TypeDeclaration\Rector\FunctionLike\AddClosureParamTypeFromIterableMethodCallRector::class,
                62 => \Rector\TypeDeclaration\Rector\Class_\TypedStaticPropertyInBehatContextRector::class,
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
            63,
            Set::withTypeCoverageLevel(63)
        );
    }

    /**
     * Adjust the expected count if Rector rules are added.
     */
    public function testWithTypeCoverageLevelWithTooHighLevelThrowsException(): void
    {
        self::expectException(DomainException::class);
        self::expectExceptionMessage(<<<TEXT
            The "->withRules(\Art4\RectorBcLibrary\Set::withTypeCoverageLevel())" level contains only 63 rules, but you set level to 75. You are using the full set now!

            Time to switch to the more efficient set:

            ->withSets([
                \Art4\RectorBcLibrary\Set::BC_TYPE_DECLARATION
            ])
            TEXT);

        Set::withTypeCoverageLevel(75);
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
