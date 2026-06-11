<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SeoRedirect;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SeoRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = '/' . ltrim($request->getPathInfo(), '/');

        $redirect = SeoRedirect::query()
            ->where('old_url', $path)
            ->where('is_active', true)
            ->first();

        if ($redirect) {
            return redirect($redirect->new_url, $redirect->status_code);
        }

        return $next($request);
    }
}
