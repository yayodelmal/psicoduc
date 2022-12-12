@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Lista de Funcionarios') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @elseif(session('statuserror'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('statuserror') }}
                        </div>
                    @endif


                    <div class="row">
                        <a href="{{ route('crearFuncionario')}}" class="btn btn-success">+ Crear funcionario</a>
                    </div>

                    <br/>

                    <table class="table">
                        <thead>
                          <tr>
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">Ingresar</th>
                            <th scope="col">Nombre completo</th>
                            <th scope="col">email</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>

                          </tr>
                        </thead>
                        <tbody>

                    @foreach($listaDeMatricula as $item)
                        <tr>
                            <td>
                                @if(!$item->registrado)
                                    <a href="{{ route('registrarFuncionario', $item->id)}}" class="btn btn-success">Ingresar</a>
                                @endif

                                @if($item->matricula)
                                <i class="fa-solid fa-trash-can"></i>
                                @endif

                            </td>

                            <td>{{ $item->nombre }} {{ $item->apellidos }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->nombre_largo_curso }}</td>

                            <td>
                                <span class="badge text-bg-{{ $item->matricula ? 'success' : 'warning'}}">{{ $item->matricula ? 'Ingresado' : 'Sin ingresar'}}</span>
                                <span class="badge text-bg-{{ $item->registrado ? 'success' : 'warning'}}">{{ $item->registrado ? 'Unidad ingresada' : 'Unidad sin ingresar'}}</span>
                            </td>

                            <td>
                                <a class="btn btn-warning" href="#" role="button" style="width: 40px; height: 40px;"><i class="fas fa-fw fa-edit"></i></a>
                                <a class="btn btn-danger" href="#" role="button" style="width: 40px; height: 40px;"><i class="fas fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach

                        </tbody>
                    </table>
                    {{ $listaDeMatricula->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
