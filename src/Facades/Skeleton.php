<?php

namespace BenQoder\TypescriptGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \VendorName\Skeleton\Skeleton
 */
class TypescriptGenerator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \BenQoder\TypescriptGenerator\TypescriptGenerator::class;
    }
}
