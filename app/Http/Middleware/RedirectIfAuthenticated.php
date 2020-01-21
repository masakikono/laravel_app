<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        //認証しているかチェックして、認証していたら/homeにリダイレクトしています。
        //これが「認証済み（ログイン済み）の状態でログインページにアクセスすると、ログイン後のトップページにリダイレクトする」処理です。非ログインはログインページに飛ばす
        }
        //closureインスタンスを返す
        return $next($request);
    }
}
