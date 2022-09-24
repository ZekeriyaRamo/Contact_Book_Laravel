<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;

final class Deleteuser
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = auth()->user()->id;
       
        $role = User::where('id','=',$id)->select('role')->get();
        $rolee= json_decode($role);
        
        $company_id = User::where('id','=',$id)->select('company_id')->get();
        $company_id_test = json_decode($company_id);
        $ids = $args['id'];
        
        if($rolee[0]->role == "admin"){
            if($args['id'] == []){
                throw new Error('Select at least one user'); 
            }
            foreach($ids as $user_id){
                $user = User::where('id','=',$user_id)->where('id','!=',$id)->where('company_id','=',$company_id_test[0]->company_id)->delete();

                if(!$user){
                    throw new Error('No such user in the company'); 
                }
                return 'user deleted';
            }
        }
            
        elseif($rolee[0]->role == "Regular"){
            throw new Error('You dont have a permission to delete user'); 
        }
    }
}
