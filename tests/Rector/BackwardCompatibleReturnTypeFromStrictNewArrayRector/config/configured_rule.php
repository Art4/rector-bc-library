<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictNewArrayRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNewArrayRector as OriginalReturnTypeFromStrictNewArrayRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibleReturnTypeFromStrictNewArrayRector::class,
    ])
    ->withSkip([
        OriginalReturnTypeFromStrictNewArrayRector::class,
    ]);
