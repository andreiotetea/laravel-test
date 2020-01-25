<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function getUsers($iso2, $status) 
    {
        $results = $this->app->select("
            SELECT u.* FROM users u
            INNER JOIN user_details ud ON ud.user_id=u.id
            INNER JOIN countries c ON c.id=ud.citizenship_country_id
            WHERE c.iso2=? AND u.active=?
        ", [$iso2, $status]);

        return $results;
    }
}
