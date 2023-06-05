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
    <title>EvenTech</title>
</head>
<body>
    <header>
        <h1>EvenTech</h1>
    </header>
    <main class="mainIndex">
        <div class="acesse">
            <form action="" method='GET'>
                <h3>Acesse sua conta</h3>
                <input type="text" name="emailLogin" id="emailLogin" placeholder="Email">
                <input type="password" name="senhaLogin" id="senhaLogin" placeholder="Senha">

                <!-- <a href="esqueciSenha.php">Esqueci minha senha</a> -->

                <input type="submit" value="Acessar">
            </form>
        </div>
        <div class="cadastre">
            <form action="" method="POST">
                <h3>Cadastre-se</h3>
                <div class="container">
                    <div class="box">
                        <input type="text" name="nomeCadastro" id="nomeCadastro" placeholder="Nome">
                        <input type="text" name="emailCadastro" id="emailCadastro" placeholder="Email">
                    </div>
                    <div class="box">
                        <input type="password" name="senhaCadastro" id="senhaCadastro" placeholder="Senha">
                        <input type="password" name="confirmaSenhaCadastro" id="confirmaSenhaCadastro" placeholder="Confirmar senha">
                    </div>
                </div>

                <input type="submit" value="Cadastrar">
            </form>
        </div>
    </main>

    <script src="js/script.js"></script>
    <?php
        session_start();
        //$conn = mysqli_connect("localhost", "nome_do_usuario", "senha", "nome_do_banco");   // Criar a conexão  - conn é de conexao / mysqli_connect() é padrão
        $conn = mysqli_connect("localhost", "root", "", "bancophp");   // Criar a conexão  - xampp
        $nomeTabela = 'usuarioseventotech';

        if($_SERVER["REQUEST_METHOD"] == "POST"){   
            $nome = $_POST['nomeCadastro'];
            $email = $_POST['emailCadastro'];
            $senha = $_POST['senhaCadastro'];
            $confirmaSenha = $_POST['confirmaSenhaCadastro'];
            if($nome != "" && $email != "" && $senha != ""){
                if($confirmaSenha == $senha){
                    $sql = "INSERT INTO $nomeTabela (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
                    
                    if(mysqli_query($conn, $sql)){
                        $result_tabela = "SELECT * FROM $nomeTabela";
                        $resultado_tabela = mysqli_query($conn, $result_tabela);
        
                        while($row_usuario = mysqli_fetch_assoc($resultado_tabela)){  
                            if($row_usuario['email'] == $email && $row_usuario['senha'] == $senha){
                                $_SESSION['idAcesso'] = $row_usuario['idusuario'];
                            }
                        }
                        header('Location: homeUser.php');
                    }else{
                        echo ('<script>Swal.fire("Erro ao inserir");</script>');
                    }
                }else{
                    echo ('<script>Swal.fire("Suas senhas não coincidem");</script>');
                }
            }else{
                echo ('<script>Swal.fire("Preencha todos os campos para se cadastrar");</script>');
            }
        }


        if($_SERVER["REQUEST_METHOD"] == "GET"){ 
            if(isset($_GET['emailLogin']) && isset($_GET['senhaLogin'])){
                
                $email = $_GET['emailLogin'];
                $senha = $_GET['senhaLogin'];
                
                if($email == 'gestor' && $senha = 123){
                    header('Location: homeGestor.php');
                }else{
                    $result_tabela = "SELECT * FROM $nomeTabela";
                    $resultado_tabela = mysqli_query($conn, $result_tabela);    
                    
                    while($row_usuario = mysqli_fetch_assoc($resultado_tabela)){
                        if($row_usuario['email'] == $email && $row_usuario['senha'] == $senha){
                            $_SESSION['idAcesso'] = $row_usuario['idusuario'];
                            header('Location: homeUser.php');
                        }else{
                            echo ('
                            <script>
                                Swal.fire("usuario ou senha invalidos")
                            </script>
                            ');
                        }
                    }
                }

            }
        }
    ?>
</body>
</html>
