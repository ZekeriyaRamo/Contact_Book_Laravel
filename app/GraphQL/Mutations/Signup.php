<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
final class Signup
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {

        $validator = Validator::make($args, [
            'password' => 'min:8',
        ]);
        if ($validator->fails()) {
            throw new Error('The password must be at least 8 characters');
        }
        $vat_number = Company::where('vat_num','=',$args['vat_num'])->select('vat_num')->get();
        $vat_number_test = json_decode($vat_number);
        if($vat_number_test != []){
            throw new Error('The Vat number is already exists');
        }
        $company = Company::create([
            'name'=>$args['company_name'],
            'vat_num'=>$args['vat_num'],
            'street'=>$args['street'],
            'street2'=>$args['street2'],
            'city'=>$args['city'],
            'state'=>$args['state'],
            'zip'=>$args['zip'],
            'country'=>$args['country'],
        ]);
        $email = User::where('email','=',$args['email'])->select('email')->get();
        $email_test = json_decode($email);
        if($email_test != []){
            throw new Error('The email has been already created');
        }
        if($company){
            $user = User::create(['first_name' =>$args['first_name'],
            'last_name'=>$args['last_name'],
            'email'=>$args['email'],
            'password'=>bcrypt($args['password']),
            'status'=>'active',
            'role'=>'admin',
            'company_id' => $company->id]);
            if($user && $company){
                // $user->notify(new WelcomeEmailNotification());
                return "Account created successfully";
            }else{
                return "failed to create Account";
            }
        }
        // $token = $user->createToken('myapptoken')->plainTextToken;
        // return $token;
    }

}
