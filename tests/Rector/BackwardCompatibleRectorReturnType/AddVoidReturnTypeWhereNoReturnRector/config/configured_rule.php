<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Rector\Config\RectorConfig;
use Rector\Contract\Rector\RectorInterface;

BackwardCompatibleRector::clearRuleConfigurations();
BackwardCompatibleRector::clearContainer();

return static function (RectorConfig $rectorConfig): void {
    BackwardCompatibleRector::setContainer($rectorConfig);

    // The rule moved from ClassMethod to ClassLike in Rector 2.8, only one of them exists
    foreach (
        [
            'Rector\\TypeDeclaration\\Rector\\ClassMethod\\AddVoidReturnTypeWhereNoReturnRector',
            'Rector\\TypeDeclaration\\Rector\\ClassLike\\AddVoidReturnTypeWhereNoReturnRector',
        ] as $originalRector
    ) {
        if (! class_exists($originalRector) || ! is_a($originalRector, RectorInterface::class, true)) {
            continue;
        }

        BackwardCompatibleRector::addRuleConfiguration($originalRector, BackwardCompatibleRector::GUARD_RETURN_TYPE);
        $rectorConfig->rule($originalRector);
        $rectorConfig->skip([$originalRector]);
    }

    $rectorConfig->rule(BackwardCompatibleRector::class);
};
