<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamFromDimFetchKeyUseRector;

BackwardCompatibleRector::clearRuleConfigurations();
BackwardCompatibleRector::clearContainer();

return static function (RectorConfig $rectorConfig): void {
    BackwardCompatibleRector::setContainer($rectorConfig);
    BackwardCompatibleRector::addRuleConfiguration(
        AddParamFromDimFetchKeyUseRector::class,
        BackwardCompatibleRector::GUARD_PARAM_TYPE_ON_CLASS
    );
    $rectorConfig->rule(BackwardCompatibleRector::class);
    $rectorConfig->rule(AddParamFromDimFetchKeyUseRector::class);
    $rectorConfig->skip([AddParamFromDimFetchKeyUseRector::class]);
};
