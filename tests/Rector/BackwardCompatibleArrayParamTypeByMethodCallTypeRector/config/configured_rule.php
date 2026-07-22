<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleArrayParamTypeByMethodCallTypeRector as BackwardCompatibleRector;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\ArrayParamTypeByMethodCallTypeRector as OriginalRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibleRector::class,
    ])
    ->withSkip([
        OriginalRector::class,
    ]);
