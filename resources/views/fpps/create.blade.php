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
                <li class="breadcrumb-item active">Create FPP</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Buat Form Permintaan Perbaikan</h5>

                            <form id="FPPForm" action="{{ route('formperbaikans.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="pemohon" class="form-label">
                                        Pemohon<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="pemohon" name="pemohon">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">
                                        Tanggal<span style="color: red;">*</span>
                                    </label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                                </div>

                                <!-- Select section -->
                                <div class="mb-3">
                                    <label for="section" class="form-label">Pilih Section<span style="color: red;">*</span></label>
                                    <select class="form-control" id="section" name="section">
                                        <option value="">Pilih Section</option>
                                        @php
                                        $uniqueSections = $mesins->unique('section')->pluck('section');
                                        @endphp
                                        @foreach($uniqueSections as $section)
                                        <option value="{{ $section }}">{{ $section }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Select mesin -->
                                <div class="mb-3">
                                    <label for="mesin" class="form-label">Pilih Mesin<span style="color: red;">*</span></label>
                                    <select class="form-control" id="mesin" name="mesin" onchange="checkSelectedOption()">
                                        <option value="">Pilih Mesin</option>
                                        @foreach($mesins as $mesin)
                                        <option value="{{ $mesin->no_mesin }}" data-lokasi="{{ $mesin->lokasi }}">{{ $mesin->no_mesin }} | {{ $mesin->tipe }}</option>
                                        @endforeach
                                        <option value="Others">Others</option> <!-- Tambahkan opsi "Others" di sini -->
                                    </select>
                                </div>

                                <div class="mb-3" id="othersFields" style="display: none;">
                                    <label for="mesin" class="form-label">Nama Alat Bantu<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="mesin" name="mesin">
                                </div>

                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="kendala" class="form-label">
                                        Kendala<span style="color: red;">*</span>
                                    </label>
                                    <textarea class="form-control" id="kendala" name="kendala"></textarea>
                                </div>

                                <div class="mb-3">
                                    <img id="gambarPreview" src="" alt="" width="300" height="200" style="display: none;">
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">
                                        Upload Gambar (Jika Ada)<span style="color: red;">*</span>
                                    </label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" onchange="previewImage()">
                                </div>

                                <input type="hidden" name="note" id="note" value="">

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary" onclick="resetForm()">Reset</button>
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
            document.getElementById('FPPForm').reset();
        }
    </script>
    <script>
        function handleFormSubmission() {
            // Memeriksa apakah semua isian telah diisi
            var pemohon = document.getElementById('pemohon').value;
            var tanggal = document.getElementById('tanggal').value;
            var mesin = document.getElementById('mesin').value;
            var lokasi = document.getElementById('lokasi').value;
            var section = document.getElementById('section').value;
            var kendala = document.getElementById('kendala').value;

            if (pemohon === '' || tanggal === '' || mesin === '' || lokasi === '' || kendala === '' || section === '') {
                // Menampilkan SweetAlert jika ada isian yang kosong kecuali upload gambar
                Swal.fire({
                    title: 'Data belum lengkap!',
                    text: 'Mohon lengkapi semua isian, kecuali unggah gambar.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            } else {
                // Jika formulir valid, tampilkan SweetAlert untuk konfirmasi
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Form Permintaan Perbaikan berhasil disimpan.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect or perform any other action after clicking OK
                        document.getElementById('FPPForm').submit();
                    }
                });
            }
        }

        // Event listener for form submission
        document.getElementById('FPPForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Call the function to handle form submission and show SweetAlert
            handleFormSubmission();
        });

        function resetForm() {
            document.getElementById('FPPForm').reset();
            document.getElementById('gambarPreview').style.display = 'none';
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Menangkap elemen input file
            var gambarInput = document.getElementById('gambar');

            // Menangkap elemen gambar preview
            var gambarPreview = document.getElementById('gambarPreview');

            // Mengatur listener untuk input file
            gambarInput.addEventListener('change', function() {
                previewImage(this, gambarPreview);
            });

            // Fungsi untuk menampilkan preview gambar
            function previewImage(input, previewElement) {
                var file = input.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewElement.src = e.target.result;
                    previewElement.style.display = 'block'; // Menampilkan preview setelah gambar diunggah
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
        document.getElementById('section').addEventListener('change', function() {
            var selectedSection = this.value;
            var mesinSelect = document.getElementById('mesin');

            // Kosongkan opsi nomor mesin
            mesinSelect.innerHTML = '';

            // Tambahkan opsi default
            var defaultOption = document.createElement('option');
            defaultOption.value = "";
            defaultOption.textContent = "Pilih Mesin";
            mesinSelect.appendChild(defaultOption);

            // Filter dan tambahkan opsi nomor mesin sesuai dengan section yang dipilih
            @foreach($mesins as $mesin)
            if ("{{ $mesin->section }}" === selectedSection) {
                var option = document.createElement('option');
                option.value = "{{ $mesin->no_mesin }}";
                option.textContent = "{{ $mesin->no_mesin }} | {{ $mesin->tipe }}";
                option.setAttribute('data-lokasi', "{{ $mesin->lokasi }}"); // Tambahkan atribut data-lokasi
                mesinSelect.appendChild(option);
            }
            @endforeach

            // Tambahkan opsi "Others" di bawah
            var othersOption = document.createElement('option');
            othersOption.value = "Others";
            othersOption.textContent = "Others";
            mesinSelect.appendChild(othersOption);
        });
    </script>




    <script>
        document.getElementById('mesin').addEventListener('change', function() {
            var selectedMesin = this.value;
            var lokasiInput = document.getElementById('lokasi');
            var namaAlatBantuInput = document.getElementById('othersFields');
            var othersFields = document.getElementById('othersFields');

            if (selectedMesin === 'Others') {
                // Jika opsi "Others" dipilih, tampilkan input "Nama Alat Bantu" dan hapus readonly pada input lokasi
                namaAlatBantuInput.style.display = 'block';
                lokasiInput.readOnly = false;
                lokasiInput.value = ''; // Kosongkan nilai lokasi
                othersFields.style.display = 'block'; // Tampilkan div "Others" fields
            } else {
                // Jika opsi bukan "Others" dipilih, sembunyikan input "Nama Alat Bantu" dan tetapkan readonly pada input lokasi
                namaAlatBantuInput.style.display = 'none';
                lokasiInput.readOnly = true;
                // Temukan lokasi dari mesin yang dipilih
                var selectedOption = this.options[this.selectedIndex];
                var lokasi = selectedOption.getAttribute('data-lokasi');
                // Perbarui nilai input teks lokasi sesuai dengan lokasi mesin yang dipilih
                lokasiInput.value = lokasi;
                othersFields.style.display = 'none'; // Sembunyikan div "Others" fields
            }
        });
    </script>

</main>
@endsection
