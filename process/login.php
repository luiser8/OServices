<?php
    session_start();
    include '../library/configServer.php';
    include '../library/consulSQL.php';

    $nombre=consultasSQL::clean_string($_POST['nombre-login']);
    $clave=consultasSQL::clean_string(md5($_POST['clave-login']));
   

    if($nombre!="" && $clave!=""){
            $verAdmin=ejecutarSQL::consultar("SELECT * FROM usuarios WHERE Nombre='$nombre' AND Clave='$clave'");
            $AdminC=mysqli_num_rows(ejecutarSQL::consultar("SELECT * FROM usuarios WHERE Nombre='$nombre' AND Clave='$clave'"));
            if($AdminC>0){
                $filaU=mysqli_fetch_array($verAdmin, MYSQLI_ASSOC);
                $_SESSION['nombre']=$nombre;
                $_SESSION['clave']=$clave;
                $_SESSION['Nivel']=$filaU['CodNivel'];
                $_SESSION['id']=$filaU['id'];
                $_SESSION['UserNIT']=$filaU['rif']; 
      
                echo '<script> location.href="index.php"; </script>';
                
            }else{
              echo 'Error nombre o contraseña invalido';
            }
    
    }else{
        echo 'Error campo vacío<br>Intente nuevamente';
    }
