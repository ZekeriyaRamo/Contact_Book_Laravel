<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

final class UpdateMyprofile
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
            $id = auth()->user()->id;
            $validator = Validator::make($args, [
                'email' => 'unique:users,email,'.$id
            ]);
            if ($validator->fails()){
                throw new Error('the email is already exists');
            }else{
                    $user = User::where('id','=',$id);
                    $user->update(['first_name'=>$args['first_name'],'last_name'=>$args['last_name'],'email'=>$args['email'],'phone'=>$args['phone']]);     
            }
            return 'user updated';
   } 
    
}
