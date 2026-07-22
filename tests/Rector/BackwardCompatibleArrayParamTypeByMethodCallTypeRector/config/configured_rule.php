<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleArrayParamTypeByMethodCallTypeRector as BackwardCompatibleRector;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\ArrayParamTypeByMethodCallTypeRector as OriginalRector;

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
