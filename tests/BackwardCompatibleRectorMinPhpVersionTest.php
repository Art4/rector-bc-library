<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests;

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Art4\RectorBcLibrary\Set;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Rector\Config\RectorConfig;
use Rector\Configuration\Deprecation\Contract\DeprecatedInterface;
use Rector\Configuration\Option;
use Rector\Configuration\Parameter\SimpleParameterProvider;
use Rector\ValueObject\PhpVersion;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Rector\VersionBonding\PhpVersionedFilter;
use ReflectionClass;

/**
 * Rector runs a rule that implements MinPhpVersionInterface only if the target
 * PHP version is high enough. The wrapper calls the originals directly, so it
 * has to apply this filter itself (#13).
 */
final class BackwardCompatibleRectorMinPhpVersionTest extends TestCase
{
    protected function tearDown(): void
    {
        // the PHP version is global state, restore the default of Rector's tests
        SimpleParameterProvider::setParameter(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_10);
    }

    /**
     * @param class-string<MinPhpVersionInterface&\Rector\Contract\Rector\RectorInterface> $originalClass
     *
     * @dataProvider provideOriginalRunsOnlyFromItsMinimumPhpVersionCases
     */
    #[DataProvider('provideOriginalRunsOnlyFromItsMinimumPhpVersionCases')]
    public function testOriginalRunsOnlyFromItsMinimumPhpVersion(string $originalClass): void
    {
        $minimum = self::instantiate($originalClass)->provideMinPhpVersion();
        $below = self::highestPhpVersionBelow($minimum);

        self::assertTrue($this->isActiveForTarget($originalClass, $minimum), 'active at its minimum version');

        if ($below !== null) {
            self::assertFalse($this->isActiveForTarget($originalClass, $below), 'inactive below its minimum version');
        }
    }

    /** @return iterable<string, array{class-string}> */
    public static function provideOriginalRunsOnlyFromItsMinimumPhpVersionCases(): iterable
    {
        foreach (array_keys(Set::getRuleGuardMap()) as $rule) {
            if (! class_exists($rule) || is_a($rule, DeprecatedInterface::class, true)) {
                continue;
            }

            if (! is_a($rule, MinPhpVersionInterface::class, true)) {
                continue;
            }

            yield $rule => [$rule];
        }
    }

    public function testWrapperIsNotExcludedForALowTargetVersion(): void
    {
        $wrapper = self::instantiate(BackwardCompatibleRector::class);

        self::assertSame(PhpVersion::PHP_70, $wrapper->provideMinPhpVersion());

        $rectorConfig = new RectorConfig();
        $rectorConfig->phpVersion(PhpVersion::PHP_70);

        /** @var PhpVersionedFilter $filter */
        $filter = $rectorConfig->make(PhpVersionedFilter::class);

        self::assertSame([$wrapper], $filter->filter([$wrapper]));
    }

    /** @param class-string<\Rector\Contract\Rector\RectorInterface> $originalClass */
    private function isActiveForTarget(string $originalClass, int $targetVersion): bool
    {
        $rectorConfig = new RectorConfig();
        // the versions come from PhpVersion's own constants, PHPStan only sees an int here
        $rectorConfig->phpVersion($targetVersion); // @phpstan-ignore argument.type

        $wrapper = self::instantiate(BackwardCompatibleRector::class);

        BackwardCompatibleRector::setContainer($rectorConfig);

        try {
            return $wrapper->isOriginalActive(self::instantiate($originalClass));
        } finally {
            BackwardCompatibleRector::clearContainer();
        }
    }

    /**
     * The rules and the wrapper need PHPStan services in their constructors, the
     * minimum PHP version does not: a bare RectorConfig cannot build them.
     *
     * @template T of object
     * @param class-string<T> $class
     * @return T
     */
    private static function instantiate(string $class): object
    {
        return (new ReflectionClass($class))->newInstanceWithoutConstructor();
    }

    private static function highestPhpVersionBelow(int $minimum): ?int
    {
        $below = array_filter(
            (new ReflectionClass(PhpVersion::class))->getConstants(),
            static fn($version): bool => \is_int($version) && $version < $minimum
        );

        return $below === [] ? null : max($below);
    }
}
