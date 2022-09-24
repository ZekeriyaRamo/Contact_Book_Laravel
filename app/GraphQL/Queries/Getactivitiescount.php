<?php

namespace App\GraphQL\Queries;

use App\Models\Activity;
use App\Models\User;

final class Getactivitiescount
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = auth()->user()->id;
        $user_type = User::where('id','=',$id)->select('role')->get();
        $company_id = User::where('id','=',$id)->select('company_id')->get();
        $company_id_test = json_decode($company_id);
        $user_type_test = json_decode($user_type);
        if($user_type_test[0]->role == "admin"){
            $activities_count = Activity::where('company_id','=',$company_id_test[0]->company_id)->select('id')->count();
            return $activities_count;
        }else{
            $activities_count = Activity::where('company_id','=',$company_id_test[0]->company_id)->select('id')->count();
            return $activities_count;
        }
    }
}
