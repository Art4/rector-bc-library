<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Rector;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictConstantReturnRector as OriginalReturnTypeRector;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Rector\Rector\AbstractScopeAwareRector;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class BackwardCompatibleReturnTypeFromStrictConstantReturnRector extends AbstractScopeAwareRector implements MinPhpVersionInterface
{
    private OriginalReturnTypeRector $originalRector;

    public function __construct(OriginalReturnTypeRector $originalRector)
    {
        $this->originalRector = $originalRector;
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
    public function refactorWithScope(Node $node, Scope $scope): ?Node
    {
        return $this->originalRector->refactorWithScope($node, $scope);
    }

    /**
     * @return int
     */
    public function provideMinPhpVersion(): int
    {
        return $this->originalRector->provideMinPhpVersion();
    }
}
