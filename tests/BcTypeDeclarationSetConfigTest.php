<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests;

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Art4\RectorBcLibrary\Set;
use PHPUnit\Framework\TestCase;
use Rector\Config\RectorConfig;

/**
 * End-to-end smoke test for the actual shipped set config, as opposed to the
 * per-rule fixture tests under tests/Rector/, which each configure only one
 * rule at a time and never load config/set/bc-type-declaration.php itself.
 *
 * RectorConfig::rule() asserts the class exists before registering it, so
 * this catches a rule (guard-mapped or reviewed-safe allowlist) that doesn't
 * exist yet in the installed Rector version -- exactly the bug that let an
 * unguarded Set::getTypeDeclarationRules() entry crash real `rector process`
 * runs on older Rector releases without ever failing our own test suite.
 */
final class BcTypeDeclarationSetConfigTest extends TestCase
{
    protected function tearDown(): void
    {
        BackwardCompatibleRector::clearRuleConfigurations();
        BackwardCompatibleRector::clearContainer();
    }

    public function testConfigRegistersEveryRuleWithoutThrowing(): void
    {
        $callable = require Set::BC_TYPE_DECLARATION;

        self::assertIsCallable($callable);

        /** @var callable(RectorConfig): void $callable */
        $rectorConfig = new RectorConfig();
        $callable($rectorConfig);

        self::assertNotEmpty(
            BackwardCompatibleRector::getRuleConfigurations(),
            'Expected the set config to register at least one guarded rule'
        );
    }
}
