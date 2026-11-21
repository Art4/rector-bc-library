<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorReturnType\ReturnNeverTypeRectorTargetPhp74;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Configuration\Option;
use Rector\Configuration\Parameter\SimpleParameterProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Rector\ValueObject\PhpVersion;

final class ReturnNeverTypeRectorTargetPhp74Test extends AbstractRectorTestCase
{
    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        // older Rector versions do not reset the PHP version of a test class
        SimpleParameterProvider::setParameter(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_10);
    }

    /** @dataProvider provideCases */
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
