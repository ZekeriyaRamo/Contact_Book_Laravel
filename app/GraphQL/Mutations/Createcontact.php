<?php

namespace App\GraphQL\Mutations;

use App\Models\Activity;
use App\Models\Contact;
use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;

final class Createcontact
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = auth()->user()->id;
        $company_id = User::where('id','=',$id)->select('company_id')->get();

        $role = Auth::user()->role;
        $com = json_decode($company_id);
        $contact = Contact::create(['image'=>$args['image'],'first_name'=>$args['first_name'],
        'last_name'=>$args['last_name'],'email'=>$args['email'],'phone'=>$args['phone'],
        'status'=>"Active",'company_id'=>$com[0]->company_id,'user_id'=>$id,'email2'=>$args['email2'],
        'mobile'=>$args['mobile'],'address1'=>$args['address1'],'address2'=>$args['address2'] ])->get();
        $user_name= User::where('id','=',$id)->select('first_name')->get();
        $contact_id = Contact::where('company_id','=',$com[0]->company_id)->where('user_id','=',$id)->select('id')->get();
        $contact_test = json_decode($contact_id);
        $user_decodname = json_decode($user_name);
        $todayDate =  date("d.m.y");
        if($contact != ''){
            $activity = Activity::create(['contactname'=>$args['first_name'],'title'=>'add','user_id'=>$id, 'contact_id'=>$contact_test[0]->id, 'company_id'=>$com[0]->company_id, 'username'=>$user_decodname[0]->first_name,'date'=>$todayDate]);
            if($activity != '')
            return "contact added successfully";
        }else{
            return "failed to add contact";
        } 


    }
}
