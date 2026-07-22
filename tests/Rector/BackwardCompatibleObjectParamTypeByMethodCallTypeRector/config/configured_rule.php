<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleObjectParamTypeByMethodCallTypeRector as BackwardCompatibleRector;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\ObjectParamTypeByMethodCallTypeRector as OriginalRector;

$rectorConfig = RectorConfig::configure()
    ->withRules([
        BackwardCompatibleRector::class,
    ]);

if (class_exists(OriginalRector::class)) {
    $rectorConfig = $rectorConfig->withSkip([
        OriginalRector::class,
    ]);
}

return $rectorConfig;
