<?php

namespace App\Http\Controllers;

use App\Models\Preventive;
use App\Models\Mesin;
use App\Models\DetailPreventive;
use App\Models\JadwalPreventif;
use Illuminate\Http\Request;

class PreventiveController extends Controller
{
    public function dashboardPreventive(Request $request)
    {
        // Mengambil data mesin
        $mesins = Mesin::all();

        // Mengambil data jadwal preventif berdasarkan bulan
        $preventives = JadwalPreventif::all();

        // Grouping data berdasarkan nomor mesin dan bulan
        $groupedPreventives = $preventives->groupBy(function ($preventive) {
            return $preventive->nomor_mesin . '-' . \Carbon\Carbon::parse($preventive->jadwal_rencana)->format('m');
        });

        // Mengirimkan data ke tampilan
        return view('deptmtce.tabelpreventive', compact('mesins', 'groupedPreventives'))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $mesins = Mesin::orderBy('updated_at', 'desc')->get();
        return view('deptmtce.createpreventive', compact('mesins'));
    }

    public function store(Request $request)
    {
        $request->merge(['status' => 0]);

        // Buat entri baru untuk setiap bulan yang belum ada
        $jadwal_rencana = \Carbon\Carbon::createFromFormat('Y-m-d', $request->jadwal_rencana);

        $existingJadwals = JadwalPreventif::where('nomor_mesin', $request->mesin)
            ->get()
            ->groupBy(function ($item) {
                return \Carbon\Carbon::createFromFormat('Y-m-d', $item->jadwal_rencana)->format('Y-m');
            });

        $bulan = $jadwal_rencana->format('Y-m');
        if ($existingJadwals->has($bulan)) {
            // Jika jadwal untuk bulan yang sama sudah ada, tidak lakukan apa-apa
            return redirect()->route('dashboardPreventive')->with('success', 'Jadwal already exists for this month');
        }

        // Jika tidak, buat entri baru
        JadwalPreventif::create([
            'nomor_mesin' => $request->mesin,
            'tipe' => $request->tipe,
            'jadwal_rencana' => $jadwal_rencana,
            'status' => $request->status
        ]);

        return redirect()->route('dashboardPreventive')->with('success', 'Jadwal created successfully');
    }


    public function update(Request $request, JadwalPreventif $jadwalPreventif)
    {
        // Update nilai aktual dan jadwal rencana
        $jadwalPreventif->actual = $request->updated_at;

        // Simpan perubahan ke database
        $jadwalPreventif->save();

        return redirect()->route('dashboardPreventive')->with('success', 'Jadwal updated successfully');
    }




    // public function maintenanceDashPreventive()
    // {
    //     // Mengambil semua data Mesin
    //     $mesins = Mesin::latest()->get();
    //     // Mengambil semua data Preventive
    //     $detailpreventives = DetailPreventive::latest()->get();
    //     // Variabel $i didefinisikan di sini
    //     $i = 0;
    //     // Kembalikan view dengan data mesins, preventives, dan $i
    //     return view('maintenance.dashpreventive', compact('mesins', 'detailpreventives', 'i'));
    // }

    // public function maintenanceDashBlockPreventive()
    // {
    //     // Mengambil semua data Mesin
    //     $mesins = Mesin::latest()->get();

    //     // Mengambil semua data Preventive
    //     $detailpreventives = DetailPreventive::latest()->get();

    //     // Variabel $i didefinisikan di sini
    //     $i = 0;

    //     // Kembalikan view dengan data mesins, preventives, dan $i
    //     return view('maintenance.blokpreventive', compact('mesins', 'detailpreventives', 'i'));
    // }

    // public function deptmtceDashPreventive()
    // {
    //     $mesins = Mesin::latest()->get();
    //     return view('deptmtce.dashpreventive', compact('mesins'))->with('i', (request()->input('page', 1) - 1) * 5);
    // }

    // public function EditDeptMTCEPreventive(Mesin $mesin, DetailPreventive $detailPreventive)
    // {
    //     $detailPreventives = DetailPreventive::where('id_mesin', $mesin->id)
    //         ->select('perbaikan_checked', 'perbaikan') // Memilih kolom perbaikan_checked dan perbaikan
    //         ->get();

    //     $mesins = Mesin::latest()->get();
    //     // Mendapatkan status mesin
    //     $status = $mesin->status;

    //     // Tentukan tampilan berdasarkan status
    //     if ($status == 1 || $status == 0) {
    //         return view('deptmtce.lihatpreventive', compact('mesin', 'mesins', 'detailPreventives'))->with('i', (request()->input('page', 1) - 1) * 5);
    //     } else {
    //         return view('deptmtce.dashpreventive', compact('mesins'))->with('i', (request()->input('page', 1) - 1) * 5);
    //     }
    // }

    // public function EditMaintenancePreventive(Mesin $mesin, DetailPreventive $detailPreventive)
    // {
    //     $detailPreventives = DetailPreventive::where('id_mesin', $mesin->id)
    //         ->select('perbaikan_checked', 'perbaikan') // Memilih kolom perbaikan_checked dan perbaikan
    //         ->get();

    //     $mesins = Mesin::latest()->get();
    //     // Mendapatkan status mesin
    //     $status = $mesin->status;
    //     // Determine view based on status
    //     if ($status === 1) {
    //         return view('maintenance.lihatpreventive', compact('mesin', 'mesins', 'detailPreventives'))->with('i', (request()->input('page', 1) - 1) * 5);
    //     } else if ($status === 0) {
    //         return view('maintenance.editpreventive', compact('mesin', 'mesins', 'detailPreventives'))->with('i', (request()->input('page', 1) - 1) * 5);
    //     } else {
    //         return view('maintenance.dashpreventive', compact('mesins'))->with('i', (request()->input('page', 1) - 1) * 5);
    //     }
    // }
}
