<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HandleNotFound
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (NotFoundHttpException $exception) {
            return response()->view('errors.404', [], 404);
        }
    }
}
