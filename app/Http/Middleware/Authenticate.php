<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guard)
    {

        if (Auth::guest()) {
            return response('Unauthorized.', 401);
        }

        // $roles = DB::table('user_roles')
        //                 ->join('roles', 'user_roles.role_id', '=', 'roles.id')
        //                 ->join('users', 'user_roles.user_id', '=', 'users.id')
        //                 ->where('user_id', Auth::id())
        //                 ->select('roles.name')
        //                 ->get();
        // if( !in_array($roles[0]->name, $guard)){
        //     return response('Page not found', 404);
        // }

        return $next($request);
    }
}
