@extends('layouts.app')
@section('content')

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

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Intervenciones</h6>
                    </div>

                        <div class="card-body" id="avanceIntervencion">
                            
                            @foreach($dashboardClimaData as $data)
                                <h4 class="small font-weight-bold">{{$data["unidad"]}}- Cuestionario de Clima - Intervención noviembre 2022<span
                                    class="float-right">{{$data["promedio"]}}%</span></h4>
                                <div class="progress mb-4">
                                    <div class="{{ colorPromedio($data["promedio"]) }}" role="progressbar" style="width: {{ $data["promedio"] }}%"
                                        aria-valuenow="{{ $data["promedio"] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            @endforeach
                        </div>
                </div>
        </div>
    </div>
</div>

@endsection
