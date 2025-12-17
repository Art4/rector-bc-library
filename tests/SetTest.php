<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests;

use Art4\RectorBcLibrary\Set;
use DomainException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class SetTest extends TestCase
{
    /**
     * Adjust the expected count if Rector rules are added or removed.
     */
    public function testGetTypeDeclarationRulesReturnsCorrectNumberOfRules(): void
    {
        self::assertCount(
            63,
            Set::getTypeDeclarationRules()
        );
    }

    /**
     * Adjust the expected count if Rector rules are removed.
     */
    public function testWithTypeCoverageLevelReturnsCorrectNumberOfRules(): void
    {
        self::assertCount(
            63,
            Set::withTypeCoverageLevel(63)
        );
    }

    /**
     * Adjust the expected count if Rector rules are added.
     */
    public function testWithTypeCoverageLevelWithTooHighLevelThrowsException(): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage(<<<TEXT
            The "->withRules(\Art4\RectorBcLibrary\Set::withTypeCoverageLevel())" level contains only 63 rules, but you set level to 75. You are using the full set now!

            Time to switch to the more efficient set:

            ->withSets([
                \Art4\RectorBcLibrary\Set::BC_TYPE_DECLARATION
            ])
            TEXT);

        Set::withTypeCoverageLevel(75);
    }

    /**
     * Adjust the expected count if Rector rules are added.
     */
    public function testWithTypeCoverageLevelWithNegativeLevelThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected a non-negative integer. Got: -1');

        Set::withTypeCoverageLevel(-1);
    }
}
