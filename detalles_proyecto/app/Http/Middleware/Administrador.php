<?php

namespace App\Http\Middleware;

use Closure;

class Administrador
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
        $admin = $request->session()->get('usuario');
        if ($admin) {
            return $next($request);
        }else{
            return redirect('/admin/session');
        }
    }
}
