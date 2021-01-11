<?php
ini_set("display_errors", true);
error_reporting(E_ALL);


require_once "funciones.php";
//Inicilizo variables
$name = $_POST['name'];
$pass = $_POST['pass'];
$admin = false;

//Verifico condiciones
if ($name=="") {
    header("Location:index.php?msj='Debe registrarse y especificar nombre'");
    exit();
}

if ($pass=="") {
    header("index.php?msj='Debe registrarse y especificar password'");
    exit();
}

if (($pass === 'admin') and ($name === 'admin'))
    $admin = true;

//Evalúo la acción que trajo a este script
$opcion = $_POST['submit'] == null;

switch ($opcion) {
    case 'Subir fichero y acceder':
        $file = $_FILES['fichero'];
        upload_file($file);
        $ficheros = show_files($admin);
        break;
    case 'Subir fichero':
        //Add aquí las acciones que consideres

        break;
    case 'Acceder':
        //Add aquí las acciones que consideres

        break;
    case 'publicar':
        $ficheros_subir = $_POST['ficheros_publicar'];
        //var_dump($ficheros_subir);
        publicar_ficheros($ficheros_subir);
        $ficheros = show_files($admin);
        break;
    default:
        header("Location:index.php?msj='Debe registrarse para subir ficheros'");
}


//Falta anotar en log.txt
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/estilo.css" type="text/css">
    <script src='https://unpkg.com/vue'></script>
    <script src='https://github.com/vuejs/vue-devtools'></script>
    <title>Descarga de ficheros</title>

</head>
<body>
<h1>WEB DE DESCARGAS DE FICHEROS</h1>
<div id="app">
    <form action="index.php" method="POST">
        <input style="float:right; margin-right:30%" type="submit" value="Volver" name="submit">
        <input type="hidden" value="<?php echo $name ?>" name="name">
        <input type="hidden" value="<?php echo $pass ?>" name="pass">

    </form>
    <?php echo $ficheros ?>

</div>
</body>

</html>
