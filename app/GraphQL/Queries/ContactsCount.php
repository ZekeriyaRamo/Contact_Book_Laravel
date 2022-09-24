<?php

namespace App\GraphQL\Queries;

use App\Models\Contact;
use App\Models\User;

final class ContactsCount
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
        
        $contacts_count = Contact::where('company_id','=',$company_id_test[0]->company_id)->select('id')->count();
        return $contacts_count;
        
    }
}
