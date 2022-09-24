<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'street',
        'street2',
        'state',
        'city',
        'country',
        'vat_num',
        'zip'
    ];


    public function User()
    {
        return $this->hasMany(User::class);   
    }
    public function Contacts()
    {
        return $this->hasMany(Contact::class);
    }

}
