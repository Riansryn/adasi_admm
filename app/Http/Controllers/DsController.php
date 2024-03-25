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
    //
    public function dashboardHandling()
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
            ->groupBy('month')
            ->get();

        $chartCutting = FormFPP::select(
            DB::raw('COUNT(CASE WHEN status_2 = 0 THEN 1 END) as total_status_2_0'),
            DB::raw('COUNT(CASE WHEN status = 3 THEN 1 END) as total_status_3'),
            DB::raw('MONTH(created_at) as month')
        )
            ->where('section', 'cutting') // Tambahkan kondisi untuk memeriksa nilai 'section'
            ->groupBy('month')
            ->get();


        // Mengambil data menggunakan model Eloquent
        $sumarryData = FormFPP::selectRaw('MONTH(created_at) as month, section, COUNT(*) as total')
                        ->whereIn('section', ['cutting', 'machining', 'heat treatment', 'machining custom'])
                        ->where('status', 3)
                        ->groupBy('month', 'section')
                        ->get();

        $datacncbubut = Mesin::select(
            DB::raw('SUM(CASE WHEN LOWER(section) = "cnc bubut" THEN 1 ELSE 0 END) as total_cnc_bubut')
        )->first()->total_cnc_bubut ?? 0;

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
                'sumarryData',
                'chartCutting',
                'chartMachining',
                'chartHeatTreatment',
                'chartCTBubut'
            )
        );
    }
}
