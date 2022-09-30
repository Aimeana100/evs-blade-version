<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'time',
        'activity',
    ];

    public function user(){
        return $this->belongsTo(GateKeeper::class, 'user_id');
    }
}
