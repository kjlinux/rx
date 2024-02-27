<?php

use Carbon\Carbon;
use App\Models\ExaminationType;
use Illuminate\Support\Facades\DB;

function getInitial(String $string)
{
    $words = explode(' ', $string);
    $initials = '';

    foreach ($words as $word) {
        $firstLetter = substr($word, 0, 1);
        $initials .= strtoupper($firstLetter);
    }

    return $initials;
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
    return DB::table('vouchers')
        ->join('patients', 'patients.id', '=', 'vouchers.patient_id')
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
        ->groupBy('vouchers.id')
        ->orderByDesc('patients.updated_at')
        // ->paginate(10);
        ->get()
        ->map(function ($item) {
            return array_values((array) $item);
        })
        ->toArray();
}

function getPatient(int $patient_id)
{
    return DB::table('vouchers')
        ->join('patients', 'patients.id', '=', 'vouchers.patient_id')
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
            vouchers.time,
            vouchers.slug")
        ->groupBy('vouchers.id')
        ->where('patients.id', $patient_id)
        ->get()
        ->map(function ($item) {
            return array_values((array) $item);
        })
        ->toArray();
}

function getPrescribers(int $prescriber_id = null)
{
    if ($prescriber_id == null) {
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

function getLeftToPayForPatient()
{
    return DB::table('vouchers')
        ->join('patients', 'patients.id', '=', 'vouchers.patient_id')
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
        ->groupBy('vouchers.id')
        ->whereRaw('vouchers.payed IS NOT NULL',)
        ->orderByDesc('patients.updated_at')
        ->get()
        ->map(function ($item) {
            return array_values((array) $item);
        })
        ->toArray();
}

function getRebates()
{
    return DB::table('prescribers')
        ->join('centers', 'centers.id', '=', 'prescribers.center_id')
        ->join('center_categories', 'center_categories.id', '=', 'centers.center_category_id')
        ->join('functions', 'functions.id', '=', 'prescribers.function_id')
        ->join('specialities', 'specialities.id', '=', 'prescribers.speciality_id')
        ->join('sends', 'sends.prescriber_id', 'prescribers.id')
        ->join('patients', 'patients.id', 'sends.patient_id')
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
        ->groupBy('prescribers.id', DB::raw("DATE('sends.created_at'), sends.created_at, sends.id")) /*Do not modify this line !*/
        ->orderBy('sends.created_at')
        ->get()
        ->map(function ($item) {
            return array_values((array) $item);
        })
        ->toArray();
}

function convertToDateString($dateStr)
{
    $date = new DateTime($dateStr);

    $days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];

    $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

    $day = $days[$date->format('w')];
    $dayNumber = $date->format('j');
    $month = $months[$date->format('n') - 1];
    $year = $date->format('Y');

    $output = "$day $dayNumber $month $year";

    return $output;
}

function nummberToLetters($number)
{
    $digit = array(
        0 => 'zéro', 1 => 'un', 2 => 'deux', 3 => 'trois', 4 => 'quatre',
        5 => 'cinq', 6 => 'six', 7 => 'sept', 8 => 'huit', 9 => 'neuf',
        10 => 'dix', 11 => 'onze', 12 => 'douze', 13 => 'treize', 14 => 'quatorze',
        15 => 'quinze', 16 => 'seize', 17 => 'dix-sept', 18 => 'dix-huit', 19 => 'dix-neuf',
        20 => 'vingt', 30 => 'trente', 40 => 'quarante', 50 => 'cinquante',
        60 => 'soixante', 70 => 'soixante-dix', 80 => 'quatre-vingt', 90 => 'quatre-vingt-dix'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && $number <= 19) || $number == 100) {
        return $digit[$number];
    }

    if ($number > 1000000) {
        return false;
    }

    $output = '';

    if ($number >= 1000) {
        $output .= nummberToLetters(floor($number / 1000)) . ' mille ';
        $number %= 1000;
    }

    if ($number >= 100) {
        $output .= nummberToLetters(floor($number / 100)) . ' cent ';
        $number %= 100;
    }

    if ($number >= 20) {
        if ($number >= 70 && $number <= 79) {
            $output .= 'soixante-' . nummberToLetters($number - 60);
        } elseif ($number >= 90) {
            $output .= 'quatre-vingt-' . nummberToLetters($number - 80);
        } else {
            $output .= $digit[floor($number / 10) * 10];
            $rest = $number % 10;

            if ($rest) {
                $output .= '-' . $digit[$rest];
            }
        }
    } elseif ($number > 0) {
        $output .= $digit[$number];
    }

    return $output;
}

function getExaminationsNames(array $examinations){
    $output = 'RX ';
    foreach($examinations as $examination){
        $query = DB::table('examinations_type')
            ->select('name')
            ->where('id', $examination)
            ->pluck('name');
        
        $output .= $query[0].',';
    }
    return rtrim($output, ',');
}

/* 
    verifier pour les info patiet lors du changement dexamens ce qui se passe
    gerer les reductions et reste a payer lors de la modification dun patient
    refler le problee de deconnexion on name null
 */

