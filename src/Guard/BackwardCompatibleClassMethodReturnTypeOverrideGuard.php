<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Guard;

use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Reflection\ClassReflection;
use Rector\PHPStan\ScopeFetcher;
use Rector\VendorLocker\NodeVendorLocker\ClassMethodReturnTypeOverrideGuard as OriginalGuard;

final class BackwardCompatibleClassMethodReturnTypeOverrideGuard
{
    private const TEMP_TYPE_NAME = '__SKIP_ADDING_RETURN_TYPE__';

    private OriginalGuard $originalGuard;

    public function __construct(OriginalGuard $originalGuard)
    {
        $this->originalGuard = $originalGuard;
    }

    public function shouldSkipClassMethod(ClassMethod $node): bool
    {
        $scope = ScopeFetcher::fetch($node);

        // If original guard says skip, we skip
        if ($this->originalGuard->shouldSkipClassMethod($node, $scope)) {
            return true;
        }

        // Keep the extra backward compatibility checks:
        // - allow add return type on final or private methods, or methods in final classes
        $scopeClassReflection = $scope->getClassReflection();

        return ! MethodOverrideSafety::isSafeToModify(
            $node,
            $scopeClassReflection instanceof ClassReflection && $scopeClassReflection->isFinal()
        );
    }

    /**
     * For rules that visit the whole class (Rector >= 2.8) instead of single
     * class methods: mark every method this guard would skip with a temporary
     * return type, so the original rule leaves it alone.
     */
    public function protectMethodsIfNeeded(ClassLike $classLike): void
    {
        foreach ($classLike->getMethods() as $method) {
            if ($method->returnType === null && $this->shouldSkipClassMethod($method)) {
                $method->returnType = new Identifier(self::TEMP_TYPE_NAME);
            }
        }
    }

    public function unprotectMethods(ClassLike $classLike): void
    {
        foreach ($classLike->getMethods() as $method) {
            if ($method->returnType instanceof Identifier && $method->returnType->name === self::TEMP_TYPE_NAME) {
                $method->returnType = null;
            }
        }
    }
}
