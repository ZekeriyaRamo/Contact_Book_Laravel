<?php

namespace App\GraphQL\Mutations;

use App\Mail\mailsetpass;
use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Mail;

final class Inviteuser
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = auth()->user()->id;
        $role = auth()->user()->role;
        $comp_id = auth()->user()->company_id;


        if($role == "admin"){
            $user = User::create(['first_name' =>$args['first_name'],
            'last_name'=>$args['last_name'],
            'email'=>$args['email'],
            'role'=>$args['role'],
            'phone'=>$args['phone'],
            'status'=>'Pending',
            'company_id' => $comp_id]);
            $token = $user->createToken('auth-token')->plainTextToken;
            $details = [
            'title' => 'Join us at our company',
            'body' => 'we invite you to be part of our company, click the button to finish siging up.',
            'token' => $token,
        ];
            Mail::to($args['email'])->send(new mailsetpass($details));
            $data = [
                'token'  => $token,
                'message'   => 'invite has been sent',    
            ];
            return  $data;
            return "invite has been sent";
        }else{
            throw new Error('you dont have a permission to invite user');
        }

    }
}
