<?php

if (!function_exists('user')) {
    /**
     * @return null|\App\Models\User
     */
    function user()
    {
        return \Auth::user();
    }
}

if (!function_exists('isAdministrator')) {
    /**
     * @param null $user
     * @return bool
     */
    function isAdministrator($user = null)
    {
        if (is_null($user)) {
            $user = user();
        }

        if (!$user) {
            return false;
        }

        return $user->hasRole('administrator');
    }
}
