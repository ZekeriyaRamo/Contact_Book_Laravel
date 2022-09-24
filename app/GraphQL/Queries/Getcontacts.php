<?php

namespace App\GraphQL\Queries;

use App\Models\Contact;
use App\Models\Favorite;
use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;

final class Getcontacts
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = auth()->user()->id;
        $company_id = User::where('id','=',$id)->select('company_id')->get();
        $company_id_test = json_decode($company_id);
        $start = ($args['page']-1) * 6 ;

        if($args['search'] == ""){
            $contacts = Contact::where('company_id','=',$company_id_test[0]->company_id)->skip($start)->take(6)->orderBy('id', 'DESC')->get();
        }else{
            $contacts = Contact::where('company_id','=',$company_id_test[0]->company_id)->where(function($query) use ($args) {
                $query->where('first_name','LIKE','%'.$args['search'].'%')
                            ->orWhere('last_name','LIKE','%'.$args['search'].'%')
                            ->orWhere('email','LIKE','%'.$args['search'].'%')
                            ->orWhere('phone','LIKE','%'.$args['search'].'%')
                            ->orWhere('id','LIKE','%'.$args['search'].'%');
        })->skip($start)->take(6)->get();
        }
        
        $total_count = [];
        foreach($contacts as $contact){
            $cont = [
                'user_id'=>$contact->user_id,
                'id' => $contact->id,
                'image'=> $contact->image,
                'first_name'=> $contact->first_name,
                'last_name'=> $contact->last_name,
                'email' => $contact->email,
                'phone'=> $contact->phone,
                'status'=> $contact->status,
                'fav'=>false
            ];
            if(Favorite::where([['user_id','=',$id],['contact_id','=',$contact->id]])->first()){
                $cont['fav'] = true;
            }else{
                $cont['fav'] = false;
            }
            // $contact_total
            $total_count[] = $cont;
        }

        return $total_count; 

    }
}
