<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Art4\RectorBcLibrary\Rector\BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanConstReturnsRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibleBoolReturnTypeFromBooleanConstReturnsRector::class,
    ])
    ->withSkip([
        BoolReturnTypeFromBooleanConstReturnsRector::class,
    ]);
