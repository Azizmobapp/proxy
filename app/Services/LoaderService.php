<?php

namespace App\Services;

use App\Components\ProxyCheckerHttp;
use App\Models\Loader;

class LoaderService
{
    public static function create()
    {
        return Loader::create();
    }

}
