<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Rector\Config\RectorConfig;

BackwardCompatibleRector::clearRuleConfigurations();
BackwardCompatibleRector::clearContainer();

return static function (RectorConfig $rectorConfig): void {
    BackwardCompatibleRector::setContainer($rectorConfig);
    BackwardCompatibleRector::addRuleConfiguration(
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnNullableTypeRector::class,
        BackwardCompatibleRector::GUARD_RETURN_TYPE
    );
    $rectorConfig->rule(BackwardCompatibleRector::class);
    $rectorConfig->skip([\Rector\TypeDeclaration\Rector\ClassMethod\ReturnNullableTypeRector::class]);
};
