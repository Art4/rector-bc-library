# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

For the full contributor guide (BC compatibility matrix rationale, how-to-wrap-a-new-rector walkthrough, fixture-file format, test-class boilerplate) read **[AGENTS.md](AGENTS.md)** — this file only covers what's needed to orient and run checks.

## What this is

`art4/rector-bc-library` wraps 34 of Rector's type-declaration rules so they're safe for library maintainers: instead of blindly adding/narrowing a type, each wrapped rule first consults a **Guard** that checks whether the change could break downstream code that extends or calls the modified class (final/private status, per the Symfony BC Promise). Another 40 type-declaration rules are reviewed as already BC-safe and pass through unwrapped. PHP `^7.4 || ^8.0`; runtime dep is `rector/rector >=2.3, <2.6`.

## Commands

```bash
composer test        # phpunit + phpstan + cs:check — run before considering any change done
composer phpunit      # PHPUnit only
composer phpstan      # PHPStan level 10, 512M memory limit
composer cs           # PHP-CS-Fixer, applies fixes
composer cs:check     # PHP-CS-Fixer, dry-run/diff only
composer coverage     # HTML + clover coverage, requires Xdebug
```

Run a single test file or case directly (composer scripts don't take extra args):

```bash
vendor/bin/phpunit tests/SetTest.php
vendor/bin/phpunit --filter testGetTypeDeclarationRulesReturnsExplicitAllowlist
vendor/bin/phpunit tests/Rector/BackwardCompatibleRectorParamType/AddParamTypeFromPropertyTypeRector
```

If the host PHP lacks required extensions, run inside Docker: `docker run --rm -v "$(pwd):/app" -w /app php:8.3-cli php vendor/bin/phpunit`.

## Architecture

One `BackwardCompatibleRector` ([src/Rector/BackwardCompatibleRector.php](src/Rector/BackwardCompatibleRector.php)) replaces what used to be 30 separate wrapper classes. It's configured statically *before* Rector runs, then dispatches per-node at runtime:

```php
BackwardCompatibleRector::setContainer($rectorConfig);
BackwardCompatibleRector::addRuleConfiguration(SomeOriginalRector::class, BackwardCompatibleRector::GUARD_RETURN_TYPE);
$rectorConfig->rule(BackwardCompatibleRector::class);
```

[config/set/bc-type-declaration.php](config/set/bc-type-declaration.php) — the set consumers import — just loops `Set::getRuleGuardMap()` and calls `addRuleConfiguration()` for each entry, so wiring a new rule into the published set never touches the config file.

`refactor()` iterates every configured rule, and for each one whose `getNodeTypes()` matches the current node, resolves the original Rector out of the static `RectorConfig` container and delegates to one of two guard strategies:

- **`GUARD_RETURN_TYPE`** (early return) — `BackwardCompatibleClassMethodReturnTypeOverrideGuard` checks the node *before* the original Rector runs; if `shouldSkipClassMethod()` says the method isn't final/private and the class isn't final, the change is skipped outright.
- **`GUARD_PARAM_TYPE` / `GUARD_PARAM_TYPE_ON_CLASS` / `GUARD_PROPERTY_TYPE`** (protect → run → restore) — the guard sets a sentinel type (`__SKIP_ADDING_PARAMETER_TYPE__` / `__SKIP_ADDING_PROPERTY_TYPE__`) on untyped members so the original Rector thinks they're already typed and leaves them alone, runs the original Rector, then restores the sentinel back to null. `_ON_CLASS` applies this around every method of a `Class_` node instead of a single `ClassMethod`. There is no try/finally here — an exception from the original Rector between protect and restore leaves the sentinel type in the AST.

`Set.php` ([src/Set.php](src/Set.php)) is the package's only public API:
- `BC_TYPE_DECLARATION` — path constant to the set config, for `withSets()`.
- `getRuleGuardMap()` — the 34 rule → guard-strategy mappings that get wrapped.
- `getTypeDeclarationRules()` — an explicit allowlist of rules from `TypeDeclarationLevel::RULES` reviewed as already BC-safe and passed through unwrapped.
- `withTypeCoverageLevel()` — gradual-adoption helper; use instead of Rector's own `withTypeCoverageLevel()` so results stay scoped to the reviewed-safe allowlist. Has a Rector 2.3/2.4 compat fallback for `LevelRulesResolver` throwing on rules that don't implement `RectorInterface`.

`tests/SetTest.php` asserts the guard map and the allowlist never overlap and together cover every rule in `TypeDeclarationLevel::RULES` — extending either list without updating the other fails this test.

## Notes

- All classes are `final`. Static state (`$container`, `$ruleConfigs`) must be cleared between tests with `clearContainer()`/`clearRuleConfigurations()` (see any `config/configured_rule.php` under `tests/Rector/`).
