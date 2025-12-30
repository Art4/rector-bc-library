<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Rector;

use Art4\RectorBcLibrary\Guard\BackwardCompatibleParameterTypeOverrideGuard;
use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Rector\AbstractRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByMethodCallTypeRector as OriginalRector;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class BackwardCompatibleParamTypeByMethodCallTypeRector extends AbstractRector
{
    private OriginalRector $originalRector;
    private BackwardCompatibleParameterTypeOverrideGuard $parameterTypeOverrideGuard;

    public function __construct(OriginalRector $originalRector, BackwardCompatibleParameterTypeOverrideGuard $parameterTypeOverrideGuard)
    {
        $this->originalRector = $originalRector;
        $this->parameterTypeOverrideGuard = $parameterTypeOverrideGuard;
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
     * @param ClassMethod $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($node instanceof ClassMethod) {
            $this->parameterTypeOverrideGuard->protectParametersIfNeeded($node);
        }

        $return = $this->originalRector->refactor($node);

        if ($node instanceof ClassMethod) {
            $this->parameterTypeOverrideGuard->unprotectParameters($node);
        }

        return $return;
    }
}
