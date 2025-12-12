<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Rector;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\PHPStan\ScopeFetcher;
use Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanStrictReturnsRector as OriginalBoolReturnTypeRector;
use Rector\Rector\AbstractRector;
use Art4\RectorBcLibrary\Guard\BackwardCompatibleClassMethodReturnTypeOverrideGuard;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector extends AbstractRector implements MinPhpVersionInterface
{
    private OriginalBoolReturnTypeRector $originalRector;
    private BackwardCompatibleClassMethodReturnTypeOverrideGuard $classMethodReturnTypeOverrideGuard;

    public function __construct(OriginalBoolReturnTypeRector $originalRector, BackwardCompatibleClassMethodReturnTypeOverrideGuard $classMethodReturnTypeOverrideGuard)
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

        return $this->classMethodReturnTypeOverrideGuard->shouldSkipClassMethod($node, $scope);
    }

    /**
     * @return int
     */
    public function provideMinPhpVersion(): int
    {
        return $this->originalRector->provideMinPhpVersion();
    }
}
