<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Art4\RectorBcLibrary\Rector\BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector as OriginalAddVoidReturnTypeRector;

return RectorConfig::configure()
    ->withRules([
        BackwardCompatibleAddVoidReturnTypeWhereNoReturnRector::class,
    ])
    ->withSkip([
        OriginalAddVoidReturnTypeRector::class,
    ]);
