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
    <title>Lista de presença</title>
</head>
<body>
    <header>
        <h1>Presenças confirmadas</h1>
        <p name="nomeUser" id="nomeUser"></p>

        <nav>
            <a href="index.php">Inicio</a>
            <a href="homeGestor.php">Todos os Eventos</a>
            <a href="criarEvento.php">Adicionar novos Eventos</a>
            <a href="presencaGestor.php">Confirmação de Presenca</a>
        </nav>
    </header>
    <main class="mainGestor mainPresGest">
        <div class="principal">
            <div class="containerForm">

                <form method="POST">
                    <select name="eventoEscolhido" class="eventoEscolhido" onchange="window.location.href='presencaGestor.php?idDetalhes='+value ">
                        <?php
                        
                        $conexao = mysqli_connect("localhost", "root", "", "bancophp");   // Criar a conexão  - xampp
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
                        <input type="submit" value="Buscar">
                    </select>
                </form>   
                
                <div id="descricaoDoEvento"></div>
            </div>

            <div class="areaPresTabelaPresenca">
                <table>
                    <tr class="th">
                        <td>ID do usuario</td>
                        <td>Nome</td>
                        <td>Email</td>
                    </tr>
                    
                    <tbody>
                    <?php
                        $conn = mysqli_connect("localhost", "root", "", "bancophp");   // Criar a conexão  - xampp
                        
                        if($_SERVER["REQUEST_METHOD"] == "POST"){   
                            $eventoEscolhido = $_POST['eventoEscolhido'];

                            //verifica se o usuario escolheu alguma opcao
                            if($eventoEscolhido == "none"){
                                echo ('<script>Swal.fire("Ops, esclha um evento primeiro");</script>');
                            }else{
                                $sqlUsuariosDoEvento = 'SELECT * FROM confirmacaopresencatech RIGHT JOIN usuarioseventotech ON usuarioseventotech.idusuario = confirmacaopresencatech.idusuario WHERE confirmacaopresencatech.idevento='.$eventoEscolhido.';';
                                $UsuariosDoEvento = mysqli_query($conn, $sqlUsuariosDoEvento);

                                while($linha = mysqli_fetch_assoc($UsuariosDoEvento)){
                                ?>
                                    <tr>
                                        <td><?php echo $linha['idusuario']?></td>
                                        <td><?php echo $linha['nome']?></td>
                                        <td><?php echo $linha['email']?></td>
                                    </tr>
                                <?php
                                }
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="js/script.js"></script>
    <?php
        
        /*$result_tabela = "SELECT * FROM $nomeTabela";
        $resultado_tabela = mysqli_query($conn, $result_tabela);*/
    ?>
</body>
</html>




                
      
