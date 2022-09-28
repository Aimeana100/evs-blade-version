<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Admin\Vistor;
use Illuminate\Http\Request;
use App\Models\Admin\CardTap;
use App\Models\Admin\Employee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CardTapCollection;
use App\Http\Resources\VisitorCollection;

class VistorController extends Controller
{
    public function vistors(Request $request)
    {



            $vistors = Vistor::with('taps')->get();

            if ($request->has('start_date')) {

                if ($request->start_date != "" && $request->end_date != '') {
                    $dateS = date($request->start_date);
                    $dateE = date($request->end_date);
                }
            } else {
                $dateS = date('Y-m-d');
                $dateE = date('Y-m-d');
            }


            $taps = CardTap::orderBy('tapped_at', 'DESC')
                ->whereBetween('tapped_at', [$dateS . " 00:00:00", $dateE . " 23:59:59"])
                ->pluck('tapped_at')
                ->toArray();


            $ymdDate = array_map(function ($el) {

                return date('Y-m-d', strtotime($el));
            }, $taps);


            $noDuplicate = array_slice(array_map(function ($el) {
                return $el;
            }, array_unique($ymdDate)), 0);

            $daysTaps = [];

            $noDuplicate = array_slice($noDuplicate, 0, 5);

            foreach ($noDuplicate as $t) {

                foreach ($vistors->toArray() as $vistor) {

                    // dd($vistor['id']);

                    // dd(array_map( function($tap){ return date('Y-m-d', strtotime($tap['tapped_at']));
                    // },$vistor['taps']), $t);


                    if (in_array($t, array_map(function ($tap) {

                        return date('Y-m-d', strtotime($tap['tapped_at']));
                    }, $vistor['taps']))) {

                        // dd($vistor['taps'], $t, in_array($t, array_map(function ($tap) {

                        //     return date('Y-m-d', strtotime($tap['tapped_at']));

                        // }, $vistor['taps'])), array_map(function ($el){return $el['tapped_at'];},$vistor['taps']), 
                        // array_filter($vistor['taps'], function($element) use($t){
                        //     return date('Y-m-d', strtotime($element['tapped_at'])) == $t;
                        // }) );

                        if (array_key_exists($t, $daysTaps)) {

                            array_push($daysTaps[$t], $vistor);
                        } else {
                            $daysTaps[$t] = [];
                            array_push($daysTaps[$t], $vistor);
                        }
                    }
                }
            }
            
            // dd( $daysTaps);

            return view('admin.visitors', ['filter' => $noDuplicate, 'daysTaps' => $daysTaps]);
        
    }
}
