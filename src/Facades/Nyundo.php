<?php

namespace Emanate\Nyundo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Emanate\Nyundo\Nyundo
 */
class Nyundo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Emanate\Nyundo\Nyundo::class;
    }
}
