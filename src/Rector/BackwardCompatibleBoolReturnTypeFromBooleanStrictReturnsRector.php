<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Rector;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\PHPStan\ScopeFetcher;
use Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanStrictReturnsRector as OriginalBoolReturnTypeRector;
use Rector\Rector\AbstractRector;
use Rector\VendorLocker\NodeVendorLocker\ClassMethodReturnTypeOverrideGuard;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector extends AbstractRector implements MinPhpVersionInterface
{
    private OriginalBoolReturnTypeRector $originalRector;
    private ClassMethodReturnTypeOverrideGuard $classMethodReturnTypeOverrideGuard;

    public function __construct(OriginalBoolReturnTypeRector $originalRector, ClassMethodReturnTypeOverrideGuard $classMethodReturnTypeOverrideGuard)
    {
        $this->originalRector = $originalRector;
        $this->classMethodReturnTypeOverrideGuard = $classMethodReturnTypeOverrideGuard;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return $this->originalRector->getRuleDefinition();
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return $this->originalRector->getNodeTypes();
    }

    /**
     * @param Node $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($node instanceof ClassMethod && $this->shouldSkipMethod($node)) {
            return null;
        }

        // Delegate to the original Rector rule
        return $this->originalRector->refactor($node);
    }

    private function shouldSkipMethod(ClassMethod $node): bool
    {
        $scope = ScopeFetcher::fetch($node);

        if ($this->classMethodReturnTypeOverrideGuard->shouldSkipClassMethod($node, $scope)) {
            return true;
        }

        if ($node->isFinal()) {
            return false;
        }

        if ($node->isPrivate()) {
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

    /**
     * @return int
     */
    public function provideMinPhpVersion(): int
    {
        return $this->originalRector->provideMinPhpVersion();
    }
}
