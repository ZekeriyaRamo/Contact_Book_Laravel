<?php

namespace App\GraphQL\Mutations;
use App\Models\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class Login
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::where('email', $args['email'])->first();
        if($user){
            if($user->status == 'Locked'){
                throw new Error('Your account has been locked');
            }
    
            if($user->status == 'Pending'){
                throw new Error('verify your account');
            }
        }
        if (! $user || ! Hash::check($args['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        

        return $user->createToken('token name')->plainTextToken;
    }
}
