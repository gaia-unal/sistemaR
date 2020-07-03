

<?php

//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$user_roap = $c->get_info_smtp();

//var_dump($user_roap);
//var_dump($data);

$intentos = 0;
$sended = false;
while ($intentos <= 3) {

    $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

    $mail->IsSMTP(); // telling the class to use SMTP


    try {
        //  $mail->Encoding = "quoted­printable";
        $mail->CharSet = "UTF-8";
        $mail->Host = "mail.yourdomain.com"; // SMTP server
        $mail->SMTPDebug = 1;                     // enables SMTP debug information (for testing) <-- set '2' to do debug
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host = $user_roap['smtp'];      // sets GMAIL as the SMTP server
        $mail->Port = $user_roap['puerto'];                   // set the SMTP port for the GMAIL server
        $mail->Username = $user_roap['email'];  // GMAIL username
        $mail->Password = $user_roap['password'];            // GMAIL password
        $mail->AddAddress($data['email_user'], $data['usuario']);  // para quien va el mensaje y como se llama el usuario
        $mail->SetFrom($user_roap['email'], $user_roap['remitente']);  // El nombre del remitente
        $mail->Subject = $data['asunto'];
        // $mail->AltBody = 'Registro en ROAp'; // optional - MsgHTML will create an alternate automatically   
        $mail->MsgHTML($data['texto']);
       // $mail->AddAttachment('./servidor/images/logo.png'); 
        $mail->Send();
        echo "Message Sent OK</p>\n";
        if ($data['mode'] == 'registro') {
            $password = sha1($password);
            $logging = $logging;
            $query = "insert into users(name,lastname,password,logging,email,role) values('$name','$lastname','$password','$logging','$email',1)";
            $c->realizarOperacion($query);
        }
        $sended = true;
        break;
    } catch (phpmailerException $e) {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e) {
        echo $e->errorMessage();
    }
    $intentos++;
}
if (!$sended) {
    echo "No se pudo enviar el correo de confirmación";
}
?>

