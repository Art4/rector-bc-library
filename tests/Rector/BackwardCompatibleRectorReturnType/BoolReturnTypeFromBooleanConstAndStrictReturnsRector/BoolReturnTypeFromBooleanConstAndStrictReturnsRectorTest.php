<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\BoolReturnTypeFromBooleanConstAndStrictReturnsRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class BoolReturnTypeFromBooleanConstAndStrictReturnsRectorTest extends AbstractRectorTestCase
{
    /** @dataProvider provideCases */
    #[DataProvider('provideCases')]
    public function test(string $filePath): void
    {
        if (!class_exists(\Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanConstAndStrictReturnsRector::class)) {
            self::markTestSkipped('Rule was added in Rector 2.7');
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
