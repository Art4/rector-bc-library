<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;

BackwardCompatibleRector::clearRuleConfigurations();
BackwardCompatibleRector::clearContainer();

return static function (RectorConfig $rectorConfig): void {
    BackwardCompatibleRector::setContainer($rectorConfig);
    BackwardCompatibleRector::addRuleConfiguration(
        AddVoidReturnTypeWhereNoReturnRector::class,
        BackwardCompatibleRector::GUARD_RETURN_TYPE
    );
    $rectorConfig->rule(BackwardCompatibleRector::class);
    $rectorConfig->skip([AddVoidReturnTypeWhereNoReturnRector::class]);
};
