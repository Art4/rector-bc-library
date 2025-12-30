<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleParamTypeByMethodCallTypeRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class BackwardCompatibleParamTypeByMethodCallTypeRectorTest extends AbstractRectorTestCase
{
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
        //return self::yieldFilesFromDirectory(__DIR__ . '/Fixture', 'skip_type_for_protected_property_on_non_final_class.php.inc');
        return self::yieldFilesFromDirectory(__DIR__ . '/Fixture', 'add_parameter_type_on_final_class.php.inc');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
