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

function extractYear(String $chaine)
{
    if (preg_match('/^(\d{2})_/', $chaine, $matches)) {
        return $matches[1];
    } else {
        return 0;
    }
}

function capitalizeWords(string $phrase)
{
    $capitalizedPhrase = ucwords(strtolower($phrase));
    return $capitalizedPhrase;
}

function deleteHyphens(string $number) {
    $noHyphens = str_replace('-', '', $number);
    return $noHyphens;
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
        ->selectRaw("patients.id AS 'N°', 
                CONCAT(patients.name, ' ', patients.forenames) AS 'Nom Complet', 
                patients.age AS 'Age', 
                patients.gender AS 'Sexe', 
                patients.clinical_information AS 'Renseignements Cliniques', 
                GROUP_CONCAT(examinations_type.name) AS 'Examens',
                GROUP_CONCAT(DISTINCT CONCAT('Dr. ', prescribers.name, ' ', prescribers.forenames)) AS 'Prescripteurs', 
                CONCAT(center_categories.name, ' ', centers.name) AS 'Provenance', 
                CASE 
                    WHEN vouchers.discount IS NULL THEN vouchers.amount_to_pay 
                    ELSE CONCAT(vouchers.amount_after_discount, '/', vouchers.discount, '%') 
                END AS 'Montant', 
                patients.phone AS 'Téléphone'")
        ->groupBy('patients.id')
        ->get()
        ->map(function ($item) {
            return array_values((array) $item);
        })
        ->toArray();
}
