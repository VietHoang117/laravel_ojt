<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class PermissionHelper
{
    public static function can($permission)
    {
        $user = Auth::user();
        if ($user) {
            return $user->roles()->where('is_system_role', true)->exists() ||
                $user->roles->flatMap->permissions->pluck('name')->contains($permission);
        }
        return false;
    }
}
