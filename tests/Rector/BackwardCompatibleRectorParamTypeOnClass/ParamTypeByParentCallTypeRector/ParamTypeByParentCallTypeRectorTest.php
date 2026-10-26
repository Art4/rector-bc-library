<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamTypeOnClass\ParamTypeByParentCallTypeRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class ParamTypeByParentCallTypeRectorTest extends AbstractRectorTestCase
{
    /** @dataProvider provideCases */
    #[DataProvider('provideCases')]
    public function test(string $filePath): void
    {
        if (!class_exists(\Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByParentCallTypeRector::class)
            || is_a(\Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByParentCallTypeRector::class, \Rector\Configuration\Deprecation\Contract\DeprecatedInterface::class, true)
        ) {
            self::markTestSkipped('Rule is missing or deprecated in the installed Rector version');
        }

        $this->doTestFile($filePath);
    }

    public static function provideCases(): Iterator
    {
        return self::yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
