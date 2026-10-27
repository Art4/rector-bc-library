<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Tests\Fixture;

use PhpParser\Node;
use Rector\Rector\AbstractRector;
use RuntimeException;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * Stand-in for an original Rector rule that fails while refactoring.
 */
final class ThrowingRector extends AbstractRector
{
    /** @var list<class-string<Node>> */
    public static array $nodeTypes = [];

    /** @var (callable(): void)|null */
    public static $onRefactor;

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Always throws', []);
    }

    /** @return list<class-string<Node>> */
    public function getNodeTypes(): array
    {
        return self::$nodeTypes;
    }

    public function refactor(Node $node): ?Node
    {
        if (self::$onRefactor !== null) {
            (self::$onRefactor)();
        }

        throw new RuntimeException('original rule failed');
    }
}
