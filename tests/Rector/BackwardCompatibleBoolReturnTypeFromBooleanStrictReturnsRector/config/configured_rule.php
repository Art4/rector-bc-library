<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Art4\RectorBcLibrary\Rector\BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector;
use Rector\TypeDeclaration\Rector\ClassMethod\BoolReturnTypeFromBooleanStrictReturnsRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibleBoolReturnTypeFromBooleanStrictReturnsRector::class,
    ])
    ->withSkip([
        BoolReturnTypeFromBooleanStrictReturnsRector::class,
    ]);
