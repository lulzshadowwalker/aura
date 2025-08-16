<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (
            $request->language &&
            in_array($request->language, config('app.supported_locales'))
        ) {
            app()->setLocale($request->language);
        }

        return $next($request);
    }
}
