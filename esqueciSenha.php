<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <title>Esqueci minha senha</title>
</head>
<body>
    <header>
        <h1>EvenTech</h1>
        <p>conecti-se</p>
    </header>
    <main class="mainEsquecis">
        <div class="emailRecupera"> <!--deixar visivel-->
            <form action="" method='GET'>
                <h3>Informe seu email</h3>
                <input type="email" name="emailRecupera" id="emailRecupera" placeholder="Email">

                <input type="submit" value="Acessar"> <!--trocar visibilidade-->
            </form>
        </div>

        <div class="defineNovaSenha"> <!--deixar invisivel-->
            <form action="" method="POST">
                <h3>Escolha uma nova senha</h3>
            
                <div>
                    <input type="text" name="nVerifica" id="nVerifica" placeholder="Código de verificaação">

                    <input type="password" name="senhaCadastro" id="senhaCadastro" placeholder="Senha">
                    <input type="password" name="confirmaSenhaCadastro" id="confirmaSenhaCadastro" placeholder="Confirma senha">
                </div>

                <input type="submit" value="Cadastrar"> <!--se correto envia, se errado troca visibilidade-->
            </form>
        </div>
        
    </main>

    <script src="js/script.js"></script>
    <?php
        require_once('src/PHPMailer.php');
        require_once('src/SMTP.php');
        require_once('src/Exception.php');
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        $mail = new PHPMailer(true);
        try{
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username='jessicamoreirars09@gmail.com';
            $mail->Password='mtihxyhofjybzdlg';
            $mail->Port=465;//587;
            $mail->SMTPSecure='ssl';

            $mail->setFrom('jessicamoreirars09@gmail.com');
            $mail->addAddress('jessicamoreirars09@gmail.com');//pode ter varias dessas linhas repitidas para enviar para varios addAddress

            $mail->isHTML(true);
            $mail->Subject = 'Teste de email via gmail';
            $mail->Body = "<b>Chegou um email</b>";
            $mail->AltBody = "Chegouuuu";

            if($mail->send()){
                echo 'Email enviado com sucesso';
            }else{
                echo 'Email não enviado';
            }

        }catch(Exception $e){
            echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        }

        /*$nAleatorioVerifica;
        if($_SERVER["REQUEST_METHOD"] == "GET"){ 
            if(isset($_GET['emailRecupera'])){
                //Variáveis

                $email = $_GET['emailRecupera'];
                $data_envio = date('d/m/Y');
                $hora_envio = date('H:i:s');
                $nAleatorioVerifica = rand(1,100);

                // Compo E-mail
                $arquivo = "
                <style type='text/css'>
                body {
                margin:0px;
                font-family:Verdane;
                font-size:12px;
                color: #666666;
                }
                a{
                color: #666666;
                text-decoration: none;
                }
                a:hover {
                color: #FF0000;
                text-decoration: none;
                }
                </style>
                    <html>
                        <table width='510' border='1' cellpadding='1' cellspacing='1' bgcolor='#CCCCCC'>
                            <tr>
                                <td width='500'>Nome:</td>
                            </tr>
                            <tr>
                                <td width='320'>E-mail:<b>$email</b></td>
                            </tr>
                            <tr>
                                <td width='320'>E-mail:<b>$nAleatorioVerifica</b></td>
                            </tr>
                            <tr>
                                <td width='320'>Esse email não deve ser compartilhado com outras pessoas</td>
                            </tr>
                            <tr>
                                <td width='320'><b>Esse email faz parte de um projeto de curso de desenvolvimento de sistemas, o conteudo dele é ficticio, se esse email chegou até você foi por engano :-) só ignore</b></td>
                            </tr>
                            <tr>
                                <td>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></td>
                            </tr>
                        </table>
                    </html>
                ";


                //enviar

                // emails para quem será enviado o formulário
                $emailenviar = $email;
                $destino = $emailenviar;
                $assunto = "Recuperação de senha";

                // É necessário indicar que o formato do e-mail é html
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: $nome <$email>';
                //$headers .= "Bcc: $EmailPadrao\r\n";

                $enviaremail = mail($destino, $assunto, $arquivo, $headers);
                if($enviaremail){
                    $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
                    echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
                    echo $mgm;
                } else {
                    $mgm = "ERRO AO ENVIAR E-MAIL!";
                    echo "";
                    echo $mgm;
                }

            }
        }*/
    ?>
</body>
</html>