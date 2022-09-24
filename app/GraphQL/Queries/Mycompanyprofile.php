<?php

namespace App\GraphQL\Queries;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class Mycompanyprofile
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $comp_id = auth()->user()->company_id;
        $company = Company::where('id', $comp_id)->first(); 
        return $company;
    }
}
