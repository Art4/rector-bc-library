<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests;

use Art4\RectorBcLibrary\Set;
use DomainException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Rector\Config\Level\TypeDeclarationLevel;
use Rector\Contract\Rector\RectorInterface;

final class SetTest extends TestCase
{
    public function testGetTypeDeclarationRulesReturnsCorrectListOfRules(): void
    {
        $rules = Set::getTypeDeclarationRules();

        self::assertCount(\count(TypeDeclarationLevel::RULES), $rules);

        foreach ($rules as $rule) {
            self::assertTrue(
                is_a($rule, RectorInterface::class, true),
                \sprintf('Rule %s does not implement RectorInterface', $rule)
            );
        }
    }

    public function testWithTypeCoverageLevelReturnsCorrectNumberOfRules(): void
    {
        $rules = Set::getTypeDeclarationRules();
        $level = \count($rules);

        self::assertCount(
            $level,
            Set::withTypeCoverageLevel($level)
        );
    }

    public function testWithTypeCoverageLevelWithTooHighLevelThrowsException(): void
    {
        $rules = Set::getTypeDeclarationRules();
        $maxLevel = \count($rules) + 20;

        self::expectException(DomainException::class);
        self::expectExceptionMessage(\sprintf(
            'The "->withRules(\Art4\RectorBcLibrary\Set::withTypeCoverageLevel())" level contains only %d rules, but you set level to %d. You are using the full set now!',
            \count(Set::getTypeDeclarationRules()),
            $maxLevel
        ));

        Set::withTypeCoverageLevel($maxLevel);
    }

    public function testWithTypeCoverageLevelWithNegativeLevelThrowsException(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Expected a non-negative integer. Got: -1');

        Set::withTypeCoverageLevel(-1);
    }
}
