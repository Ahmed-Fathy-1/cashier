<?php

namespace App\Models\SuperAdmin\Needes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubNeeds extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function main_need()
    {
        return $this->belongsTo(MainNeed::class);
    }
}
