<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'contactname',
        'username',
        'user_id',
        'contact_id',
        'date',
        'username',
        'company_id',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Contact()
    {
        return $this->belongsTo(Contact::class);
    }
    
}
