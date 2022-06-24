<?php

namespace Nekoding\LaravelSoftbank;

use Illuminate\Support\Facades\Facade;

/**
 * 
 * @method static \Nekoding\LaravelSoftbank\Contract\Payload payload()
 * @method static \Nekoding\LaravelSoftbank\Contract\PaymentMethod\CreditCard creditCard()
 * 
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
