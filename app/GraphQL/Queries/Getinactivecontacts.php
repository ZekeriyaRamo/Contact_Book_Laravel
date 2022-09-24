<?php

namespace App\GraphQL\Queries;

use App\Models\Contact;
use App\Models\User;

final class Getinactivecontacts
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = auth()->user()->id;
        $comany_id = User::where('id','=',$id)->select('company_id')->get();
        $comany_id_test = json_decode($comany_id);
        $user_type = User::where('id','=',$id)->select('role')->get();
        $user_type_test = json_decode($user_type);
        if($user_type_test[0]->role == "Admin"){
            $inactive = Contact::where('company_id','=',$comany_id_test[0]->company_id)->select('id')->count();
        return $inactive;
        }else{
            $inactive = Contact::where('status','=','Inactive')->where('company_id','=',$comany_id_test[0]->company_id)->select('id')->count();
        return $inactive;
        }
    }
}
