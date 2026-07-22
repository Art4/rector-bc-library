# Repository Guide for AI Coding Assistants

## Project Overview

**art4/rector-bc-library** — a PHP library that wraps 29 of Rector's type-declaration rules to make them backward-compatible safe for library maintainers. Instead of blindly adding/narrowing types, each wrapped rule consults a **Guard** that checks whether the change would break downstream consumers that extend or call the modified class.

- **PHP:** `^7.4 || ^8.0`
- **Runtime dependency:** `rector/rector ^2.3`
- **Dev tools:** PHPUnit, PHPStan (level 10), PHP-CS-Fixer

---

## Directory Structure

```
src/
├── Guard/                        # BC heuristics (decide if a change is safe)
│   ├── BackwardCompatibleClassMethodReturnTypeOverrideGuard.php
│   ├── BackwardCompatibleParameterTypeOverrideGuard.php
│   └── BackwardCompatiblePropertyTypeOverrideGuard.php
├── Rector/
│   └── BackwardCompatibleRector.php  # Single configurable wrapper (replaces 30 classes)
├── Set.php                       # Public API: rule mapping, level helper, set constant
config/set/
└── bc-type-declaration.php       # Rector set config (consumers import this)
tests/
├── SetTest.php                   # Verifies pass-through rule list, guard map, level logic
└── Rector/                       # 3 consolidated test directories
    ├── BackwardCompatibleRectorReturnType/
    ├── BackwardCompatibleRectorParamType/
    └── BackwardCompatibleRectorPropertyType/
        ├── <GuardStrategy>Test.php
        ├── config/configured_rule.php
        └── Fixture/*.php.inc
```

---

## Core Architecture: Single BackwardCompatibleRector + Static Config

Instead of 30 separate wrapper classes (old design), a single `BackwardCompatibleRector` is configured via static methods before Rector runs:

```php
BackwardCompatibleRector::setContainer($rectorConfig);
BackwardCompatibleRector::addRuleConfiguration(
    AddVoidReturnTypeWhereNoReturnRector::class,
    BackwardCompatibleRector::GUARD_RETURN_TYPE
);
$rectorConfig->rule(BackwardCompatibleRector::class);
```

The config in `config/set/bc-type-declaration.php` iterates `Set::getRuleGuardMap()` to register all 29 rule→guard mappings at once.

At runtime, `BackwardCompatibleRector::refactor()` iterates all configured rules, delegates matching nodes to the correct guard strategy, and returns the first non-null result.

### Two Guard Strategies

#### Strategy A: Early Return (GUARD_RETURN_TYPE)

Used for return-type changes. The guard checks **before** the original Rector runs.

```
refactor(node):
    if guard.shouldSkipClassMethod(node) → return null (skip)
    return originalRector.refactor(node)
```

**Guard:** `BackwardCompatibleClassMethodReturnTypeOverrideGuard`
- Wraps Rector's built-in `ClassMethodReturnTypeOverrideGuard`, adds Symfony BC checks
- Skips if: method is NOT final, NOT private, AND class is NOT final

#### Strategy B: Protect + Restore (GUARD_PARAM_TYPE / GUARD_PROPERTY_TYPE)

Used for parameter-type and property-type changes. The guard temporarily **protects** untyped members by setting a sentinel type, runs the original Rector (which skips members it thinks are already typed), then **restores** the original state.

```
refactor(node):
    guard.protect(node)          # set sentinel type on untyped members
    result = originalRector.refactor(node)
    guard.unprotect(node)        # restore null on sentinel members
    return result
```

**Guards:**
- `BackwardCompatibleParameterTypeOverrideGuard` — sentinel: `__SKIP_ADDING_PARAMETER_TYPE__`
- `BackwardCompatiblePropertyTypeOverrideGuard` — sentinel: `__SKIP_ADDING_PROPERTY_TYPE__`

GUARD_PARAM_TYPE_ON_CLASS wraps the protect/restore around `Class_` nodes and iterates the class methods.

### Warning: Sentinel Pattern

The protect/restore strategy mutates the AST temporarily. If the original Rector throws an exception between `protect()` and `unprotect()`, the AST is left with the sentinel type. Handle with care — the current code does NOT use `try-finally`.

---

## BC Compatibility Rules

These rules (from README, Symfony BC Promise) determine what changes are safe:

### Properties

| Change                        | final class | not-final |
|-------------------------------|-------------|-----------|
| Add type to public property   | phpdoc only | phpdoc only |
| Add type to protected property| Yes         | No        |
| Add type to private property  | Yes         | Yes       |

### Public / Protected Methods

| Change                        | final class | final method | not-final |
|-------------------------------|-------------|--------------|-----------|
| Add/Remove/Change param type  | Yes         | Yes          | No        |
| Add return type               | Yes         | Yes          | No        |
| Remove return type            | Yes         | Yes          | void only |
| Change return type            | Yes         | Yes          | No        |

### Private Methods

All changes are always allowed.

---

## How to Wrap a New Original Rector

### 1. Determine which Guard to use

| If the rule changes...            | Use Guard                                      | Strategy      |
|----------------------------------|------------------------------------------------|---------------|
| Return type of a class method    | `GUARD_RETURN_TYPE`                            | Early return  |
| Parameter type of a method       | `GUARD_PARAM_TYPE`                             | Protect/restore |
| Parameter type (on Class_ node)  | `GUARD_PARAM_TYPE_ON_CLASS`                    | Protect/restore |
| Property type                    | `GUARD_PROPERTY_TYPE`                          | Protect/restore |

### 2. Add entry to `Set::getRuleGuardMap()` in `src/Set.php`

```php
\Rector\TypeDeclaration\Rector\<Group>\<OriginalRector>::class
    => BackwardCompatibleRector::GUARD_<STRATEGY>,
```

The set config (`config/set/bc-type-declaration.php`) consumes this map automatically — no config change needed.

### 3. If the original rule is in `TypeDeclarationLevel::RULES`

Update `WRAPPED_RULE_COUNT` in `tests/SetTest.php`. The pass-through count adjusts dynamically.

### 4. Add fixture tests

Create a guard-strategy test directory or add fixtures to an existing one:

```
tests/Rector/BackwardCompatibleRector<GuardStrategy>/
├── BackwardCompatibleRector<GuardStrategy>Test.php
├── config/configured_rule.php
└── Fixture/
    ├── add_<case>.php.inc
    └── skip_<case>.php.inc
```

### Config for a test

```php
// config/configured_rule.php
BackwardCompatibleRector::clearRuleConfigurations();
BackwardCompatibleRector::clearContainer();

return static function (RectorConfig $rectorConfig): void {
    BackwardCompatibleRector::setContainer($rectorConfig);
    BackwardCompatibleRector::addRuleConfiguration(
        OriginalRector::class,
        BackwardCompatibleRector::GUARD_<STRATEGY>
    );
    $rectorConfig->rule(BackwardCompatibleRector::class);
    $rectorConfig->skip([OriginalRector::class]);
};
```

---

## Test Conventions

### Directory structure per guard strategy

```
tests/Rector/BackwardCompatibleRector<GuardStrategy>/
├── BackwardCompatibleRector<GuardStrategy>Test.php
├── config/configured_rule.php
└── Fixture/
    ├── add_<case>.php.inc
    └── skip_<case>.php.inc
```

### Test class pattern

```php
final class BackwardCompatibleRector<Strategy>Test extends AbstractRectorTestCase
{
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
```

### Fixture naming conventions

- `add_*.php.inc` — files where the wrapper SHOULD apply the change
- `skip_*.php.inc` — files where the guard SHOULD block the change

A fixture is a before/after pair separated by `-----`:

```php
<?php
// Before: untyped public method in non-final class
class SomeClass
{
    public function getData()
    {
        return $this->getNumber();
    }
}
-----
<?php
// After: unchanged (guard skipped it) — for skip_ fixtures, after = before
```

For `add_*` fixtures, the after section shows the expected modified code.

---

## Commands

| Command                | What it runs                                      |
|------------------------|---------------------------------------------------|
| `composer test`        | phpunit + phpstan + cs:check                      |
| `composer phpunit`     | PHPUnit with phpunit.xml.dist                     |
| `composer phpstan`     | PHPStan level 10 (512MB memory)                   |
| `composer cs`          | Fix code style (PHP-CS-Fixer)                     |
| `composer cs:check`    | Dry-run style check                               |
| `composer coverage`    | Generate coverage (requires Xdebug)               |

**PHPStan:** Level 10, `treatPhpDocTypesAsCertain: false`, scans `src/` and `tests/`, includes phpstan-phpunit extension.

---

## CI Pipeline (.gitlab-ci.yml)

| Job              | PHP Versions     | Rector Versions | What it runs          |
|------------------|------------------|-----------------|-----------------------|
| phpstan-tests    | 7.4              | ^2.3            | PHPStan               |
| phpunit-tests    | 7.4, 8.0–8.5     | ^2.3            | PHPUnit               |
| rector-tests     | 7.4              | 2.3.*, dev-main | PHPUnit (Rector compat) |
| phpunit-coverage | 8.2              | ^2.3            | PHPUnit + Xdebug      |

---

## Code Style

Configured in `.php-cs-fixer.dist.php`:
- `@auto`, `@auto:risky`, `@PhpCsFixer:risky` rule sets
- `no_unused_imports` and `ordered_imports` enforced
- `php_unit_data_provider_return_type` disabled (PHP 7.4 compat)

---

## Key Details for Agents

- **`Set.php` is the public API.** It exports `BC_TYPE_DECLARATION` constant, `getTypeDeclarationRules()`, `getRuleGuardMap()`, and `withTypeCoverageLevel()`.
- **Rule mapping is in `Set::getRuleGuardMap()`.** 29 original rules are mapped to 4 guard strategies. 44 rules pass through unchanged.
- **Single rector class.** `BackwardCompatibleRector` uses a static container + static rule configs. Add new rules to the guard map, not as new classes.
- **Prefer adding/adjusting guards over changing rector logic.** The guards encapsulate the actual BC heuristics.
- **Always check `isFinal()` / `isPrivate()` / `isFinal() on class`** — these are the core BC checks.
- **PHP 7.4 compatible.** Avoid PHP 8.0+ syntax (named arguments, match, readonly properties, constructor property promotion, etc.).
- **All classes are `final`.**
- **Static container pattern.** `setContainer()` and `addRuleConfiguration()` must be called before the rector runs. Clear state between tests with `clearContainer()` and `clearRuleConfigurations()`.

---

## Quick Contribution Checklist

1. Run `composer test` and `composer cs` locally (use `docker run --rm -v "$(pwd):/app" -w /app php:8.3-cli php vendor/bin/phpunit` if host PHP lacks extensions).
2. Add entry to `Set::getRuleGuardMap()` in `src/Set.php`.
3. Update `WRAPPED_RULE_COUNT` in `tests/SetTest.php` if the set size changed.
4. Add fixture tests in the appropriate `tests/Rector/BackwardCompatibleRector*` directory.
5. Update `README.md` only if usage or supported levels change.
6. Update `CHANGELOG.md` with notable additions/changes.
