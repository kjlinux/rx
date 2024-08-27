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
        // dd(isSpecialHoliday());
        // return VoucherController::generateVoucher($data);

        return view('patients.add_patient', compact('exam_data', 'center_data', 'prescriber_data'));
    }

    public function updatePatient()
    {
        // dd(getRegister());
        $exam_data = ExaminationType::getExaminations();
        $center_data = getCentersWhithCategory();
        $prescriber_data  = Prescriber::getPrescribers();
        $register = getRegister();
        // $deleted = Flight::where('active', 0)->delete();
        // $examination = Examination::where('patient_id', 4)->delete();
        // $examination->delete();
        // $patient = Patient::find('voucher_id');
        // $patient = getPatient(16);
        // dd($register);
        return view('patients.update_patient', compact('exam_data', 'center_data', 'prescriber_data', 'register'));
    }

    public function payedPatient()
    {
        // dd(getLeftToPayForPatient());
        $left_to_pay = getLeftToPayForPatient();
        return view('patients.payed_patient', compact('left_to_pay'));
    }

    public function testVoucher()
    {
        return view('voucher');
    }

    public function priceCalculator(Request $request)
    {
        try {
            if ($request->ajax()) {
                $examination_data = getPrice($request->examination);
                return response()->json([
                    'examination_data' => $examination_data[0],
                    'date' => $examination_data[1],
                    'time' => $examination_data[2]
                ]);
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

                $patient->name = capitalizeWords($request->name);
                $patient->forenames = capitalizeWords($request->forenames);
                $patient->gender = $request->gender;
                $patient->age = $request->year;
                $patient->phone = $request->phone;
                $patient->clinical_information = $request->clinical_information;
                $patient->center_id = $request->center;
                $patient->save();

                $voucher->date = $request->date;
                $voucher->time = $request->time;
                $voucher->amount_to_pay = $request->total_amount;
                $voucher->payed = $request->payed_amount;
                $voucher->left_to_pay = $request->left_to_pay;
                $voucher->discount = $request->discount;
                $voucher->amount_after_discount = is_null($request->after_discount) ? $request->total_amount : $request->after_discount;
                $voucher->slug = $voucher->slug();
                $voucher->patient_id  = $patient->id;
                $voucher->save();

                foreach ($request->examination as $examination_id) {
                    $examination = new Examination;
                    $examination->patient_id = $patient->id;
                    $examination->examination_type_id = $examination_id;
                    $examination->save();
                }

                // foreach ($request->prescriber as $prescriber_id) {
                //     $rebate = new Rebate;
                //     $rebate->prescriber_id = $prescriber_id;
                //     $rebate->save();
                // }

                $prescriber = $request->prescriber;
                if ($prescriber != null && $prescriber !== "1000") {
                    $send = new Send;
                    $send->patient_id = $patient->id;
                    $send->prescriber_id = $prescriber;
                    $send->save();
                } else {
                    $send = new Send;
                    $send->patient_id = $patient->id;
                    $send->prescriber_id = 1000;
                    $send->save();
                }

                $data = array();
                $data['id'] = $patient->id;
                $data['date'] = convertToDateString($voucher->date);
                $data['time'] = $voucher->time;
                $data['name'] = $patient->name;
                $data['forenames'] = $patient->forenames;
                $data['amount_to_pay'] = is_null($voucher->amount_after_discount) ?  $voucher->amount_to_pay : $voucher->amount_after_discount;
                $data['payed'] = is_null($voucher->payed) ? 0 : $voucher->payed;
                $data['left_to_pay'] = is_null($voucher->payed) ? 0 : $voucher->left_to_pay;
                $data['amount_to_pay_in_letters'] = capitalizeWords(nummberToLetters($data['amount_to_pay']));
                $data['examination'] = getExaminationsNames($request->examination);
                $data['slug'] = $voucher->slug;

                return VoucherController::generateVoucher($data);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function displayPatientInformations(Request $request)
    {
        try {
            if ($request->ajax()) {
                $patient = getPatient($request->id)[0];
                return response()->json([
                    'name' => $patient[0],
                    'forename' => $patient[1],
                    'year' => $patient[2],
                    'gender' => $patient[3],
                    'prescriber' => $patient[4],
                    'center' => $patient[5],
                    'examination' => $patient[6],
                    'clinical_information' => $patient[7],
                    'phone' => $patient[8],
                    'total_amount' => $patient[9],
                    'discount' => $patient[10],
                    'after_discount' => $patient[11],
                    'payed_amount' => $patient[12],
                    'left_to_pay' => $patient[13],
                    'date' => $patient[14],
                    'time' => $patient[15],
                    'slug' => $patient[16]
                ]);
                // return response()->json($request->all());
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updatePatientRecord(Request $request)
    {
        try {
            if ($request->ajax()) {
                $voucher = Voucher::find($request->id);
                $patient = Patient::find($request->id);
                $examination = Examination::where('patient_id', $request->id)->delete();
                $send = Send::where('patient_id', $request->id)->delete();

                $patient->name = capitalizeWords($request->name);
                $patient->forenames = capitalizeWords($request->forename);
                $patient->gender = $request->gender;
                $patient->age = $request->year;
                $patient->phone = $request->phone;
                $patient->clinical_information = $request->clinical_information;
                $patient->center_id = $request->center;
                $patient->save();

                $voucher->date = $request->date;
                $voucher->time = $request->time;
                $voucher->amount_to_pay = $request->total_amount;
                $voucher->payed = $request->payed_amount;
                $voucher->left_to_pay = $request->left_to_pay;
                $voucher->discount = $request->discount;
                $voucher->amount_after_discount = is_null($request->after_discount) ? $request->total_amount : $request->after_discount;
                $voucher->slug = $voucher->slug();
                $voucher->patient_id  = $patient->id;
                $voucher->save();

                foreach ($request->examination as $examination_id) {
                    $examination = new Examination;
                    $examination->patient_id = $patient->id;
                    $examination->examination_type_id = $examination_id;
                    $examination->save();
                }

                $prescriber = $request->prescriber;
                if ($prescriber != null && $prescriber !== "1000") {
                    $send = new Send;
                    $send->patient_id = $patient->id;
                    $send->prescriber_id = $prescriber;
                    $send->save();
                }

                return response()->json();
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function dataTableRefresh(Request $request)
    {
        try {
            return response()->json(getRegister());
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deletePatient(Request $request)
    {
        try {
            if ($request->ajax()) {
                Send::where('patient_id', $request->id)->delete();
                Examination::where('patient_id', $request->id)->delete();
                Patient::where('id', $request->id)->delete();
                Voucher::where('id', $request->id)->delete();
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function dataTableRefreshPayment(Request $request)
    {
        try {
            if ($request->ajax()) {
                return response()->json(getLeftToPayForPatient());
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function confirmPatientPayment(Request $request)
    {
        try {
            if ($request->ajax()) {
                $voucher = Voucher::find($request->id);
                $voucher->payed = NULL;
                $voucher->left_to_pay = NULL;
                $voucher->save();
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
