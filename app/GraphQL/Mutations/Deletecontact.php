<?php

namespace App\GraphQL\Mutations;

use App\Models\Activity;
use App\Models\Contact;
use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;

final class Deletecontact
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = auth()->user()->id;
        $comp_id = User::where('id','=',$id)->select('company_id')->get();
        $company_id_test = json_decode($comp_id);

        if($args['id'] == []){
            throw new Error('Select at least one contact'); 
        }
        $contact_ids = $args['id'];

        foreach($contact_ids as $cont_id){
            $contact_name = Contact::where('id','=',$cont_id)->where('user_id','=',$id)->select('first_name')->get();
            $contacname = json_decode($contact_name);
            $contacti = Contact::where('id','=',$cont_id)->where('company_id','=',$company_id_test[0]->company_id)->delete();
            $user_name= User::where('id','=',$id)->select('first_name')->get();
            $user_decodname = json_decode($user_name);
            $todayDate =  date("d.m.y");
            if($contacti){
                Activity::create(['contactname'=>$contacname[0]->first_name,
                'title'=>'delete','user_id'=>$id,'contact_id'=>$cont_id,'company_id'=>$company_id_test[0]->company_id,
                'username'=>$user_decodname[0]->first_name,'date'=>$todayDate]);

            }else{
                throw new Error('No such contact in your conatact list'); 
            }
        }

    }
}
