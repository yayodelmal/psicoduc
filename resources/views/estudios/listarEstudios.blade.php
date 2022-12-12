@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Lista de Estudios por intervención') }}</div>
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

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Unidad</th>
                                        <th>Periodo</th>
                                        <th>Intrumentos</th>
                                        <th>Estado</th>
                                        <th>Estudio</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($listaDeIntervenciones as $item)
                                <tr>


                                    <td>
                                        {{$listaDeUnidades[$item->curso_id][0]}}
                                    </td>

                                    <td>{{ $item->periodo }}</td>
                                    <td>Cuestionario de Clima</td>

                                    <td>
                                        @if($item->estado == 0)
                                        {{ "Finalizado" }}
                                        @elseif($item->estado == 1)
                                        {{ "Activo" }}
                                        @endif
                                    </td>

                                    <td>
                                        <a class="btn btn-success" href="{{ route('vistaEstudio', $item->id_intervencion) }}" role="button"><i class="fas fa-fw fa-eye"></i> Ver</a>
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
