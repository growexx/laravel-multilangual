<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Stichoza\GoogleTranslate\GoogleTranslate;


class LanguageManager
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
