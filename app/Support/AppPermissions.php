<?php

namespace App\Support;

class AppPermissions
{
    public static function modules(): array
    {
        return [
            'dashboard' => 'Dashboard',
            'tables' => 'Tables',
            'billing' => 'Billing',
            'virtual-reality' => 'Virtual Reality',
            'rtl' => 'RTL',
            'notifications' => 'Notifications',
            'profile' => 'Profile',
            'user-management' => 'User Management',
            'projects' => 'Projects',
            'user-profile' => 'User Profile',
        ];
    }
}
