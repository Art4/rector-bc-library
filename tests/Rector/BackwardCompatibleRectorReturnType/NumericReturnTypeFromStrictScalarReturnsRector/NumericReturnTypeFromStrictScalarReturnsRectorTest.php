<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\NumericReturnTypeFromStrictScalarReturnsRector;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class NumericReturnTypeFromStrictScalarReturnsRectorTest extends AbstractRectorTestCase
{
    /** @dataProvider provideCases */
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
