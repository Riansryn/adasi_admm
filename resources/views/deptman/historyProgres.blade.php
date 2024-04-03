@extends('layout')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Halaman Riwayat Progres</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboardHandling') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('submission') }}">Menu Tindak Lanjut</a></li>
                    <li class="breadcrumb-item active">Halaman Riwayat Progres</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Konfirmasi</h5>
                        <form action="{{ route('updateConfirm', $handling->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="no_wo" class="col-sm-2 col-form-label">No. WO</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="no_wo" name="no_wo"
                                        value="{{ $handling->no_wo }}" maxlength="15" required readonly>
                                </div>
                            </div>
                            <!-- Customer Code -->
                            <div class="row mb-3">
                                <label for="customer_code" class="col-sm-2 col-form-label">Kode Pelanggan</label>
                                <div class="col-sm-10">
                                    <select name="customer_id" id="customer_id_code" class="w-100 select2" disabled>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                @if ($customer->id == $handling->customer_id) selected @endif>
                                                {{ $customer->customer_code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Customer Name -->
                            <div class="row mb-3">
                                <label for="customer_name" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                                <div class="col-sm-10">
                                    <select name="customer_id" id="customer_id_name" class="w-100 select2" disabled>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                @if ($customer->id == $handling->customer_id) selected @endif>
                                                {{ $customer->name_customer }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Area -->
                            <div class="row mb-3">
                                <label for="area" class="col-sm-2 col-form-label">Area Pelanggan</label>
                                <div class="col-sm-10">
                                    <select name="customer_id" id="customer_id_area" class="w-100 select2" disabled>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                @if ($customer->id == $handling->customer_id) selected @endif>
                                                {{ $customer->area }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="area" class="col-sm-2 col-form-label">Tipe Bahan</label>
                                <div class="col-sm-10">
                                    <select name="type_id" id="type_id" class="w-100" disabled>
                                        @foreach ($type_materials as $typeMaterial)
                                            <option value="{{ $typeMaterial->id }}"
                                                @if ($typeMaterial->id == $handling->type_id) selected @endif>
                                                {{ $typeMaterial->type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2 ps-5">
                                <div class="col-md-2">
                                    <label for="t" class="form-label">T:</label>
                                    <input type="text" class="form-control input-sm" id="thickness" name="thickness"
                                        placeholder="Thickness" value="{{ $handling->thickness }}"
                                        style="max-width: 150px;" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="w" class="form-label">W:</label>
                                    <input type="text" class="form-control input-sm" id="weight" name="weight"
                                        placeholder="Weight" value="{{ $handling->weight }}" style="max-width: 150px;"
                                        readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="w" class="form-label">OD:</label>
                                    <input type="text" class="form-control input-sm" id="outer_diameter"
                                        name="outer_diameter" value="{{ $handling->outer_diameter }}"
                                        placeholder="Outer Diameter" style="max-width: 150px;" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="w" class="form-label">ID:</label>
                                    <input type="text" class="form-control input-sm" id="inner_diameter"
                                        name="inner_diameter" value="{{ $handling->inner_diameter }}"
                                        placeholder="Inner Diameter" style="max-width: 150px;" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="w" class="form-label">L:</label>
                                    <input type="text" class="form-control input-sm" id="lenght" name="lenght"
                                        placeholder="Lenght" value="{{ $handling->lenght }}" style="max-width: 150px;"
                                        readonly>
                                </div>
                            </div>
                            <div class="row mb-2 ps-5">
                                <div class="col-md-2">
                                    <label for="qty" class="form-label">Jumlah:</label>
                                    <input type="text" class="form-control input-sm" id="qty" name="qty"
                                        value="{{ $handling->qty }}" placeholder="(/KG)" style="max-width: 150px;"
                                        required readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="pcs" class="form-label">Jumlah</label>
                                    <input type="text" class="form-control input-sm" id="pcs" name="pcs"
                                        value="{{ $handling->pcs }}" placeholder="(/PCS)" style="max-width: 150px;"
                                        required readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="hasil_tindak_lanjut" class="col-sm-2 col-form-label">Catatan Hasil:
                                    (optional)</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="5" id="results" name="results" style="width: 29%" required>{{ $handlings->results }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="category" class="col-sm-2 col-form-label">Kategori (NG)</label>
                                <div class="col-sm-10">
                                    <select name="category" class="form-control" id="category" required disabled>
                                        <option value="">------------------- Category -----------------</option>
                                        <option value="Retak" {{ $handling->category == 'Retak' ? 'selected' : '' }}>
                                            Retak</option>
                                        <option value="Pecah" {{ $handling->category == 'Pecah' ? 'selected' : '' }}>
                                            Pecah</option>
                                        <option value="Etc" {{ $handling->category == 'Etc' ? 'selected' : '' }}>Etc
                                        </option>
                                        <!-- Tambahkan opsi statis lainnya jika diperlukan -->
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="process_type" class="col-sm-2 col-form-label">Jenis Proses</label>
                                <div class="col-sm-10">
                                    <select name="process_type" class="form-control" id="process_type" required disabled>
                                        <option value="">------------------- Jenis Proses -----------------</option>
                                        <option value="HeatTreatment"
                                            {{ $handling->process_type == 'HeatTreatment' ? 'selected' : '' }}>Heat
                                            treatment</option>
                                        <option value="Cutting"
                                            {{ $handling->process_type == 'Cutting' ? 'selected' : '' }}>Cutting</option>
                                        <option value="Machining"
                                            {{ $handling->process_type == 'Machining' ? 'selected' : '' }}>Machining
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="type_1" class="col-sm-2 col-form-label">Jenis</label>
                                <div class="col-sm-10">
                                    <div class="form-check mr-2">
                                        <input type="checkbox" class="form-check-input" id="type_1" name="type_1"
                                            disabled value="Klaim" @if ($handling->type_1 == 'Klaim') checked @endif>
                                        <label class="form-check-label" for="check1">Klaim</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="type_1" name="type_1"
                                            disabled value="Komplain" @if ($handling->type_1 == 'Komplain') checked @endif>
                                        <label class="form-check-label" for="check2">Komplain</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Gambar</label>
                                <div class="col-sm-10">
                                    <img src="{{ asset('assets/image/' . $handling->image) }}"
                                        class="img-fluid img-thumbnail rounded" style="max-width: 350px;">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            </div>
            <div class="card mb-2">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Riwayat Progres
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <table id="" class="table table-striped table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">NO</th>
                                            <th style="text-align: center;">Hasil dan Tindak Lanjut</th>
                                            <th style="text-align: center;">Jadwal Kunjungan</th>
                                            <th style="text-align: center;">PIC</th>
                                            <th style="text-align: center;">Tenggat waktu</th>
                                            <th style="text-align: center;">Jenis 1</th>
                                            <th style="text-align: center;">Jenis 2</th>
                                            <th style="text-align: center;">Unggahan (File)</th>
                                            <th style="text-align: center;">Pembaruan Terakhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $row)
                                            <tr>
                                                <td class="text-center py-3">{{ $loop->iteration }}</td>
                                                <td class="text-center py-3">{{ $row->results }}</td>
                                                <td class="text-center py-3">{{ $row->schedule }}</td>
                                                <td class="text-center py-3">{{ $row->pic }}</td>
                                                <td class="text-center py-3">{{ $row->due_date }}</td>
                                                <td class="text-center py-3">
                                                    @if ($row->history_type == 1)
                                                        Komplain
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($row->history_type == 1)
                                                        Klaim
                                                    @endif
                                                </td>
                                                <td class="text-center pt-3">
                                                    @if (in_array(pathinfo($row->file, PATHINFO_EXTENSION), ['pdf']))
                                                        <a href="{{ asset('assets/image/' . $row->file) }}"
                                                            download="{{ $row->file_name }}">
                                                            <i class="fas fa-file-pdf fs-4"></i>
                                                        </a>
                                                    @elseif(in_array(pathinfo($row->file, PATHINFO_EXTENSION), ['xlsx', 'xls']))
                                                        <a href="{{ asset('assets/image/' . $row->file) }}"
                                                            download="{{ $row->file_name }}">
                                                            <i class="fas fa-file-excel fs-4"></i>
                                                        </a>
                                                    @elseif(in_array(pathinfo($row->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                        <a href="{{ asset('assets/image/' . $row->file) }}"
                                                            download="{{ $row->file_name }}">
                                                            <img src="{{ asset('assets/image/' . $row->file) }}"
                                                                class="img-fluid rounded"
                                                                style="max-width: 100%; height: auto;">
                                                        </a>
                                                    @else
                                                        <p>File tidak didukung</p>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">{{ $row->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img id="modalImage" class="img-fluid" src="" alt="Image Preview"
                                style="max-width: 100%; max-height: 80vh;">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
