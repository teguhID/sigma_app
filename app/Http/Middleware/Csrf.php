<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class Csrf extends Middleware
{
    protected function shouldSkip(Request $request)
    {
        return $request->is('midtrans/notification');
    }
}
