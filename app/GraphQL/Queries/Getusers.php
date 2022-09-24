<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class Getusers
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $id = auth()->user()->id;
        $company_id = User::where('id','=',$id)->select('company_id')->get();
        $test = json_decode($company_id);
        $user_type = User::where('id','=',$id)->select('role')->get();
        $user_type_test = json_decode($user_type);
        $start = ($args['page']-1) * 6 ;
        
            if($args['search'] == ""){
                $users = User::where('id','!=',$id)->where('company_id','=',$test[0]->company_id)->skip($start)->take(6)->orderBy('id', 'DESC')->get();
            }else{
                $users = User::where([['id','!=',$id],['company_id','=',$test[0]->company_id]])->where(function($query) use ($args) {
                    $query->where('id','LIKE','%'.$args['search'].'%')
                    ->orWhere('first_name','LIKE','%'.$args['search'].'%')
                    ->orWhere('last_name','LIKE','%'.$args['search'].'%')
                    ->orWhere('email','LIKE','%'.$args['search'].'%')
                    ->orWhere('phone','LIKE','%'.$args['search'].'%');    
                })->skip($start)->take(6)->orderBy('id', 'DESC')->get();
            }
        return $users;   
    }
}

