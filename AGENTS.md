# Repository Guide for AI Coding Assistants

## Project Overview

**art4/rector-bc-library** — a PHP library that wraps 30 of Rector's type-declaration rules to make them backward-compatible safe for library maintainers. Instead of blindly adding/narrowing types, each wrapper consults a **Guard** that checks whether the change would break downstream consumers that extend or call the modified class.

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
├── Rector/                       # 30 wrapper Rector classes (BackwardCompatible*.php)
├── Set.php                       # Public API: rule mapping, level helper, set constant
config/set/
└── bc-type-declaration.php       # Rector set config (consumers import this)
tests/
├── SetTest.php                   # Snapshots the exact 63-rule list, tests level logic
└── Rector/                       # 30 test directories (one per wrapper rule)
    └── BackwardCompatible<X>/
        ├── <X>Test.php           # PHPUnit test extending AbstractRectorTestCase
        ├── config/configured_rule.php
        └── Fixture/*.php.inc     # before/after code pairs
```

---

## Core Architecture: Guard + Decorator

Every wrapper Rector follows one of **two strategies**:

### Strategy A: Early Return (Return-Type Guards)

Used for return-type changes. The guard checks **before** the original Rector runs.

```
refactor(node):
    if guard.shouldSkipClassMethod(node) → return null (skip)
    return originalRector.refactor(node)
```

**Guard:** `BackwardCompatibleClassMethodReturnTypeOverrideGuard`
- Wraps Rector's built-in `ClassMethodReturnTypeOverrideGuard`, adds Symfony BC checks
- Skips if: method is NOT final, NOT private, AND class is NOT final

### Strategy B: Protect + Restore (Parameter/Property Guards)

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

## How to Add a New Wrapper Rector Rule

### 1. Determine which Guard to use

| If the rule changes...            | Use Guard                                      | Strategy      |
|----------------------------------|------------------------------------------------|---------------|
| Return type of a class method    | `BackwardCompatibleClassMethodReturnTypeOverrideGuard` | Early return  |
| Parameter type of a method       | `BackwardCompatibleParameterTypeOverrideGuard`  | Protect/restore |
| Property type                    | `BackwardCompatiblePropertyTypeOverrideGuard`   | Protect/restore |

### 2. Create the wrapper class

Place it in `src/Rector/BackwardCompatible<Name>.php`. Pattern:

```php
final class BackwardCompatible<Name> extends AbstractRector implements MinPhpVersionInterface
{
    private OriginalRector $originalRector;
    private BackwardCompatible<X>Guard $guard;

    public function __construct(OriginalRector $originalRector, <GuardClass> $guard)
    {
        $this->originalRector = $originalRector;
        $this->guard = $guard;
    }

    // Delegate these to the original Rector:
    public function getRuleDefinition(): RuleDefinition { ... }
    public function getNodeTypes(): array { ... }
    public function provideMinPhpVersion(): int { ... }

    public function refactor(Node $node): ?Node
    {
        // For Strategy A (early return):
        if ($node instanceof ClassMethod && $this->guard->shouldSkipClassMethod($node)) {
            return null;
        }

        // For Strategy B (protect/restore):
        if ($node instanceof ClassMethod) {
            $this->guard->protectParametersIfNeeded($node);
        }
        $return = $this->originalRector->refactor($node);
        if ($node instanceof ClassMethod) {
            $this->guard->unprotectParameters($node);
        }
        return $return;
    }
}
```

If the original Rector does NOT implement `MinPhpVersionInterface`, omit that interface and the `provideMinPhpVersion()` method.

**Canonical examples:**
- Strategy A: `src/Rector/BackwardCompatibleReturnNeverTypeRector.php`
- Strategy B (param): `src/Rector/BackwardCompatibleAddParamTypeFromPropertyTypeRector.php`
- Strategy B (property): `src/Rector/BackwardCompatibleTypedPropertyFromStrictConstructorRector.php`

### 3. Register the rule in `src/Set.php`

Add a mapping entry to the `$ruleMap` array:

```php
\Rector\TypeDeclaration\Rector\<Group>\<OriginalRector>::class
    => \Art4\RectorBcLibrary\Rector\BackwardCompatible<OriginalRector>::class,
```

The `Set::getTypeDeclarationRules()` method iterates over Rector's `TypeDeclarationLevel::RULES` constant and substitutes wrapped rules via this map.

### 4. Update `tests/SetTest.php`

The test `testGetTypeDeclarationRulesReturnsCorrectListOfRules()` snapshots the exact rule list. Update it to match the new output.

---

## Test Conventions

### Directory structure per rule

```
tests/Rector/BackwardCompatible<Name>/
├── BackwardCompatible<Name>Test.php
├── config/configured_rule.php     # enables the wrapper, skips the original
└── Fixture/
    ├── add_<case>.php.inc         # Expected: rule modifies the code
    └── skip_<case>.php.inc        # Expected: guard blocks the change
```

### Test class pattern

```php
final class BackwardCompatible<Name>Test extends AbstractRectorTestCase
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

### Config pattern

```php
// config/configured_rule.php
return RectorConfig::configure()
    ->withRules([BackwardCompatibleRector::class])
    ->withSkip([OriginalRector::class]);
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
// (skip fixtures often omit the after section entirely)
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
| phpunit-tests    | 7.4, 8.0–8.5     | ^2.3            | PHPUnit + JUnit       |
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

- **`Set.php` is the public API.** It exports `BC_TYPE_DECLARATION` constant, `getTypeDeclarationRules()`, and `withTypeCoverageLevel()`.
- **Rule mapping is explicit.** The `$ruleMap` in `Set::getTypeDeclarationRules()` maps 30 original rules to wrappers. 33 rules pass through unchanged.
- **Prefer adding/adjusting guards over changing wrapper logic.** The guards encapsulate the actual BC heuristics.
- **Always check `isFinal()` / `isPrivate()` / `isFinal() on class`** — these are the core BC checks.
- **PHP 7.4 compatible.** Avoid PHP 8.0+ syntax (named arguments, match, readonly properties, etc.).
- **All classes are `final`.**
- **Constructor injection** via Rector's DI container.

---

## Quick Contribution Checklist

1. Run `composer test` and `composer cs` locally.
2. Add/adjust wrapper in `src/Rector/`.
3. Update `$ruleMap` in `src/Set.php`.
4. Add fixture tests in `tests/Rector/` (at least one `add_*` and one `skip_*`).
5. Update `tests/SetTest.php` snapshot if the rule list changes.
6. Update `README.md` only if usage or supported levels change.
