@extends('layouts.app')

@section('css')
@endsection

@section('content')

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="{{ asset('js/cuestionarioclima.js') }}"></script>

        <div class="card _card-rounded">

            {{-- Encabezado del cuestionario --}}
            <h2 class="text-center" style="margin-top: 30px;">Cuestionario de Clima Organizacional</h1>
            
            <div class="text-sm-start">
            <p>Este cuestionario tiene por objetivo identificar a través de la percepción de los funcionarios/as, características que subyacen al clima organizacional de este servicio. Para responder elija una sola una opción. Debe responder todas las preguntas. Recuerde que no existen respuestas buenas o malas, ya que interesa conocer su opinión sobre contenidos y características de su trabajo.</p>
            </div>

       
            {{-- preguntar genero y edad --}}
        <form method="POST" action="{{ route('guardarCuestionarioClima') }}" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
            <div class="col-sm-3">
        
        
            <table class="table table-bordered">
                <tr>
                    <th rowspan="3">Género</th>
                    <th>Hombre</th>
                    <td><input class="form-check-input" type="radio" id="genero" name="genero" value="hombre"></td>
                </tr>
                <tr>
                    <th>Mujer</th>
                    <td><input class="form-check-input" type="radio" id="genero" name="genero" value="mujer"></td>
                </tr>
                <tr>
                    <th>Prefiero no contestar</th>
                    <td><input class="form-check-input" type="radio" id="genero" name="genero" value="nc"></td>
                </tr>    
            </table>
            </div>

            <div class="col-sm-1">
                <table class="table table-bordered">
                    <tr>
                        <th>Edad</th>
                        <td><input class="col-sm-12" id="edad" name="edad" type="number" min="1" max="100"></td>
                    </tr>
                </table>
            </div>
               
            <table class="table table-striped" id="tableclima">
                <thead>
                    <tr class="text-center small">
                        <th colspan="2"></th>
                        <th>Totalmente de acuerdo</th>
                        <th>Relativamente de acuerdo</th>
                        <th>Relativamente en desacuerdo</th>
                        <th>Totalmente en desacuerdo</th>
                    </tr>
                </thead>
                <tbody id="clima-tbody" class="text-secondary">
                </tbody>
            </table>

            <div id="desarrollo-tbody"></div>
                 <div class="text-center">

                    <div class="text-center">
                        <button type="submit" class="btn btn-success" id="btnEnviar">Finalizar cuestionario</button>
                    </div>
                    
                </div>
        </form>
        </div>
    



@endsection

