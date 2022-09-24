<?php

namespace App\GraphQL\Mutations;

use App\Models\Company;
use GraphQL\Error\Error;

final class UpdateCompanyprofile
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $comp_id = auth()->user()->company_id;
        $role= auth()->user()->role;

        if($role== "admin"){
            $users = Company::where('id','=',$comp_id)->update(['name'=>$args['name'],'vat_num'=>$args['vat_num'],
            'street'=>$args['street'],'street2'=>$args['street2'],'city'=>$args['city'],
            'state'=>$args['state'],'zip'=>$args['zip'],'country'=>$args['country']]);
            if($users){
                return "updated successfully";
            }else{
                throw new Error('failed to updated');
            }
        }
        else{
            throw new Error('You dont have a permission to edit company profile');
        }
    }
}
