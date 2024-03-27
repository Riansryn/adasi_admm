@extends('layout')

@section('content')
<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Daftar Tabel Preventif</h5>
                        </div>
                        <div>
                            <a class="btn btn-primary btn-lg" href="{{ route('preventives.create') }}">
                                <i class="bi bi-plus"></i> Tambah Preventif
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Nomor Mesin</th>
                                        <th rowspan="2">Tipe</th>
                                        @for ($i = 1; $i <= 12; $i++) <th colspan="2">{{ \Carbon\Carbon::create(null, $i, null)->format('F') }}</th>
                                            @endfor
                                    </tr>
                                    <tr>
                                        @for ($i = 0; $i < 12; $i++) <th>Plan</th>
                                            <th>Actual</th>
                                            @endfor
                                    </tr>
                                </thead>
                                <tbody>
    @php
        // Grouping data berdasarkan nomor mesin dan bulan
        $groupedPreventives = $preventives->groupBy(function($preventive) {
            return $preventive->nomor_mesin . '-' . \Carbon\Carbon::parse($preventive->jadwal_rencana)->format('m');
        });
    @endphp

    @if(isset($groupedPreventives))
        @foreach ($groupedPreventives as $groupedPreventive)
            @php
                $preventive = $groupedPreventive->first(); // Ambil salah satu data sebagai representasi
                $nomor_mesin = $preventive->nomor_mesin;
                $tipe = $preventive->tipe;
                $month = \Carbon\Carbon::parse($preventive->jadwal_rencana)->month;
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $nomor_mesin }}</td>
                <td>{{ $tipe }}</td>
                @for ($i = 1; $i <= 12; $i++)
                    @php
                        $plan = '';
                        $actual = '';

                        // Ambil data jadwal rencana untuk bulan yang sesuai
                        $planPreventive = $groupedPreventive->first(function($item) use ($i) {
                            return \Carbon\Carbon::parse($item->jadwal_rencana)->month == $i;
                        });

                        // Ambil data actual untuk bulan yang sesuai
                        $actualPreventive = $groupedPreventive->first(function($item) use ($i) {
                            return \Carbon\Carbon::parse($item->updated_at)->month == $i;
                        });

                        if ($planPreventive) {
                            $plan = $planPreventive->jadwal_rencana ? \Carbon\Carbon::createFromFormat('Y-m-d', $planPreventive->jadwal_rencana)->format('d/m/Y') : '';
                        }

                        if ($actualPreventive) {
                            $actual = \Carbon\Carbon::parse($actualPreventive->updated_at)->format('d/m/Y');
                        }
                    @endphp
                    <td>{{ $plan }}</td>
                    <td class="editable actual">{{ $actual }}</td>
                @endfor
            </tr>
        @endforeach
    @endif
</tbody>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        $('table').on('click', 'td.editable', function(e) {
            var $this = $(this);
            var currentValue = $this.text().trim();
            var inputType = $this.hasClass('plan') ? 'number' : 'text';

            // Buat elemen input untuk mengedit nilai
            var $input = $('<input>', {
                type: inputType,
                value: currentValue
            });

            // Ganti nilai dengan elemen input
            $this.html($input);

            // Fokus pada input
            $input.focus();

            // Reaksi ketika input kehilangan fokus
            $input.on('blur', function() {
                var newValue = $(this).val().trim();

                // Perbarui nilai hanya jika berbeda
                if (newValue !== currentValue) {
                    $this.text(newValue);
                    // Panggil fungsi untuk menyimpan ke database
                    saveToDatabase(newValue, $this);
                }
            });

            // Tangani event keydown untuk tombol Enter
            $input.on('keydown', function(event) {
                if (event.which === 13) { // 13 adalah kode tombol Enter
                    $input.trigger('blur'); // Panggil event blur
                }
            });
        });

        // Fungsi untuk menyimpan ke database
        function saveToDatabase(newValue, $element) {
            var rowData = $element.closest('tr').find('td').map(function() {
                return $(this).text().trim();
            }).get();

            var data = {
                nomor_mesin: rowData[1], // Menggunakan nomor_mesin sebagai identifikasi
                newValue: newValue
            };

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route("updatePreventive") }}', // Sesuaikan dengan route Anda
                method: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('Data berhasil disimpan ke database');
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan:', error);
                }
            });
        }
    });
</script>
@endsection
