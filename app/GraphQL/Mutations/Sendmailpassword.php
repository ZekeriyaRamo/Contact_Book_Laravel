<?php

namespace App\GraphQL\Mutations;
use GraphQL\Error\Error;
use App\Models\User;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
// use App\Mail\TestMail;

// use Illuminate\Support\Facades\Mail;
final class Sendmailpassword
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::where('email','=',$args['email'])->first();
        
        if($user == ""){
            throw new Error('There is no user for this email');
        }
        $token = $user->createToken('auth-token')->plainTextToken;

        $token_sub = substr($token,strpos($token,'|')+1);
        $details = [
            'title' => 'reset password',
            'body' => 'Click the button to continue your order',
            'token' => $token_sub
        ];

        Mail::to($args['email'])->send(new TestMail($details));
        return $token;
        return "Email has been Sent";
        
    }
}
