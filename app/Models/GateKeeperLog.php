<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GateKeeperLog extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'session',
        'time',
        'gate_keeper_id',
        'loginDevice',
        'activity',
    ];

    public function gatekeeper(){
        return $this->belongsTo(GateKeeper::class, 'gate_keeper_id');
    }
}
