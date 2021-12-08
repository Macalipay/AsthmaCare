@extends('backend.master.template')
@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
               Dashboard
            </h1>
            <p class="header-subtitle"> Transaction Management Overview.</p>
        </div>

        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Appointment</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-dark">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="display-5 mt-2 mb-4">{{$appointment}}</h1>
                                    <div class="mb-0">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> </span> Total count of appointment.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Completed</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-dark">
                                                    <i class="align-middle" data-feather="activity"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="display-5 mt-2 mb-4">{{$completed}}</h1>
                                    <div class="mb-0">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span> Total Record of Completed Appointment.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">On-going</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-dark">
                                                    <i class="align-middle" data-feather="external-link"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="display-5 mt-2 mb-4">{{$ongoing}}</h1>
                                    <div class="mb-0">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i></span> Total Record of On-going Appointment.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Cancelled</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-dark">
                                                    <i class="align-middle" data-feather="shopping-cart"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="display-5 mt-2 mb-4">{{$cancelled}}</h1>
                                    <div class="mb-0">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>  </span> Total Record of Cancelled Appointment.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-7 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <div class="card-actions float-right">
                            <a href="#" class="mr-1">
                                <i class="align-middle" data-feather="refresh-cw"></i>
                            </a>
                            <div class="d-inline-block dropdown show">
                                <a href="#" data-toggle="dropdown" data-display="static">
                            <i class="align-middle" data-feather="more-vertical"></i>
                            </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Appointment Summary</h5>
                    </div>
                    <table class="table table-striped my-0">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th class="text-right">Total Request </th>
                                <th class="d-none d-xl-table-cell w-75">% Request Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Success Transaction</td>
                                <td class="text-right">{{$ongoing}}</td>
                                <td class="d-none d-xl-table-cell">
                                    <div class="progress">
                                        @if (App\Appointment::where('status', 0)->count() != 0)
                                        <div class="progress-bar bg-primary-dark" role="progressbar" style="width: {{(App\Appointment::where('status', 0)->count() / App\Appointment::where('status', '!=', 3)->count() ) * 100}}%" solve="{{App\Appointment::where('status', '!=', 3)->count()}}">
                                        {{number_format((App\Appointment::where('status', 0)->count() / App\Appointment::where('status', '!=', 3)->count() ) * 100)}}%</div>
                                        @else
                                            <div class="progress-bar bg-primary-dark" role="progressbar" style="width: 0%" solve="0">0%</div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Cancelled Transaction</td>
                                <td class="text-right">350</td>
                                <td class="d-none d-xl-table-cell">
                                    <div class="progress">
                                        @if (App\Appointment::where('status', 1)->count() != 0)
                                        <div class="progress-bar bg-primary-dark" role="progressbar" style="width: {{(App\Appointment::where('status', 1)->count() / App\Appointment::where('status', '!=', 3)->count() ) * 100}}%" solve="{{App\Appointment::where('status', '!=', 3)->count()}}">
                                        {{number_format((App\Appointment::where('status', 1)->count() / App\Appointment::where('status', '!=', 3)->count() ) * 100)}}%</div>
                                        @else
                                            <div class="progress-bar bg-primary-dark" role="progressbar" style="width: 0%" solve="0">0%</div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>On-going Transaction</td>
                                <td class="text-right">438</td>
                                <td class="d-none d-xl-table-cell">
                                    <div class="progress">
                                        @if (App\Appointment::where('status', 2)->count() != 0)
                                        <div class="progress-bar bg-primary-dark" role="progressbar" style="width: {{(App\Appointment::where('status', 2)->count() / App\Appointment::where('status', '!=', 3)->count() ) * 100}}%" solve="{{App\Appointment::where('status', '!=', 3)->count()}}">
                                        {{number_format((App\Appointment::where('status', 2)->count() / App\Appointment::where('status', '!=', 3)->count() ) * 100)}}%</div>
                                        @else
                                            <div class="progress-bar bg-primary-dark" role="progressbar" style="width: 0%" solve="0">0%</div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-7 col-xl-8 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="card-actions float-right">
                            <a href="#" class="mr-1">
                                <i class="align-middle" data-feather="refresh-cw"></i>
                            </a>
                            <div class="d-inline-block dropdown show">
                                <a href="#" data-toggle="dropdown" data-display="static">
                                    <i class="align-middle" data-feather="more-vertical"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Top 10 Latest Appointment</h5>
                    </div>
                    <table id="datatables" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Patient</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latest_appointments as $key => $appointment)
                                <tr>
                                    <td>{{ ++$key}}</td>
                                    <td>{{ $appointment->doctor->firstname . ' ' . $appointment->doctor->lastname}}</td>
                                    <td>{{ $appointment->date}}</td>
                                    <td>{{ $appointment->time}}</td>
                                    <td>{{ $appointment->patient->firstname . ' ' . $appointment->patient->lastname}}</td>
                                    @if ($appointment->status == 0)
                                        <td class="text-primary">On-going</td>
                                    @elseif($appointment->status == 1)
                                        <td class="text-success">Completed</td>
                                    @elseif($appointment->status == 2)
                                        <td class="text-danger">Cancelled</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-4 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <div class="card-actions float-right">
                            <a href="#" class="mr-1">
                                <i class="align-middle" data-feather="refresh-cw"></i>
                            </a>
                            <div class="d-inline-block dropdown show">
                                <a href="#" data-toggle="dropdown" data-display="static">
                                    <i class="align-middle" data-feather="more-vertical"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Summary of Appointment </h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="py-3">
                                <div class="chart chart-xs">
                                    <canvas id="chartjs-dashboard-pie"></canvas>
                                </div>
                            </div>

                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td><i class="fas fa-circle text-primary fa-fw"></i> On-going Appointment </td>
                                        <td class="text-right">{{$ongoing}}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-circle text-success fa-fw"></i> Completed Appointment</td>
                                        <td class="text-right">{{$completed}}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-circle text-danger fa-fw"></i> Cancelled Appointment</td>
                                        <td class="text-right">{{$cancelled}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

@section('scripts')
        <script>
            $(function() {
                // Pie chart
                new Chart(document.getElementById("chartjs-dashboard-pie"), {
                    type: 'pie',
                    data: {
                        labels: ["Chrome", "Firefox", "IE", "Other"],
                        datasets: [{
                            data: [4401, 4003, 1589],
                            backgroundColor: [
                                window.theme.primary,
                                window.theme.warning,
                                window.theme.danger,
                                "#E8EAED"
                            ],
                            borderColor: "transparent"
                        }]
                    },
                    options: {
                        responsive: !window.MSInputMethodContext,
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 75
                    }
                });
            });
        </script>
        <script>
            $(function() {
                // Radar chart
                new Chart(document.getElementById("chartjs-dashboard-radar"), {
                    type: "radar",
                    data: {
                        labels: ["Birth Request", "Death Request", "Marriage Request", "Birth Application", "Death Application", "Marriage Application"],
                        datasets: [{
                            label: "Process",
                            backgroundColor: "rgba(0, 123, 255, 0.2)",
                            borderColor: "#2979ff",
                            pointBackgroundColor: "#2979ff",
                            pointBorderColor: "#fff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "#2979ff",
                            data: [70, 53, 82, 60, 33, 55]
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        }
                    }
                });
            });
        </script>
        <script>
            $(function() {
                // Bar chart
                new Chart(document.getElementById("chartjs-dashboard-bar-alt"), {
                    type: "bar",
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May"],
                        datasets: [{
                            label: "Last year",
                            backgroundColor: window.theme.primary,
                            borderColor: window.theme.primary,
                            hoverBackgroundColor: window.theme.primary,
                            hoverBorderColor: window.theme.primary,
                            data: [54, 67, 41, 55, 62, 45],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }, {
                            label: "This year",
                            backgroundColor: "#E8EAED",
                            borderColor: "#E8EAED",
                            hoverBackgroundColor: "#E8EAED",
                            hoverBorderColor: "#E8EAED",
                            data: [69, 66, 24, 48, 52, 51],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: false
                                },
                                stacked: false,
                                ticks: {
                                    stepSize: 20
                                }
                            }],
                            xAxes: [{
                                stacked: false,
                                gridLines: {
                                    color: "transparent"
                                }
                            }]
                        }
                    }
                });
            });
        </script>
        <script>
            $(function() {
                $("#datatables-dashboard-traffic").DataTable({
                    pageLength: 7,
                    lengthChange: false,
                    bFilter: false,
                    autoWidth: false,
                    order: [
                        [1, "desc"]
                    ]
                });
            });
    </script>
@endsection
