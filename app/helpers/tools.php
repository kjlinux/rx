<?php

use Carbon\Carbon;
use App\Models\ExaminationType;
use Illuminate\Support\Facades\DB;

function getInitial(String $phrase)
{
    $mots = explode(' ', $phrase);
    $initiales = '';

    foreach ($mots as $mot) {
        $premiereLettre = substr($mot, 0, 1);
        $initiales .= strtoupper($premiereLettre);
    }

    return $initiales;
}

// function extractYear(String $chaine)
// {
//     if (preg_match('/^(\d{3})_/', $chaine, $matches)) {
//         return $matches[1];
//     } else {
//         return 0;
//     }
// }

function capitalizeWords(string $phrase)
{
    $capitalizedPhrase = ucwords(strtolower($phrase));
    return $capitalizedPhrase;
}

function deleteHyphens(string $number)
{
    $noHyphens = str_replace('-', '', $number);
    return $noHyphens;
}

function convertToArray(string $phrase)
{
    return explode(',', $phrase);
}

function getCentersWhithCategory()
{
    return DB::table('center_categories')
        ->join('centers', 'center_categories.id', '=', 'centers.center_category_id')
        ->selectRaw("CONCAT(center_categories.name, ' ', centers.name) AS center_name, centers.id")
        ->orderBy('center_name')
        ->pluck('center_name', 'centers.id');
}

function isHoliday(Carbon $date)
{
    $format_date = Carbon::createFromFormat('Y-m-d', $date->toDateString())->format('m-d');
    $matching = DB::table('holidays')
        ->select('name')
        ->where('primary_date', $format_date)
        ->orWhere('secondary_date', $format_date)
        ->where('activated', 1)
        ->pluck('name');

    if (!$matching->isEmpty()) {
        return true;
    } else {
        return false;
    }
}

function getPrice(array $examinations)
{
    $today = now();
    $total_price = null;
    foreach ($examinations as $examination) {
        $z_coefficient = DB::table('examinations_type')
            ->select('z_coefficient')
            ->where('id', $examination)
            ->pluck('z_coefficient');

        $temporary_price = $z_coefficient[0] * 1000;

        if ($today->isSunday() || isHoliday($today)) {
            $temporary_price += 2500;
        }

        if (($today->hour >= 19 && $today->hour <= 23) || ($today->hour >= 0 && $today->hour < 7)) {
            $temporary_price += $temporary_price / 2;
        }

        $total_price += $temporary_price;
    }

    return [$total_price, $today->toDateString(), $today->toTimeString()];
}

function getRegister()
{
    return DB::table('patients')
        ->join('vouchers', 'vouchers.id', '=', 'patients.voucher_id')
        ->join('centers', 'centers.id', '=', 'patients.center_id')
        ->join('center_categories', 'center_categories.id', '=', 'centers.center_category_id')
        ->join('examinations', 'examinations.patient_id', '=', 'patients.id')
        ->join('examinations_type', 'examinations_type.id', '=', 'examinations.examination_type_id')
        ->join('sends', 'sends.patient_id', '=', 'patients.id')
        ->join('prescribers', 'prescribers.id', '=', 'sends.prescriber_id')
        ->selectRaw("patients.updated_at AS 'Updated at',
                patients.id AS 'N°', 
                CONCAT(patients.name, ' ', patients.forenames) AS 'Nom Complet', 
                patients.age AS 'Age', 
                patients.gender AS 'Sexe', 
                patients.clinical_information AS 'Renseignements Cliniques', 
                GROUP_CONCAT(DISTINCT examinations_type.name) AS 'Examens',
                GROUP_CONCAT(DISTINCT CONCAT('Dr. ', prescribers.name, ' ', prescribers.forenames)) AS 'Prescripteurs', 
                CONCAT(center_categories.name, ' ', centers.name) AS 'Provenance', 
                CASE
                    WHEN vouchers.discount IS NULL THEN vouchers.amount_to_pay 
                    ELSE CONCAT(vouchers.amount_after_discount, '/', vouchers.discount, '%') 
                END AS 'Montant', 
                patients.phone AS 'Téléphone'")
        ->groupBy('patients.id')
        ->orderByDesc('patients.updated_at')
        ->get()
        ->map(function ($item) {
            return array_values((array) $item);
        })
        ->toArray();
}

function getPatient(int $patient_id)
{
    return DB::table('patients')
        ->join('vouchers', 'vouchers.id', '=', 'patients.voucher_id')
        ->join('centers', 'centers.id', '=', 'patients.center_id')
        ->join('examinations', 'examinations.patient_id', '=', 'patients.id')
        ->join('sends', 'sends.patient_id', '=', 'patients.id')
        ->join('prescribers', 'prescribers.id', '=', 'sends.prescriber_id')
        ->selectRaw("patients.name, 
            patients.forenames, 
            patients.age, 
            patients.gender, 
            GROUP_CONCAT(DISTINCT sends.prescriber_id) AS prescribers,
            patients.center_id, 
            GROUP_CONCAT(examinations.examination_type_id) AS examinations, 
            patients.clinical_information,
            patients.phone,
            vouchers.amount_to_pay,
            vouchers.discount,
            vouchers.amount_after_discount,
            vouchers.payed,
            vouchers.left_to_pay,
            vouchers.date,
            vouchers.time")
        ->groupBy('patients.id')
        ->where('patients.id', $patient_id)
        ->get()
        ->map(function ($item) {
            return array_values((array) $item);
        })
        ->toArray();
}

function getPrescribers(int $prescriber_id = null){
    if($prescriber_id == null){
        return DB::table('prescribers')
        ->join('centers', 'centers.id', '=', 'prescribers.center_id')
        ->join('center_categories', 'center_categories.id', '=', 'centers.center_category_id')
        ->join('functions', 'functions.id', '=', 'prescribers.function_id')
        ->join('specialities', 'specialities.id', '=', 'prescribers.speciality_id')
        ->selectRaw("prescribers.id  AS id, 
            CONCAT('Dr. ', prescribers.name, ' ', prescribers.forenames) AS name, 
            CONCAT(center_categories.name, ' ', centers.name) AS center, 
            functions.name AS _function, 
            specialities.name AS speciality")
        ->get()
        ->map(function ($item) {
            return array_values((array) $item);
        })
        ->toArray();
    } else {
        return DB::table('prescribers')
        ->selectRaw("name, forenames, center_id, function_id, speciality_id")
        ->where('prescribers.id', $prescriber_id)
        ->get()
        ->map(function ($item) {
            return array_values((array) $item);
        })
        ->toArray();
    }

}

function getLeftToPayForPatient(){
    return DB::table('patients')
    ->join('vouchers', 'vouchers.id', '=', 'patients.voucher_id')
    ->join('centers', 'centers.id', '=', 'patients.center_id')
    ->join('center_categories', 'center_categories.id', '=', 'centers.center_category_id')
    ->join('examinations', 'examinations.patient_id', '=', 'patients.id')
    ->join('examinations_type', 'examinations_type.id', '=', 'examinations.examination_type_id')
    ->join('sends', 'sends.patient_id', '=', 'patients.id')
    ->join('prescribers', 'prescribers.id', '=', 'sends.prescriber_id')
    ->selectRaw("patients.updated_at AS 'Updated at',
            patients.id AS 'N°', 
            CONCAT(patients.name, ' ', patients.forenames) AS 'Nom Complet', 
            GROUP_CONCAT(DISTINCT examinations_type.name) AS 'Examens',
            patients.phone AS 'Téléphone', 
            vouchers.amount_to_pay,
            vouchers.payed,
            vouchers.left_to_pay")
    ->groupBy('patients.id')
    ->whereRaw('vouchers.left_to_pay IS NOT NULL',)
    ->orderByDesc('patients.updated_at')
    ->get()
    ->map(function ($item) {
        return array_values((array) $item);
    })
    ->toArray();
}

function getRebates(){
    return DB::table('prescribers')
    ->join('centers', 'centers.id', '=', 'prescribers.center_id')
    ->join('center_categories', 'center_categories.id', '=', 'centers.center_category_id')
    ->join('functions', 'functions.id', '=', 'prescribers.function_id')
    ->join('specialities', 'specialities.id', '=', 'prescribers.speciality_id')
    ->join('sends', 'sends.prescriber_id', 'prescribers.id')
    ->join('patients', 'patients.id', 'sends.prescriber_id')
    ->selectRaw("sends.id  AS id, 
        CONCAT('Dr. ', prescribers.name, ' ', prescribers.forenames) AS name, 
        CONCAT(center_categories.name, ' ', centers.name) AS center, 
        specialities.name AS speciality,
        CONCAT(patients.name, ' ', patients.forenames) AS 'Nom Complet', 
        CASE
            WHEN prescribers.speciality_id <> 2 
            THEN COUNT(sends.patient_id)*1000
            ELSE COUNT(sends.patient_id)*5000
        END AS 'Ristourne',
        DATE(sends.created_at)")
    ->groupBy('prescribers.id', DB::raw("DATE('sends.created_at'), sends.created_at, sends.id"))
    ->orderBy('sends.created_at')
    ->get()
    ->map(function ($item) {
        return array_values((array) $item);
    })
    ->toArray();
}