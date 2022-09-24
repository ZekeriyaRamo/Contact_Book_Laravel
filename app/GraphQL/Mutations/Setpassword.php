<?php

namespace App\GraphQL\Mutations;
use App\Models\User;
use GraphQL\Error\Error;
final class Setpassword
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = auth()->user()->id;
        $password = $args['password'];
        $confirm_password = $args['confirmpassword'];
        if($password == $confirm_password){
            $user = User::where('id','=',$id)->update(['password' => bcrypt($password),'status'=>'Active']);
            return $user;
        }else{
            throw new Error('The password must be identical');
        }
    }
}
