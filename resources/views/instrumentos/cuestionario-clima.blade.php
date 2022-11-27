<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <title>Cuestionario de Clima</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

    
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('js/cuestionarioclima.js') }}"></script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            
                            <div class="col-lg-12">
                                
                                <div class="p-5">

                                    <div class="mb-1 small">
                                    Bienvenido, {{ $userData["nombre_user"]." ".$userData["apellidos_user"] }}
                                    </div>

                                    <input type="hidden" id="email_user" value="{{ $userData["email_user"] }}">
                                    <input type="hidden" id="curso_user" value="{{ $userData["curso_user"] }}">


                                    <br/>
                                    <br/>

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Cuestionario de Clima Organizacional</h1>
                                    </div>

                                    <br/>

                                    <div class="text-sm-start">
                                        <p>Este cuestionario tiene por objetivo identificar a través de la percepción de los funcionarios/as, características que subyacen al clima organizacional de este servicio. Para responder elija una sola una opción. Debe responder todas las preguntas. Recuerde que no existen respuestas buenas o malas, ya que interesa conocer su opinión sobre contenidos y características de su trabajo.</p>
                                    </div>

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

                                    {{-- <form class="user" method="POST" action="{{ route('guardarCuestionarioClima') }}" accept-charset="UTF-8" enctype="multipart/form-data"> --}}
                                    {{-- @csrf --}}
        
                                        
                                            <table class="table table-responsive">
                                                <tr>
                                                    <th rowspan="3">Género</th>
                                                    <th>Hombre</th>
                                                    <td>
                                                        <input class="form-check-input" type="radio" id="genero" name="genero" value="hombre" style="margin-left: 1%;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Mujer</th>
                                                    <td>
                                                        <input class="form-check-input" type="radio" id="genero" name="genero" value="mujer" style="margin-left: 1%;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Prefiero no contestar</th>
                                                    <td>
                                                        <input class="form-check-input" type="radio" id="genero" name="genero" value="nc" style="margin-left: 1%;">
                                                    </td>
                                                </tr>    
                                            </table>
                                        
                            
                                            <table class="table table-responsive">
                                                <tr>
                                                    <th>Edad</th>
                                                    <td>
                                                        <input style="width : 50px;" type="text" id="edad" name="edad" onkeypress="return valideKey(event);" />
                                                    </td>
                                                </tr>
                                            </table>
                                        
                                           
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



                                        <br/>
                                        <p><b>A continuación, encontrará 4 preguntas, las cuales tienen por objetivo conocer su percepción con respecto a lo consultado</b></p>
                                        <br/>

                                        <div id="desarrollo-tbody"></div>
                                             <div class="text-center">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success" onclick="guardarRespuestasClima()" id="btnEnviar">Finalizar cuestionario</button>
                                                </div>
                                        </div>
                                       
                                    {{-- </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/js/jquery/jquery.min.js"></script>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/js/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

</body>

</html>