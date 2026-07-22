<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleScalarParamTypeByMethodCallTypeRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class BackwardCompatibleScalarParamTypeByMethodCallTypeRectorTest extends AbstractRectorTestCase
{
    protected function setUp(): void
    {
        if (!class_exists(\Rector\TypeDeclaration\Rector\ClassMethod\ScalarParamTypeByMethodCallTypeRector::class)) {
            self::markTestSkipped('ScalarParamTypeByMethodCallTypeRector is not available in this Rector version');
        }

        parent::setUp();
    }

    /**
     * @dataProvider provideCases
     */
    #[DataProvider('provideCases')]
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    /**
     * @return Iterator<int, string>
     */
    public static function provideCases(): Iterator
    {
        return self::yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
