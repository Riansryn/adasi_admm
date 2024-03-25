@extends('layout')


@section('content')
<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
            </div>
        </div>
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
                        <!-- Calendar -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Jenis Mesin</th>
                                        <th rowspan="2">Type</th>
                                        <th colspan="2">Januari</th>
                                        <th colspan="2">Februari</th>
                                        <th colspan="2">Maret</th>
                                        <th colspan="2">April</th>
                                        <th colspan="2">Mei</th>
                                        <th colspan="2">Juni</th>
                                        <th colspan="2">Juli</th>
                                        <th colspan="2">Agustus</th>
                                        <th colspan="2">September</th>
                                        <th colspan="2">Oktober</th>
                                        <th colspan="2">November</th>
                                        <th colspan="2">Desember</th>
                                    </tr>
                                    <tr>
                                        <th>Plan</th>
                                        <th>Actual</th>
                                        <th>Plan</th>
                                        <th>Actual</th>
                                        <th>Plan</th>
                                        <th>Actual</th>
                                        <th>Plan</th>
                                        <th>Actual</th>
                                        <th>Plan</th>
                                        <th>Actual</th>
                                        <th>Plan</th>
                                        <th>Actual</th>
                                        <th>Plan</th>
                                        <th>Actual</th>
                                        <th>Plan</th>
                                        <th>Actual</th>
                                        <th>Plan</th>
                                        <th>Actual</th>
                                        <th>Plan</th>
                                        <th>Actual</th>
                                        <th>Plan</th>
                                        <th>Actual</th>
                                        <th>Plan</th>
                                        <th>Actual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Isi tabel -->
                                    @foreach ($mesins as $mesin)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $mesin->no_mesin }}</td>
                                        <td>{{ $mesin->tipe }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
        $('table').click(function(e) {
            if ($(e.target).is('td, th')) {
                $(e.target).parent().toggleClass('clicked');
            }
        });
    });
</script>


@endsection