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
        // $dd = totalRevenue();
        // dd((json_encode($dd, JSON_UNESCAPED_UNICODE)));
        return view('insights', compact('listOfInsights'));
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
                    $data['name'] = 'Patients envoyés';
                    $data['categories'] = getTopPrescribersName()[0];
                    $data['data'] = getTopPrescribersCount()[0];
                    return response()->json($data);
                }
                if ($request->insight == 'MTDRAACP') {
                    $data = array();
                    $data['chart'] = 'bar';
                    $data['title'] = 'Montant total des ristournes attribuées à chaque prescripteur';
                    $data['name'] = 'Ristourne';
                    $data['categories'] = getPrescribersName();
                    $data['data'] = getDiscountsPerPrescriber();
                    return response()->json($data);
                }
                if ($request->insight == 'RDPPSP') {
                    $data = array();
                    $data['chart'] = 'pie';
                    $data['title'] = 'Répartition des prescripteurs par spécialité';
                    $data['name'] = null;
                    $data['categories'] = null;
                    $data['data'] = prescribersBySpecialty();
                    return response()->json($data);
                }
                if ($request->insight == getInitial('Nombre d\'examens prescrits par spécialité')) {
                    $data = array();
                    $data['chart'] = 'bar';
                    $data['title'] = 'Nombre d\'examens prescrits par spécialité';
                    $data['name'] = 'Examens prescrits';
                    $data['categories'] = examsBySpecialtyName();
                    $data['data'] = examsBySpecialtyCount();
                    return response()->json($data);
                }
                if ($request->insight == getInitial('Top examens les plus prescrits')) {
                    $data = array();
                    $data['chart'] = 'column';
                    $data['title'] = 'Top examens les plus prescrits';
                    $data['name'] = 'Examens';
                    $data['categories'] = topExamsName()[0];
                    $data['data'] = topExamsCount()[0];
                    return response()->json($data);
                }
                if ($request->insight == getInitial('Total des recettes générées')) {
                    $data = array();
                    $data['chart'] = 'line';
                    $data['title'] = 'Total des recettes générées';
                    $data['name'] = null;
                    $data['categories'] = null;
                    $data['data'] = totalRevenue($request->yearpicker);
                    return response()->json($data);
                }
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
