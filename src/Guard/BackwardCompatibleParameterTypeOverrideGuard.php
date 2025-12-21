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
        $scope = ScopeFetcher::fetch($method);

        $class = $scope->getClassReflection();

        foreach ($method->getParams() as $property) {
            if ($this->skipParameter($method, $class)) {
                $property->type = new Identifier(self::TEMP_TYPE_NAME);
            }
        }
    }

    public function unprotectParameters(ClassMethod $method): void
    {
        foreach ($method->getParams() as $property) {
            if ($property->type instanceof Identifier && $property->type->name === self::TEMP_TYPE_NAME) {
                $property->type = null;
            }
        }
    }

    private function skipParameter(ClassMethod $method, ?ClassReflection $class): bool
    {
        if ($class instanceof ClassReflection && $class->isFinal()) {
            return false;
        }

        if ($method->isFinal() || $method->isPrivate()) {
            return false;
        }

        return true;
    }
}
