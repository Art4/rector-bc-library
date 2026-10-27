<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Guard;

use PhpParser\Node\Stmt\ClassMethod;

/**
 * The backward compatibility decision shared by the return type and parameter
 * type guards: nobody can override the method, so changing its signature is safe.
 */
final class MethodOverrideSafety
{
    public static function isSafeToModify(ClassMethod $method, bool $classIsFinal): bool
    {
        return $method->isFinal() || $method->isPrivate() || $classIsFinal;
    }
}
