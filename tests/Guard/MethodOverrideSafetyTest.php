<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests\Guard;

use Art4\RectorBcLibrary\Guard\MethodOverrideSafety;
use Iterator;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class MethodOverrideSafetyTest extends TestCase
{
    /** @dataProvider provideCases */
    #[DataProvider('provideCases')]
    public function test(int $flags, bool $classIsFinal, bool $expected): void
    {
        $method = new ClassMethod('run', ['flags' => $flags]);

        self::assertSame($expected, MethodOverrideSafety::isSafeToModify($method, $classIsFinal));
    }

    /** @return Iterator<string, array{int, bool, bool}> */
    public static function provideCases(): Iterator
    {
        yield 'public method in non-final class' => [Class_::MODIFIER_PUBLIC, false, false];
        yield 'protected method in non-final class' => [Class_::MODIFIER_PROTECTED, false, false];
        yield 'final public method in non-final class' => [Class_::MODIFIER_PUBLIC | Class_::MODIFIER_FINAL, false, true];
        yield 'final protected method in non-final class' => [Class_::MODIFIER_PROTECTED | Class_::MODIFIER_FINAL, false, true];
        yield 'private method in non-final class' => [Class_::MODIFIER_PRIVATE, false, true];
        yield 'public method in final class' => [Class_::MODIFIER_PUBLIC, true, true];
        yield 'protected method in final class' => [Class_::MODIFIER_PROTECTED, true, true];
        yield 'private method in final class' => [Class_::MODIFIER_PRIVATE, true, true];
    }
}
