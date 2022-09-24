<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable =[
        'image',
        'first_name',
        'last_name',
        'email',
        'phone',
        'company_id',
        'user_id',
        'status',
        'email2',
        'mobile',
        'address1',
        'address2',
    ];

    public function Company()
    {
        return $this->belongsTo(Company::class);   
    }
    public function User()
    {
        return $this->belongsTo(User::class);   
    }
/*     public function Activity()
    {
        return $this->hasMany(Activity::class);
    } */

}
