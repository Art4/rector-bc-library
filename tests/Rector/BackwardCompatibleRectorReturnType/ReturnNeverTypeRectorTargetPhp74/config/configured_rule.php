<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Rector\Config\RectorConfig;
use Rector\ValueObject\PhpVersion;

BackwardCompatibleRector::clearRuleConfigurations();
BackwardCompatibleRector::clearContainer();

// ReturnNeverTypeRector needs PHP 8.1: Rector's own filter drops it for a lower target version
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->phpVersion(PhpVersion::PHP_74);
    BackwardCompatibleRector::setContainer($rectorConfig);
    BackwardCompatibleRector::addRuleConfiguration(
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector::class,
        BackwardCompatibleRector::GUARD_RETURN_TYPE
    );
    $rectorConfig->rule(BackwardCompatibleRector::class);
    $rectorConfig->rule(\Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector::class);
    $rectorConfig->skip([\Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector::class]);
};
