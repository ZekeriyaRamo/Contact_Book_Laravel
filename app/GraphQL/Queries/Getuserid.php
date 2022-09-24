<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Auth;

final class Getuserid
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = Auth::user()->id;
        return $id;
    }
}
