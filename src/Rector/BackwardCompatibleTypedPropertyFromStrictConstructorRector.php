<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Rector;

use Art4\RectorBcLibrary\Guard\BackwardCompatiblePropertyTypeOverrideGuard;
use PhpParser\Node;
use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PHPStan\Type\Type;
use Rector\Rector\AbstractRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector as OriginalRector;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class BackwardCompatibleTypedPropertyFromStrictConstructorRector extends AbstractRector implements MinPhpVersionInterface
{
    private OriginalRector $originalRector;
    private BackwardCompatiblePropertyTypeOverrideGuard $propertyTypeOverrideGuard;

    public function __construct(OriginalRector $originalRector, BackwardCompatiblePropertyTypeOverrideGuard $propertyTypeOverrideGuard)
    {
        $this->originalRector = $originalRector;
        $this->propertyTypeOverrideGuard = $propertyTypeOverrideGuard;
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
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $node instanceof Class_) {
            return null;
        }

        foreach ($node->getProperties() as $property) {
            if (! $this->propertyTypeOverrideGuard->isLegal($property, $node)) {
                $this->propertyTypeOverrideGuard->addOverrideProtection($property);
            }
        }

        $return = $this->originalRector->refactor($node);

        foreach ($node->getProperties() as $property) {
            $this->propertyTypeOverrideGuard->removePropertyProtection($property);
        }

        return $return;
    }

    /**
     * @return int
     */
    public function provideMinPhpVersion(): int
    {
        return $this->originalRector->provideMinPhpVersion();
    }
}
