<?php

namespace App;

class Permission extends \Spatie\Permission\Models\Permission
{
    public static function defaultPermissions()
    {
        return [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',

            'view_needs',
            'add_needs',
            'edit_needs',
            'delete_needs',

            'view_offers',
            'add_offers',
            'edit_offers',
            'delete_offers',
        ];
    }
}