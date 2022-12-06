@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script src="{{ asset('js/intervenciones.js') }}"></script>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Lista de Intervenciones') }}</div>
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

                        <div class="row">
                            <a href="{{ route('crearIntervencion') }}" class="btn btn-success">+ Crear intervención</a>
                        </div>
    
                        <br/>
                
                        
                        <div class="table-responsive">
                            {{-- usar data tables --}}
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Acción</th>
                                        <th>Periodo</th>
                                        <th>Intrumentos</th>
                                        <th>Unidad</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    @foreach($listaDeIntervenciones as $item)
                                <tr>
                                    <td>
                                        @if(!$item->estado)
                                            <a href="#" class="btn btn-danger">Finalizar</a>
                                        @endif

                                    </td>
                                    
                                    <td>{{ $item->periodo }}</td>
                                    <td>Cuestionario de Clima</td>
                                    <td>{{ $item->curso_id }}</td>
                                    <td>{{ $item->estado }}</td>

                                    
                                </tr>
                                @endforeach
                                    
                                </tbody>
                            </table>
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection