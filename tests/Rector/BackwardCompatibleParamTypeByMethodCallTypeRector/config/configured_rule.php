<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleParamTypeByMethodCallTypeRector as BackwardCompatibleRector;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByMethodCallTypeRector as OriginalRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibleRector::class,
    ])
    ->withSkip([
        OriginalRector::class,
    ]);
