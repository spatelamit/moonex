<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class historyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // if($request->ip()=='3.6.60.154'){
        //            return $next($request);
        // }
        
        // $host = $request->getHttpHost();
        // $method = $request->method();
        // $origin = request()->headers->get('origin');
        // $userAgent = $request->server('HTTP_USER_AGENT');
        
        // $dt = Carbon::now()->toDateTimeString();
        // if(Auth::id()){
        //     $user_id = Auth::id();
        // }else{
        //     $user_id = null;
        // }

        // DB::table('pannel_history')->insert(["user_id" => $user_id,
        //             "ip_address" => $request->ip(),
        //             "link" => URL::current(),
        //             "user_agent" => $userAgent,
        //             "method" => $method,
        //             // "requested_data" => json_encode($request->all()),
        //             'origin' => $origin,
        //             'host' => $host,
        //             "submited_date" => $dt,
        //         ]); 
        return $next($request);
    }
}
