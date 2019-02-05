<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\User;
use App\Calendar;
use App\Service;
use App\Session;
use App\SessionPrice;

class CoreService
{
    public function getRequestIds($key)
    {
        return (request()->{$key} && is_array(request()->{$key})) ? array_values(request()->{$key}) : [];
    }
}