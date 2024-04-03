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

    public function getRepairMaintenance(Request $request)
    {
        // Ambil parameter tahun dan bagian dari permintaan HTTP
        $selectedYear = $request->input('year', date('Y')); // Jika tidak ada parameter tahun, gunakan tahun saat ini sebagai default
        $selectedSection = $request->input('section'); // Ambil bagian dari permintaan HTTP

        // Query data summary berdasarkan tahun dan bagian tertentu
        $summaryData = FormFPP::selectRaw('section, YEAR(created_at) as year, MONTH(created_at) as month, SUM(TIMESTAMPDIFF(SECOND, created_at, updated_at) / 3600) as total_hour')
            ->whereYear('created_at', $selectedYear)
            ->where('section', $selectedSection)
            ->where('status', 3)
            ->groupBy('section', DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->get();

        // Mengonversi data ke format yang dapat digunakan oleh Chart.js
        $labels = []; // Label bulan
        $data2 = []; // Total jam per bulan
        foreach ($summaryData as $dataPoint) {
            $labels[] = date('F', mktime(0, 0, 0, $dataPoint->month, 1)); // Mendapatkan nama bulan dari angka bulan
            $data2[] = $dataPoint->total_hour * 60;
        }

        // Kirim data sebagai respons JSON
        return response()->json(['labels' => $labels, 'data2' => $data2]);
    }

    public function getPeriodeMesin(Request $request)
    {
        // Ambil rentang tanggal dan section dari permintaan HTTP
        $startDate = $request->input('start_month2');
        $endDate = $request->input('end_month2');
        $section = $request->input('section');

        // Query data summary berdasarkan rentang tanggal dan section
        $periodemesin = FormFPP::select('mesin', 'section')
            ->where('section', $section)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Inisialisasi array untuk menyimpan jumlah FPP per mesin
        $data3 = [];

        // Loop melalui data summary dan menghitung jumlah FPP per mesin
        foreach ($periodemesin as $dataPoint) {
            $mesin = $dataPoint->mesin;

            // Menambahkan jumlah FPP per mesin ke dalam array
            if (!isset($data[$mesin])) {
                $data3[$mesin] = 1;
            } else {
                $data3[$mesin]++;
            }
        }

        // Kirim data sebagai respons JSON
        return response()->json(['data3' => $data3]);
    }

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

        $years2 = []; // Tambahkan tahun 2024 secara manual
        sort($years2);

        // Mendapatkan semua section yang tersedia dari tabel Mesin
        $sections = Mesin::select('section')->distinct()->pluck('section');

        $selectedYear = $request->input('year', date('Y'));
        $selectedSection = $request->input('section', $sections->first());
        $summaryData2 = FormFPP::selectRaw('section, YEAR(created_at) as year, MONTH(created_at) as month, SUM(TIMESTAMPDIFF(SECOND, created_at, updated_at) / 3600) as total_hour')
            ->whereYear('created_at', $selectedYear)
            ->where('section', $selectedSection)
            ->where('status', 3)
            ->groupBy('section', DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->get();

        // Mengonversi data ke format yang dapat digunakan oleh Chart.js
        $labels = []; // Label bulan
        $data2 = []; // Total jam per bulan
        foreach ($summaryData2 as $dataPoint) {
            $labels[] = date('F', mktime(0, 0, 0, $dataPoint->month, 1)); // Mendapatkan nama bulan dari angka bulan
            $data2[] = $dataPoint->total_hour * 60;
        }

        // Ambil rentang tanggal dan section dari permintaan HTTP
        $startDate = $request->input('start_month2');
        $endDate = $request->input('end_month2');
        $section = $request->input('section');

        // Query data summary berdasarkan rentang tanggal dan section
        $periodemesin = FormFPP::select('mesin', 'section')
            ->where('section', $section)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Inisialisasi array untuk menyimpan jumlah FPP per mesin
        $data3 = [];

        // Loop melalui data summary dan menghitung jumlah FPP per mesin
        foreach ($periodemesin as $dataPoint) {
            $mesin = $dataPoint->mesin;

            // Menambahkan jumlah FPP per mesin ke dalam array
            if (!isset($data[$mesin])) {
                $data3[$mesin] = 1;
            } else {
                $data3[$mesin]++;
            }
        }

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
                'labels',
                'data2',
                'data3',
                'sections',
                'years2',
                'periodemesin',
            )
        );
    }
}
