<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleReturnTypeFromStrictConstantReturnRector;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictConstantReturnRector as OriginalReturnTypeRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibleReturnTypeFromStrictConstantReturnRector::class,
    ])
    ->withSkip([
        OriginalReturnTypeRector::class,
    ]);
