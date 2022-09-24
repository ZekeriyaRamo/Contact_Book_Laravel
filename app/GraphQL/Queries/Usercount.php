<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class Usercount
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $comp_id = Auth::user()->company_id;
        if($args['search'] == ""){
                $count= User::where('company_id','=',$comp_id)->select('id')->count();
        }else{
                $count = User::where('company_id','=',$comp_id)
                    ->where(function($query) use ($args) {
                    $query->where('id','LIKE','%'.$args['search'].'%')
                    ->orWhere('first_name','LIKE','%'.$args['search'].'%')
                    ->orWhere('last_name','LIKE','%'.$args['search'].'%')
                    ->orWhere('email','LIKE','%'.$args['search'].'%')
                    ->orWhere('phone','LIKE','%'.$args['search'].'%');
                })->count();
        }
        return $count;
    }
}
