<?php

//Vamos a copiar los ficheros iniciales si es la primera vez que se conecta un usuario
//Esto es para eliminar los ficheros que subáis después de que terminéis la sesión
 function restablecer_carpetas()
    {
        //echo "Estoy reestablaciendo carpetas <br />";
        //var_dump($_SESSION);
        `rm -r descargas`;
        `cp  -r descargas_original descargas`;
    }

session_start();

if (!isset($_SESSION['conectado'])) {
    restablecer_carpetas();
    $_SESSION['conectado'] = true;
}

$msj = isset( $_GET[ 'msj' ] ) ? $_GET[ 'msj' ] : null;
//Inicilizo variables
$name = $_POST[ 'name' ] ?? "admin";
$pass = $_POST[ 'pass' ] ?? "admin";

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="./css/estilo.css" rel="stylesheet" type="text/css">

    </head>
    <body>

        <fieldset class="caja_centrada">
            <div class="error"><?php echo $msj ?></div>
            <legend style="font-size:20px;font-style: oblique;background:aliceblue ">Subida de ficheros</legend>
            <form action="descarga.php" method="POST" enctype="multipart/form-data">
                <br/>
                Usuario&nbsp&nbsp&nbsp <input type="text" name="name" value="<?php echo $name ?>"  >
                <br>
                Password <input type="text" name="pass" value="<?php echo $pass ?>"  >
                <br/>
                <br/>
                <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                <!--    <input type="hidden" name="MAX_FILE_SIZE" value=1024 />-->
                <div style="float:right">
                    <input type="file" name="fichero"><br>
                </div>
                <br>
                <br>
                <input type="submit" value="Subir fichero y acceder" name="enviar">
                <input type="submit" value="Subir fichero" name="enviar">
                <input type="submit" value="Acceder" name="enviar">

            </form>
        </fieldset>

    </body>
</html>
