<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Rector\Config\RectorConfig;

BackwardCompatibleRector::clearRuleConfigurations();
BackwardCompatibleRector::clearContainer();

return static function (RectorConfig $rectorConfig): void {
    BackwardCompatibleRector::setContainer($rectorConfig);
    BackwardCompatibleRector::addRuleConfiguration(
        \Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByParentCallTypeRector::class,
        BackwardCompatibleRector::GUARD_PARAM_TYPE_ON_CLASS
    );
    $rectorConfig->rule(BackwardCompatibleRector::class);
    $rectorConfig->rule(\Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByParentCallTypeRector::class);
    $rectorConfig->skip([\Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByParentCallTypeRector::class]);
};
