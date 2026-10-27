<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Art4\RectorBcLibrary\Set;
use Rector\Config\RectorConfig;

BackwardCompatibleRector::clearRuleConfigurations();
BackwardCompatibleRector::clearContainer();

// Emulates ->withPhpSets(php81: true), which registers the original rule next to our set
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(Set::BC_TYPE_DECLARATION);
    $rectorConfig->rule(\Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector::class);
};
