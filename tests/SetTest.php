<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests;

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Art4\RectorBcLibrary\Set;
use DomainException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Rector\Config\Level\TypeDeclarationLevel;
use Rector\Contract\Rector\RectorInterface;

final class SetTest extends TestCase
{
    public function testGetTypeDeclarationRulesReturnsExplicitAllowlist(): void
    {
        $rules = Set::getTypeDeclarationRules();
        $guardMap = Set::getRuleGuardMap();

        // All returned rules must not be in the guard map
        foreach ($rules as $rule) {
            self::assertArrayNotHasKey(
                $rule,
                $guardMap,
                \sprintf('Rule %s is in the guard map but also in the explicit allowlist', $rule)
            );
        }

        // All TypeDeclarationLevel::RULES must be covered by guard map + allowlist
        $covered = array_merge(array_keys($guardMap), $rules);
        $missing = array_diff(TypeDeclarationLevel::RULES, $covered);

        self::assertEmpty(
            $missing,
            \sprintf(
                'These rules from TypeDeclarationLevel::RULES are not covered by the guard map or explicit allowlist: %s',
                implode(', ', $missing)
            )
        );
    }

    public function testGetRuleGuardMapCoversAllWrappedRules(): void
    {
        $guardMap = Set::getRuleGuardMap();

        foreach ($guardMap as $originalRectorClass => $guard) {
            self::assertContains($guard, [
                BackwardCompatibleRector::GUARD_RETURN_TYPE,
                BackwardCompatibleRector::GUARD_PARAM_TYPE,
                BackwardCompatibleRector::GUARD_PARAM_TYPE_ON_CLASS,
                BackwardCompatibleRector::GUARD_PROPERTY_TYPE,
            ]);
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
