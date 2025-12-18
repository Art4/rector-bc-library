<?php

declare(strict_types=1);

namespace Art4\RectorBcLibrary\Guard;

use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;

final class BackwardCompatiblePropertyTypeOverrideGuard
{
    private const TEMP_TYPE_NAME = '__SKIP_ADDING_PROPERTY_TYPE__';

    public function isLegal(Property $property, Class_ $class): bool
    {
        if ($property->isProtected() && ! $class->isFinal()) {
            return false;
        }

        return true;
    }

    public function addOverrideProtection(Property $property): void
    {
        $property->type = new Identifier(self::TEMP_TYPE_NAME);
    }

    public function removePropertyProtection(Property $property): void
    {
        if ($property->type instanceof Identifier && $property->type->name === self::TEMP_TYPE_NAME) {
            $property->type = null;
        }
    }
}
