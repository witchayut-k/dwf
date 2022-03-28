<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;

class CountVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $this->getUserIpAddr();

       // if (Visitor::where('date', today())->where('ip', $ip)->count() == 0) {
            Visitor::create([
                'date' => today(),
                'ip' => $ip,
            ]);
       // }
        return $next($request);
    }

    function getUserIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
