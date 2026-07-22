<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;

BackwardCompatibleRector::clearRuleConfigurations();
BackwardCompatibleRector::clearContainer();

return static function (RectorConfig $rectorConfig): void {
    BackwardCompatibleRector::setContainer($rectorConfig);
    BackwardCompatibleRector::addRuleConfiguration(
        TypedPropertyFromStrictConstructorRector::class,
        BackwardCompatibleRector::GUARD_PROPERTY_TYPE
    );
    $rectorConfig->rule(BackwardCompatibleRector::class);
    $rectorConfig->skip([TypedPropertyFromStrictConstructorRector::class]);
};
