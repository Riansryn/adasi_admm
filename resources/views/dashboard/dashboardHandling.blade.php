@extends('layout')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard Maintenance Handling</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <hr>

        <section class="section dashboard">
            <div class="row">
                <h3 style="display: flex;
            justify-content: center;">Daftar Form Permintaan Perbaikan</h3>
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Open <span></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    @if ($openCount > 0)
                                    <i class="bi bi-envelope-open-fill"></i>
                                    @else
                                    <i class="bi bi-envelope-open-fill"></i>
                                    @endif
                                </div>
                                <div class="ps-3">
                                    <h2>{{ $openCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card Today -->

                <!-- Sales Card This Month -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">On Progress <span></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    @if ($onProgressCount > 0)
                                    <i class="bi bi-hourglass-split "></i>
                                    @else
                                    <i class="bi bi-hourglass-split "></i>
                                    @endif
                                </div>
                                <div class="ps-3">
                                    <h2>{{ $onProgressCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card This Month -->

                <!-- Revenue Card Today -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Finish <span></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    @if ($finishCount > 0)
                                    <i class="bi bi-check2-all"></i>
                                    @else
                                    <i class="bi bi-check2-all"></i>
                                    @endif
                                </div>
                                <div class="ps-3">
                                    <h2>{{ $finishCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Revenue Card Today -->

                <!-- Revenue Card This Month -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Closed <span></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    @if ($closedCount > 0)
                                    <i class="bi bi-x-circle-fill"></i>
                                    @else
                                    <i class="bi bi-x-circle-fill"></i>
                                    @endif
                                </div>
                                <div class="ps-3">
                                    <h2>{{ $closedCount }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Revenue Card This Month -->
            </div>



        </section>

        <hr>

        <section class="section dashboard">
            <div class="row">
            <h3 style="display: flex; justify-content: center;">Daftar Form Claim dan Complain</h3>


                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Open</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                              <i class="bi bi-envelope-open-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            @php
                                                $openHandlingsCount = \App\Models\Handling::where('status', 0)->count();
                                            @endphp
                                            <h6>{{ $openHandlingsCount }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">On Progress</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-hourglass-split "></i>
                                        </div>
                                        <div class="ps-3">
                                            @php
                                                $openHandlingsCount = \App\Models\Handling::where('status', 1)->count();
                                            @endphp
                                            <h6>{{ $openHandlingsCount }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Finish</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-check2-all"></i>
                                        </div>
                                        <div class="ps-3">
                                            @php
                                                $openHandlingsCount = \App\Models\Handling::where('status', 2)->count();
                                            @endphp
                                            <h6>{{ $openHandlingsCount }}</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->
                        <!-- Customers Card -->
                        <div class="col-xxl-3 col-md-6">

                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Close</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-x-circle-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            @php
                                                $openHandlingsCount = \App\Models\Handling::where('status', 3)->count();
                                            @endphp
                                            <h6>{{ $openHandlingsCount }}</h6>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->

                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Handling Claim & Complain <span>/Year</span></h5>

                                    <!-- Line Chart -->
                                    {{-- <div id="reportsChart"></div> --}}
                                    <div style="width: 100%;">
                                        <canvas id="combinedChart" width="800" height="220"></canvas>
                                    </div>

                                    <!-- End Line Chart -->

                                </div>

                            </div>
                        </div><!-- End Reports -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                {{-- <div class="col-lg-4"> --}}

            </div>
        </section>
        <script>
            // chartDashboard Handling
            const ctx = document.getElementById('combinedChart').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ],
                    datasets: [{
                        label: 'Claim',
                        borderColor: 'blue',
                        borderWidth: 1
                    }, {
                        label: 'Complain',
                        data: {!! json_encode(array_values($complainData)) !!},
                        borderColor: 'green',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

            <script>
        // Function to update card based on data

        function updateCard(cardId, title, iconId, count) {
            document.getElementById(cardId + 'Title').textContent = title;
            document.getElementById(cardId + 'Icon').className = 'bi bi-' + iconId;
            document.getElementById(cardId + 'Count').textContent = count;
        }

        // Simulate data update every 5 seconds
        setInterval(function() {
            // Simulate new data
            var openCount = Math.floor(Math.random() * 100);
            var onProgressCount = Math.floor(Math.random() * 100);
            var finishCount = Math.floor(Math.random() * 100);
            var closedCount = Math.floor(Math.random() * 100);

            // Update each card
            updateCard('open', 'Open', 'cart', openCount);
            updateCard('onProgress', 'On Progress', 'clock', onProgressCount);
            updateCard('finish', 'Finish', 'currency-dollar', finishCount);
            updateCard('closed', 'Closed', 'check-circle', closedCount);
        }, 5000); // Update every 5 seconds
    </script>

    </main><!-- End #main -->
@endsection
