<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Guard;

use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Reflection\ClassReflection;
use Rector\PHPStan\ScopeFetcher;

final class BackwardCompatibleParameterTypeOverrideGuard
{
    private const TEMP_TYPE_NAME = '__SKIP_ADDING_PARAMETER_TYPE__';

    public function protectParametersIfNeeded(ClassMethod $method): void
    {
        if (! $this->skipParameters($method)) {
            return;
        }

        foreach ($method->getParams() as $param) {
            if ($param->type === null) {
                $param->type = new Identifier(self::TEMP_TYPE_NAME);
            }
        }
    }

    public function unprotectParameters(ClassMethod $method): void
    {
        foreach ($method->getParams() as $param) {
            if ($param->type instanceof Identifier && $param->type->name === self::TEMP_TYPE_NAME) {
                $param->type = null;
            }
        }
    }

    private function skipParameters(ClassMethod $method): bool
    {
        if ($method->isFinal() || $method->isPrivate()) {
            return false;
        }

        $class = (ScopeFetcher::fetch($method))->getClassReflection();

        if ($class instanceof ClassReflection && $class->isFinal()) {
            return false;
        }

        return true;
    }
}
