<?php

namespace App\Helpers\Menu\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;

use App\Helpers\Menu\SimpleMenuBuilder;

class SimpleMenu extends BaseFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SimpleMenuBuilder::class;
    }
}