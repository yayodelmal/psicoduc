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

                        <p style="display:none;" id="p1">http://localhost:8081/cuestionario-de-clima</p>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Acción</th>
                                        <th>Unidad</th>
                                        <th>Periodo</th>
                                        <th>Intrumentos</th>
                                        <th>Enlace</th>
                                        <th>Estado</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($listaDeIntervenciones as $item)
                                <tr>
                                    <td>

                                        @if($item->estado)
                                        <div class="text-center">
                                            <a href="{{ route('finalizarIntervencion', $item->id_intervencion) }}" class="btn btn-danger">Finalizar</a>
                                        </div>
                                        @endif

                                    </td>

                                    <td>
                                        {{$listaDeUnidades[$item->curso_id][0]}}
                                    </td>

                                    <td>{{ $item->periodo }}</td>
                                    <td>Cuestionario de Clima</td>
                                    <td><button class="btn btn-success" onclick="copyToClipboard('#p1')"><i class="fas fa-fw fa-copy"></i>Copiar enlace</button></td>

                                    <td>
                                        @if($item->estado == 0)
                                        {{ "Finalizado" }}
                                        @elseif($item->estado == 1)
                                        {{ "Activo" }}
                                        @endif
                                    </td>

                                    <td>
                                        <a class="btn btn-warning" href="#" role="button" style="width: 40px; height: 40px;"><i class="fas fa-fw fa-edit"></i></a>
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
</div>


@endsection
