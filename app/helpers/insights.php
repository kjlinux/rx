<?php

use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Voucher;
use App\Models\Prescriber;
use App\Models\Examination;
use Illuminate\Support\Facades\DB;

function getInsights()
{
    return array(
        getInitial('Nombre de prescripteurs par centre') => 'Nombre de prescripteurs par centre',
        // getInitial('Nombre total de patients suivis') => 'Nombre total de patients suivis',
        getInitial('Répartition des patients par genre') => 'Répartition des patients par genre',
        getInitial('Répartition des patients par tranche d\'âge') => 'Répartition des patients par tranche d\'âge',
        getInitial('Top prescripteurs par le nombre d\'examens prescrits') => 'Top prescripteurs par le nombre d\'examens prescrits',
        'MTDRAACP' => 'Montant total des ristournes attribuées à chaque prescripteur',
        /*2*/
        'RDPPSP' => 'Répartition des prescripteurs par spécialité',
        getInitial('Nombre d\'examens prescrits par spécialité') => 'Nombre d\'examens prescrits par spécialité',
        /*3*/
        getInitial('Top examens les plus prescrits') => 'Top examens les plus prescrits',
        /*1*/
        getInitial('Total des recettes générées') => 'Total des recettes générées',
        // 'MDMTAPPP' => 'Moyenne du montant total à payer par patient',
        'EDRAFDT' => 'Évolution des recettes au fil du temps',
        // getInitial('Montant total des recettes générées') => 'Montant total des recettes générées',
        // getInitial('Pourcentage du montant total des recettes attribué en ristournes') => 'Pourcentage du montant total des recettes attribué en ristournes',
        // getInitial('Répartition des ristournes par prescripteur') => 'Répartition des ristournes par prescripteur',
        getInitial('Nombre de patients par mois') => 'Nombre de patients par mois',
        getInitial('Répartition des patients par centre') => 'Répartition des patients par centre',
        // 'EDLRDPPSAFDT' => 'Évolution de la répartition des patients par sexe au fil du temps',
        // getInitial('Moyenne d\'âge des patients dans le cabinet') => 'Moyenne d\'âge des patients dans le cabinet',
        // getInitial('Nombre d\'examens par patient') => 'Nombre d\'examens par patient',
        // getInitial('Fréquence des visites par jour/semaine/mois') => 'Fréquence des visites par jour/semaine/mois',
        // getInitial('Heures de pointe pour les consultations') => 'Heures de pointe pour les consultations',
        getInitial('Tendances saisonnières des examens') => 'Tendances saisonnières des examens',
        getInitial('Répartition des examens par tranche d\'âge des patients') => 'Répartition des examens par tranche d\'âge des patients',
        // getInitial('Répartition des examens par centre') => 'Répartition des examens par centre',
        // 'EDTDREDPAFDT' => 'Évolution du total des recettes et des paiements au fil du temps',
        // getInitial('Répartition des ristournes par mois ou par trimestre') => 'Répartition des ristournes par mois ou par trimestre',
        // 'EDNDPPPAFDT' => 'Évolution du nombre de patients par prescripteur au fil du temps',
        /*4*/
        getInitial('Heures de la journée les plus fréquentées pour les examens') => 'Heures de la journée les plus fréquentées pour les examens'
    );
}

function getPrescribersCenter()
{
    return Prescriber::select('center_id', DB::raw('count(*) as prescriber_count'))
        ->groupBy('center_id')
        // ->get()
        ->pluck('prescriber_count');
    // ->map(function ($item) {
    //     return array_values((array) $item);
    // })
    // ->toArray();
}

function getCentersNameWhithCategory()
{
    return DB::table('center_categories')
        ->join('centers', 'center_categories.id', '=', 'centers.center_category_id')
        ->selectRaw("CONCAT(center_categories.name, ' ', centers.name) AS center_name, centers.id")
        ->orderBy('centers.id')
        ->pluck('center_name');
}

function getPatientsByGender()
{
    return Patient::select('gender AS name', DB::raw('count(*) AS y'))
        ->groupBy('gender')
        ->get();
}

function getAgeGroupForPatients()
{
    $ageInterval = array();

    $agesGroup = Patient::select(DB::raw("FLOOR(age/10)*10 as age_group"))
        ->groupBy('age_group')
        ->orderBy('age_group')
        ->pluck('age_group')
        ->toArray();

    foreach ($agesGroup as $ageGroup) {
        $interval = $ageGroup . '-' . $ageGroup + 9;
        array_push($ageInterval, $interval);
    }
    return $ageInterval;
}

function getPatientsByAgeGroup()
{
    return Patient::select(DB::raw('FLOOR(age/10) as age_group'), DB::raw('count(*) as patient_count'))
        ->groupBy('age_group')
        ->orderBy('age_group')
        ->pluck('patient_count');
}

function getTopPrescribersCount()
{
    return Prescriber::withCount('sends')
        ->orderBy('sends_count', 'desc')
        ->pluck('sends_count')
        ->chunk(5);
    // ->get();
}

function getTopPrescribersName()
{
    return Prescriber::withCount('sends')
        ->orderByDesc('sends_count')
        ->get()
        ->map(function ($prescriber) {
            return 'Dr. ' . $prescriber->name . ' ' . $prescriber->forenames;
        })
        ->chunk(5);
}

function getPrescribersName()
{
    return Prescriber::withCount('sends')
        ->orderByDesc('sends_count')
        ->get()
        ->map(function ($prescriber) {
            return 'Dr. ' . $prescriber->name . ' ' . $prescriber->forenames;
        });
}

function getDiscountsPerPrescriber()
{
    return Prescriber::select('prescribers.id', 'name', DB::raw('SUM(CASE WHEN speciality_id = 2 THEN 5000 ELSE 1000 END) AS total_discount'))
        ->leftJoin('sends', 'prescribers.id', '=', 'sends.prescriber_id')
        ->groupBy('prescribers.id', 'prescribers.name')
        ->pluck('total_discount')
        ->map(function ($discount) {
            return intval($discount);
        });
}

function prescribersBySpecialty()
{
    return Prescriber::join('specialities', 'prescribers.speciality_id', '=', 'specialities.id')
        ->select('specialities.name as name', DB::raw('count(*) as y'))
        ->groupBy('specialities.name')
        ->get();
}

function examsBySpecialtyName()
{
    return Examination::join('examinations_type', 'examinations.examination_type_id', '=', 'examinations_type.id')
        ->join('examinations_group', 'examinations_type.examination_group_id', '=', 'examinations_group.id')
        ->select('examinations_group.name as group_name', DB::raw('count(*) as exam_count'))
        ->groupBy('examinations_group.name')
        ->pluck('group_name');
}

function examsBySpecialtyCount()
{
    return Examination::join('examinations_type', 'examinations.examination_type_id', '=', 'examinations_type.id')
        ->join('examinations_group', 'examinations_type.examination_group_id', '=', 'examinations_group.id')
        ->select('examinations_group.name as group_name', DB::raw('count(*) as exam_count'))
        ->groupBy('examinations_group.name')
        ->pluck('exam_count');
}

function topExamsName()
{
    return Examination::join('examinations_type', 'examinations.examination_type_id', '=', 'examinations_type.id')
        ->select('examinations_type.name as exam_name', DB::raw('count(*) as exam_count'))
        ->groupBy('examinations_type.name')
        ->orderBy('exam_count', 'desc')
        ->pluck('exam_name')
        ->chunk(10);
}

function topExamsCount()
{
    return Examination::join('examinations_type', 'examinations.examination_type_id', '=', 'examinations_type.id')
        ->select('examinations_type.name as exam_name', DB::raw('count(*) as exam_count'))
        ->groupBy('examinations_type.name')
        ->orderBy('exam_count', 'desc')
        ->pluck('exam_count')
        ->chunk(10);
}

function totalRevenue($year)
{
    $totalRevenuePerMonth = Voucher::select(
        DB::raw('MONTHNAME(date) as month'),
        DB::raw('DAY(date) as day'),
        DB::raw('SUM(amount_after_discount) as total_revenue')
    )
        ->whereYear('date', intval($year))
        ->groupBy('month', 'day')
        ->orderBy('month', 'asc')
        ->orderBy('day', 'asc')
        ->get();

    $monthsFr = [
        'January' => 'Janvier',
        'February' => 'Février',
        'March' => 'Mars',
        'April' => 'Avril',
        'May' => 'Mai',
        'June' => 'Juin',
        'July' => 'Juillet',
        'August' => 'Août',
        'September' => 'Septembre',
        'October' => 'Octobre',
        'November' => 'Novembre',
        'December' => 'Décembre',
    ];

    $formattedData = [];

    foreach ($totalRevenuePerMonth as $result) {
        if (!isset($formattedData[$result->month])) {
            $formattedData[$result->month] = [
                'name' => $monthsFr[$result->month],
                'data' => array_fill(0, 31, 0) // Initialise les recettes de chaque jour à 0
            ];
        }

        $formattedData[$result->month]['data'][$result->day - 1] = intval($result->total_revenue);
    }

    $formattedData = array_values($formattedData);

    return $formattedData;
}

function patientsPerMonth()
{
    $patientData = Patient::select(
        DB::raw('YEAR(created_at) as year'),
        DB::raw('MONTH(created_at) as month'),
        DB::raw('COUNT(*) as new_patient_count')
    )
        ->groupBy('year', 'month')
        ->get();

    $formattedData = [];

    foreach ($patientData as $result) {
        if (!isset($formattedData[$result->year])) {
            $formattedData[$result->year] = [
                'name' => $result->year,
                'data' => array_fill(0, 12, 0) // Initialise les nouveaux patients de chaque mois à 0
            ];
        }

        $formattedData[$result->year]['data'][$result->month - 1] = $result->new_patient_count;
    }

    $formattedData = array_values($formattedData);

    return $formattedData;
}

function patientsByCenterName()
{
    return Patient::select(
        DB::raw('CONCAT(center_categories.name, " ", centers.name) AS center_name'),
        DB::raw('count(*) as patient_count')
    )
        ->join('centers', 'patients.center_id', '=', 'centers.id')
        ->join('center_categories', 'centers.center_category_id', '=', 'center_categories.id')
        ->groupBy('center_name')
        ->pluck('center_name');
}

function patientsByCenterCount()
{
    return Patient::select(
        DB::raw('CONCAT(center_categories.name, " ", centers.name) AS center_name'),
        DB::raw('count(*) as patient_count')
    )
        ->join('centers', 'patients.center_id', '=', 'centers.id')
        ->join('center_categories', 'centers.center_category_id', '=', 'center_categories.id')
        ->groupBy('center_name')
        ->pluck('patient_count');
}

function seasonalExamDemand()
{
    $seasonalExamDemand = Examination::select(
        DB::raw('YEAR(created_at) as year'),
        DB::raw('MONTH(created_at) as month'),
        DB::raw('count(*) as exam_count')
    )
        ->groupBy('year', 'month')
        ->get();

    $formattedData = [];

    foreach ($seasonalExamDemand as $result) {
        if (!isset($formattedData[$result->year])) {
            $formattedData[$result->year] = [
                'name' => $result->year,
                'data' => array_fill(0, 12, 0) // Initialise les nouveaux patients de chaque mois à 0
            ];
        }

        $formattedData[$result->year]['data'][$result->month - 1] = $result->exam_count;
    }

    $formattedData = array_values($formattedData);

    return $formattedData;
}

function examsByAgeGroup()
{
    $ageInterval = array();

    $agesGroup = Examination::join('patients', 'examinations.patient_id', '=', 'patients.id')
        ->select(DB::raw('FLOOR(age/10)*10 as age_group'), DB::raw('count(*) as exam_count'))
        ->groupBy('age_group')
        ->orderBy('age_group')
        ->pluck('age_group')
        ->toArray();

    foreach ($agesGroup as $ageGroup) {
        $interval = $ageGroup . '-' . $ageGroup + 9;
        array_push($ageInterval, $interval);
    }
    return $ageInterval;
}

function examsByAgeGroupCount()
{
    return Examination::join('patients', 'examinations.patient_id', '=', 'patients.id')
        ->select(DB::raw('FLOOR(age/10) as age_group'), DB::raw('count(*) as exam_count'))
        ->groupBy('age_group')
        ->orderBy('age_group')
        ->pluck('exam_count')
        ->toArray();
}

function busyExamHours()
{
    return Examination::select(DB::raw("CONCAT(HOUR(created_at), 'H') as hour"), DB::raw('count(*) as exam_count'))
        ->groupBy('hour')
        ->orderBy('hour')
        // ->limit(5)
        ->pluck('hour');
}

function busyExamHoursCount()
{
    return Examination::select(DB::raw('HOUR(created_at) as hour'), DB::raw('count(*) as exam_count'))
        ->groupBy('hour')
        ->orderBy('hour')
        // ->limit(5)
        ->pluck('exam_count');
}

/*For the dashboard*/

function countPatientsToday()
{
    $today = Carbon::today();
    return Patient::whereDate('created_at', $today)->count();
}

function totalRevenueToday()
{
    $today = Carbon::today();
    return Voucher::whereDate('date', $today)->sum('amount_after_discount');
}

function totalRemainingToPay()
{
    $totalAmountToPay = Voucher::sum('amount_after_discount');
    $totalAmountPaid = Voucher::sum('payed');
    $leftToPay = Voucher::sum('left_to_pay');
    return $leftToPay;
    return $totalAmountToPay - $totalAmountPaid;
}

function totalToPayPrescribers()
{
    $amountPerPatient = Prescriber::selectRaw('CASE WHEN speciality_id = 2 THEN 5000 ELSE 1000 END AS amount_per_patient')
        ->pluck('amount_per_patient')
        ->first();

    $totalPatientsSent = Prescriber::join('sends', 'prescribers.id', '=', 'sends.prescriber_id')
        // ->whereDate('sends.created_at', $today)
        ->where('prescribers.id', '!=', 1000)
        ->count();

    $totalToPay = $amountPerPatient * $totalPatientsSent;

    return $amountPerPatient;
}
