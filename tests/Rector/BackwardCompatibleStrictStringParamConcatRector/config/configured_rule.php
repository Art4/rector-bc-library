<?php

declare(strict_types=1);

use Art4\RectorBcLibrary\Rector\BackwardCompatibleStrictStringParamConcatRector as BackwardCompatibleRector;
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\StrictStringParamConcatRector as OriginalRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibleRector::class,
    ])
    ->withSkip([
        OriginalRector::class,
    ]);
