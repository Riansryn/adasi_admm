@extends('layout')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Edit mesin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Form Edit Mesin</h5>

                            <form id="mesinForm" action="{{ route('mesins.update', $mesin->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="nama_mesin" class="form-label">
                                        Nama Mesin<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="nama_mesin" name="nama_mesin" value="{{ $mesin->nama_mesin }}">
                                </div>

                                <div class="mb-3">
                                    <label for="no_mesin" class="form-label">
                                        No Mesin<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="no_mesin" name="no_mesin" value="{{ $mesin->no_mesin }}">
                                </div>

                                <div class="mb-3">
                                    <label for="merk" class="form-label">
                                        Merk<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="merk" name="merk" value="{{ $mesin->merk }}">
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">
                                        Type<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="type" name="type" value="{{ $mesin->type }}">
                                </div>

                                <div class="mb-3">
                                    <label for="mfg_date" class="form-label">
                                        Manufacturing date<span style="color: red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="mfg_date" name="mfg_date" placeholder="YYYY" min="1900" max="{{ date('Y') }}" value="{{ $mesin->mfg_date }}">
                                </div>

                                <div class="mb-3">
                                    <label for="acq_date" class="form-label">
                                        Acquisition date<span style="color: red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="acq_date" name="acq_date" placeholder="YYYY" min="1900" max="{{ date('Y') }}" value="{{ $mesin->acq_date }}">
                                </div>

                                <div class="mb-3">
                                    <label for="age" class="form-label">
                                        Age<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="age" name="age" readonly value="{{ $mesin->age }}">
                                </div>


                                <div class="mb-3">
                                    <label for="preventive_date" class="form-label">Schedule Preventive Date</label>
                                    <input type="date" class="form-control" id="preventive_date" name="preventive_date" value="{{ $mesin->preventive_date }}">
                                </div>

                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <div>
                                        @if($mesin->foto)
                                        <img id="fotoPreview" src="{{ asset($mesin->foto) }}" alt="Preview Foto" style="max-width: 200px;">
                                        @else
                                        <p>No image available</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="foto" class="form-label">Upload Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>

                                <div class="mb-3">
                                    <label for="sparepart" class="form-label">Sparepart</label>
                                    <div>
                                        @if($mesin->sparepart)
                                        <img id="fotoPreview" src="{{ asset($mesin->sparepart) }}" alt="Preview Sparepart" style="max-width: 200px;">
                                        @else
                                        <p>No image available</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="sparepart" class="form-label">Upload Data Sparepart</label>
                                    <input type="file" class="form-control" id="sparepart" name="sparepart">
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary" onclick="resetForm()">Reset</button>
                                    <a href="{{ route('mesins.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function resetForm() {
            document.getElementById('mesinForm').reset();
        }
    </script>
    <script>
        function handleFormSubmission() {
            // Validasi form sebelum pengiriman
            var nama_mesin = document.getElementById('nama_mesin').value.trim();
            var no_mesin = document.getElementById('no_mesin').value.trim();
            var merk = document.getElementById('merk').value.trim();
            var type = document.getElementById('type').value.trim();
            var mfg_date = document.getElementById('mfg_date').value.trim();
            var acq_date = document.getElementById('acq_date').value.trim();

            if (nama_mesin === '' || no_mesin === '' || merk === '' || type === '' || mfg_date === '' || acq_date === '' || preventive_date === '') {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Harap isi semua kolom yang dibutuhkan.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            } else {
                // Jika formulir valid, tampilkan SweetAlert untuk konfirmasi
                Swal.fire({
                    title: 'Berhasil Diubah!',
                    text: 'Data mesin berhasil diubah.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect or perform any other action after clicking OK
                        document.getElementById('mesinForm').submit();
                    }
                });
            }
        }

        // Event listener for form submission
        document.getElementById('mesinForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Call the function to handle form submission and show SweetAlert
            handleFormSubmission();
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Tambahkan skrip JavaScript untuk menghitung Age saat mengisi form
        document.getElementById('mfg_date').addEventListener('input', function() {
            calculateAge();
        });

        document.getElementById('acq_date').addEventListener('input', function() {
            calculateAge();
        });

        function calculateAge() {
            let mfgdate = parseInt(document.getElementById('mfg_date').value);
            let acquisitiondate = parseInt(document.getElementById('acq_date').value);

            if (!isNaN(mfgdate) && !isNaN(acquisitiondate)) {
                let age = acquisitiondate - mfgdate;
                document.getElementById('age').value = age >= 0 ? age : '';
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Menangkap elemen input file
            var fotoInput = document.getElementById('foto');
            var sparepartInput = document.getElementById('sparepart');

            // Menangkap elemen gambar preview
            var fotoPreview = document.getElementById('fotoPreview');
            var sparepartPreview = document.getElementById('sparepartPreview');
            // Mengatur listener untuk input file
            fotoInput.addEventListener('change', function() {
                previewImage(this, fotoPreview);
            });

            sparepartInput.addEventListener('change', function() {
                previewImage(this, sparepartPreview);
            });

            // Fungsi untuk menampilkan preview gambar
            function previewImage(input, previewElement) {
                var file = input.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewElement.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        });
    </script>



</main><!-- End #main -->
@endsection