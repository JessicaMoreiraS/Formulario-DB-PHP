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
    <title>Home - Eventos</title>
</head>
<body>
    <header class="headerHomeUser">
        <div id="tituloTexto" class="tituloTexto">
            <h1>Eventos</h1>
        </div>

        <nav>
        <h4 name="nomeUser" id="nomeUser">
                <?php
                session_start();
                $idAcesso = $_SESSION['idAcesso'];
                //$conexao = mysqli_connect("localhost", "id20741728_jessica", "Admin@23", "id20741728_banco");   // Criar a conexão  - conn é de conexao / mysqli_connect() é padrão
                $conexao = mysqli_connect("localhost", "root", "", "bancophp");   // Criar a conexão  - xampp
                $sqlNome  = 'SELECT * FROM usuarioseventotech WHERE idusuario = '.$idAcesso.'; ';

                $mostrarNome = mysqli_query($conexao, $sqlNome);
                while($linhaNome = mysqli_fetch_assoc($mostrarNome)){
                    echo $linhaNome['nome'];
                }
                ?>
            </h4>
            <a href="index.php">Inicio</a>
            <a class="aCentro" href="homeUser.php">Todos os Eventos</a>
            <a href="meusEventosUser.php">Meus eventos</a>
        </nav>
    </header>
    <main class="mainHomeUser mainUser">
        
        <div class="principal">
            <div class="containerPrincipal">
                <p>Fique por dentro dos principais eventos do mundo de tecnoligia, não perca a sua oportunidade e marque sua presença</p>
                
                <form method="POST">
                    <select name="eventoEscolhido" class="eventoEscolhido" onchange="window.location.href='homeUser.php?idDetalhes='+value ">
                        <?php
                        if(isset($_GET['idDetalhes']) > 0){
                            $idDetalhes = $_GET['idDetalhes'];
                            $comandoEventoMostrar  = 'SELECT * FROM eventostech WHERE idevento = '.$idDetalhes.'; ';
                            $mostrar = mysqli_query($conexao, $comandoEventoMostrar);
                            while($linhaMostrar = mysqli_fetch_assoc($mostrar)){
                                echo '<option value='.$linhaMostrar['idevento'].'>-->'.$linhaMostrar['nome_evento'].'<--</option>';
                            }
                        }else{
                            echo "<option value=0>Escolha um evento</option>";
                        }                        
                        $read = "SELECT * FROM eventostech";
                        $resultado = mysqli_query($conexao, $read);
                    
                        while($linha = mysqli_fetch_assoc($resultado)){
                        ?>
                            <option value="<?php echo $linha['idevento'];?>">
                                <?php echo $linha['nome_evento'];?>
                            </option>
                        <?php
                        };
                        ?>

                    </select>
                    <input class="btnConfPres" type="submit" value="Confirmar Presença">
                </form>   
                
                <div id="descricaoDoEvento">
                <?php
                    if(isset($_GET['idDetalhes']) > 0){
                        $idDetalhes = $_GET['idDetalhes'];
                        $conexao = mysqli_connect("localhost", "root", "", "bancophp");   // Criar a conexão  - xampp
                        $comandoEventoMostrar  = 'SELECT * FROM eventostech WHERE idevento = '.$idDetalhes.'; ';
                        $mostrar = mysqli_query($conexao, $comandoEventoMostrar);
                        while($linhaMostrar = mysqli_fetch_assoc($mostrar)){
                            echo '<div class="imgEvento"><img src="gera.php?idDetalhes='.$idDetalhes.'"></div> <div class="descricao">'.$linhaMostrar['descricao_evento'].'</div>';
                        }
                    }
                    if(isset($_GET['idDetalhes']) == 0){
                        echo "";
                    }
                ?>
                </div>
            </div>
            
        </div>
    </main>

    <script src="js/script.js"></script>
    <?php
        //$conn = mysqli_connect("localhost", "id20741728_jessica", "Admin@23", "id20741728_banco");   // Criar a conexão  - conn é de conexao / mysqli_connect() é padrão
        $conn = mysqli_connect("localhost", "root", "", "bancophp");   // Criar a conexão  - xampp
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){   
            $eventoEscolhido = $_POST['eventoEscolhido'];

            //verifica se o usuario escolheu alguma opcao
            if($eventoEscolhido == "none"){
                echo ('<script>Swal.fire("Ops, esclha um evento primeiro");</script>');
            }else{

                $sqlConfirmaInexistencia = 'SELECT * FROM confirmacaopresencatech WHERE idusuario='.$idAcesso.' AND idevento='.$eventoEscolhido.';';
                $confirmaInexistencia = mysqli_query($conn, $sqlConfirmaInexistencia);
                
                // verifica se já não esta cadastrado no evento
                if($linhaConfirmacao = mysqli_fetch_assoc($confirmaInexistencia)){
                    echo ('<script>Swal.fire("Ops, você já confirmou sua presença para esse evento");</script>');

                }else{

                    $sql = "INSERT INTO confirmacaopresencatech (idevento, idusuario) VALUES ($eventoEscolhido, $idAcesso)";
    
                    if(mysqli_query($conn, $sql)){
                        echo ('<script>Swal.fire("Presença marcada com sucesso");</script>');
                    }else{
                        echo ('<script>Swal.fire("Erro ao marcar presença");</script>');
                    }
                }
            }
        }

        /*$result_tabela = "SELECT * FROM $nomeTabela";
        $resultado_tabela = mysqli_query($conn, $result_tabela);*/
    ?>
</body>
</html>




                
      