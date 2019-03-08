<?php

namespace App\Http\Middleware;

use Closure;

class KepalaDinas
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
        if(auth()->check() && \Auth::user()->jabatan == 'Kepala Dinas' || \Auth::user()->jabatan == 'Administrator') {
            return $next($request); 
        }
        return redirect()->guest('/')->with('alert', 'Anda tidak memiliki hak akses!');
    }
}
