@extends('admin.layouts.app')
@section('content')
    <style>
        .grad {
            color: #f9f9f9;
            background: var(--sidebar-background-color);
            /* background-image: linear-gradient(210deg, var(--primary-color), #423c95); */
            /* border: 1px solid var(--primary-color); */
            box-shadow: 3px 31px 40px -42px #var(--primary-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 6%;
        }

        .card-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>



    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">

                    <div class="row">


                        <div class="row match-height">
                            <!-- Medal Card -->
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="card card-congratulation-medal">
                                    <div class="card shadow">
                                        <div class="card-header  text-center">
                                            <h4 class="m-0 font-weight-bold text-primary">Statistics Overview</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="statisticsChart" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Medal Card -->

                            <!-- Statistics Card -->
                            <div class="col-xl-8 col-md-6 col-12">

                                <div class="row">

                                    @foreach ($statistics as $key => $val)
                                        @php
                                            $colClass = in_array($loop->index, [0, 1])
                                                ? 'col-md-6 col-sm-6'
                                                : 'col-md-4 col-sm-4';
                                        @endphp

                                        <div class=" col-12 {{ $colClass }} mb-xl-2">
                                            <div class="d-flex flex-row card grad"
                                                style="box-shadow: 5px 8px 11px 2px rgb(167 168 190 / 7">
                                                <div class="card-info text-align-center">
                                                    <div class="d-flex align-items-end mb-1">
                                                        <h1 class="mb-0 text-light" style="font-weight: 600;">
                                                            {{ $val }}</h1>
                                                    </div>
                                                    <h5 class="text-nowrap text-light">{{ $key }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>

                            </div>


                        </div>

                    </div>




                </section>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('statisticsChart').getContext('2d');
            const data = {
                labels: {!! json_encode(array_keys($graf_statistics)) !!},
                datasets: [{
                    label: 'Statistics',
                    data: {!! json_encode(array_values($graf_statistics)) !!},
                    backgroundColor: [
                        '#4e73df',
                        '#1cc88a',
                        '#36b9cc',
                        '#f6c23e',
                        '#e74a3b',
                        '#858796',
                        '#fd7e14',
                        '#20c997',
                        '#6f42c1',
                    ],
                    hoverOffset: 12,
                    borderColor: '#fff',
                    borderWidth: 2,
                }]
            };

            const options = {
                responsive: true,
                cutout: '60%', // Makes it a doughnut
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.formattedValue}`;
                            }
                        }
                    }
                },
                animation: {
                    animateRotate: true,
                    duration: 1000,
                    easing: 'easeOutBounce'
                }
            };

            new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: options
            });
        });
    </script>
@endsection
