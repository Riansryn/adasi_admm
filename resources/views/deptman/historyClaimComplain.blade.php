@extends('layout')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Menu Riwayat Klaim dan Komplain</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboardHandling') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Menu Riwayat Klaim dan Komplain</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
{{-- test push --}}
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Table History Claim & Complain</h5>
                            <!-- Button trigger modal -->
                            {{-- <div class="card-header" style="margin-bottom: 50px;">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#dateRangeModal">
                                    <i class="bi bi-calendar3 fa-2x"></i>
                                </button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="dateRangeModalLabel">Select Date Range</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="start-date" class="form-label">Start Date:</label>
                                                        <input type="date" class="form-control" id="start-date">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="end-date" class="form-label">End Date:</label>
                                                        <input type="date" class="form-control" id="end-date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                <i class="fas fa-times fa-2x"></i> <!-- Icon close -->
                                            </button>
                                            <button type="button" class="btn btn-success" onclick="exportToExcel()">
                                                <i class="fas fa-file-excel fa-2x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table id="viewSales" class="table table-striped" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="50px">NO</th>
                                            <th class="text-center" width="100px">NO WO</th>
                                            <th class="text-center" width="100px">Customer Code</th>
                                            <th class="text-center" width="150px">Name Customer</th>
                                            <th class="text-center" width="50px">Area</th>
                                            <th class="text-center" width="100px">Type Material</th>
                                            <th class="text-center" width="30px">T</th>
                                            <th class="text-center" width="30px">W</th>
                                            <th class="text-center" width="30px">OD</th>
                                            <th class="text-center" width="30px">ID</th>
                                            <th class="text-center" width="30px">L</th>
                                            <th class="text-center" width="90px">Qty(/KG)</th>
                                            <th class="text-center" width="30px">PCS</th>
                                            <th class="text-center" width="100px">Category (NG)</th>
                                            <th class="text-center" width="100px">Proses Type</th>
                                            <th class="text-center" width="100px">Type 1</th>
                                            <th class="text-center" width="100px">Type 2</th>
                                            <th class="text-center" width="100px">Image</th>
                                            <th class="text-center" width="100px">Schedule Visit</th>
                                            <th class="text-center" width="100px">Due Date</th>
                                            <th class="text-center" width="100px">Pic</th>
                                            <th class="text-center" width="100px">Last Update</th>
                                            <th class="text-center" width="100px">Status</th>
                                            <th class="text-center" width="100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data2 as $row)
                                            <tr id="row_{{ $row->id }}">
                                                <td class="text-center py-3">{{ ++$i }}</td>
                                                <td class="text-center py-3">{{ $row->no_wo }}</td>
                                                <td class="text-center py-3">{{ $row->customer_code }}
                                                </td>
                                                <td class="text-center py-3">{{ $row->name_customer }}
                                                </td>
                                                <td class="text-center py-3">{{ $row->area }}</td>
                                                <td class="text-center py-3">{{ $row->type_name }}
                                                </td>
                                                <td class="text-center py-3">{{ $row->thickness }}</td>
                                                <td class="text-center py-3">{{ $row->weight }}</td>
                                                <td class="text-center py-3">{{ $row->outer_diameter }}</td>
                                                <td class="text-center py-3">{{ $row->inner_diameter }}</td>
                                                <td class="text-center py-3">{{ $row->lenght }}</td>
                                                <td class="text-center py-3">{{ $row->qty }}</td>
                                                <td class="text-center py-3">{{ $row->pcs }}</td>
                                                <td class="text-center py-3">{{ $row->category }}</td>
                                                <td class="text-center py-3">{{ $row->process_type }}</td>
                                                <td class="text-center py-3">{{ $row->type_1 }}</td>
                                                <td class="text-center py-3">{{ $row->type_2 }}</td>
                                                <td class="text-center pt-3">
                                                    <img src="{{ asset('/storage/handling/' . $row->image) }}"
                                                        class="img-fluid rounded" style="max-width: 100%; height: auto;">
                                                </td>
                                                <td class="text-center pt-3">{{ $row->schedule }}</td>
                                                <td class="text-center pt-3">{{ $row->due_date }}</td>
                                                <td class="text-center pt-3">{{ $row->pic }}</td>
                                                <td class="text-center py-3">{{ $row->created_at }}</td>
                                                <td class="text-center py-3"
                                                    style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                    @if ($row->status == 3)
                                                        <span class="badge bg-danger align-items-center"
                                                            style="font-size: 18px;">Close</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{-- <button class="btn btn-primary export-pdf-button"
                                                        data-row-id="{{ $row->id }}">
                                                        <i class="fas fa-file-pdf fa-2x"></i>
                                                    </button> --}}
                                                    <a href="{{ route('showCloseProgres', ['id' => $row->id]) }}" class="btn btn-sm btn-success">
                                                        <i class="fa fa-eye fa-1x" aria-hidden="true"></i>
                                                    </a>                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
