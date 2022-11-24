<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $data[ 'subject']; ?> </title>
</head>
<body>
    <b>Estimad@:</b> <?php echo $data['nombrecompleto']; ?> <br/>
    <p>
        Se le informa que usted ha sido matriculado en la Unidad de: <?php echo $data['nombrecurso']; ?>.
        <br/>Sus datos de acceso son los siguientes:<br/>
        <b>Nombre de usuario: </b> <?php echo $data['nombreusuario']; ?> <br/>
        <b>Contraseña temporal: </b> <?php echo $data['contrasenia']; ?> <br/>
    </p>
    <br/>
</body>
</html>