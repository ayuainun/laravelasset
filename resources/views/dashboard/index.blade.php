@extends('dashboard.body.main')


@section('specificpagestyles')
<link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
@endsection

@section('specificpagescripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/litepicker.js') }}"></script>
<script>
    var incomingData = [
        {{ $sumin }}, {{ $bulksumin }}, {{ $partssumin }}, {{ $repairsumin }}, {{ $unresumin }}
    ];
    
    var outgoingData = [
        {{ $sumout }}, {{ $bulksumout }}, {{ $partssumout }}, {{ $repairsumout }}, {{ $unresumout }}
    ];
    
    var atWorkshopData = [
        {{ $sumqty }}, {{ $bulksumqty }}, {{ $partssumqty }}, {{ $repairsumqty }}, {{ $unresumqty }}
    ];
    
    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Spare Unit", "Bulk Material", "Spare Part", "Repair", "Unrepairable"],
            datasets: [
                {
                    label: "Incoming",
                    backgroundColor: "rgba(0, 97, 242, 1)",
                    data: incomingData,
                },
                {
                    label: "Outgoing",
                    backgroundColor: "rgba(255, 99, 132, 1)",
                    data: outgoingData,
                },
                {
                    label: "At Workshop",
                    backgroundColor: "rgba(75, 192, 192, 1)",
                    data: atWorkshopData,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Asset Overview',
                },
            },
        },
    });
    </script>    
@endsection

@section('content')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                        Dashboard
                    </h1>
                    {{-- <div class="page-header-subtitle">Example dashboard overview and content summary</div> --}}
                </div>
                <div class="col-12 col-xl-auto mt-4">
                    <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                        <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                        <input class="form-control ps-0 pointer" id="litepickerRangePlugin" placeholder="Select date range..." />
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main page content -->
<div class="container-xl px-4 mt-n10">
    <!-- Example Colored Cards for Dashboard Demo -->
    <div class="row">
        <div class="col-lg-4 col-xl-3 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-lg fw-bold">Asset Spare Unit</div>
                            <div class="text-white-75 high">Incoming : {{ $sumin }}</div>
                            <div class="text-white-75 high">Outgoing : {{ $sumout }}</div>
                            <div class="text-white-75 high">At Workshop : {{ $sumqty }}</div>
                        </div>
                        <i class="feather-xl text-white-50" data-feather="calendar"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-lg fw-bold">Asset Bulk Material</div>
                            <div class="text-white-75 high">Incoming : {{ $bulksumin }}</div>
                            <div class="text-white-75 high">Outgoing : {{ $bulksumout }}</div>
                            <div class="text-white-75 high">At Workshop : {{ $bulksumqty }}</div>
                        </div>
                        <i class="feather-xl text-white-50" data-feather="dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-success text-white h-80">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-lg fw-bold">Asset Spare Part</div>
                            <div class="text-white-75 high">Incoming : {{ $partssumin }}</div>
                            <div class="text-white-75 high">Outgoing : {{ $partssumout }}</div>
                            <div class="text-white-75 high">At Workshop : {{ $partssumqty }}</div>
                        </div>
                        <i class="feather-xl text-white-50" data-feather="check-square"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-danger text-white h-80">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-lg fw-bold">Asset Repair</div>
                            <div class="text-white-75 high">Incoming : {{ $repairsumin }}</div>
                            <div class="text-white-75 high">Outgoing : {{ $repairsumout }}</div>
                            <div class="text-white-75 high">At Workshop : {{ $repairsumqty }}</div>
                        </div>
                        <i class="feather-xl text-white-50" data-feather="message-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-lg fw-bold">Unrepairable Asset</div>
                            <div class="text-white-75 high">Incoming : {{ $unresumin }}</div>
                            <div class="text-white-75 high">Outgoing : {{ $unresumout }}</div>
                            <div class="text-white-75 high">At Workshop : {{ $unresumqty }}</div>
                        </div>
                        <i class="feather-xl text-white-50" data-feather="message-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Example Charts for Dashboard Demo -->
      <div class="row justify-content-center">
        <div class="col-xl-6 mb-4">
            <div class="card card-header-actions h-100">
                <div class="card-header">
                    Asset Stock
                    {{-- <div class="dropdown no-caret">
                        <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="areaChartDropdownExample">
                            <a class="dropdown-item" href="#">2021</a>
                            <a class="dropdown-item" href="#">2022</a>
                            <a class="dropdown-item" href="#">2023</a>
                            <a class="dropdown-item" href="#">This Month</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Custom Range</a>
                        </div>
                    </div> --}}
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart" width="100%" height="30"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
