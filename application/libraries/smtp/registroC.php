<?php

session_start();
require '../../modelo/conexion.php';
$c = conector_pg::getInstance();



if (isset($_GET['verificarUsuario'])) {

    $logging = $_GET['verificarUsuario'];
    $r = $c->realizarOperacion("SELECT count(*) as  logging FROM users WHERE logging = '$logging'");
    $r2 = pg_fetch_array($r);
    if ($r2[0] != 0) {
        echo"invalido";
    }
} else if (isset($_GET['verificarEmail'])) {
    $email = $_GET['verificarEmail'];
    $r = $c->realizarOperacion("SELECT count(*) as email FROM users WHERE email = '$email'");
    $r2 = pg_fetch_array($r);
    if ($r2[0] != 0) {
        echo "invalido";
    }
} else if (isset($_GET['registrarse'])) {

    // extract($_POST);
    extract($_GET);

    $to = $email;
    $asunto = "Registro ROAp";
    $mensaje = "Para confimar su contraseña por favor haga click en el siguiente link... <br/>";
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    $ruta = dirname($url);
    $ruta = str_replace("/lib/smtp", "", $ruta);
    $mensaje.= $ruta . "/control/validarCuenta.php?key=" . base64_encode($email);

    $texto = '<body style="margin: 10px;">
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
        <div align="center"><img src="./servidor/images/logo.png" style="height: 90px; width: 340px"></div><br>
        <br/>
        <h1>Bienvenido a ROAP.</h1><br/>
        USUARIO: ' . $logging . ' <br/>      
        PASSWORD: ' . $password . '<br/>
       ' . $mensaje . '
    </div>
</body>';



    $data['mode'] = 'registro';
    $data['usuario'] = $name . " " . $lastname;
    $data['asunto'] = $asunto;
    $data['texto'] = $texto;
    $data['email_user'] = $email;

    
    require('./class.smtp.php');
    require('./class.phpmailer.php');
    require('./servidor/servidor_smtp.php');
    
    
} else if (isset($_GET['reestablecer'])) {
    extract($_GET);
    //verificamos que exista el e-mail 
    $r = $c->realizarOperacion("SELECT count(*) email FROM users WHERE email = '$email'");
    $r2 = pg_fetch_array($r);
    if ($r2[0] == 0) {
        echo "false";
    } else {
        $to = $email;
        $asunto = utf8_decode("Cambio de contraseña ROAp");
        $mensaje = "Para cambiar su contraseña por favor haga click en el siguiente link... <br/>";
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        $ruta = dirname($url);
        $ruta = str_replace("/lib/smtp", "", $ruta);
        $mensaje.= $ruta . "/main.php?action=cambiarPass&key=" . base64_encode(base64_encode(base64_encode($email)));


        $texto = '<body style="margin: 10px;">
    <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
        <div align="center"><img src="./servidor/images/logo.png" style="height: 50px; width: 250px"></div><br>
        <br/>
       ' . $mensaje . '
    </div>
</body>';


        $data['mode'] = 'reestablecimiento';
        $data['asunto'] = $asunto;
        $data['texto'] = $texto;
        $data['email_user'] = $email;
        $data['usuario'] = $email;


        require('./class.smtp.php');
        require('./class.phpmailer.php');
        require('./servidor/servidor_smtp.php');
    }
}
$c->close();
?>


