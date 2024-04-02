<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Handling;
use App\Models\FormFPP;
use App\Models\Mesin;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DsController extends Controller
{
    // Buat Dashboard dan Chart
    public function dashboardHandling(Request $request)
    {
        // Mengambil semua data FormFPP diurutkan berdasarkan updated_at terbaru
        $formperbaikans = FormFPP::orderBy('updated_at', 'desc')->get();
        $mesins = Mesin::orderBy('updated_at', 'desc')->get();

        // Menghitung jumlah form FPP berdasarkan status
        $openCount = $formperbaikans->where('status', 0)->count();
        $onProgressCount = $formperbaikans->where('status', 1)->count();
        $finishCount = $formperbaikans->where('status', 2)->count();
        $closedCount = $formperbaikans->where('status', 3)->count();

        // Mendapatkan data dari database berdasarkan tahun ini pada kolom created_at dan status 3
        $claimData = Handling::whereYear('created_at', date('Y'))
            ->where('type_1', 'Claim')
            ->where('status', 3) // Menambahkan kondisi untuk status bernilai 3
            ->get(['created_at'])
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            })
            ->map(function ($item) {
                return count($item);
            })
            ->toArray();

        $complainData = Handling::whereYear('created_at', date('Y'))
            ->where('type_1', 'Complain')
            ->where('status', 3) // Menambahkan kondisi untuk status bernilai 3
            ->get(['created_at'])
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            })
            ->map(function ($item) {
                return count($item);
            })
            ->toArray();


        $data = Handling::select(
            DB::raw('COUNT(CASE WHEN status_2 = 0 THEN 1 END) as total_status_2_0'),
            DB::raw('COUNT(CASE WHEN status = 3 THEN 1 END) as total_status_3'),
            DB::raw('MONTH(created_at) as month')
        )
            ->whereYear('created_at', date('Y')) // Menambahkan filter tahun
            ->groupBy('month')
            ->get();

        $years = Handling::select(
            DB::raw('COUNT(CASE WHEN status_2 = 0 THEN 1 END) as total_status_2_0'),
            DB::raw('COUNT(CASE WHEN status = 3 THEN 1 END) as total_status_3'),
            DB::raw('YEAR(created_at) as years')
            // Menggunakan YEAR() untuk mengambil tahun
        )
            ->groupBy('years') // Mengelompokkan berdasarkan years (tahun)
            ->get();

        $countPeriode = Handling::select(
            DB::raw('COUNT(CASE WHEN status_2 = 0 THEN 1 END) as total_status_2_0'),
            DB::raw('COUNT(CASE WHEN status = 3 THEN 1 END) as total_status_3'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as years') // Menggunakan YEAR() untuk mengambil tahun
        )
            ->groupBy('years', 'month') // Mengelompokkan berdasarkan years (tahun)
            ->get();

        $chartCutting = FormFPP::select(
            DB::raw('COUNT(CASE WHEN status_2 = 0 THEN 1 END) as total_status_2_0'),
            DB::raw('COUNT(CASE WHEN status = 3 THEN 1 END) as total_status_3'),
            DB::raw('MONTH(created_at) as month')
        )
            ->where('section', 'cutting') // Tambahkan kondisi untuk memeriksa nilai 'section'
            ->groupBy('month')
            ->get();

        $chartMachiningCustom = FormFPP::select(
            DB::raw('COUNT(CASE WHEN status_2 = 0 THEN 1 END) as total_status_2_0'),
            DB::raw('COUNT(CASE WHEN status = 3 THEN 1 END) as total_status_3'),
            DB::raw('MONTH(created_at) as month')
        )
            ->where('section', 'machining custom') // Tambahkan kondisi untuk memeriksa nilai 'section'
            ->groupBy('month')
            ->get();

        $summaryData = FormFPP::select(
            DB::raw('MONTH(created_at) as month'),
            'section',
            DB::raw('SUM(CASE WHEN status_2 = 0 THEN 1 ELSE 0 END) as total_status_2_0'), // Total status "open"
            DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) as total_status_3') // Total status "closed"
        )
            ->whereIn('section', ['cutting', 'machining', 'heat treatment', 'machining custom'])
            ->groupBy('month', 'section')
            ->get();

        $summaryData2 = FormFPP::selectRaw('id_fpp, section, mesin, TIMESTAMPDIFF(SECOND, created_at, updated_at) / 3600 as time_difference_hour')
            ->get();

        $chartMachining = FormFPP::select(
            DB::raw('COUNT(CASE WHEN status_2 = 0 THEN 1 END) as total_status_2_0'),
            DB::raw('COUNT(CASE WHEN status = 3 THEN 1 END) as total_status_3'),
            DB::raw('MONTH(created_at) as month')
        )
            ->where('section', 'machining') // Tambahkan kondisi untuk memeriksa nilai 'section'
            ->groupBy('month')
            ->get();

        $chartHeatTreatment = FormFPP::select(
            DB::raw('COUNT(CASE WHEN status_2 = 0 THEN 1 END) as total_status_2_0'),
            DB::raw('COUNT(CASE WHEN status = 3 THEN 1 END) as total_status_3'),
            DB::raw('MONTH(created_at) as month')
        )
            ->where('section', 'heat treatment') // Tambahkan kondisi untuk memeriksa nilai 'section'
            ->groupBy('month')
            ->get();

        $chartCTBubut = FormFPP::select(
            DB::raw('COUNT(CASE WHEN status_2 = 0 THEN 1 END) as total_status_2_0'),
            DB::raw('COUNT(CASE WHEN status = 3 THEN 1 END) as total_status_3'),
            DB::raw('MONTH(created_at) as month')
        )
            ->where('section', 'ct bubut') // Tambahkan kondisi untuk memeriksa nilai 'section'
            ->groupBy('month')
            ->get();

        // dd($data);
        return view(
            'dashboard.dashboardHandling',
            compact(
                'complainData',
                'formperbaikans',
                'openCount',
                'onProgressCount',
                'finishCount',
                'closedCount',
                'data',
                'chartCutting',
                'summaryData',
                'summaryData2',
                'chartCutting',
                'chartMachining',
                'chartMachiningCustom',
                'chartHeatTreatment',
                'years',
                'countPeriode',
            )
        );
    }
}
