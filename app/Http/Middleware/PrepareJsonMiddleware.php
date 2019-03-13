<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Response;
class PrepareJsonMiddleware
{
    /**
     * Handle output.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(strpos($request->path(),'api') === false ){
            return $next($request);
        }
        $response           = $next($request);
        if( $response instanceof Response){
            $msg = $response->exception->getTrace()[1];
//            if($response->isServerError())
//                $msg = $response->exception->getTrace()[1];
            $response = response()->json($msg,$response->getStatusCode());
        }
        $responseFormater   = app()->make('PrepareResponseService');
        return $responseFormater->formatResponse( $response );
    }
}