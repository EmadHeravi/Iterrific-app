<?php

namespace App\Support;

class AppPermissions
{
    public static function modules(): array
    {
        return [
            'dashboard' => 'Dashboard',
            'time-entry' => 'Time Entry',
            'approvals' => 'Approvals',
            'billing' => 'Billing',
            'notifications' => 'Notifications',
            'profile' => 'Profile',
            'user-management' => 'User Management',
            'projects' => 'Projects',
            'calendars' => 'Calendars',
            'user-profile' => 'User Profile',
        ];
    }
}
