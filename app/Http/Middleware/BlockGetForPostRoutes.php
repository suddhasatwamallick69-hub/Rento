<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockGetForPostRoutes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if ($request->isMethod('post')) {
            // return response()->view('errors.403', [], Response::HTTP_FORBIDDEN);
            abort(403, 'POST requests are not allowed.');
        }

        return $next($request);
    }
}
