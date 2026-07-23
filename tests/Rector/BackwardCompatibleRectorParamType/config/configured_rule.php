<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeFromPropertyTypeRector;

BackwardCompatibleRector::clearRuleConfigurations();
BackwardCompatibleRector::clearContainer();

return static function (RectorConfig $rectorConfig): void {
    BackwardCompatibleRector::setContainer($rectorConfig);
    BackwardCompatibleRector::addRuleConfiguration(
        AddParamTypeFromPropertyTypeRector::class,
        BackwardCompatibleRector::GUARD_PARAM_TYPE
    );
    $rectorConfig->rule(BackwardCompatibleRector::class);
    if (class_exists('AddParamTypeFromPropertyTypeRector::class')) {
        $rectorConfig->rule(AddParamTypeFromPropertyTypeRector::class);
        $rectorConfig->skip([AddParamTypeFromPropertyTypeRector::class]);
    }
};
