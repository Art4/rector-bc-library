# Releasing

How a new version of the library gets released. A release is **developer-initiated and never agent-launched**: the developer picks the moment; an agent may prepare work up to the developer's gate but never starts the process or executes the irreversible steps on its own.

Both a developer and an agent can follow this procedure. Each step ends with a completion criterion — the condition that tells you the step is done. Steps 6–8 are developer-only: don't act on them for the developer.

## Entry

The developer decides a release is warranted, and `main` is in the state they intend to release (pending feature branches and their version impact are their call). If the `[Unreleased]` section of `CHANGELOG.md` is empty, the answer is *nothing to release* — stop.

## Steps

**1. Propose the version** [agent proposes, developer confirms]
Read the `[Unreleased]` section and classify it: any breaking change → major, any new behavior → minor, fixes only → patch. Present the proposed version number and the classification rationale.
_Done_: the developer confirms the version (or corrects it).

**2. Supported-range integrity gate** [blocking]
If `[Unreleased]` claims a supported-range change (e.g. a widened or narrowed `rector/rector` constraint, an EOL PHP drop), verify `composer.json`'s constraints and the matrix in `.gitlab-ci.yml` actually match that claim. A mismatch is a hard stop: resolve it before proceeding. The manual `rector-version-audit` job and `rector-tests-legacy` (allowed to fail, by design) are not part of the declared supported range and need no action here.
_Done_: no claim with a mismatch; or the mismatch is resolved.

**3. Prepare the release branch**
From up-to-date `main`, create the branch `release-<X.Y>` (minor only, matching this repo's existing branches — not `release-<X.Y.Z>`) and rewrite `CHANGELOG.md`:

- Insert a new `## [X.Y.Z - <ISO date>](https://gitlab.com/Art4/rector-bc-library/-/compare/<previous>...X.Y.Z)` section directly under `[Unreleased]`, containing that section's categories moved verbatim.
- Update the `[Unreleased]` link's compare target from `<previous>...main` to `X.Y.Z...main`, leaving the section body empty (this repo doesn't use an explicit "Nothing yet." placeholder — see 1.1.0's release commit for the exact pattern).
- Bump `composer.json`'s `"version"` field to `X.Y.Z`.

```bash
git fetch origin
git checkout -b release-<X.Y> origin/main
```
Commit as `chore: prepare release X.Y.Z` (matching `1539c94` from the 1.1.0 release).
_Done_: the changelog diff shows only the `[Unreleased]` content moved into the new section header, plus the version bump in `composer.json`; no entry was dropped or reworded.

**4. Validate locally**
Run `composer test` (phpunit + phpstan + cs:check). If the host PHP lacks required extensions, use `docker run --rm -v "$(pwd):/app" -w /app php:8.3-cli sh -c "..."` per `AGENTS.md`'s Quick Contribution Checklist.
_Done_: the full check passes.

**5. Open the MR** [agent proposes draft, developer approves]
```bash
git push origin release-<X.Y>
```
Propose the MR to the developer **before opening it** — draft the title and body, and ask for permission to open. Never open an MR on your own.

Draft an MR into `main` (title: `Release X.Y.Z`, matching the pattern of past release merge commits):
- Body: state that once this MR lands, version `X.Y.Z` will be released, and include a short summary of the relevant changes from `CHANGELOG.md` (one line per topic; do not reproduce the full changelog).

Once the developer approves and the MR is open, wait for CI.
_Done_: every required job in the pipeline is green (`rector-tests-legacy` is allowed to fail by design and is not a blocker).

**6. Merge** [developer-only]
The developer reviews the wording and the version, then merges once CI is green. This repo merges release MRs as a merge commit (`Merge branch 'release-<X.Y>' into 'main'`), not a squash — matching `6074d10`.
_Done_: the merge lands on `main`.

**7. Tag** [developer-only]
On the merged `main` commit, create a lightweight tag named exactly `X.Y.Z` (no `v` prefix — matching repo history) and push it:
```bash
git fetch origin
git tag X.Y.Z
git push origin X.Y.Z
```
_Done_: `git ls-remote --tags origin` shows `X.Y.Z` pointing at the merged commit.

**8. GitLab Release** [developer-only, informational]
GitLab auto-creates a Release object from the pushed tag; past releases (1.0.0, 1.1.0) left its description empty and relied on the tag + `CHANGELOG.md` as the source of truth. No extra action is required unless the developer wants to fill in release notes.

**9. Verify on Packagist** [informational — not blocking]
Check that `art4/rector-bc-library` on Packagist shows `X.Y.Z`. The webhook is automatic on tag push; lag is expected.
_Done_: the new version is live on Packagist.

## Reference

- **Version classification** — breaking change in `[Unreleased]` → major; new behavior → minor; fixes only → patch. The type is read from the changelog, never the developer's mood.
- **Supported-range gate interpretation** — a release publicly restates the supported range (`composer.json` + README's compatibility table + `.gitlab-ci.yml`'s matrix), so all three must agree with what `[Unreleased]` claims.
- **Keep a Changelog** — the changelog must follow the repo's existing conventions: section headers with `compare/<from>...<to>` links, ISO dates, and category grouping (Added / Changed / Deprecated / Removed / Fixed / Security).
- **Irreversible = the developer's hands** — merging the MR, pushing the tag, and any GitLab Release edits are developer-only. An agent prepares up to the MR and stops.
