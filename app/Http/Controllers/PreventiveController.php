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
        $mesins = Mesin::all();
        $preventives = JadwalPreventif::all();
        return view('deptmtce.tabelpreventive', compact('mesins', 'preventives'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $mesins = Mesin::orderBy('updated_at', 'desc')->get();
        return view('deptmtce.createpreventive', compact('mesins'));
    }

    public function store(Request $request)
    {
        $request->merge(['status' => 0]);
        JadwalPreventif::create([
            'id_mesin' => $request->mesin,
            'jadwal_rencana' => $request->jadwal_rencana,
            'status' => $request->status
        ]);

        return redirect()->route('dashboardPreventive')->with('success', 'Jadwal created successfully');
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
