@extends('layout')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Halaman Tambah Data</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboardHandling') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Menu Handling</a></li>
                    <li class="breadcrumb-item active">Halaman Tambah Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Tambah Data</h5>
                        <form id="formInputHandling" action="{{ route('store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="no_wo" class="col-sm-2 col-form-label">No. WO:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="no_wo" name="no_wo"
                                                maxlength="6" style="width: 100%; max-width: 100%;" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="customer_code" class="col-sm-5 col-form-label">Kode Pelanggan:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select id="customer_id" name="customer_id" class="select2" style="width: 100%;"
                                                required>
                                                <option value="" disabled selected></option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}"
                                                        data-name_customer="{{ $customer->name_customer }}"
                                                        data-area="{{ $customer->area }}">{{ $customer->customer_code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="name_customer" class="col-sm-5 col-form-label">Nama Pelanggan:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="name_customer" class="select2" id="name_customer"
                                                style="width: 100%;" required disabled>
                                                <option>🔍 Search or select customer</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->name_customer }}">
                                                        {{ $customer->name_customer }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="area" class="col-sm-5 col-form-label">Area Pelanggan:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="area" class="select2" id="area" style="width: 100%"
                                                required disabled>
                                                <option>🔍 Search or select area</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->area }}">
                                                        {{ $customer->area }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="type_material" class="col-sm-5 col-form-label">Tipe Bahan:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select id="type_id" name="type_id" class="form-select" style="width: 100%"
                                                required>
                                                <option value="">------------- Type Material ------------</option>
                                                @foreach ($type_materials as $typematerial)
                                                    <option value="{{ $typematerial->id }}">{{ $typematerial->type_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="t" class="form-label">T:</label>
                                            <input type="text" class="form-control input-sm" id="thickness"
                                                name="thickness" placeholder="Thickness" style="max-width: 80%">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="w" class="form-label">W:</label>
                                            <input type="text" class="form-control input-sm" id="weight"
                                                name="weight" placeholder="Weight" style="max-width: 80%;">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="w" class="form-label">L:</label>
                                            <input type="text" class="form-control input-sm" id="lenght"
                                                name="lenght" placeholder="Lenght" style="max-width: 80%;">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="w" class="form-label">OD:</label>
                                            <input type="text" class="form-control input-sm" id="outer_diameter"
                                                name="outer_diameter" placeholder="Outer Diameter" style="max-width: 80%">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="w" class="form-label">ID:</label>
                                            <input type="text" class="form-control input-sm" id="inner_diameter"
                                                name="inner_diameter" placeholder="Inner Diameter" style="max-width: 80%">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="qty" class="form-label">QTY (Kg):</label>
                                            <input type="text" class="form-control input-sm" id="qty"
                                                name="qty" style="max-width: 80%;" 
                                                required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="pcs" class="form-label">Unit (Pcs):</label>
                                            <input type="text" class="form-control input-sm" id="pcs"
                                                name="pcs" style="max-width: 80%" 
                                                required>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="cataegory" class="col-sm-5 col-form-label">Kategori (NG):<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="category" class="form-control" id="category" name="category"
                                                style="width: 100%;" required>
                                                <option value="">------------------- Kategori -----------------
                                                </option>
                                                <option value="Retak">Retak</option>
                                                <option value="Pecah">Pecah</option>
                                                <option value="Etc">Etc</option>
                                                <!-- Tambahkan opsi statis lainnya jika diperlukan -->
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="hasil_tindak_lanjut" class="col-sm-5 col-form-label">Keterangan:
                                                (Jika ada)</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <textarea class="form-control" rows="5" id="results" name="results" style="width: 100%"></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="process_type" class="col-sm-5 col-form-label">Jenis Proses:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="process_type" class="form-control" id="process_type"
                                                style="width: 100%;" required>
                                                <option value="">------------------- Tipe Proses -----------------
                                                </option>
                                                <option value="HeatTreatment">Heat treatment</option>
                                                <option value="Cutting">Cutting</option>
                                                <option value="Machining">Machining</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="proses_type" class="col-sm-5 col-form-label">Jenis:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6" @required(true)>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="type_1"
                                                    name="type_1" value="Komplain">
                                                <label class="form-check-label" for="check2">Komplain</label>
                                            </div>
                                            <div class="form-check mr-2">
                                                <input type="checkbox" class="form-check-input" id="type_2"
                                                    name="type_2" value="Klaim">
                                                <label class="form-check-label" for="check1">Klaim</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="col lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="image_upload" class="col-sm-5 col-form-label">Unggah Gambar:<span
                                                    style="color: red;">*</span></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="file" id="formFile" name="image[]" accept="image/*" style="width: 100%" onchange="viewImage(event);" required multiple>
                                        </div>
                                        <small id="fileError" class="text-danger" style="display:none;">Format berkas
                                            tidak sesuai. Silakan unggah gambar.</small>
                                        <!-- error message untuk title -->
                                        <div id="imageError" class="alert alert-danger mt-2" style="display:none;"></div>
                                    </div>
                                    <div class="row mt-3">
                                        <div id="imagePreviewContainer" class="row"
                                            style="display: flex; flex-wrap: wrap;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3" style="margin-top: 2%">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button id="saveButton" type="submit" class="btn btn-primary mb-4 me-3"
                                        onclick="validateCreate()">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <button type="button" class="btn btn-primary mb-4 me-3" onclick="goToIndex()">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script>
            var imageError = document.getElementById('imageError');
            imageError.style.display = 'none';

            var fileInput = document.getElementById('formFile');
            fileInput.addEventListener('change', function(event) {
                var files = event.target.files;

                var imagePreviewContainer = document.getElementById('imagePreviewContainer');
                imagePreviewContainer.innerHTML = '';

                if (files.length === 0) {
                    return;
                }

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var img = new Image();
                        img.onload = function() {
                            var imagePreview = document.createElement('img');
                            imagePreview.src = e.target.result;
                            imagePreview.style.width = '30%'; // Set width to 30%
                            imagePreview.style.height = 'auto'; // Maintain aspect ratio
                            imagePreview.style.marginRight = '10px'; // Set margin right
                            imagePreview.style.marginBottom = '10px'; // Set margin bottom
                            imagePreviewContainer.appendChild(imagePreview);
                        };
                        img.onerror = function() {
                            imageError.innerHTML = 'File yang dipilih bukan gambar valid.';
                            imageError.style.display = 'block';
                        };
                        img.src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                }
            });

            //ddlselect
            document.addEventListener('DOMContentLoaded', function() {
                // Ambil elemen-elemen yang diperlukan
                var customerIdSelect = document.querySelector('select[name="customer_id"]');
                var nameCustomerSelect = document.querySelector('select[name="name_customer"]');
                var areaCustomerSelect = document.querySelector('select[name="area"]');

                // Tambahkan event listener untuk perubahan pada pilihan customer_id
                customerIdSelect.addEventListener('change', function() {
                    // Ambil opsi yang dipilih
                    var selectedOption = customerIdSelect.options[customerIdSelect.selectedIndex];

                    // Set nilai name_customer dan area sesuai dengan data yang dipilih
                    nameCustomerSelect.value = selectedOption.getAttribute('data-name_customer');
                    areaCustomerSelect.value = selectedOption.getAttribute('data-area');
                });
            });

            //button validasi
            function validateCreate() {
                event.preventDefault();

                var no_wo = document.getElementById('no_wo').value.trim();
                var image = document.getElementById('formFile').value.trim();
                var customerCode = document.getElementById('customer_id').value.trim();
                var customerName = document.getElementById('name_customer').value.trim();
                var area = document.getElementById('area').value.trim();
                var qty = document.getElementById('qty').value.trim();
                var pcs = document.getElementById('pcs').value.trim();
                var category = document.getElementById('category').value.trim();
                var process_type = document.getElementById('process_type').value.trim();
                var type_1 = document.getElementById('type_1').value.trim();

                // Memeriksa apakah ada input yang kosong
                if (!no_wo || !image || !customerName || !customerCode || !area || !qty || !pcs || !category || ! process_type ||
                    type_1.length === 0) {
                    // Menampilkan sweet alert error jika ada input yang kosong
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Form belum di isi!',
                    });
                } else {
                    // Simulasi validasi
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data telah tersimpan',
                        showConfirmButton: false
                    });
                    document.getElementById('formInputHandling').submit();
                }
            }

            // Event listener untuk submit form
            document.getElementById('formInputHandling').addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah pengiriman formulir secara default

                // Memanggil fungsi untuk menangani pengiriman formulir dan menampilkan SweetAlert
                validateCreate();
            });

            $(document).ready(function() {
                $('select').selectize({
                    sortField: 'text'
                });
            });
        </script>
    </main><!-- End #main -->
@endsection
