<?php

namespace App\GraphQL\Queries;

use App\Models\Activity;
use App\Models\User;

final class Getactivities
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = auth()->user()->id;
        $company_id = User::where('id','=',$id)->select('company_id')->get();
        $company_id_test = json_decode($company_id);
        $user_type = User::where('id','=',$id)->select('role')->get();
        $user_type_test = json_decode($user_type);
        $start = ($args['page']-1) * 10 ;
        if($user_type_test[0]->role == "admin"){
            $activity = Activity::where('company_id','=',$company_id_test[0]->company_id)->skip($start)->take(10)->orderby('id','DESC')->get();
        return $activity;
        }else{
            $activity = Activity::where('company_id','=',$company_id_test[0]->company_id)->skip($start)->take(10)->orderby('id','DESC')->get();
        return $activity;
        }
    }
}
