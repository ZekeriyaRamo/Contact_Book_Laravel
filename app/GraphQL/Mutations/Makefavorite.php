<?php

namespace App\GraphQL\Mutations;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

final class Makefavorite
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = auth()->user()->id;
        $favorite = Favorite::where(['user_id'=>$id,'contact_id'=>$args['contact_id']])->first();
        if($favorite == ""){
            $favorite = Favorite::create(['user_id'=>$id,'contact_id'=>$args['contact_id']]);
            $id = Auth::user()->id;
            $favorite = Favorite::where(['user_id'=>$id])->get();
            return $favorite;
        }   
        else {
            $favorite = Favorite::where(['user_id'=>$id,'contact_id'=>$args['contact_id']])->delete();
            $id = Auth::user()->id;
            $favorite = Favorite::where(['user_id'=>$id])->get();
            return $favorite;
        }
              
    }
}
