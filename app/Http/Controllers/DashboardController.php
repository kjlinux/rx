<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // $dd = totalRevenueToday();
        // dd((json_encode($dd, JSON_UNESCAPED_UNICODE)));
        $datas = array();

        $datas['countPatientsToday'] = countPatientsToday();

        $datas['totalRevenueToday'] = totalRevenueToday();

        $datas['totalRemainingToPay'] = totalRemainingToPay();

        $datas['totalToPayPrescribers'] = totalToPayPrescribers();

        $datas['line_revenue']['title'] = 'Total des recettes générées';
        $datas['line_revenue']['data'] = totalRevenue(Carbon::now()->year);

        $datas['pie_prescriber_speciality']['title'] = 'Répartition des prescripteurs par spécialité';
        $datas['pie_prescriber_speciality']['data'] = prescribersBySpecialty();

        $datas['column_top_exams']['title'] = 'Top examens les plus prescrits';
        $datas['column_top_exams']['categories'] = topExamsName()[0];
        $datas['column_top_exams']['data'] = topExamsCount()[0];
        $datas['column_top_exams']['name'] = 'Examens';

        $datas['bar_busy_hours']['title'] = 'Heures de la journée les plus fréquentées pour les examens';
        $datas['bar_busy_hours']['categories'] = busyExamHours();
        $datas['bar_busy_hours']['data'] = busyExamHoursCount();
        $datas['bar_busy_hours']['name'] = 'Examens';

        return view('dashboard', compact('datas'));
    }

    public function updateHoliday(Request $request)
    {
        try {
            if ($request->ajax()) {
                // $state = null;
                if ($request->switch == 'on') {
                    Holiday::where('name', 'Holiday')->update(['activated' => 1]);
                    // $state = 1;
                } else {
                    Holiday::where('name', 'Holiday')->update(['activated' => 0]);
                    // $state = 0;
                }
                // return response()->json($state);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function checkHoliday()
    {
        try {
            $holiday = isHoliday(now());
            // $checking = Holiday::where('name', 'Holiday')->pluck('activated');
            $specialHoliday = isSpecialHoliday();
            return response()->json([$holiday , $specialHoliday]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
