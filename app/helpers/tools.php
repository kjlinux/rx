<?php

use Carbon\Carbon;
use App\Models\ExaminationType;
use Illuminate\Support\Facades\DB;

function getInitial($phrase) {
    $mots = explode(' ', $phrase); 
    $initiales = '';

    foreach ($mots as $mot) {
        $premiereLettre = substr($mot, 0, 1);
        $initiales .= strtoupper($premiereLettre);
    }

    return $initiales;
}

function getCentersWhithCategory(){
    return DB::table('center_categories')
            ->join('centers', 'center_categories.id', '=', 'centers.center_category_id')
            ->selectRaw("CONCAT(center_categories.name, ' ', centers.name) AS center_name, centers.id")
            ->orderBy('center_name')
            ->pluck('center_name', 'centers.id');
}

// function _isSunday(Carbon $date){
//     if ($date->isSunday())
//     {
//         return true;
//     }
//     else 
//     {
//         return false;
//     }
// }

function isHoliday(Carbon $date){
    $format_date = Carbon::createFromFormat('Y-m-d', $date->toDateString())->format('m-d');
    $matching = DB::table('holidays')
                ->select('name')
                ->where('primary_date', $format_date)
                ->orWhere('secondary_date', $format_date)
                ->where('activated', 1)
                ->pluck('name');

    if (!$matching->isEmpty())
    {
        return true;
    }
    else
    {
        return false;
    }
}

function getPrice(Array $examinations){
    $today = now();
    $total_price = null;
    foreach($examinations as $examination){
        $z_coefficient = DB::table('examinations_type')
                        ->select('z_coefficient')
                        ->where('id', $examination)
                        ->pluck('z_coefficient');
        
        $temporary_price = $z_coefficient[0]*1000;

        if($today->isSunday() || isHoliday($today))
        {
            $temporary_price += 2500;
        }

        if (($today->hour >= 19 && $today->hour <= 23) || ($today->hour >= 0 && $today->hour < 7))
        {
            $temporary_price += $temporary_price/2;
        }

        $total_price += $temporary_price;
    }

    return $total_price;
}