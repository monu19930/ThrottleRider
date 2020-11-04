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

if (!function_exists('dateFormate')) {
    /**
     * @param $date
     * @param $format
     * @return null|string
     */
    function formatDate($date, $format = 'Y-m-d')
    {
        if (empty($date)) {
            return null;
        }

        if (!($date instanceof \Carbon\Carbon)) {
            $date = Carbon\Carbon::parse($date);
        }

        return $date->format($format);
    }
    
}


if (!function_exists('getCurrentLocation')) {
   
    function getCurrentLocation()
    {
        $ip = request()->ip();
        $result = \Location::get($ip);
        if($result) {
            $city_name =  $result->cityName;
        }
        else {
            $ip = '180.149.226.195';
            $result = \Location::get($ip);
            $city_name =  $result->cityName;
        }
        return $city_name;
    }
    
}

if (!function_exists('getRideImage')) {
   
    function getRideImage($explore_ride)
    {   
        $result = '';
        if(!empty($explore_ride)) {
            $filter_data = explode(',', implode(',', array_filter($explore_ride)));
            $result = $filter_data[0];
        }
        return $result;
    }
    
}

if (!function_exists('dateDifference')) {
   
    function dateDifference($start_date,$end_date)
    {   
        $start_date = \Carbon\Carbon::createFromFormat('Y-m-d',formatDate($start_date));
        $end_date = \Carbon\Carbon::createFromFormat('Y-m-d', formatDate($end_date));
        $days =  $start_date->diffInDays($end_date);
        return $days;
    }
    
}





