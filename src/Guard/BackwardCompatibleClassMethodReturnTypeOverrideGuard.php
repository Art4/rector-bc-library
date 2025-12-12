<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Guard;

use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Analyser\Scope;
use Rector\VendorLocker\NodeVendorLocker\ClassMethodReturnTypeOverrideGuard as OriginalGuard;

final class BackwardCompatibleClassMethodReturnTypeOverrideGuard
{
    private OriginalGuard $originalGuard;

    public function __construct(OriginalGuard $originalGuard)
    {
        $this->originalGuard = $originalGuard;
    }

    public function shouldSkipClassMethod(ClassMethod $classMethod, Scope $scope): bool
    {
        // If original guard says skip, we skip
        if ($this->originalGuard->shouldSkipClassMethod($classMethod, $scope)) {
            return true;
        }

        // Keep the extra backward compatibility checks:
        // - allow add return type on final or private methods, or methods in final classes
        if ($classMethod->isFinal()) {
            return false;
        }

        if ($classMethod->isPrivate()) {
            return false;
        }

        $scopeClassReflection = $scope->getClassReflection();
        if ($scopeClassReflection === null) {
            return false;
        }

        if ($scopeClassReflection->isFinal()) {
            return false;
        }

        return true;
    }
}
