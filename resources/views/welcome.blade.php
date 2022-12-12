@extends('layouts.app')
@section('content')

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<?php

function colorPromedio($promedio){

    switch ($promedio) {

        case ($promedio <= 20):
            $color = "progress-bar bg-danger";
            return $color;
        break;

        case ($promedio > 20 && $promedio <= 40 ):
            $color = "progress-bar bg-warning";
            return $color;
        break;

        case ($promedio > 40 && $promedio <= 60 ):
            $color = "progress-bar";
            return $color;
        break;

        case ($promedio > 60 && $promedio <= 80 ):
            $color = "progress-bar bg-info";
            return $color;
        break;

        case ($promedio > 80 && $promedio <= 100 ):
            $color = "progress-bar bg-success";
            return $color;
        break;

    }
}

?>
<div id="content">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>



        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total de intervenciones</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dashboardData["Total_intervenciones"] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total de unidades</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dashboardData["Total_unidades"] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Avance general
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $dashboardData["Avance"] }}%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="{{ colorPromedio($dashboardData["Avance"]) }}" role="progressbar"
                                                style="width: {{ $dashboardData["Avance"] }}%" aria-valuenow="{{ $dashboardData["Avance"] }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pendientes en contestar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$dashboardData["Pendientes"]}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Intervenciones activas</h6>
                    </div>

                    <div class="card-body" id="avanceIntervencion">

                        @foreach($dashboardData["intervencion"] as $data)
                            <h4 class="small font-weight-bold">{{ $data["unidad"] }} - Intervención {{ $data["periodo"] }}<span
                                class="float-right">{{$data["promedio"]}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="{{ colorPromedio($data["promedio"]) }}" role="progressbar" style="width: {{ $data["promedio"] }}%"
                                    aria-valuenow="{{ $data["promedio"] }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">

                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Funcionarios por unidad</h6>
                    </div>
                    <div class="chart-container" style="height:auto ; width: 550px ; margin: auto;">
                        <br/>
                        <canvas id="myChart"></canvas>
                        <br/>
                    </div>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                            <script>
                            traerDatos();
                            </script>

                </div>
            </div>


        </div>


    </div>
</div>


@endsection
