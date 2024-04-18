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
        $selectedSection = $request->input('section', 'All');

        if ($selectedSection === 'All') {
            $summaryData2 = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
                ->selectRaw('YEAR(form_f_p_p_s.created_at) as year,
                    MONTH(form_f_p_p_s.created_at) as month, SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 3600) as total_hour')
                ->whereYear('form_f_p_p_s.created_at', $selectedYear)
                ->where('form_f_p_p_s.status', 3)
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get();
        } else {
            $summaryData2 = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
                ->selectRaw('mesin.no_mesin, YEAR(form_f_p_p_s.created_at) as year,
                    MONTH(form_f_p_p_s.created_at) as month, SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 3600) as total_hour')
                ->whereYear('form_f_p_p_s.created_at', $selectedYear)
                ->where('form_f_p_p_s.section', $selectedSection)
                ->where('form_f_p_p_s.status', 3)
                ->groupBy('mesin.no_mesin', 'year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get();
        }


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
        $selectedSection = $request->input('section', 'All');
        $startMonth = $request->input('start_month2');
        $endMonth = $request->input('end_month2');
        $selectedYear = $request->input('year', date('Y'));

        // Jika bagian yang dipilih adalah 'All' dan tidak ada tanggal mulai dan akhir yang diberikan
        if ($selectedSection === 'All' && empty($startMonth) && empty($endMonth)) {
            $periodeWaktuPengerjaan = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
                ->selectRaw('SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 60) as total_minute')
                ->whereYear('form_f_p_p_s.created_at', $selectedYear)
                ->where('form_f_p_p_s.status', 3)
                ->first();
        } else {
            // Jika bagian yang dipilih adalah 'All' dan tanggal mulai dan akhir diberikan
            if ($selectedSection === 'All') {
                $periodeWaktuPengerjaan = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
                    ->selectRaw('SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 60) as total_minute')
                    ->whereBetween('form_f_p_p_s.created_at', [$startMonth, $endMonth])
                    ->where('form_f_p_p_s.status', 3)
                    ->first();
            } else {
                // Jika bagian yang dipilih bukan 'All' dan tanggal mulai dan akhir diberikan
                if (empty($startMonth) && empty($endMonth)) {
                    $periodeWaktuPengerjaan = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
                        ->selectRaw('SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 60) as total_minute')
                        ->whereYear('form_f_p_p_s.created_at', $selectedYear)
                        ->where('form_f_p_p_s.section', $selectedSection)
                        ->where('form_f_p_p_s.status', 3)
                        ->first();
                } else {
                    $periodeWaktuPengerjaan = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
                        ->selectRaw('SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 60) as total_minute')
                        ->where('form_f_p_p_s.section', $selectedSection)
                        ->whereBetween('form_f_p_p_s.created_at', [$startMonth, $endMonth])
                        ->where('form_f_p_p_s.status', 3)
                        ->first();
                }
            }
        }
        // Return data as JSON response
        return response()->json($periodeWaktuPengerjaan);
    }



    public function getPeriodeMesin(Request $request)
    {
        $section = $request->input('section', 'All');
        $startDate = $request->input('start_mesin');
        $endDate = $request->input('end_mesin');

        // Memeriksa apakah opsi "All" dipilih
        if ($section === 'All' && empty($startDate) && empty($endDate)) {
            $periodeMesin = DB::table('mesin')
                ->leftJoin('form_f_p_p_s', function ($join) {
                    $join->on('mesin.no_mesin', '=', 'form_f_p_p_s.mesin')
                        ->where('form_f_p_p_s.status', 3)
                        ->whereYear('form_f_p_p_s.created_at', date('Y'));
                })
                ->select('mesin.no_mesin', 'mesin.section', DB::raw('SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 60) AS total_minutes'))
                ->orderByRaw("SUBSTRING(mesin.no_mesin FROM 1 FOR 1), CAST(REGEXP_SUBSTR(mesin.no_mesin, '[0-9]+') AS UNSIGNED)")
                ->whereIn('mesin.section', ['cutting', 'machining', 'heat treatment', 'machining custom'])
                ->groupBy('mesin.no_mesin', 'mesin.section')
                ->get();
        } else {
            // Jika section yang dipilih bukan 'All' dan tidak ada tanggal mulai dan akhir yang diberikan
            if (empty($startDate) && empty($endDate)) {
                $periodeMesin = DB::table('mesin')
                    ->leftJoin('form_f_p_p_s', function ($join) use ($section) {
                        $join->on('mesin.no_mesin', '=', 'form_f_p_p_s.mesin')
                            ->where('form_f_p_p_s.status', 3)
                            ->where('form_f_p_p_s.section', $section);
                    })
                    ->select('mesin.no_mesin', 'mesin.section', DB::raw('SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 60) AS total_minutes'))
                    ->where('mesin.section', $section)
                    ->orderByRaw("SUBSTRING(mesin.no_mesin FROM 1 FOR 1), CAST(REGEXP_SUBSTR(mesin.no_mesin, '[0-9]+') AS UNSIGNED)")
                    ->whereIn('mesin.section', ['cutting', 'machining', 'heat treatment', 'machining custom'])
                    ->groupBy('mesin.no_mesin', 'mesin.section')
                    ->get();
            } else {
                $startDate = Carbon::parse($startDate);
                $endDate = Carbon::parse($endDate);

                if ($section === 'All') {
                    $periodeMesin = DB::table('mesin')
                        ->leftJoin('form_f_p_p_s', function ($join) use ($startDate, $endDate) {
                            $join->on('mesin.no_mesin', '=', 'form_f_p_p_s.mesin')
                                ->where('form_f_p_p_s.status', 3)
                                ->whereBetween('form_f_p_p_s.created_at', [$startDate, $endDate]);
                        })
                        ->select('mesin.no_mesin', 'mesin.section', DB::raw('SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 60) AS total_minutes'))
                        ->orderByRaw("SUBSTRING(mesin.no_mesin FROM 1 FOR 1), CAST(REGEXP_SUBSTR(mesin.no_mesin, '[0-9]+') AS UNSIGNED)")
                        ->whereIn('mesin.section', ['cutting', 'machining', 'heat treatment', 'machining custom'])
                        ->groupBy('mesin.no_mesin', 'mesin.section')
                        ->get();
                } else {
                    $periodeMesin = DB::table('mesin')
                        ->leftJoin('form_f_p_p_s', function ($join) use ($section, $startDate, $endDate) {
                            $join->on('mesin.no_mesin', '=', 'form_f_p_p_s.mesin')
                                ->where('form_f_p_p_s.status', 3)
                                ->where('form_f_p_p_s.section', $section)
                                ->whereBetween('form_f_p_p_s.created_at', [$startDate, $endDate]);
                        })
                        ->select('mesin.no_mesin', 'mesin.section', DB::raw('SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 60) AS total_minutes'))
                        ->where('mesin.section', $section)
                        ->orderByRaw("SUBSTRING(mesin.no_mesin FROM 1 FOR 1), CAST(REGEXP_SUBSTR(mesin.no_mesin, '[0-9]+') AS UNSIGNED)")
                        ->whereIn('mesin.section', ['cutting', 'machining', 'heat treatment', 'machining custom'])
                        ->groupBy('mesin.no_mesin', 'mesin.section')
                        ->get();
                }
            }
        }

        return response()->json($periodeMesin);
    }

    // Buat Dashboard dan Chart
    public function dashboardHandling(Request $request)
    {
        // Mengambil semua data FormFPP yang memiliki nomor mesin valid, diurutkan berdasarkan updated_at terbaru
        $formperbaikans = FormFPP::whereIn('mesin', function ($query) {
            $query->select('no_mesin')
                ->from('mesin');
        })
            ->orderBy('updated_at', 'desc')
            ->get();

        // Mengambil semua data Mesin yang diurutkan berdasarkan updated_at terbaru
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

        $chartCutting = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
            ->select(
                DB::raw('COUNT(CASE WHEN form_f_p_p_s.status_2 = 0 THEN 1 END) as total_status_2_0'),
                DB::raw('COUNT(CASE WHEN form_f_p_p_s.status = 3 THEN 1 END) as total_status_3'),
                DB::raw('MONTH(form_f_p_p_s.created_at) as month')
            )
            ->where('form_f_p_p_s.section', 'cutting') // Tambahkan kondisi untuk memeriksa nilai 'section'
            ->groupBy('month')
            ->groupBy('form_f_p_p_s.mesin') // Grouping berdasarkan nomor mesin
            ->get();

        $chartMachiningCustom = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
            ->select(
                DB::raw('COUNT(CASE WHEN form_f_p_p_s.status_2 = 0 THEN 1 END) as total_status_2_0'),
                DB::raw('COUNT(CASE WHEN form_f_p_p_s.status = 3 THEN 1 END) as total_status_3'),
                DB::raw('MONTH(form_f_p_p_s.created_at) as month')
            )
            ->where('form_f_p_p_s.section', 'machining custom') // Tambahkan kondisi untuk memeriksa nilai 'section'
            ->groupBy('month')
            ->groupBy('form_f_p_p_s.mesin') // Grouping berdasarkan nomor mesin
            ->get();

        $chartMachining = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
            ->select(
                DB::raw('COUNT(CASE WHEN form_f_p_p_s.status_2 = 0 THEN 1 END) as total_status_2_0'),
                DB::raw('COUNT(CASE WHEN form_f_p_p_s.status = 3 THEN 1 END) as total_status_3'),
                DB::raw('MONTH(form_f_p_p_s.created_at) as month')
            )
            ->where('form_f_p_p_s.section', 'machining') // Tambahkan kondisi untuk memeriksa nilai 'section'
            ->groupBy('month')
            ->groupBy('form_f_p_p_s.mesin') // Grouping berdasarkan nomor mesin
            ->get();

        $chartHeatTreatment = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
            ->select(
                DB::raw('COUNT(CASE WHEN form_f_p_p_s.status_2 = 0 THEN 1 END) as total_status_2_0'),
                DB::raw('COUNT(CASE WHEN form_f_p_p_s.status = 3 THEN 1 END) as total_status_3'),
                DB::raw('MONTH(form_f_p_p_s.created_at) as month')
            )
            ->where('form_f_p_p_s.section', 'heat treatment') // Tambahkan kondisi untuk memeriksa nilai 'section'
            ->groupBy('month')
            ->groupBy('form_f_p_p_s.mesin') // Grouping berdasarkan nomor mesin
            ->get();

        $summaryData = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
            ->select(
                DB::raw('MONTH(form_f_p_p_s.created_at) as month'),
                'form_f_p_p_s.section',
                DB::raw('SUM(CASE WHEN form_f_p_p_s.status_2 = 0 THEN 1 ELSE 0 END) as total_status_2_0'), // Total status "open"
                DB::raw('SUM(CASE WHEN form_f_p_p_s.status = 3 THEN 1 ELSE 0 END) as total_status_3') // Total status "closed"
            )
            ->whereIn('form_f_p_p_s.section', ['cutting', 'machining', 'heat treatment', 'machining custom'])
            ->groupBy('month', 'form_f_p_p_s.section', 'form_f_p_p_s.mesin')
            ->get();

        $years2 = []; // Tambahkan tahun 2024 secara manual
        sort($years2);
        // Mendapatkan semua section yang tersedia dari tabel Mesin
        $sections = Mesin::where('status', 0)->select('section')->distinct()->pluck('section');

        $section = $request->input('section', 'All');
        $startDate = Carbon::parse($request->input('start_mesin'));
        $endDate = Carbon::parse($request->input('end_mesin'));

        $selectedYear = $request->input('year', date('Y'));
        $selectedSection = $request->input('section', 'All');
        $startMonth = Carbon::parse($request->input('start_month2'));
        $endMonth = Carbon::parse($request->input('end_month2'));

        if ($selectedSection === 'All') {
            $summaryData2 = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
                ->selectRaw('YEAR(form_f_p_p_s.created_at) as year,
                    MONTH(form_f_p_p_s.created_at) as month, SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 3600) as total_hour')
                ->whereYear('form_f_p_p_s.created_at', $selectedYear)
                ->where('form_f_p_p_s.status', 3)
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get();

            $periodeWaktuPengerjaan = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
                ->selectRaw('SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 60) as total_minute')
                ->whereYear('form_f_p_p_s.created_at', $selectedYear)
                ->whereBetween('form_f_p_p_s.created_at', [$startMonth, $endMonth])
                ->where('form_f_p_p_s.status', 3)
                ->first();

            $periodeMesin = DB::table('mesin')
                ->leftJoin('form_f_p_p_s', function ($join) use ($startDate, $endDate) {
                    $join->on('mesin.no_mesin', '=', 'form_f_p_p_s.mesin')
                        ->where('form_f_p_p_s.status', 3)
                        ->whereBetween('form_f_p_p_s.created_at', [$startDate, $endDate]);
                })
                ->select('mesin.no_mesin', DB::raw('SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 60) AS total_minutes'))
                ->orderByRaw("SUBSTRING(mesin.no_mesin FROM 1 FOR 1), CAST(REGEXP_SUBSTR(mesin.no_mesin, '[0-9]+') AS UNSIGNED)")
                ->whereIn('mesin.section', ['cutting', 'machining', 'heat treatment', 'machining custom'])
                ->groupBy('mesin.no_mesin')
                ->get();
        } else {
            $summaryData2 = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
                ->selectRaw('mesin.no_mesin, YEAR(form_f_p_p_s.created_at) as year,
                    MONTH(form_f_p_p_s.created_at) as month, SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 3600) as total_hour')
                ->whereYear('form_f_p_p_s.created_at', $selectedYear)
                ->where('form_f_p_p_s.section', $selectedSection)
                ->where('form_f_p_p_s.status', 3)
                ->groupBy('mesin.no_mesin', 'year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get();

            $periodeWaktuPengerjaan = FormFPP::join('mesin', 'form_f_p_p_s.mesin', '=', 'mesin.no_mesin')
                ->selectRaw('SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 60) as total_minute')
                ->whereYear('form_f_p_p_s.created_at', $selectedYear)
                ->where('form_f_p_p_s.section', $selectedSection)
                ->whereBetween('form_f_p_p_s.created_at', [$startMonth, $endMonth])
                ->where('form_f_p_p_s.status', 3)
                ->first();

            $periodeMesin = DB::table('mesin')
                ->leftJoin('form_f_p_p_s', function ($join) use ($section, $startDate, $endDate) {
                    $join->on('mesin.no_mesin', '=', 'form_f_p_p_s.mesin')
                        ->where('form_f_p_p_s.status', 3)
                        ->where('form_f_p_p_s.section', $section)
                        ->whereBetween('form_f_p_p_s.created_at', [$startDate, $endDate]);
                })
                ->select('mesin.no_mesin', DB::raw('SUM(TIMESTAMPDIFF(SECOND, form_f_p_p_s.created_at, form_f_p_p_s.updated_at) / 60) AS total_minutes'))
                ->where('mesin.section', $section)
                ->orderByRaw("SUBSTRING(mesin.no_mesin FROM 1 FOR 1), CAST(REGEXP_SUBSTR(mesin.no_mesin, '[0-9]+') AS UNSIGNED)")
                ->whereIn('mesin.section', ['cutting', 'machining', 'heat treatment', 'machining custom'])
                ->groupBy('mesin.no_mesin')
                ->get();
        }

        $labels = [];
        $data2 = [];
        foreach ($summaryData2 as $dataPoint) {
            $labels[] = date('F', mktime(0, 0, 0, $dataPoint->month, 1)); // Mendapatkan nama bulan dari angka bulan
            $data2[] = $dataPoint->total_hour * 60;
        }


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
