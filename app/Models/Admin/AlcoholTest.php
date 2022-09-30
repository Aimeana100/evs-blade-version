<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlcoholTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'gatename',
        'fullname_tested',
        'fullname_tester',
        'witness',
        'sn_instrument',
        'time',
        'result',
        'sn_instrument2',
        'result2',
        'smell_of_alcohol',
        'slurred_speech',
        'talkative',
        'unsteady_on_feet',
        'bloodshot_eyes',
        'Cooperative',
        'observation',
    ];
}
