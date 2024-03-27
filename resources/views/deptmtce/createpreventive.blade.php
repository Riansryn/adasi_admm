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
                <li class="breadcrumb-item active">Form Jadwal Preventif</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Buat Jadwal Preventif</h5>

                            <form id="preventiveForm" method="POST" action="{{ route('preventives.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="mesin" class="form-label">
                                        Pilih Mesin<span style="color: red;">*</span>
                                    </label>
                                    <select class="form-control" id="mesin" name="mesin">
                                        <option value="">Pilih Mesin</option>
                                        @foreach($mesins as $mesin)
                                        <option value="{{ $mesin->no_mesin }}" data-tipe="{{$mesin->tipe}}">
                                            {{ $mesin->section }} | {{ $mesin->tipe }} | {{ $mesin->no_mesin }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tipe" class="form-label">
                                        Tipe<span style="color: red;">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="tipe" name="tipe" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="jadwal_rencana" class="form-label">
                                        Schedule Plan<span style="color: red;">*</span>
                                    </label>
                                    <input type="date" class="form-control" id="jadwal_rencana" name="jadwal_rencana">
                                </div>

                                <!-- <div class="mb-3">
                                    <label for="actual_plan" class="form-label">
                                        Actual Plan<span style="color: red;">*</span>
                                    </label>
                                    <input type="date" class="form-control" id="actual_plan" name="actual_plan">
                                </div> -->

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

</main><!-- End #main -->
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen-elemen yang diperlukan
        var MesinSelect = document.getElementById('mesin');
        var tipeInput = document.getElementById('tipe');
        // Tambahkan event listener untuk perubahan pada pilihan nama_mesin
        MesinSelect.addEventListener('change', function() {
            // Ambil opsi yang dipilih
            var selectedOption = MesinSelect.options[MesinSelect.selectedIndex];

            // Set nilai type, no_mesin, dan mfg_date sesuai data yang dipilih
            tipeInput.value = selectedOption.getAttribute('data-tipe');
        });
    });
</script>