<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Handling;
use App\Models\ScheduleVisit;
use App\Models\TypeMaterial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// import Facade "Storage"
use Illuminate\View\View;

class HandlingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Handling::with('customers', 'type_materials')
    ->whereIn('status', [1, 2, 0, 3])
    ->orderByRaw('FIELD(status, 3, 2, 0, 1)')
    ->orderByDesc('created_at')
    ->paginate();
        $data = $data->reverse();

        return view('sales.handling', compact('data'));
    }

    public function getChartData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query untuk mengambil data berdasarkan tanggal mulai dan tanggal selesai
        $data = Handling::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('COUNT(CASE WHEN status_2 = 0 THEN 1 END) as Open')
            ->selectRaw('COUNT(CASE WHEN status = 3 THEN 1 END) as Close')
            ->first();

        // Mengembalikan data dalam format JSON
        return response()->json($data);
    }

    public function getDataByYear(Request $request)
    {
        // Ambil tahun dari request
        $year = $request->input('year');

        // Query untuk mengambil data berdasarkan tahun
        $data = Handling::select(
            \DB::raw('COUNT(CASE WHEN status_2 = 0 THEN 1 END) as total_status_2_0'),
            \DB::raw('COUNT(CASE WHEN status = 3 THEN 1 END) as total_status_3'),
            \DB::raw('MONTH(created_at) as month')
        )
            ->whereYear('created_at', $year) // Filter berdasarkan tahun
            ->groupBy('month')
            ->get();

        return response()->json($data); // Mengembalikan data dalam format JSON
    }

    public function changeStatus($id)
    {
        // Temukan data berdasarkan ID
        $data = Handling::findOrFail($id);

        // Ubah status menjadi 3 (Close)
        $data->status = 3;
        $data->save();

        // Redirect kembali ke halaman yang sesuai (opsional)
        return redirect()->route('index')->with('success', 'Status changed successfully.');
    }

    public function showHistory($id)
    {
        // get handlings by ID
        $handlings = Handling::findOrFail($id);

        $customers = Customer::all();
        $type_materials = TypeMaterial::all();
        $data = ScheduleVisit::where('handling_id', $id)->get();

        // render view with handlings
        return view('sales.showHistory', compact('handlings', 'customers', 'type_materials', 'data'));
    }

    public function FilterPieChartTipe(Request $request)
    {
        // Mendapatkan nilai yang dipilih dari dropdown
        $type_name = $request->input('type_name');
        $kategori = $request->input('kategori');
        $jenis = $request->input('jenis');
        $type = $request->input('type');
        $start_month = $request->input('start_month'); // Tambahkan parameter bulan mulai
        $end_month = $request->input('end_month'); // Tambahkan parameter bulan akhir

        if (empty($start_month) && empty($end_month)) {
            // Mengambil data berdasarkan filter yang dipilih
            $data = Handling::join('type_materials', 'handlings.type_id', '=', 'type_materials.id')
                ->select(
                    'type_materials.type_name AS type_name',
                    DB::raw('SUM(handlings.qty) AS total_qty'),
                    DB::raw('SUM(handlings.pcs) AS total_pcs'),
                    DB::raw('SUM(CASE WHEN handlings.type_1 = "Komplain" THEN 1 ELSE 0 END) AS total_komplain'),
                    DB::raw('SUM(CASE WHEN handlings.type_2 = "Klaim" THEN 1 ELSE 0 END) AS total_klaim'),
                    DB::raw('COALESCE(SUM(CASE WHEN handlings.type_1 = "Komplain" THEN 1 ELSE 0 END) +
                            SUM(CASE WHEN handlings.type_2 = "Klaim" THEN 1 ELSE 0 END), 0) AS kategori')
                )
                ->where(function ($query) use ($type) {
                    if ($type == 'total_komplain') {
                        $query->where('handlings.type_1', 'Komplain');
                    } elseif ($type == 'total_klaim') {
                        $query->where('handlings.type_2', 'Klaim');
                    }
                })
                ->groupBy('handlings.type_id', 'type_materials.type_name')
                ->get();
        } else {
            // Mengambil data berdasarkan filter yang dipilih
            $data = Handling::join('type_materials', 'handlings.type_id', '=', 'type_materials.id')
                ->select(
                    'type_materials.type_name AS type_name',
                    DB::raw('SUM(handlings.qty) AS total_qty'),
                    DB::raw('SUM(handlings.pcs) AS total_pcs'),
                    DB::raw('SUM(CASE WHEN handlings.type_1 = "Komplain" THEN 1 ELSE 0 END) AS total_komplain'),
                    DB::raw('SUM(CASE WHEN handlings.type_2 = "Klaim" THEN 1 ELSE 0 END) AS total_klaim'),
                    DB::raw('COALESCE(SUM(CASE WHEN handlings.type_1 = "Komplain" THEN 1 ELSE 0 END) +
                      SUM(CASE WHEN handlings.type_2 = "Klaim" THEN 1 ELSE 0 END), 0) AS kategori')
                )
                ->where(function ($query) use ($type) {
                    if ($type == 'total_komplain') {
                        $query->where('handlings.type_1', 'Komplain');
                    } elseif ($type == 'total_klaim') {
                        $query->where('handlings.type_2', 'Klaim');
                    }
                })
                ->whereBetween('handlings.created_at', [$start_month, $end_month]) // Filter berdasarkan rentang tanggal
                ->groupBy('handlings.type_id', 'type_materials.type_name')
                ->get();
        }

        // Mengembalikan data dalam format JSON
        return response()->json($data);
    }

    public function FilterPieChartProses(Request $request)
    {
        $type_name = $request->input('type_name');
        $kategori2 = $request->input('kategori2');
        $jenis2 = $request->input('jenis2');
        $type2 = $request->input('type2');
        $start_month3 = $request->input('start_month3');
        $end_month3 = $request->input('end_month3');

        $dataQuery = DB::table('handlings')
            ->select(
                'handlings.process_type AS type_name',
                DB::raw('SUM(handlings.qty) AS total_qty'),
                DB::raw('SUM(handlings.pcs) AS total_pcs'),
                DB::raw('SUM(CASE WHEN handlings.type_1 = "Komplain" THEN 1 ELSE 0 END) AS total_komplain'),
                DB::raw('SUM(CASE WHEN handlings.type_2 = "Klaim" THEN 1 ELSE 0 END) AS total_klaim')
            );

        if (empty($start_month3) && empty($end_month3)) {
            $dataQuery->where(function ($query) use ($type2) {
                if ($type2 == 'total_komplain') {
                    $query->where('handlings.type_1', 'Komplain');
                } elseif ($type2 == 'total_klaim') {
                    $query->where('handlings.type_2', 'Klaim');
                }
            });
        } else {
            $dataQuery->where(function ($query) use ($type2) {
                if ($type2 == 'total_komplain') {
                    $query->where('handlings.type_1', 'Komplain');
                } elseif ($type2 == 'total_klaim') {
                    $query->where('handlings.type_2', 'Klaim');
                }
            })
            ->whereBetween('handlings.created_at', [$start_month3, $end_month3]);
        }

        if ($kategori2 === 'All Kategori') {
            $data = $dataQuery
                ->selectRaw('SUM(CASE WHEN handlings.type_1 = "Komplain" THEN 1 ELSE 0 END) +
                     SUM(CASE WHEN handlings.type_2 = "Klaim" THEN 1 ELSE 0 END) AS kategori2')
                ->groupBy() // Menghilangkan groupBy karena kita ingin total untuk semua jenis
                ->get();
        } else {
            $data = $dataQuery
                ->selectRaw('COALESCE(SUM(CASE WHEN handlings.type_1 = "Komplain" THEN 1 ELSE 0 END) +
                     SUM(CASE WHEN handlings.type_2 = "Klaim" THEN 1 ELSE 0 END), 0) AS kategori2')
                ->groupBy('handlings.process_type')
                ->get();
        }

        // Mengembalikan data dalam format JSON
        return response()->json($data);
    }

    /**
     * create.
     */
    public function create(): View
    {
        $customers = Customer::all();
        $type_materials = TypeMaterial::all();

        return view('sales.create', compact('customers', 'type_materials'));
    }

    /**
     * store.
     *
     * @param mixed $request
     */
    public function store(Request $request): RedirectResponse
    {
        $imagePaths = []; // Array untuk menyimpan jalur gambar

        // Cek apakah file gambar diunggah
        if ($request->hasFile('image')) {
            // Validasi file gambar
            $request->validate([
                'image.*' => 'image|mimes:jpeg,jpg,png',
            ]);

            // Loop melalui setiap gambar yang diunggah
            foreach ($request->file('image') as $image) {
                // Pindahkan foto ke direktori public/assets/foto
                $imagePath = $image->hashName(); // Gunakan hashname sebagai nama file
                $image->move(public_path('assets/image'), $imagePath);

                // Simpan jalur gambar ke dalam array
                $imagePaths[] = $imagePath;
            }
        }

        // Ubah array menjadi string JSON sebelum menyimpannya ke dalam database
        $imagePathsString = json_encode($imagePaths);

        // Dapatkan tahun saat ini
        $currentYear = date('Y');

        // Buat nomor WO dengan menambahkan tahun saat ini
        $no_wo = 'WO/'.$currentYear.'/'.$request->no_wo;

        // Buat data handling
        $handling = new Handling();
        $handling->no_wo = $no_wo;
        $handling->customer_id = $request->customer_id;
        $handling->type_id = $request->type_id;
        $handling->thickness = $request->thickness;
        $handling->weight = $request->weight;
        $handling->outer_diameter = $request->outer_diameter;
        $handling->inner_diameter = $request->inner_diameter;
        $handling->length = $request->lenght;
        $handling->qty = $request->qty;
        $handling->pcs = $request->pcs;
        $handling->category = $request->category;
        $handling->results = $request->results;
        $handling->process_type = $request->process_type;
        $handling->type_1 = $request->type_1;
        $handling->type_2 = $request->type_2;
        $handling->image = $imagePathsString; // Simpan string JSON jalur gambar
        $handling->status = 0;
        $handling->status_2 = 0;
        $handling->save();

        // redirect to index
        return redirect()->route('index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * edit.
     *
     * @param mixed $id
     */
    public function edit(string $id): View
    {
        // get handlings by ID
        $handlings = Handling::findOrFail($id);
        $customers = Customer::all();
        $type_materials = TypeMaterial::all();

        // render view with handlings
        return view('sales.edit', compact('handlings', 'customers', 'type_materials'));
    }

    /**
     * update.
     *
     * @param mixed $request
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validate form
        $this->validate($request, [
            'images.*' => 'image|mimes:jpeg,jpg,png|max:10000',
        ]);

        // Get handling by ID
        $handlings = Handling::findOrFail($id);

        // Delete old images (if any)
        if ($handlings->image) {
            $oldImagePaths = json_decode($handlings->image, true);

            foreach ($oldImagePaths as $oldImagePath) {
                $fullPath = public_path('assets/image/'.$oldImagePath);
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }
        }

        // Initialize an array to hold new image paths
        $newImagePaths = [];

        // Check if images are uploaded
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Move each image to the appropriate directory
                $imagePath = $image->hashName();
                $image->move(public_path('assets/image'), $imagePath);

                // Add the new image path to the array
                $newImagePaths[] = $imagePath;
            }
        }

        // Combine old and new image paths
        $allImagePaths = $newImagePaths;

        // Update post with new image paths
        $handlings->update([
            'no_wo' => $request->no_wo,
            'customer_id' => $request->customer_id,
            'type_id' => $request->type_id,
            'thickness' => $request->thickness,
            'weight' => $request->weight,
            'outer_diameter' => $request->outer_diameter,
            'inner_diameter' => $request->inner_diameter,
            'length' => $request->lenght,
            'qty' => $request->qty,
            'pcs' => $request->pcs,
            'category' => $request->category,
            'results' => $request->results,
            'process_type' => $request->process_type,
            'type_1' => $request->type_1,
            'type_2' => $request->type_2,
            'image' => json_encode($allImagePaths),
            'status' => 0,
        ]);

        // redirect to index
        return redirect()->route('index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy.
     *
     * @return void
     */
    public function delete($id): RedirectResponse
    {
        // get post by ID
        $handlings = Handling::findOrFail($id);

        // delete old image
        // Hapus gambar lama jika ada
        if ($handlings->image) {
            $oldImagePath = public_path('assets/image/'.$handlings->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // delete post
        $handlings->delete();

        // redirect to index
        return redirect()->route('index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
