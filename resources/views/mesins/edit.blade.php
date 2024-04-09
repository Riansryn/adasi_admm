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
                                    <label for="section" class="form-label">
                                        Section<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="section" name="section" value="{{ $mesin->section }}">
                                </div>

                                <div class="mb-3">
                                    <label for="tipe" class="form-label">
                                        Tipe<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="tipe" name="tipe" value="{{ $mesin->tipe }}">
                                </div>

                                <div class="mb-3">
                                    <label for="no_mesin" class="form-label">
                                        Nomor Mesin<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="no_mesin" name="no_mesin" value="{{ $mesin->no_mesin }}">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_dibuat" class="form-label">
                                        Manufacturing Year<span style="color: red;">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" value="{{ $mesin->tanggal_dibuat }}" min="1900" max="2099" onchange="hitungUmur()">
                                </div>

                                <div class="mb-3">
                                    <label for="umur" class="form-label">Umur<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="umur" name="umur" value="{{ $mesin->umur }}" readonly>
                                    <!-- Jika Anda ingin melakukan perhitungan Age secara otomatis, Anda perlu menambahkan JavaScript untuk menghitungnya. -->
                                </div>

                                <div class="mb-3">
                                    <label for="spesifikasi" class="form-label">
                                        Spesifikasi<span style="color: red;">*</span>
                                    </label>
                                    <textarea class="form-control" id="spesifikasi" name="spesifikasi">{{ $mesin->spesifikasi }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">
                                        Lokasi Mesin<span style="color: red;">*</span>
                                    </label>
                                    <select class="form-select" id="lokasi" name="lokasi">
                                        <option value="" disabled>Pilih Lokasi Mesin</option>
                                        <option value="Deltamas" {{ strtoupper($mesin->lokasi) === 'DELTAMAS' ? 'selected' : '' }}>Deltamas</option>
                                        <option value="DS8" {{ strtoupper($mesin->lokasi) === 'DS8' ? 'selected' : '' }}>DS8</option>
                                        <option value="Surabaya" {{ strtoupper($mesin->lokasi) === 'SURABAYA' ? 'selected' : '' }}>Surabaya</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_preventif" class="form-label">Schedule Preventive Date</label>
                                    <input type="date" class="form-control" id="tanggal_preventif" name="tanggal_preventif" value="{{ $mesin->lokasi }}">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Fungsi untuk menghitung umur berdasarkan tahun pembuatan
        function hitungUmur() {
            // Ambil tahun pembuatan dari input tahun_dibuat
            var tahunDibuat = document.getElementById('tanggal_dibuat').value;

            // Ambil tahun saat ini
            var tahunSaatIni = new Date().getFullYear();

            // Hitung umur dengan mengurangi tahun saat ini dengan tahun pembuatan
            var umur = tahunSaatIni - tahunDibuat;

            // Masukkan hasil perhitungan umur ke input umur
            document.getElementById('umur').value = umur;
        }

        // Perbarui umur setiap kali tahun berubah
        setInterval(function() {
            hitungUmur();
        }, 1000 * 60 * 60 * 24); // Perbarui setiap hari
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Menangkap elemen input file
            var fotoInput = document.getElementById('foto');
            var sparepartInput = document.getElementById('sparepart');

            // Menangkap elemen gambar preview
            var fotoPreview = document.getElementById('fotoPreview');
            var sparepartPreview = document.getElementById('sparepartPreview');

            // Mengatur listener untuk input file foto
            fotoInput.addEventListener('change', function() {
                previewImage(this, fotoPreview);
            });

            // Mengatur listener untuk input file sparepart
            sparepartInput.addEventListener('change', function() {
                previewImage(this, sparepartPreview);
            });

            // Memanggil fungsi previewImage untuk menampilkan preview gambar yang sudah ada
            setPreviewImage(fotoPreview, '{{ $mesin->foto ?? '
                ' }}');
            setPreviewImage(sparepartPreview, '{{ $mesin->sparepart ?? '
                ' }}');

            // Fungsi untuk menampilkan preview gambar
            function previewImage(input, previewElement) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        previewElement.src = e.target.result;
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Fungsi untuk menetapkan URL gambar yang ada sebagai preview
            function setPreviewImage(previewElement, imageURL) {
                if (imageURL) {
                    previewElement.src = imageURL;
                } else {
                    previewElement.src = ''; // Set the src attribute to an empty string
                }
            }
        });
    </script>





</main><!-- End #main -->
@endsection