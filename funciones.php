<?php
/**
 * Dada una ruta a un directorio devuelve codigo html con los nombres de los archivos que contiene con un enlace al archivo.
 * Opcinalmente crea un check al lado del archivo
 * @param string $carpeta ruta a la carpeta que queremos listar
 * @param bool $con_check si true añadirá html para crear el check
 * @return string codigo html para presentar en la página
 */
function archivos_en_carpeta(string $carpeta,bool $con_check= false):string{
    //obtenemos el vector con los nombres de los archivos contenidos
    $lista_carpeta=scandir($carpeta);
    //auxiliar para la salida
    $lista="";
    //recorremos el vector
    foreach ($lista_carpeta as $archivo){
        //omitimos los padres
        if ($archivo != "." and $archivo != "..") {
            //creamos una linea html si  con el check si es true
             if ($con_check){
                $lista.="     <input type=checkbox name='ficheros_publicar[]'  value=$carpeta/$archivo />\n";
            }
            //añadimos el nombre del archivo con enlace a si mismo
            $lista .= "     <a href=$carpeta/$archivo>$archivo</a><br />\n";
        }
    }
    //return el codigo html
    return $lista;

}


function crear_fieldset(string $legend, string $html,string $class,string $classlegend):string{
    return "<fieldset class=$class><legend class=$classlegend>$legend</legend>\n$html</fieldset>\n";
}

function crear_formulario_submit(string $value,string $html):string{
    return "<div><form action=\"descarga.php\" method=\"POST\">
            \n$html
            \n      <input type=\"submit\" name=\"submit\" value=$value />
            \n      <input type=\"hidden\" value=\"admin\" name=\"name\">
            \n      <input type=\"hidden\" value=\"admin\" name=\"pass\">
            \n</form></div>";
}

function show_files(bool $admin):string{
    $fs_imagen=crear_fieldset("Imágenes",archivos_en_carpeta("descargas/visibles/imagenes"),"fieldset2","legend2");
    $fs_pdf=crear_fieldset("PDF's",archivos_en_carpeta("descargas/visibles/pdf"),"fieldset2","legend2");
    $fs_musica=crear_fieldset("Música",archivos_en_carpeta("descargas/visibles/musica"),"fieldset2","legend2");
    $fs_otros=crear_fieldset("Otros",archivos_en_carpeta("descargas/visibles/otros"),"fieldset2","legend2");

    $fs_nivel2=$fs_imagen.$fs_pdf.$fs_musica.$fs_otros;

    $fs_visibles=crear_fieldset("Visibles",$fs_nivel2,"fieldset1","legend2");

    if ($admin){


        $fs_imagen=crear_fieldset("Imágenes",archivos_en_carpeta("descargas/subidas/imagenes",$admin),"fieldset2","legend2");
        $fs_pdf=crear_fieldset("PDF's",archivos_en_carpeta("descargas/subidas/pdf",$admin),"fieldset2","legend2");
        $fs_musica=crear_fieldset("Música",archivos_en_carpeta("descargas/subidas/musica",$admin),"fieldset2","legend2");
        $fs_otros=crear_fieldset("Otros",archivos_en_carpeta("descargas/subidas/otros",$admin),"fieldset2","legend2");

        $fs_nivel2=$fs_imagen.$fs_pdf.$fs_musica.$fs_otros;

        $fs_subidas=crear_fieldset("Subidas",$fs_nivel2,"fieldset1","legend2");

        return $fs_visibles.crear_formulario_submit("publicar",$fs_subidas);

    }

    return $fs_visibles;
}


//function buscartipo()

function upload_file(array $file){
    $tipo=buscartipo($file['type']);
    switch ($tipo){
        case "/*audio/*";
            return "audio";
            break;
        default:
            return "fuhb";

    }
    //move_uploaded_file($file['tmp_name'],"descargas/visibles/otros/".$file['name']);
    //chmod("descargas/visibles/otros/".$file['name'],0775);
}
