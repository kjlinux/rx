<?php

use App\Models\Patient;
use App\Models\Prescriber;
use Illuminate\Support\Facades\DB;

function getInsights()
{
    return array(
        getInitial('Nombre de prescripteurs par centre') => 'Nombre de prescripteurs par centre',
        getInitial('Nombre total de patients suivis') => 'Nombre total de patients suivis',
        getInitial('Répartition des patients par genre') => 'Répartition des patients par genre',
        getInitial('Répartition des patients par tranche d\'âge') => 'Répartition des patients par tranche d\'âge',
        getInitial('Top prescripteurs par le nombre d\'examens prescrits') => 'Top prescripteurs par le nombre d\'examens prescrits',
        'MTDRAACP' => 'Montant total des ristournes attribuées à chaque prescripteur',
        'RDPPSP' => 'Répartition des prescripteurs par spécialité',
        getInitial('Nombre d\'examens prescrits par spécialité') => 'Nombre d\'examens prescrits par spécialité',
        getInitial('Top examens les plus prescrits') => 'Top examens les plus prescrits',
        getInitial('Total des recettes générées par le cabinet') => 'Total des recettes générées par le cabinet',
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
    
    foreach($agesGroup as $ageGroup){
        $interval = $ageGroup.'-'.$ageGroup+9 ;
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

function getTopPrescribers(){
    return Prescriber::withCount('sends')
    ->orderBy('sends_count', 'desc')
    ->get();
}
