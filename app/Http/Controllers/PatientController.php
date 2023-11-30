<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Prescriber;
use Illuminate\Http\Request;
use App\Models\ExaminationType;

class PatientController extends Controller
{
    //
    public function newPatient(){
        // dd(getPrice([1]));
        $exam_data = ExaminationType::getExaminations();
        $center_data = getCentersWhithCategory();
        $prescriber_data  = Prescriber::getPrescribers();
        return view('patients.add_patient', compact('exam_data', 'center_data', 'prescriber_data'));
    }

    public function updatePatient(){
        $exam_data = ExaminationType::getExaminations();
        $center_data = getCentersWhithCategory();
        $prescriber_data  = Prescriber::getPrescribers();
        return view('patients.update_patient', compact('exam_data', 'center_data', 'prescriber_data'));
    }

    public function payedPatient(){
        return view('patients.payed_patient');
    }

    public function registerExamination(Request $request){
        try{
            if($request->ajax()){
                return response()->json($request->all());
            }
        } catch (Exception $e){
            $e->getMessage();
        }
    }

    public function priceCalculator(Request $request){
        try{
            if($request->ajax()){
                $examination_data = getPrice($request->examination);
                return response()->json(['examination_data' => $examination_data]);
            }
        } catch (Exception $e){
            $e->getMessage();
        }
    }
}
