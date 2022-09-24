<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;

final class Userprofilbyid
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

            $comp_id = Auth::user()->company_id;
            $role = Auth::user()->role;

            if($role == "Administrator"){
                $user = User::where('company_id','=',$comp_id)->where('id','=',$args['id'])->select('id','first_name','last_name','email','phone','role','status')->get();
                if($user != "[]"){
                    $user = json_decode($user);
                return $user[0];
                }else{
                    throw new Error('there is no such user in the company');
                }
                
            }else{
                $user = User::where('role','!=',"Administrator")->where('company_id','=',$comp_id)->where('id','=',$args['id'])->select('id','first_name','last_name','email','phone','role','status')->get();
                if($user != "[]"){
                    $user = json_decode($user);
                return $user[0];
                }else{
                    throw new Error('there is no such user in the company');
                }
            }
    }
}

