<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests;

use Art4\RectorBcLibrary\Guard\BackwardCompatibleClassMethodReturnTypeOverrideGuard;
use Art4\RectorBcLibrary\Guard\BackwardCompatibleParameterTypeOverrideGuard;
use Art4\RectorBcLibrary\Guard\BackwardCompatiblePropertyTypeOverrideGuard;
use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Art4\RectorBcLibrary\Tests\Fixture\ThrowingRector;
use PhpParser\Node;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use PhpParser\Node\Param;
use PhpParser\Node\PropertyItem;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use PHPStan\Analyser\Scope;
use PHPUnit\Framework\TestCase;
use Rector\Config\RectorConfig;
use Rector\NodeTypeResolver\Node\AttributeKey;
use ReflectionClass;
use RuntimeException;

// tests/ is not autoloaded (no autoload-dev in composer.json)
require_once __DIR__ . '/Fixture/ThrowingRector.php';

/**
 * The wrapper protects members with a sentinel type while the original rule
 * runs. If the original rule throws, the AST must not keep the sentinel.
 */
final class BackwardCompatibleRectorExceptionSafetyTest extends TestCase
{
    protected function tearDown(): void
    {
        BackwardCompatibleRector::clearRuleConfigurations();
        BackwardCompatibleRector::clearContainer();
    }

    public function testParamTypeSentinelIsRemovedWhenOriginalRuleThrows(): void
    {
        $param = new Param(new Variable('value'));
        $method = new ClassMethod('run', ['flags' => Class_::MODIFIER_PUBLIC, 'params' => [$param]]);
        $method->setAttribute(AttributeKey::SCOPE, self::createStub(Scope::class));

        $this->refactorAndExpectException(BackwardCompatibleRector::GUARD_PARAM_TYPE, [ClassMethod::class], $method);

        self::assertNull($param->type);
    }

    public function testParamTypeOnClassSentinelIsRemovedWhenOriginalRuleThrows(): void
    {
        $param = new Param(new Variable('value'));
        $method = new ClassMethod('run', ['flags' => Class_::MODIFIER_PUBLIC, 'params' => [$param]]);
        $method->setAttribute(AttributeKey::SCOPE, self::createStub(Scope::class));
        $class = new Class_('SomeClass', ['stmts' => [$method]]);

        $this->refactorAndExpectException(BackwardCompatibleRector::GUARD_PARAM_TYPE_ON_CLASS, [Class_::class], $class);

        self::assertNull($param->type);
    }

    public function testPropertyTypeSentinelIsRemovedWhenOriginalRuleThrows(): void
    {
        $property = new Property(Class_::MODIFIER_PROTECTED, [new PropertyItem('value')]);
        $class = new Class_('SomeClass', ['stmts' => [$property]]);

        $this->refactorAndExpectException(BackwardCompatibleRector::GUARD_PROPERTY_TYPE, [Class_::class], $class);

        self::assertNull($property->type);
    }

    public function testSentinelIsSetWhileOriginalRuleRuns(): void
    {
        // Guards against a vacuous pass: the tests above only mean something if protecting happens at all
        $property = new Property(Class_::MODIFIER_PROTECTED, [new PropertyItem('value')]);
        $class = new Class_('SomeClass', ['stmts' => [$property]]);

        $seen = null;
        ThrowingRector::$onRefactor = static function () use ($property, &$seen): void {
            $seen = $property->type;
        };

        $this->refactorAndExpectException(BackwardCompatibleRector::GUARD_PROPERTY_TYPE, [Class_::class], $class);

        self::assertInstanceOf(Identifier::class, $seen);
    }

    /** @param list<class-string<Node>> $nodeTypes */
    private function refactorAndExpectException(string $guard, array $nodeTypes, Node $node): void
    {
        ThrowingRector::$nodeTypes = $nodeTypes;

        BackwardCompatibleRector::setContainer(new RectorConfig());
        BackwardCompatibleRector::addRuleConfiguration(ThrowingRector::class, $guard);

        $rector = new BackwardCompatibleRector(
            (new ReflectionClass(BackwardCompatibleClassMethodReturnTypeOverrideGuard::class))->newInstanceWithoutConstructor(),
            new BackwardCompatibleParameterTypeOverrideGuard(),
            new BackwardCompatiblePropertyTypeOverrideGuard()
        );

        try {
            $rector->refactor($node);
            self::fail('Expected the original rule to throw');
        } catch (RuntimeException $exception) {
            self::assertSame('original rule failed', $exception->getMessage());
        }
    }

    protected function setUp(): void
    {
        ThrowingRector::$nodeTypes = [];
        ThrowingRector::$onRefactor = null;
    }
}
