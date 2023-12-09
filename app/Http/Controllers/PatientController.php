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
use App\Models\Send;

class PatientController extends Controller
{
    //
    public function newPatient()
    {
        $exam_data = ExaminationType::getExaminations();
        $center_data = getCentersWhithCategory();
        $prescriber_data  = Prescriber::getPrescribers();
        return view('patients.add_patient', compact('exam_data', 'center_data', 'prescriber_data'));
    }

    public function updatePatient()
    {
        $exam_data = ExaminationType::getExaminations();
        $center_data = getCentersWhithCategory();
        $prescriber_data  = Prescriber::getPrescribers();
        // $register = json_encode(htmlspecialchars_decode(getRegister(), ENT_QUOTES) , JSON_UNESCAPED_UNICODE);
        // $register = json_encode(getRegister(), JSON_UNESCAPED_UNICODE);
        // $register = array_values(getRegister());
        $register = getRegister();
        // dd($register);
        return view('patients.update_patient', compact('exam_data', 'center_data', 'prescriber_data', 'register'));
    }

    public function payedPatient()
    {
        return view('patients.payed_patient');
    }

    public function priceCalculator(Request $request)
    {
        try {
            if ($request->ajax()) {
                $examination_data = getPrice($request->examination);
                return response()->json(['examination_data' => $examination_data[0], 'date' => $examination_data[1], 'time' => $examination_data[2]]);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function recordExamination(Request $request)
    {
        try {
            if ($request->ajax()) {
                $voucher = new Voucher;
                $patient = new Patient;

                $voucher->date = $request->date;
                $voucher->time = $request->time;
                $voucher->amount_to_pay = $request->total_amount;
                $voucher->payed = $request->payed_amount;
                $voucher->left_to_pay = $request->left_to_pay;
                $voucher->discount = $request->discount;
                $voucher->amount_after_discount = $request->after_discount;
                $voucher->slug = $voucher->newUniqueId();
                $voucher->save();

                $patient->name = capitalizeWords($request->name);
                $patient->forenames = capitalizeWords($request->forenames);
                $patient->gender = $request->gender;
                $patient->age = extractYear($request->year);
                $patient->phone = deleteHyphens($request->phone);
                $patient->clinical_information = capitalizeWords($request->clinical_information);
                $patient->voucher_id  = $voucher->id;
                $patient->center_id = $request->center;
                $patient->save();

                foreach ($request->examination as $examination_id) {
                    $examination = new Examination;
                    $examination->patient_id = $patient->id;
                    $examination->examination_type_id = $examination_id;
                    $examination->save();
                }

                foreach ($request->prescriber as $prescriber_id) {
                    $rebate = new Rebate;
                    $rebate->amount = 1000;
                    $rebate->prescriber_id = $prescriber_id;
                    $rebate->save();
                }

                foreach ($request->prescriber as $prescriber_id) {
                    $send = new Send;
                    $send->patient_id = $patient->id;
                    $send->prescriber_id = $prescriber_id;
                    $send->save();
                }

                return response()->json(["y" => "yyy"]);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // public function displayRegister(Request $request){
    //     try{
    //         if($request->ajax()){
    //         $register = getRegister();
    //             return response()->json(['register' => $register]);
    //         }
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
}
