<?php

namespace Nekoding\LaravelSoftbank;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nekoding\LaravelSoftbank\Skeleton\SkeletonClass
 */
class LaravelSoftbankFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-softbank';
    }
}
