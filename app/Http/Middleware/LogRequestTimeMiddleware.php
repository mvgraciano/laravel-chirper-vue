<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogRequestTimeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Antes de atingir o controlador
        $startTime = microtime(true);
        
        $response = $next($request);

        // Depois de atingir o controlador

        $endTime = microtime(true);
        $executionTime = round($endTime - $startTime, 3);

        Log::info("Tempo de execução da solicitação: {$executionTime} segundos");

        return $response;
    }
}
