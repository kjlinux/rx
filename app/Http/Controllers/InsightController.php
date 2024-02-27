<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class InsightController extends Controller
{
    //
    public function insights()
    {
        $listOfInsights = getInsights();
        $dd = getTopPrescribers();
        dd(json_encode($dd));
        return view('insights', compact('listOfInsights', 'dd'));
    }

    public function drawer(Request $request)
    {
        try {
            if ($request->ajax()) {
                if ($request->insight == getInitial('Nombre de prescripteurs par centre')) {
                    $data = array();
                    $data['chart'] = 'bar';
                    $data['title'] = 'Nombre de prescripteurs par centre';
                    $data['name'] = 'Prescripteurs';
                    $data['categories'] = getCentersNameWhithCategory();
                    $data['data'] = getPrescribersCenter();
                    return response()->json($data);
                }
                if ($request->insight == getInitial('Répartition des patients par genre')) {
                    $data = array();
                    $data['chart'] = 'pie';
                    $data['title'] = 'Répartition des patients par genre';
                    $data['name'] = null;
                    $data['categories'] = null;
                    $data['data'] = getPatientsByGender();
                    return response()->json($data);
                }
                if ($request->insight == getInitial('Répartition des patients par tranche d\'âge')) {
                    $data = array();
                    $data['chart'] = 'column';
                    $data['title'] = 'Répartition des patients par tranche d\'âge';
                    $data['name'] = 'Patients';
                    $data['categories'] = getAgeGroupForPatients();
                    $data['data'] = getPatientsByAgeGroup();
                    return response()->json($data);
                }
                if ($request->insight == getInitial('Top prescripteurs par le nombre d\'examens prescrits')) {
                    $data = array();
                    $data['chart'] = 'bar';
                    $data['title'] = 'Top prescripteurs par le nombre d\'examens prescrits';
                    $data['name'] = 'Prescripteurs';
                    $data['categories'] = getCentersNameWhithCategory();
                    $data['data'] = getPrescribersCenter();
                    return response()->json($data);
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
