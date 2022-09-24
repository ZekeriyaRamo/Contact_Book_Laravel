<?php

namespace App\GraphQL\Queries;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

final class Getfavorite
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $id = Auth::user()->id;
        $favorite = Favorite::where(['user_id'=>$id])->get();
        return $favorite;
                

    }
}
