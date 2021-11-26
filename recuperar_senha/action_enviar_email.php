<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>

<body>

</body>

</html>
<?php
session_start();



//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-6.5.1/src/Exception.php';
require '../PHPMailer-6.5.1/src/PHPMailer.php';
require '../PHPMailer-6.5.1/src/SMTP.php';
include '../ferramentas/conexao.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$email = $_POST['email'];
$user = $_POST['user'];

$sql = $pdo->prepare("SELECT id,email FROM usuarios WHERE email = :email AND usuario = :user");
$sql->bindValue(':email', $email);
$sql->bindValue(':user', $usuario);
$sql->execute();
$resultado = $sql->fetch(PDO::FETCH_ASSOC);


if ($resultado == null) {

    echo "<script>Swal.fire({
            icon: 'error',
            title: 'E-mail inválido',
          })</script>";
} else {

    try {
        //Server settings

        $sql = $pdo->prepare("SELECT * FROM email");
        $result_email = $sql->execute();
        $provedor = $result_email['provedor'];
        $usuario = $result_email['usuario'];
        $porta = $result_email['porta'];
        $senha = $result_email['senha'];
        

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = $provedor;
        $mail->SMTPAuth = true;
        $mail->Port = $porta;
        $mail->Username = $usuario;
        $mail->Password = $senha;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients


        //Lugar para colocar as informações de quem está usando


        $mail->setFrom($email, 'user');
        $mail->addAddress($email, $user);     //Add a recipient
        $mail->addReplyTo('no-reply@gmail.com', 'no-reply');

        $url = 'localhost:8080';

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Redefinir a sua senha';
        $mail->Body    = "
                    Para trocar a sua senha clique <a href=http://localhost:8080/recuperar_senha/alterar_senha.php?user=$user>neste link</a> caso não queira trocar apenas ignore este email";
        $mail->AltBody = '';

        $mail->send();
        echo "<script>
    Swal.fire({
        position: 'top',
        icon: 'success',
        title: 'Mensagem enviada com sucesso!',
        showConfirmButton: false,
      })</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
$_SESSION['email'] = $resultado['id'];
