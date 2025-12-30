<!-- Copilot instructions for repository-specific AI assistance -->
# Repository guide for AI coding assistants

Purpose: Help AI agents quickly understand and modify this project (a small PHP library of backward-compatible Rector rules).

- Big picture: This package provides wrapper Rector rules that apply Rector's original transformations more cautiously to avoid breaking downstream library consumers. Key folders:
  - `src/Rector/` — wrapper Rector classes (e.g. `BackwardCompatibleReturnNeverTypeRector.php`) that delegate to original Rector rules after compatibility guards.
  - `src/Guard/` — heuristics that decide when a change is safe (examples: `BackwardCompatibleClassMethodReturnTypeOverrideGuard.php`).
  - `src/Set.php` and `config/set/` — prepared sets exported for `rector.php` imports (use `\Art4\RectorBcLibrary\Set::BC_TYPE_DECLARATION`).

- Build / Test / Lint commands (use these exact scripts):
  - Run all checks: `composer test`
  - Run unit tests: `composer phpunit` (reads `phpunit.xml.dist`, bootstrap `vendor/autoload.php`)
  - Run static analysis: `composer phpstan`
  - Generate coverage: `composer coverage` (requires Xdebug)
  - Fix style: `composer cs`
  - Check style only: `composer cs:check`

- Common patterns to follow when editing code:
  - Add wrapper Rector: create `src/Rector/BackwardCompatible<Thing>.php`, inject the original Rector (usually aliased as `OriginalRector`) and the appropriate Guard, then:
    1) ask guard (e.g. `$this->guard->shouldSkipClassMethod($node)`) and return `null` if unsafe;
    2) otherwise delegate `return $this->originalRector->refactor($node);`.
    See `src/Rector/BackwardCompatibleReturnNeverTypeRector.php` for a canonical example.
  - Guards live in `src/Guard/` and encapsulate compatibility heuristics (final/private checks, vendor-lock signals, etc.). Prefer adding/adjusting guards over changing wrapper logic.
  - Export any new rule in `src/Set.php` and add corresponding config in `config/set/` if needed.

- Tests and CI expectations:
  - Tests are under `tests/` (see `tests/SetTest.php`). New rules should include a unit test demonstrating intended behavior and a negative test when the guard blocks changes.
  - CI expects `composer test` to succeed and style to be unchanged (so run `composer cs` locally before PRs).

- Project-specific conventions:
  - PHP versions supported: `^7.4 || ^8.0` (see `composer.json`). Be conservative with typing changes — library compatibility is the primary goal.
  - The wrappers intentionally delegate to Rector internals via constructor injection (OriginalRector). Keep that DI pattern when adding rules.
  - Naming: classes are `BackwardCompatible<Feature>Rector` and guards `BackwardCompatible<Feature>Guard`.

- Integration points:
  - This package is consumed by importing the prepared set in the host project's `rector.php`:

```php
use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withSets([
        \Art4\RectorBcLibrary\Set::BC_TYPE_DECLARATION,
    ]);
```

- Quick PR checklist for contributors:
  - Run `composer test` and `composer cs` locally.
  - Add/adjust unit tests under `tests/` that cover the guard behavior.
  - Update `README.md` only if usage or supported levels change.

If anything in these notes is unclear or you want more detail (examples for creating a new Rector + test), say which area to expand.
