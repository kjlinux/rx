<?php

namespace App\Http\Controllers;

use App\Models\Functions;
use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrescriberController extends Controller
{
    //
    public function new_prescriber(){
        $center_data = getCentersWhithCategory();
        $function_data = Functions::getFunctions();
        $speciality_data = Speciality::getSpecialities();
        return view('prescribers.add_prescriber', compact('center_data', 'function_data', 'speciality_data'));
    }

    public function update_prescriber(){
        $center_data = getCentersWhithCategory();
        $function_data = Functions::getFunctions();
        $speciality_data = Speciality::getSpecialities();
        return view('prescribers.update_prescriber', compact('center_data', 'function_data', 'speciality_data'));
    }

    public function payed_prescriber(){
        return view('prescribers.payed_prescriber');
    }
}
