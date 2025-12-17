<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Guard;

use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Reflection\ClassReflection;
use Rector\PHPStan\ScopeFetcher;
use Rector\VendorLocker\NodeVendorLocker\ClassMethodReturnTypeOverrideGuard as OriginalGuard;

final class BackwardCompatibleClassMethodReturnTypeOverrideGuard
{
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
        if ($node->isFinal()) {
            return false;
        }

        if ($node->isPrivate()) {
            return false;
        }

        $scopeClassReflection = $scope->getClassReflection();

        if ($scopeClassReflection instanceof ClassReflection && $scopeClassReflection->isFinal()) {
            return false;
        }

        return true;
    }
}
