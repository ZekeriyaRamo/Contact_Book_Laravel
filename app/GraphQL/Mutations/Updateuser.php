<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

final class Updateuser
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $validator = Validator::make($args, [
            'email' => 'unique:users,email,'.$args['id']
        ]);
        $comp_id = Auth::user()->company_id;
        $role = Auth::user()->role;
      
        if ($validator->fails()){
            throw new Error('the email is already exists');
        }else{
            if($role == "admin"){
                $user = User::where('company_id','=',$comp_id)->find($args['id']);
                $user->update(['first_name'=>$args['first_name'],'last_name'=>$args['last_name'],'email'=>$args['email'],'phone'=>$args['phone'],'status'=>$args['status'],'role'=>$args['role']]);
                return 'user updated';
            }elseif($role == "Regular"){
                throw new Error('You dont have a permission to edit another user');
            }
    }   }

}
