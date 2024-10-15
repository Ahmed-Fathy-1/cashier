<?php

namespace App\Models\SuperAdmin;

use App\Models\SuperAdmin\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'] ;

    public function packageDetails()
    {
        return $this->hasOne(PackageDetails::class , 'package_id');
    }

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

}
