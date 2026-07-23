<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamType\ScalarParamTypeByMethodCallTypeRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class ScalarParamTypeByMethodCallTypeRectorTest extends AbstractRectorTestCase
{
    #[DataProvider('provideCases')]
    public function test(string $filePath): void
    {
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
