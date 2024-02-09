@section('title', 'WebArt CRM')
@extends('admin.master.layout')

@section('content')

    @php

    @endphp

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="crms-title row bg-white mb-4">
                <div class="col">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="la la-table"></i>
                        </span> <span>Dashboard</span>
                    </h3>
                </div>
                <div class="col text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>

            <!-- /Page Header -->

            <div class="row graphs">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Department Wise Employee</h3>
                            <h4></h4>
                            <canvas id="pie-chart" width="800" height="450"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">      
                        <div class="card-body">
                            <h3 class="card-title">Monthly Wise Collections</h3>
                            <canvas id="bar-chart-horizontal" width="800" height="450"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row graphs">
                {{-- <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Sales Overview</h3>
                            <div id="line-charts"></div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-6">

                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Total Client</h3>
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Monthly Projects</h3>
                            <canvas id="bar-chart" width="800" height="550"></canvas>
                        </div>
                    </div>
                </div>
            </div>
         
            <div class="row graphs">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Total Active/Inactive Employee</h3>
                            <h4></h4>
                            <canvas id="emppie-chart" width="800" height="450"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Client Wise Active Projects</h3>
                            <canvas id="salesbar-chart" width="800" height="550"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Chart JS -->
    <script src="{{ url('panel/assets/js/morris.js') }}"></script>
    <script src="{{ url('panel/assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ url('panel/assets/js/chart.js') }}"></script>
    <script src="{{ url('panel/assets/js/linebar.min.js') }}"></script>
    <script src="{{ url('panel/assets/js/piechart.js') }}"></script>
    <script src="{{ url('panel/assets/js/apex.min.js') }}"></script>

    <script>
        
        var options = {
            series: [{
                name: "Client",
                data: <?php echo $clientDataJSON; ?>
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Product Trends by Month',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                'Dec'], // takes an array which will be repeated on
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();



        // Bar chart
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                'Dec'],
                datasets: [{
                    label: "Projects",
                    backgroundColor: ["#fe7096", "#9a55ff", "#fe7096", "#e8c3b9", "#9a55ff"],
                    data: <?php echo $saleDataJSON; ?>
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Monthly Wise Projects'
                }
            }
        });


        /*horixzontal bar chart*/
        new Chart(document.getElementById("bar-chart-horizontal"), {
            type: 'horizontalBar',
            data: {
              labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
              datasets: [
                {
                  label: "Collections",
                  backgroundColor: ["#fe7096", "#9a55ff","#3cba9f","#e8c3b9","#9a55ff","#fe7096", "#9a55ff","#3cba9f","#e8c3b9","#9a55ff","#fe7096"],
                  data: <?php echo $collectionDataJSON; ?>
                }
              ]
            },
            options: {
              legend: { display: false },
              title: {
                display: true,
                text: ''
              }
            }
        });


        /*pie chart*/
        new Chart(document.getElementById("pie-chart"), {
            type: 'pie',
            data: {
            labels: <?php echo $labels; ?>,
            datasets: [{
                label: "Population (millions)",
                backgroundColor: ["#9a55ff", "#fe7096", "#ffdd57", "#00d4ff", "#ff6b6b", "#28df99", "#ffa801", "#ff3838", "#4b4b4b", "#0fb9b1"],
                data: <?php echo $data; ?>
            }]
            },
            options: {
            title: {
                display: true,
                text: ''
            }
            }
        });

        /*Employee pie chart*/
        new Chart(document.getElementById("emppie-chart"), {
            type: 'pie',
            data: {
            labels: ["Active", "Inactive"],
            datasets: [{
                label: "Population (millions)",
                backgroundColor: [ "#9a55ff","#fe7096"],
                data: [<?php echo $activeuser; ?>, <?php echo $inactiveuser; ?>]
            }]
            },
            options: {
            title: {
                display: true,
                text: ''
            }
            }
        });

        /*Client Wise Sales chart*/
        new Chart(document.getElementById("salesbar-chart"), {
            type: 'bar',
            data: {
            labels: <?php echo $labelsJSON; ?>,
            datasets: [
                {
                label: "Projects",
                backgroundColor: ["#fe7096", "#9a55ff","#fe7096","#e8c3b9","#9a55ff"],
                data: <?php echo $dataJSON; ?>
                }
            ]
            },
            options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Client Wise Active Projects'
            }
            }
       });
        
    </script>
@endsection
