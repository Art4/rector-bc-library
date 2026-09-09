# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased](https://gitlab.com/Art4/rector-bc-library/-/compare/1.1.0...main)

### Fixed

- **Important:** `Set::getTypeDeclarationRules()`'s allowlist is now filtered to rules that actually exist in the installed Rector version. Previously, an allowlisted rule not yet present in an older Rector release was passed straight to `RectorConfig::rules()` unchecked and crashed `rector process` outright for any consumer on that version — unlike the guard-map path, which already resolves rules defensively. This was a real, previously-undetected bug affecting real usage, not just our own test suite.
- Add an end-to-end test that loads `config/set/bc-type-declaration.php` against a real `RectorConfig` and asserts it doesn't throw — this is what should have caught the bug above; our existing tests only ever configured one rule at a time and never exercised the actual shipped config file.
- **Correct previously-overstated Rector version support (retroactively affects 1.1.0 too, see README):** Rector 2.3.0–2.4.6 and 2.5.0–2.5.7 hit a bug in Rector's own parser bootstrap (`PHPStanContainerMemento` reflecting into a private property removed from `PHPStan\Parser\RichParser`) that crashes `rector process` outright. This is a bug in Rector itself, confirmed via a stack trace entirely inside `vendor/rector/rector`, reproducible even pinning PHPStan to the exact floor version those Rector releases declare — not something this library can guard against. Verified with both this library's test suite and actual `rector process` runs across every released patch from 2.3.0 through 2.6.6. Rector 2.3.3 is an isolated, narrow exception that happens to work despite sitting in the broken range, but is inconsistent across PHP versions and too fragile to officially support.

### Added

- Add `BinaryOpNullableToInstanceofRector` and `WhileNullableToInstanceofRector` to the reviewed-safe allowlist (new in Rector 2.5/2.6's `TypeDeclarationLevel::RULES`; both only rewrite `&&`/`||`/`while` conditions to `instanceof` checks, no class-member signature is touched)
- Add explicit CI testing for Rector 2.6
- Add manual, on-demand `rector-version-audit` CI job to exhaustively test every patch version of a given Rector minor line before widening `composer.json`'s upper bound to admit it

### Changed

- Limit supported Rector versions to `>=2.5.8, <2.7` (was `>=2.3, <2.6`) — adds Rector 2.6 support, drops Rector 2.3/2.4 and Rector 2.5.0–2.5.7 support (see Fixed above)

## [1.1.0 - 2026-07-25](https://gitlab.com/Art4/rector-bc-library/-/compare/1.0.0...1.1.0)

### Added

- Add AGENTS.md with comprehensive guide for AI coding assistants
- Add wrappers for `ObjectParamTypeByMethodCallTypeRector`, `ScalarParamTypeByMethodCallTypeRector`, `ArrayParamTypeByMethodCallTypeRector` (split from `ParamTypeByMethodCallTypeRector` in Rector 2.5)
- Add explicit CI testing for Rector 2.4 and 2.5

### Changed

- **Consolidate 30 wrapper rectors into single `BackwardCompatibleRector`** — replaces all individual `BackwardCompatible*` classes with one configurable rector using static container + rule configuration map. Test directories reduced from 30 to 3 (grouped by guard strategy).
- Minimum Rector version bumped from `^2.2` to `^2.3` (Rector 2.2 has a fatal DI container bug and was never usable with this library)
- Limit supported Rector versions to `>=2.3, <2.6`
- Make `SetTest` version-agnostic (dynamic count + class existence checks instead of hardcoded rule snapshot)
- Update CI to drop 2.2.* test matrix

### Fixed

- Skip deprecated rectors (implementing `DeprecatedInterface`) that throw in `refactor()` — prevents crash on `StrictStringParamConcatRector` in Rector >= 2.5

### Removed

- Remove `StrictStringParamConcatRector` from guard map (no longer in `TypeDeclarationLevel::RULES`)

## [1.0.0 - 2025-12-31](https://gitlab.com/Art4/rector-bc-library/-/compare/09fcc212fd6948ce5be37b563eb99f51d2bb321b...1.0.0)

### Added

- Add backward compatible replacment for type declaration set of Rector 2.2 and 2.3.
