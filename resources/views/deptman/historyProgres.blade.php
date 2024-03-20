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
                                                <td class="text-center py-3">{{ ++$i }}</td>
                                                <td class="text-center py-3">{{ $row->results }}</td>
                                                <td class="text-center py-3">{{ $row->schedule }}</td>
                                                <td class="text-center py-3">{{ $row->pic }}</td>
                                                <td class="text-center py-3">{{ $row->due_date }}</td>
                                                <td class="text-center py-3">{{ $row->handlings->type_1 }}</td>
                                                <td class="text-center py-3">{{ $row->handlings->type_2 }}</td>
                                                <td class="text-center pt-3">
                                                    @if (in_array(pathinfo($row->file, PATHINFO_EXTENSION), ['pdf']))
                                                        <a href="{{asset('assets/image/' . $row->file) }}"  download="{{ $row->file_name }}">
                                                            <i class="fas fa-file-pdf fs-4"></i>
                                                        </a>
                                                    @elseif(in_array(pathinfo($row->file, PATHINFO_EXTENSION), ['xlsx', 'xls']))
                                                        <a href="{{asset('assets/image/' . $row->file) }}"  download="{{ $row->file_name }}">
                                                            <i class="fas fa-file-excel fs-4"></i>
                                                        </a>
                                                    @elseif(in_array(pathinfo($row->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                        <a href="{{ asset('assets/image/' . $row->file) }}"  download="{{ $row->file_name }}">
                                                            <img src="{{ asset('/storage/handling/' . $row->file) }}"
                                                                class="img-fluid rounded"
                                                                style="max-width: 100%; height: auto;">
                                                        </a>
                                                    @else
                                                        <p>File tidak didukung</p>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">{{ $row->created_at }}</td>
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
