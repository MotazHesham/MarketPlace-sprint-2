<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class customer
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
      if(auth()->user() && auth()->user()->role ==0){
        return $next($request);
      }else{
        return redirect("home");
      }
    }
}
