<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permissions): Response
    {
        $permissionList = explode('|', $permissions);

        // Kiểm tra xem user có ít nhất một quyền trong danh sách
        $hasPermission = collect($permissionList)->contains(function ($permission) {
            return Auth::check() && Auth::user()->hasPermission($permission);
        });

        if (!$hasPermission) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
