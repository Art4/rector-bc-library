<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleRector;
use Rector\Config\RectorConfig;

BackwardCompatibleRector::clearRuleConfigurations();
BackwardCompatibleRector::clearContainer();

return static function (RectorConfig $rectorConfig): void {
    BackwardCompatibleRector::setContainer($rectorConfig);

    // String literal instead of ::class: the rule only exists from Rector 2.7 on
    $rule = 'Rector\\TypeDeclaration\\Rector\\ClassMethod\\BoolReturnTypeFromBooleanConstAndStrictReturnsRector';

    if (is_a($rule, \Rector\Contract\Rector\RectorInterface::class, true)) {
        BackwardCompatibleRector::addRuleConfiguration(
            $rule,
            BackwardCompatibleRector::GUARD_RETURN_TYPE
        );
        $rectorConfig->rule($rule);
        $rectorConfig->skip([$rule]);
    }

    $rectorConfig->rule(BackwardCompatibleRector::class);
};
