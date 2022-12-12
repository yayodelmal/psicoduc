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

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">¡El Cuestionario de Clima Organizacional ha sido respondido con éxto!</h1>
                                    </div>

                                    <div class="text-center">
                                        <p>Gracias por tú participación.</p>
                                    </div>

                                    <div class="bg-finish-image" style=" width: 100%; height: 200px;">
                                        <img src="../img/gracias.webp" alt="">
                                    </div>

                                    <br/>

                                    <div class="text-center">
                                        <button class="btn btn-success"><i class="fas fa-fw fa-link"></i><a href="{{ "http://localhost:8082/course/view.php?id=".$unidad }}" style="color: aliceblue">Volver a Moodle</a></button>
                                    </div>


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
