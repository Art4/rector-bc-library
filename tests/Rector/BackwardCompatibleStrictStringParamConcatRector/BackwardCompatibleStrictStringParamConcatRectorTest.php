<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleStrictStringParamConcatRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Config\Level\TypeDeclarationLevel;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class BackwardCompatibleStrictStringParamConcatRectorTest extends AbstractRectorTestCase
{
    protected function setUp(): void
    {
        // @phpstan-ignore function.impossibleType
        if (!\in_array(\Rector\TypeDeclaration\Rector\ClassMethod\StrictStringParamConcatRector::class, TypeDeclarationLevel::RULES, true)) {
            self::markTestSkipped('StrictStringParamConcatRector is not available in this Rector version');
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
