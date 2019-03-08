<?php

namespace App\Http\Middleware;

use Closure;

class Pegawai
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
        if(auth()->check() && \Auth::user()->jabatan == 'Pegawai') {
            return $next($request); 
        }
        return redirect()->guest('/')->with('alert', 'Anda tidak memiliki hak akses!');
    }
}
