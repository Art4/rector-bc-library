<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Art4\RectorBcLibrary\Rector\BackwardCompatibilityReturnTypeFromReturnNewRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnNewRector as OriginalReturnTypeFromReturnNewRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibilityReturnTypeFromReturnNewRector::class,
    ])
    ->withSkip([
        OriginalReturnTypeFromReturnNewRector::class,
    ]);
