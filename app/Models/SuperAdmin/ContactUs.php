<?php

namespace App\Models\SuperAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';



    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];
}
