<?php

namespace App\GraphQL\Queries;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Validation\ValidationException;

final class Getlastactivities
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
        if($user_type_test[0]->role == "admin"){
            $activity = Activity::where('company_id','=',$company_id_test[0]->company_id)->select('id','date','title','user_id','created_at','username','contactname')->orderBy('id', 'desc')->limit(6)->get();
            
        }else{
            $activity = Activity::where('company_id','=',$company_id_test[0]->company_id)->select('id','date','title','user_id','created_at','username','contactname')->orderBy('id', 'desc')->limit(6)->get();
           
        }
        if($activity != "[]"){
            $activity_test = json_decode($activity);
        return $activity_test;
        }else{
            throw ValidationException::withMessages([
                'you have no permission to get other contact'
            ]);
        }
    }
}
