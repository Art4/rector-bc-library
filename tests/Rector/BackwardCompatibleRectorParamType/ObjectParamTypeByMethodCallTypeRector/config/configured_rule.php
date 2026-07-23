<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Rector\Config\RectorConfig;

BackwardCompatibleRector::clearRuleConfigurations();
BackwardCompatibleRector::clearContainer();

return static function (RectorConfig $rectorConfig): void {
    BackwardCompatibleRector::setContainer($rectorConfig);

    if (class_exists(\Rector\TypeDeclaration\Rector\ClassMethod\ObjectParamTypeByMethodCallTypeRector::class)) {
        BackwardCompatibleRector::addRuleConfiguration(
            \Rector\TypeDeclaration\Rector\ClassMethod\ObjectParamTypeByMethodCallTypeRector::class,
            BackwardCompatibleRector::GUARD_PARAM_TYPE
        );
        $rectorConfig->rule(\Rector\TypeDeclaration\Rector\ClassMethod\ObjectParamTypeByMethodCallTypeRector::class);
        $rectorConfig->skip([\Rector\TypeDeclaration\Rector\ClassMethod\ObjectParamTypeByMethodCallTypeRector::class]);
    }

    $rectorConfig->rule(BackwardCompatibleRector::class);
};
