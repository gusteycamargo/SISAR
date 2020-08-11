<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class AccessLevel
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
        $level = 2;

        if($level == 0) {
            if($request->route()->getName() != '') {
                return redirect('/negado');
            }
        }
        else if($level == 1) {
            $nome = explode(".", $request->route()->getName());
            Log::debug($request->route()->getName());
            Log::debug($nome[0]);
            if($nome[0] == 'cursos' || $nome[0] == 'disciplinas' || $request->route()->getName() == '') {
                return $next($request);
            }
            else {
                return redirect('/negado');
            }
        }
        else if($level == 2) {
            return $next($request);
        }
        
        return $next($request);
        

    }
}
