<?php
namespace App\Http\Middleware;
use Closure;
use JWTAuth;
use Exception;
class jwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token  = $request->header('authorization');
        $resp   = tokenizer()->validateJwtToken($token);
        try {
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        return $next($request);
    }
}