<?php

namespace App\GraphQL\Queries;

use App\Models\Contact;
use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;

final class Getcontactprofile
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
            $comp_id = Auth::user()->company_id;
            $role = Auth::user()->role;
            $id= Auth::user()->id;
   
            $contact = Contact::where('user_id','=',$id)->where('id','=',$args['id'])->where('company_id','=',$comp_id)->select('id','image','first_name','last_name','email','phone','status','email2','mobile','address1','address2')->first();
            if($contact){   
                return $contact;
            }else{
                throw new Error('You do not have permission to get other contact');
            }    
        
    }
}
