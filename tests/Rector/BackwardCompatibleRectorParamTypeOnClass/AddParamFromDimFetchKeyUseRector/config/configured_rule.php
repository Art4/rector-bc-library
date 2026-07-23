<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Rector\Config\RectorConfig;

BackwardCompatibleRector::clearRuleConfigurations();
BackwardCompatibleRector::clearContainer();

return static function (RectorConfig $rectorConfig): void {
    BackwardCompatibleRector::setContainer($rectorConfig);
    BackwardCompatibleRector::addRuleConfiguration(
        \Rector\TypeDeclaration\Rector\ClassMethod\AddParamFromDimFetchKeyUseRector::class,
        BackwardCompatibleRector::GUARD_PARAM_TYPE_ON_CLASS
    );
    $rectorConfig->rule(BackwardCompatibleRector::class);
    if (class_exists('Rector\TypeDeclaration\Rector\ClassMethod\AddParamFromDimFetchKeyUseRector')) {
        $rectorConfig->rule(\Rector\TypeDeclaration\Rector\ClassMethod\AddParamFromDimFetchKeyUseRector::class);
        $rectorConfig->skip([\Rector\TypeDeclaration\Rector\ClassMethod\AddParamFromDimFetchKeyUseRector::class]);
    }
};
