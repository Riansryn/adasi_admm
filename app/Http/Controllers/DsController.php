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
        $summaryData2 = FormFPP::selectRaw('section, YEAR(created_at) as year, MONTH(created_at) as month, SUM(TIMESTAMPDIFF(SECOND, created_at, updated_at) / 3600) as total_hour')
            ->whereYear('created_at', $selectedYear)
            ->where('section', $selectedSection)
            ->where('status', 3)
            ->groupBy('section', DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->get();

        // Buat array lengkap dari label bulan
        $fullMonthLabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // Inisialisasi array data kosong
        $data2 = array_fill(0, 12, 0);

        // Iterasi melalui data yang diterima dari database
        foreach ($summaryData2 as $dataPoint) {
            $monthIndex = $dataPoint->month - 1; // Index bulan dimulai dari 0
            $data2[$monthIndex] = $dataPoint->total_hour * 60;
        }

        // Mengisi label bulan untuk bulan-bulan yang tidak memiliki data
        $labels = [];
        foreach ($fullMonthLabels as $index => $monthLabel) {
            $labels[] = $monthLabel;
        }

        // Kirim data sebagai respons JSON
        return response()->json(['labels' => $labels, 'data2' => $data2]);
    }

    public function getPeriodeWaktuPengerjaan(Request $request)
    {
        $selectedSection = $request->input('section');
        $startMonth = Carbon::parse($request->input('start_month2'))->startOfMonth();
        $endMonth = Carbon::parse($request->input('end_month2'))->endOfMonth();

        $periodeWaktuPengerjaan = FormFPP::selectRaw('section, SUM(TIMESTAMPDIFF(SECOND, created_at, updated_at) / 60) as total_minute')
            ->where('section', $selectedSection)
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->where('status', 3)
            ->groupBy('section') // Kelompokkan berdasarkan kolom section
            ->first();

        // Return data as JSON response
        return response()->json($periodeWaktuPengerjaan);
    }

    public function getPeriodeMesin(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_mesin'))->startOfMonth();
        $endDate = Carbon::parse($request->input('end_mesin'))->endOfMonth();
        $section = $request->input('section');

        $periodeMesin = DB::table('mesin')
            ->leftJoin('form_f_p_p_s', function ($join) use ($section, $startDate, $endDate) {
                $join->on('mesin.no_mesin', '=', 'form_f_p_p_s.mesin')
                    ->where('form_f_p_p_s.status', 3)
                    ->where('form_f_p_p_s.section', $section)
                    ->whereBetween('form_f_p_p_s.created_at', [$startDate, $endDate]);
            })
            ->select('mesin.no_mesin', DB::raw('COUNT(form_f_p_p_s.id) as total_fpp'))
            ->where('mesin.section', $section) // Filter mesin berdasarkan section yang dipilih
            ->groupBy('mesin.no_mesin')
            ->get();


        return response()->json($periodeMesin);
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

        $summaryData2 = FormFPP::selectRaw('section, YEAR(created_at) as year,
    MONTH(created_at) as month, SUM(TIMESTAMPDIFF(SECOND, created_at, updated_at) / 3600) as total_hour')
            ->whereYear('created_at', $selectedYear)
            ->where('section', $selectedSection)
            ->where('status', 3)
            ->groupBy('section', 'year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data2 = [];
        foreach ($summaryData2 as $dataPoint) {
            $labels[] = date('F', mktime(0, 0, 0, $dataPoint->month, 1)); // Mendapatkan nama bulan dari angka bulan
            $data2[] = $dataPoint->total_hour * 60;
        }

        $startMonth = Carbon::parse($request->input('start_month2'))->startOfMonth();
        $endMonth = Carbon::parse($request->input('end_month2'))->endOfMonth();

        $periodeWaktuPengerjaan = FormFPP::selectRaw('section, SUM(TIMESTAMPDIFF(SECOND, created_at, updated_at) / 60) as total_minute')
            ->where('section', $selectedSection)
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->where('status', 3)
            ->groupBy('section') // Kelompokkan berdasarkan kolom section
            ->first();

        $startDate = Carbon::parse($request->input('start_mesin'))->startOfMonth();
        $endDate = Carbon::parse($request->input('end_mesin'))->endOfMonth();
        $section = $request->input('section');

        $periodeMesin = DB::table('mesin')
            ->leftJoin('form_f_p_p_s', function ($join) use ($section, $startDate, $endDate) {
                $join->on('mesin.no_mesin', '=', 'form_f_p_p_s.mesin')
                    ->where('form_f_p_p_s.status', 3)
                    ->where('form_f_p_p_s.section', $section)
                    ->whereBetween('form_f_p_p_s.created_at', [$startDate, $endDate]);
            })
            ->select('mesin.no_mesin', DB::raw('COUNT(form_f_p_p_s.id) as total_fpp'))
            ->where('mesin.section', $section) // Filter mesin berdasarkan section yang dipilih
            ->groupBy('mesin.no_mesin')
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
                'labels',
                'data2',
                'periodeWaktuPengerjaan',
                'sections',
                'years2',
                'data2',
                'periodeMesin' // tambahkan data periodeMesin ke dalam array compact()
            )
        );
    }
}
