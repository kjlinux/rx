<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Rebate;
use App\Models\Patient;
use App\Models\Voucher;
use App\Models\Prescriber;
use App\Models\Examination;
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

    public function priceCalculator(Request $request){
        try{
            if($request->ajax()){
                $examination_data = getPrice($request->examination);
                return response()->json(['examination_data' => $examination_data[0], 'date' => $examination_data[1], 'time' => $examination_data[2]]);
            }
        } catch (Exception $e){
            $e->getMessage();
        }
    }

    public function registerExamination(Request $request){
        try{
            if($request->ajax()){
                $voucher = new Voucher;
                $patient = new Patient;
                $examination = new Examination;
                $rebate = new Rebate;

                $voucher->date = $request->date;
                $voucher->time = $request->time;
                $voucher->amount_to_pay = $request->total_amount;
                $voucher->payed = $request->payed_amount;
                $voucher->left_to_pay = $request->left_to_pay;
                $voucher->discount = $request->discount;
                $voucher->amount_after_discount = $request->after_discount;
                $voucher->save();

                dd($voucher->id);

                // $patient->

                return response()->json(["j" => $voucher->id]);
            }
        } catch (Exception $e){
            $e->getMessage();
        }
    }
}
