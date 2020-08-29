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
        // $level = -1;
        // if(isset($request->user()->level)) {
        //     $level = $request->user()->level;
        // }
        // Log::debug($request->route()->getName());
        // Log::debug($level);

        // if($request->route()->getName() == 'home') {
        //     return redirect('/');
        // } 

        // if($level == -1) {
        //     if($request->route()->getName() == 'logout' || $request->route()->getName() == 'login' || $request->route()->getName() == 'register' || $request->route()->getName() == 'password') {
        //         return $next($request);
        //     }
        // }
        // else if($level == 0) {
        //     if($request->route()->getName() != 'logout') {
        //         if($request->route()->getName() != 'home' && $request->route()->getName() != '') {
        //             return redirect('/negado');
        //         }
        //     }
            
        // }
        // else if($level == 1) {
        //     $nome = explode(".", $request->route()->getName());
        //     if($nome[0] == 'cursos' || $nome[0] == 'disciplinas' || $nome[0] == 'logout' || $request->route()->getName() == 'home' || $request->route()->getName() == '') {
        //         return $next($request);
        //     }
        //     else {
        //         return redirect('/negado');
        //     }
        // }
        // else if($level == 2) {
        //     return $next($request);
        // }
        
        return $next($request);
        

    }
}
