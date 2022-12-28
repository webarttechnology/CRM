<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Adminauth
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
        $checkAdmin = false;
        if($checkAdmin == false){
            return redirect('/login');
        }else{
            return $next($request);
        }        
    }
}
