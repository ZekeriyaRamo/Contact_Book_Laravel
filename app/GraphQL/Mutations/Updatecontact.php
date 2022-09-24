<?php

namespace App\GraphQL\Mutations;

use App\Models\Activity;
use App\Models\Contact;
use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;

final class Updatecontact
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id =auth()->user()->id;

        $company_id = Auth::user()->company_id;
       
        $contact = Contact::where('id','=',$args['contact_id'])->where('company_id','=',$company_id);
        $contact->update(['image'=>$args['image'],
        'first_name'=>$args['first_name'],'last_name'=>$args['last_name'],'email'=>$args['email'],'phone'=>$args['phone'],'status'=>$args['status'],
        'company_id'=>$company_id,'user_id'=>$id,'email2'=>$args['email2'],
        'mobile'=>$args['mobile'],'address1'=>$args['address1'],'address2'=>$args['address2']]);

        $user_name= User::where('id','=',$id)->select('first_name')->get();

        $user_decodname = json_decode($user_name);
        $todayDate =  date("d.m.y");
        
        if($contact){
            $activity = Activity::create(['contactname'=>$args['first_name'],'title'=>'update',
            'user_id'=>$id, 'contact_id'=>$args['contact_id'], 'company_id'=>$company_id,
            'username'=>$user_decodname[0]->first_name,'date'=>$todayDate]);
            return 'contact updated sucessfully';
        }else{
            return 'update failed';
        }
    }
}
