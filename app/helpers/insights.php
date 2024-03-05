<?php

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
        'RDPPSP' => 'Répartition des prescripteurs par spécialité',
        getInitial('Nombre d\'examens prescrits par spécialité') => 'Nombre d\'examens prescrits par spécialité',
        getInitial('Top examens les plus prescrits') => 'Top examens les plus prescrits',
        getInitial('Total des recettes générées') => 'Total des recettes générées',
        'MDMTAPPP' => 'Moyenne du montant total à payer par patient',
        'EDRAFDTMOA' => 'Évolution des recettes au fil du temps (mensuelle ou annuelle)',
        getInitial('Montant total des recettes générées') => 'Montant total des recettes générées',
        getInitial('Pourcentage du montant total des recettes attribué en ristournes') => 'Pourcentage du montant total des recettes attribué en ristournes',
        getInitial('Répartition des ristournes par prescripteur') => 'Répartition des ristournes par prescripteur',
        getInitial('Nombre de nouveaux patients par période') => 'Nombre de nouveaux patients par période',
        getInitial('Répartition des patients par centre') => 'Répartition des patients par centre',
        'EDLRDPPSAFDT' => 'Évolution de la répartition des patients par sexe au fil du temps',
        getInitial('Moyenne d\'âge des patients dans le cabinet') => 'Moyenne d\'âge des patients dans le cabinet',
        getInitial('Nombre d\'examens par patient') => 'Nombre d\'examens par patient',
        getInitial('Fréquence des visites par jour/semaine/mois') => 'Fréquence des visites par jour/semaine/mois',
        getInitial('Heures de pointe pour les consultations') => 'Heures de pointe pour les consultations',
        getInitial('Tendances saisonnières dans la demande d\'examens') => 'Tendances saisonnières dans la demande d\'examens',
        getInitial('Répartition des examens par tranche d\'âge des patients') => 'Répartition des examens par tranche d\'âge des patients',
        getInitial('Répartition des examens par centre') => 'Répartition des examens par centre',
        'EDTDREDPAFDT' => 'Évolution du total des recettes et des paiements au fil du temps',
        getInitial('Répartition des ristournes par mois ou par trimestre') => 'Répartition des ristournes par mois ou par trimestre',
        'EDNDPPPAFDT' => 'Évolution du nombre de patients par prescripteur au fil du temps',
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
        DB::raw('SUM(amount_to_pay) as total_revenue')
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

    // Initialisation d'un tableau pour stocker les résultats formatés
    $formattedData = [];

    // Boucle à travers les résultats et formatage des données
    foreach ($totalRevenuePerMonth as $result) {
        // Si le mois n'existe pas dans $formattedData, on l'initialise
        if (!isset($formattedData[$result->month])) {
            $formattedData[$result->month] = [
                'name' => $monthsFr[$result->month],
                'data' => array_fill(0, 31, 0) // Initialise les recettes de chaque jour à 0
            ];
        }

        // On attribue le montant de recette au jour correspondant
        $formattedData[$result->month]['data'][$result->day - 1] = intval($result->total_revenue);
    }

    // Réorganisation des données pour avoir un tableau séquentiel
    $formattedData = array_values($formattedData);

    // Retourner les données formatées
    return $formattedData;
}
