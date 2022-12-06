@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script src="{{ asset('js/intervenciones.js') }}"></script>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Creación de intervención') }}</div>
                    <div class="card-body">

                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @elseif (session('statuserror'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('statuserror') }}
                            </div>
                        @endif

                        <br/>

                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">¡La intervención se ha creado con éxito!</h1>
                        </div>
                        
                        <p style="display:none;" id="p1">http://localhost:8081/cuestionario-de-clima</p>
                        
                        <div class="text-sm-start">
                            <p>Para que los funcionarios puedan aplicar al instrumento deberá <b>publicar el link de éste en Moodle</b>.</p>
                        </div>

                        <div class="table-responsive">
                            {{-- usar data tables --}}
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Instrumento</th>
                                        <th>Enlace</th>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    <tr>
                                        <td>Cuestionario de clima</td>
                                        <td>
                                            <button class="btn btn-success" onclick="copyToClipboard('#p1')"><i class="fas fa-fw fa-copy"></i>Copiar enlace</button>
                                        </td>         
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>

                        <br/>

                        <div class="text-center">
                            <button class="btn btn-success"><i class="fas fa-fw fa-link"></i><a href="http://localhost:8082/login/index.php" style="color: aliceblue">Ir a Moodle</a></button>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection