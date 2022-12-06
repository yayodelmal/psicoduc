@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="{{ asset('js/estudioclima.js') }}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<?php

  function pintarEstados($resultado){
    
    switch($resultado){
      
      case 'Muy favorable':
        $color = "#1cc88a";
        return $color;
      break;

      case 'Favorable':
        $color = "#96ee8a"; //original
        return $color;
      break;

      case 'Regular':
        $color = "#fff000";
        return $color;
      break;

      case 'Desfavorable':
        $color = "#FFC300";
        return $color;
      break;

      case 'Muy desfavorable':
        $color = "#e74a3b";
        return $color;
      break;

    }
  }

?>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Estudio de clima organizacional') }}</div>
    
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

                        <h4>Resultados Globales</h4>
                                    
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col"></th>
                                <th scope="col" width="200">Media</th>
                                <th scope="col" width="200">Desviación estandar</th>
                                <th scope="col" width="140">Resultado</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">Estructura</th>
                                <td>{{ $EstudioClima->estructura_media }}</td>
                                <td>{{ $EstudioClima->estructura_desviacion }}</td>
                                <td bgcolor="{{ pintarEstados($EstudioClima->estructura_resultado) }}">{{ $EstudioClima->estructura_resultado }}</td>
                              </tr>
                              <tr>
                                <th scope="row">Responsabilidad</th>
                                <td>{{ $EstudioClima->responsabilidad_media }}</td>
                                <td>{{ $EstudioClima->responsabilidad_desviacion }}</td>
                                <td bgcolor="{{ pintarEstados($EstudioClima->responsabilidad_resultado) }}">{{ $EstudioClima->responsabilidad_resultado }}</td>
                              </tr>
                              <tr>
                                <th scope="row">Recompensa</th>
                                <td>{{ $EstudioClima->recompensa_media }}</td>
                                <td>{{ $EstudioClima->recompensa_desviacion }}</td>
                                <td bgcolor="{{ pintarEstados($EstudioClima->recompensa_resultado) }}">{{ $EstudioClima->recompensa_resultado }}</td>
                              </tr>
                              <tr>
                                <th scope="row">Desafio</th>
                                <td>{{ $EstudioClima->desafio_media }}</td>
                                <td>{{ $EstudioClima->desafio_desviacion }}</td>
                                <td bgcolor="{{ pintarEstados($EstudioClima->desafio_resultado) }}">{{ $EstudioClima->desafio_resultado }}</td>
                              </tr>
                              <tr>
                                <th scope="row">Relaciones</th>
                                <td>{{ $EstudioClima->relaciones_media }}</td>
                                <td>{{ $EstudioClima->relaciones_desviacion }}</td>
                                <td bgcolor="{{ pintarEstados($EstudioClima->relaciones_resultado) }}">{{ $EstudioClima->relaciones_resultado }}</td>
                              </tr>
                              <tr>
                                <th scope="row">Cooperación</th>
                                <td>{{ $EstudioClima->cooperacion_media }}</td>
                                <td>{{ $EstudioClima->cooperacion_desviacion }}</td>
                                <td bgcolor="{{ pintarEstados($EstudioClima->cooperacion_resultado) }}">{{ $EstudioClima->cooperacion_resultado }}</td>
                              </tr>
                              <tr>
                                <th scope="row">Estandares</th>
                                <td>{{ $EstudioClima->estandares_media }}</td>
                                <td>{{ $EstudioClima->estandares_desviacion }}</td>
                                <td bgcolor="{{ pintarEstados($EstudioClima->estandares_resultado) }}">{{ $EstudioClima->estandares_resultado }}</td>
                              </tr>
                              <tr>
                                <th scope="row">Conflicto</th>
                                <td>{{ $EstudioClima->conflicto_media }}</td>
                                <td>{{ $EstudioClima->conflicto_desviacion }}</td>
                                <td bgcolor="{{ pintarEstados($EstudioClima->conflicto_resultado) }}">{{ $EstudioClima->conflicto_resultado }}</td>
                              </tr>
                              <tr>
                                <th scope="row">Identidad</th>
                                <td>{{ $EstudioClima->identidad_media }}</td>
                                <td>{{ $EstudioClima->identidad_desviacion }}</td>
                                <td bgcolor="{{ pintarEstados($EstudioClima->identidad_resultado) }}">{{ $EstudioClima->identidad_resultado }}</td>
                              </tr>
                              <tr>
                                <th scope="row">Total</th>
                                <td>{{ $EstudioClima->totales_media }}</td>
                                <td>{{ $EstudioClima->totales_desviacion }}</td>
                                <td bgcolor="{{ pintarEstados($EstudioClima->totales_resultado) }}">{{ $EstudioClima->totales_resultado }}</td>
                              </tr>
                            </tbody>
                        </table>

                        <div class="card">
                            <ul>
                                <li>Puntaje <b>1.00 a 1.99, <i>muy favorable:</i></b> los sujetos perciben un grado muy favorable a la dimensión medida.</li>
                                <li>Puntaje <b>2.00 a 2.49, <i>favorable:</i></b> los entrevistados perciben que la dimensión medida se clasifica como favorable.</li>
                                <li>Puntaje <b>2.50 a 2.99, <i>regular:</i></b> los individuos perciben como regular la dimensión medida dentro de la organización.</li>
                                <li>Puntaje <b>3.00 a 3.49, <i>desfavorable:</i></b> los sujetos perciben que la institución se experimenta en grado desfavorable en la dimensión medida.</li>
                                <li>Puntaje <b>3.50 a 4.00, <i>muy desfavorable:</i></b> los sujetos tienen una percepción muy desfavorable de la institución en la dimensión evaluada.</li>
                            </ul>
                        </div>

                        <script type="text/javascript">
                            function drawChart() {

                                // Create the data table.
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'Topping');
                                data.addColumn('number', 'Medias');
                                data.addRows([
                                ['Estructura', {{$EstudioClima->estructura_media}}],
                                ['Responsabilidad', {{$EstudioClima->responsabilidad_media}}],
                                ['Recompensa', {{$EstudioClima->recompensa_media}}],
                                ['Desafio', {{$EstudioClima->desafio_media}}],
                                ['Relaciones', {{$EstudioClima->relaciones_media}}],
                                ['Cooperación', {{$EstudioClima->cooperacion_media}}],
                                ['Estandares', {{$EstudioClima->estandares_media}}],
                                ['Conflicto', {{$EstudioClima->conflicto_media}}],
                                ['Identidad', {{$EstudioClima->identidad_media}}]
                                ]);

                                // Set chart options
                                var options = {'title':'Gráfico nº1: Resultados Globales',
                                            'width':800,
                                            'height':600};

                                // Instantiate and draw our chart, passing in some options.
                                var chart = new google.visualization.ColumnChart(document.getElementById('chart_general'));
                                chart.draw(data, options);
                            }       
                        </script>

                        <div id="chart_general"></div>

                        <hr class="sidebar-divider">
                        
                        <br/>
                        <br/>

                        <h4>Resultados de Liderazgo</h4>

                        {{-- {{ dd($EstudioClima) }} --}}

                        <script type="text/javascript">

                            var array = [
                            @foreach ($EstudioClima->liderazgo_data as $item => $id)
                                [ {{ $id }} ], 
                            @endforeach
                            ];

                            array_aux = [];

                            for(let a=0; a<array.length; a++){
                                //console.log(array[a][0]);
                                array_aux.push(array[a][0]);
                            }
                          
                            var arr = [];
                            
                            for(let a=0; a<array_aux.length; a++){
                                arr.push([(a+1)], [array_aux[a]])
                            }

                            function drawChartLiderazgo() {
                                
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'Topping');
                                data.addColumn('number', 'Medias');

                                for(let a = 0 ; a<arr.length; a+=2){
                                    data.addRows([  
                                    
                                   [''+arr[a][0]+'' , arr[a+1][0]],
                                    
                                    ])
                                }
                                
                                var options = {title:'Gráfico nº2: Resultados Liderazgo',
                                            width:800,
                                            height:600};

                                var chart = new google.visualization.LineChart(document.getElementById('chart_liderazgo'));
                                chart.draw(data, options);
                            
                            }
                        
                        </script>

                        <div id="chart_liderazgo"></div>
                        
                        <div class="card">
                            <ul>
                                <li>Puntaje <b>1.00 a 1.99, <i>muy favorable:</i></b> los sujetos perciben un grado muy favorable a la dimensión medida.</li>
                                <li>Puntaje <b>2.00 a 2.49, <i>favorable:</i></b> los entrevistados perciben que la dimensión medida se clasifica como favorable.</li>
                                <li>Puntaje <b>2.50 a 2.99, <i>regular:</i></b> los individuos perciben como regular la dimensión medida dentro de la organización.</li>
                                <li>Puntaje <b>3.00 a 3.49, <i>desfavorable:</i></b> los sujetos perciben que la institución se experimenta en grado desfavorable en la dimensión medida.</li>
                                <li>Puntaje <b>3.50 a 4.00, <i>muy desfavorable:</i></b> los sujetos tienen una percepción muy desfavorable de la institución en la dimensión evaluada.</li>
                            </ul>
                        </div>
                    

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection