<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Send;
use App\Models\Functions;
use App\Models\Prescriber;
use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrescriberController extends Controller
{
    //
    public function new_prescriber()
    {
        $center_data = getCentersWhithCategory();
        $function_data = Functions::getFunctions();
        $speciality_data = Speciality::getSpecialities();
        return view('prescribers.add_prescriber', compact('center_data', 'function_data', 'speciality_data'));
    }

    public function update_prescriber()
    {
        $center_data = getCentersWhithCategory();
        $function_data = Functions::getFunctions();
        $speciality_data = Speciality::getSpecialities();
        $prescribers = getPrescribers();
        // dd($prescribers);
        return view('prescribers.update_prescriber', compact('center_data', 'function_data', 'speciality_data', 'prescribers'));
    }

    public function payed_prescriber()
    {
        $rebates = getRebates();
        // dd($rebates);
        return view('prescribers.payed_prescriber', compact('rebates'));
    }

    public function recordPrescriber(Request $request)
    {
        try {
            if ($request->ajax()) {
                $prescriber = new Prescriber;

                $prescriber->name = capitalizeWords($request->name);
                $prescriber->forenames = capitalizeWords($request->forename);
                $prescriber->center_id = $request->center;
                $prescriber->function_id = $request->function;
                $prescriber->speciality_id = $request->speciality;
                $prescriber->save();
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function displayPrescriberInformations(Request $request)
    {
        try {
            if ($request->ajax()) {
                $prescriber = getPrescribers($request->id)[0];
                return response()->json([
                    'name' => $prescriber[0],
                    'forename' => $prescriber[1],
                    'center' => $prescriber[2],
                    'function' => $prescriber[3],
                    'speciality' => $prescriber[4],
                ]);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updatePrescriberRecord(Request $request)
    {
        try {
            if ($request->ajax()) {
                $prescriber = Prescriber::find($request->id);

                $prescriber->name = capitalizeWords($request->name);
                $prescriber->forenames = capitalizeWords($request->forename);
                $prescriber->center_id = $request->center;
                $prescriber->function_id = $request->function;
                $prescriber->speciality_id = $request->speciality;
                $prescriber->save();
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function dataTableRefresh(Request $request)
    {
        try {
            if ($request->ajax()) {
                return response()->json(getPrescribers());
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deletePrescriber(Request $request)
    {
        try {
            if ($request->ajax()) {
                Prescriber::where('id', $request->id)->delete();
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function dataTableRefreshPayment(Request $request)
    {
        try {
            if ($request->ajax()) {
                return response()->json(getRebates());
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function confirmPrescriberPayment(Request $request)
    {
        try {
            if ($request->ajax()) {
                Send::where('id', $request->id)->delete();
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
