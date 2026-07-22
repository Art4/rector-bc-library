# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased](https://gitlab.com/Art4/rector-bc-library/-/compare/1.0.0...main)

### Added

- Add AGENTS.md with comprehensive guide for AI coding assistants
- Add wrappers for `ObjectParamTypeByMethodCallTypeRector`, `ScalarParamTypeByMethodCallTypeRector`, `ArrayParamTypeByMethodCallTypeRector` (split from `ParamTypeByMethodCallTypeRector` in Rector 2.5)

### Changed

- **Consolidate 30 wrapper rectors into single `BackwardCompatibleRector`** — replaces all individual `BackwardCompatible*` classes with one configurable rector using static container + rule configuration map. Test directories reduced from 30 to 3 (grouped by guard strategy).
- Minimum Rector version bumped from `^2.2` to `^2.3` (Rector 2.2 has a fatal DI container bug and was never usable with this library)
- Make `SetTest` version-agnostic (dynamic count + class existence checks instead of hardcoded rule snapshot)
- Restore `BackwardCompatibleStrictStringParamConcatRector` wrapper for Rector 2.3 compatibility
- Update CI to drop 2.2.* test matrix

### Removed

- Remove `StrictStringParamConcatRector` from guard map (no longer in `TypeDeclarationLevel::RULES`)

## [1.0.0 - 2025-12-31](https://gitlab.com/Art4/rector-bc-library/-/compare/09fcc212fd6948ce5be37b563eb99f51d2bb321b...1.0.0)

### Added

- Add backward compatible replacment for type declaration set of Rector 2.2 and 2.3.
