<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Rector;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;
use Rector\TypeDeclaration\Rector\ClassMethod\StringReturnTypeFromStrictScalarReturnsRector as OriginalRector;
use Rector\Rector\AbstractRector;
use Art4\RectorBcLibrary\Guard\BackwardCompatibleClassMethodReturnTypeOverrideGuard;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class BackwardCompatibleStringReturnTypeFromStrictScalarReturnsRector extends AbstractRector implements MinPhpVersionInterface
{
    private OriginalRector $originalRector;
    private BackwardCompatibleClassMethodReturnTypeOverrideGuard $classMethodReturnTypeOverrideGuard;

    public function __construct(OriginalRector $originalRector, BackwardCompatibleClassMethodReturnTypeOverrideGuard $classMethodReturnTypeOverrideGuard)
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
     * @param ClassMethod|Function_ $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($node instanceof ClassMethod && $this->classMethodReturnTypeOverrideGuard->shouldSkipClassMethod($node)) {
            return null;
        }

        return $this->originalRector->refactor($node);
    }

    /**
     * @return int
     */
    public function provideMinPhpVersion(): int
    {
        return $this->originalRector->provideMinPhpVersion();
    }
}
