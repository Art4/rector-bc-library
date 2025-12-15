# rector-bc-library

Backward-compatible Rector rules for library maintainers.

## Installation

Install as a development dependency in your project:

```bash
composer require --dev art4/rector-bc-library
```

## Usage

After installing, import the provided set into your project's `rector.php` configuration file:

```php
<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    // Import this package's set
    $rectorConfig->import(\Art4\RectorBcLibrary\Set::SET);
};
```

### Notes

- This package is designed to be used together with Rector. Please install `rector/rector` as a development dependency in projects that use this library (for example: `composer require --dev rector/rector`).
- Add any custom rules or sets in `rector.php` as needed.

## Motivation

This library targets maintainers of PHP libraries that are consumed by other projects. When running Rector "out of the box", some type-focused rules will add return and parameter type declarations automatically. While these transformations improve type-safety, they can introduce breaking changes for downstream projects that extend or override your library classes and methods.

Specifically, adding or narrowing a return type or parameter type on a method that may be overridden can make child classes incompatible with the parent, causing runtime errors or subtle behavioral regressions for consumers.

To help reduce this risk, the package wraps selected Rector rules and applies them more cautiously — for example, restricting automated additions to final classes or private/final methods, or skipping changes when guards indicate it may be unsafe. The goal is to preserve public API compatibility while still benefiting from automated modernizations.

### Intended audience

This package is intended primarily for library maintainers whose packages are consumed by other projects (downstream consumers). Its goal is to avoid introducing breaking API changes when running automated Rector rules that add or narrow type declarations.

If your project is an application or a library that is not used or extended by downstream projects, you likely don't need this package — running Rector "out of the box" (without the backward-compat wrappers) is usually fine for internal codebases where public API compatibility is not a concern.

### How it works

- Each wrapper first checks compatibility via a guard that inspects the class/method (final/private status, vendor-locking, scope, and other signals).
- If the guard detects a potential risk to downstream compatibility, the wrapper skips the change; otherwise it delegates to the original Rector rule and the change is applied.
- Use the set by importing it in your project's `rector.php` (see the Usage section above).

### Benefits

- Reduce the chance of unexpected breaking changes when upgrading libraries ✅
- Keep the benefits of automated type improvements while protecting public API stability ✅
- Low friction: continue using Rector with more conservative, library-friendly behavior ✅

## License

This project is licensed under the GNU General Public License v3 or later (`GPL-3.0-or-later`). See the `LICENSE` file for the full text.

When using this package, make sure that your project's licensing is compatible with the GNU GPL v3 or later.

## Contributing

If you discover a breaking change caused by an original Rector rule (for example, a rule adding a type that breaks a downstream consumer), we'd love your help — please open an issue so we can investigate.

How to contribute:

- Open an issue with a minimal reproducible example (before/after fixture or short code sample) and mention the Rector version you used.
- If possible, include a failing test or fixture that demonstrates the issue; PRs that include a test and a fix are especially helpful.
- Run the test suite and PHPStan locally before submitting a PR: `composer test` and `composer run phpstan`.
- Create a pull request with a clear description of the problem, your proposed fix, and why it is safe for library maintainers.

Thanks for helping make automated refactorings safer for library maintainers and their downstream users — your contributions are much appreciated! 🎉
