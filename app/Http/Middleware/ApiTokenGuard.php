<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ApiTokenGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bearer_token = $request->header('authorization');
        if (preg_match('/Bearer\s(\S+)/', $bearer_token, $matches)) {
            $token = $matches[1];
            $user = User::where('api_token', $token)->first();
            if ($user) {
                $request->user = $user;
                return $next($request);
            } else {
                return response(['meta' => [
                    'status' => 'error',
                    'message' => 'Token expired or invalid'
                ]], 401);
            }
        } else {
            return response(['meta' => [
                'status' => 'error',
                'message' => 'Token is required to access this api'
            ]], 401);
        }
    }
}
