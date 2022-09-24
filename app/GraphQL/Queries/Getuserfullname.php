<?php

namespace App\GraphQL\Queries;

use App\Models\User;

final class Getuserfullname
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::where('id','=',$args['id'])->select('first_name','last_name')->get();
        return $user;
    }
}
