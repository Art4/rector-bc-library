# rector-bc-library

Backward-compatible Rector rules for library maintainers.

| Rector Version | Status                                                        | Details                                 |
| -------------- | ------------------------------------------------------------- | --------------------------------------- |
| Rector 2.2     | [![Status](https://progress-bar.xyz/53/)](/tests/SetTest.php) | 33 of 63 rules are checked and replaced |

## Installation

Install as a development dependency:

```bash
composer require --dev art4/rector-bc-library
```

This package is intended to be used alongside Rector. If you don't already have Rector in the project, add it as a dev dependency too:

```bash
composer require --dev rector/rector
```

## Usage

The easiest way to use this package is to import the prepared set into your project's `rector.php`:

```php
<?php

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPreparedSets(
        // NOTE: Deactivate the default prepared typeDeclaration set with `false`
        typeDeclaraion: false
    )
    // Instead import this package's set as replacement
    ->withSets([
        \Art4\RectorBcLibrary\Set::BC_TYPE_DECLARATION,
    ])
;
```

### Gradual (level-based) adoption

If you'd like to increase type coverage gradually [one level at a time](https://getrector.com/documentation/levels#content-one-level-at-a-time) (recommended), you can use the provided helper to apply a subset of rules for a given level. Do not use the `->withTypeCoverageLevel()` method. For example:

```php
<?php

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    // NOTE: Do not use the withTypeCoverageLevel() method
    //->withTypeCoverageLevel(25)
    >withRules(\Art4\RectorBcLibrary\Set::withTypeCoverageLevel(25))
;
```

Start with a low level and raise it iteratively as you gain confidence and run your tests.

## Motivation

When Rector adds or narrows type declarations automatically, it usually improves type safety — but it can also introduce breaking changes for downstream projects that extend or override your classes or methods.

This package wraps selected Rector rules and applies them more cautiously to reduce the risk of accidental API breakage for library consumers.

## Who should use this

- Library maintainers whose packages are consumed or extended by other projects ✅
- Projects where public API compatibility matters

If you are working on an application (not a library) or you control both upstream and downstream code, the standard Rector rules are often sufficient.

## How it works

- Each wrapper inspects the code (for example: final/private status, vendor-lock signals, and other heuristics) before applying a change.
- If the wrapper detects a potential risk to downstream compatibility, it skips the change; otherwise it delegates to the original Rector rule.
- Use the prepared set by importing `\Art4\RectorBcLibrary\Set::BC_TYPE_DECLARATION` (see Usage).

### Allowed changes in classes

Based on the [Symfony Backward Compatibility Promise](https://symfony.com/doc/current/contributing/code/bc.html) the Rectors only allows this changes in classes:

#### Properties

| Type of Change allowed?               | final class          | not-final          |
| ------------------------------------- | -------------------- | ------------------ |
| Add type to a public property         | No, only as phpdoc   | No, only as phpdoc |
| Add type to a protected property      | Yes                  | No                 |
| Add type to a private property        | Yes                  | Yes                |

#### Public Methods

| Type of Change allowed?         | final class | final method | not-final           |
| ------------------------------- | ----------- | ------------ | ------------------- |
| Add type hint to an argument    | Yes         | Yes          | No                  |
| Remove type hint of an argument | Yes         | Yes          | No                  |
| Change argument type            | Yes         | Yes          | No                  |
| Add return type                 | Yes         | Yes          | No                  |
| Remove return type              | Yes         | Yes          | No, only for `void` |
| Change return type              | Yes         | Yes          | No                  |

#### Protected Methods

| Type of Change allowed?         | final class | final method | not-final           |
| ------------------------------- | ----------- | ------------ | ------------------- |
| Add type hint to an argument    | Yes         | Yes          | No                  |
| Remove type hint of an argument | Yes         | Yes          | No                  |
| Change argument type            | Yes         | Yes          | No                  |
| Add return type                 | Yes         | Yes          | No                  |
| Remove return type              | Yes         | Yes          | No, only for `void` |
| Change return type              | Yes         | Yes          | No                  |

#### Private Methods

| Type of Change allowed?         | final class | final method | not-final |
| ------------------------------- | ----------- | ------------ | --------- |
| Add type hint to an argument    | Yes         | Yes          | Yes       |
| Remove type hint of an argument | Yes         | Yes          | Yes       |
| Change argument type            | Yes         | Yes          | Yes       |
| Add return type                 | Yes         | Yes          | Yes       |
| Remove return type              | Yes         | Yes          | Yes       |
| Change return type              | Yes         | Yes          | Yes       |

## Benefits ✅

- Reduce the chance of unexpected breaking changes when modernizing code
- Keep most of Rector's automated improvements while protecting public APIs
- Low-friction: works with your current Rector setup

## License

This project is licensed under the GNU General Public License v3 or later (`GPL-3.0-or-later`). See the `LICENSE` file for details.

Be sure your project's license is compatible with the GNU GPL v3+ before using this package.

## Contributing

Thanks for considering contributing! The fastest way to help is:

1. Open an issue with a minimal reproducible example and the Rector version you used.
2. If possible, add a failing test or fixture that demonstrates the problem.
3. Run tests and static analysis locally: `composer test` and `composer run phpstan`.
4. Open a pull request with a clear description of the fix and why it's safe for library maintainers.

Contributions that include a test and a short explanation are especially appreciated — thanks! 🎉
