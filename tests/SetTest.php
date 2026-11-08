<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests;

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Art4\RectorBcLibrary\Set;
use DomainException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Rector\Config\Level\TypeDeclarationLevel;
use Rector\Configuration\Deprecation\Contract\DeprecatedInterface;
use ReflectionClass;

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

    public function testSetContainsNoRulesOutsideTypeDeclarationLevel(): void
    {
        $ours = array_merge(array_keys(Set::getRuleGuardMap()), Set::getTypeDeclarationRules());
        $extra = [];

        foreach ($ours as $rule) {
            // Rules missing in the installed Rector or deprecated ones are never executed
            if (! class_exists($rule) || is_a($rule, DeprecatedInterface::class, true)) {
                continue;
            }

            // Rules moved to another namespace (Rector >= 2.8) stay available as class alias of the new name
            $resolvedRule = (new ReflectionClass($rule))->getName();

            if (! \in_array($resolvedRule, TypeDeclarationLevel::RULES, true)) {
                $extra[] = $rule;
            }
        }

        self::assertSame(
            [],
            $extra,
            \sprintf(
                'These rules are not part of TypeDeclarationLevel::RULES of the installed Rector, the set must not add more than the set it replaces: %s',
                implode(', ', $extra)
            )
        );
    }

    public function testGetTypeDeclarationRulesExcludesDeprecatedRules(): void
    {
        foreach (Set::getTypeDeclarationRules() as $rule) {
            self::assertFalse(
                is_a($rule, DeprecatedInterface::class, true),
                \sprintf('Rule %s is deprecated in the installed Rector version and must not be registered', $rule)
            );
        }
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

    public function testWithTypeCoverageLevelReturnsOnlyRulesUpToLevel(): void
    {
        $rules = Set::getTypeDeclarationRules();

        self::assertSame([$rules[0]], Set::withTypeCoverageLevel(0));
        self::assertSame(\array_slice($rules, 0, 3), Set::withTypeCoverageLevel(2));
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
