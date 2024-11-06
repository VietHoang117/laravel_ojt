<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class PermissionHelper
{
    public static function can($permission)
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        $isSystemAdmin = $user->roles()->where('is_system_role', true)->exists();

        if ($permission === 'is-system-admin') {
            return $isSystemAdmin;
        }

        return $isSystemAdmin || $user->roles->flatMap->permissions->pluck('name')->contains($permission);
    }
}
