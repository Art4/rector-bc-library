<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleScalarParamTypeByMethodCallTypeRector as BackwardCompatibleRector;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\ScalarParamTypeByMethodCallTypeRector as OriginalRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibleRector::class,
    ])
    ->withSkip([
        OriginalRector::class,
    ]);
