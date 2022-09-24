<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class UsersCount
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id= Auth::id();
        $comp_id = Auth::user()->company_id;
        $count = User::where('company_id','=',$comp_id)->where('id' ,'!=', $id )->count();
        return $count;
    }
}
