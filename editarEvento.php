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
    <title>Editar Evento</title>
</head>
<body>
    <header>
        <h1>Editar Eventos</h1>

        <nav>
            <a href="index.php">Inicio</a>
            <a href="homeGestor.php">Todos os Eventos</a>
            <a href="criarEvento.php">Adicionar novos Eventos</a>
            <a href="presencaGestor.php">Confirmação de Presenca</a>
        </nav>
    </header>
    <main  class="mainEditEvento mainGestor">
        <div class="principal">
            <?php
            if(isset($_GET['id']) > 0){
                    $idEventoEdit = $_GET['id'];
                    //$conexao = mysqli_connect("localhost", "id20741728_jessica", "Admin@23", "id20741728_banco");
                    $conexao = mysqli_connect("localhost", "root", "", "bancophp");   // Criar a conexão  - xampp
                    $comandoEventoMostrar  = 'SELECT * FROM eventostech WHERE idevento = '.$idEventoEdit.'; ';
                    $mostrar = mysqli_query($conexao, $comandoEventoMostrar);
                    while($linhaMostrar = mysqli_fetch_assoc($mostrar)){
                        $aImagem = $linhaMostrar['imagem_evento'];
                        $idEvento = $linhaMostrar['idevento'];

                        ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="boxContainerForm">
                                <div class="containerForm">
                                    <input type="text" name="nomeEvento" value="<?php echo $linhaMostrar['nome_evento']; ?>">
                                    <input type="date" name="dataEvento" value="<?php echo $linhaMostrar['data_evento']; ?>">
                                    <input type="text" name="localEvento" value="<?php echo $linhaMostrar['local_evento']; ?>">
                                    <input type="time" name="horaEvento" value="<?php echo $linhaMostrar['horario_evento']; ?>">
                                    <input type="number" name="precoEvento" value="<?php echo $linhaMostrar['preco_evento']; ?>">
                                </div>
                                <div class="containerForm">
                                    <textarea name="descricaoEvento"><?php echo $linhaMostrar['descricao_evento']; ?></textarea>
                                    <img  src="gera.php?idDetalhes='<?php echo $linhaMostrar['idevento']; ?>'">

                                    <label for="imagemEvento" class="imagemEvento">
                                        <div class="buttonFake">
                                            <img class="img" src="imagens/camera.png">
                                            Escolha uma imagem
                                        </div>
                                    </label>
                                    <input type="file" class="none" name="imagemEvento" id="imagemEvento" onchange="carregaNomeImg()">
                                    <p id="descricaoImg"></p>
                                </div>
                            </div>
                            
                            <!-- <input class="btnAtualizaEvento" type="submit" value="Atualizar Evento"> -->
                        <!-- </form> -->
                        
                        <!-- <form method="POST" enctype="multipart/form-data"> -->
                            <!-- <input type="number" name="idevento" value="" readonly> -->

                            <input class="btnFormG" type="submit" value="Atualizar Evento">
                        </form>
                        <?php
                    }
                }
                if(isset($_GET['idDetalhes']) == 0){
                    echo "";
                }
            ?>
        </div>
    </main>

    <footer>
    </footer>

    <script>
        function carregaNomeImg(){
            if(document.getElementById("imagemEvento").value != "" && document.getElementById("imagemEvento").value != null && document.getElementById("imagemEvento").value != undefined){
                document.getElementById("descricaoImg").innerHTML= document.getElementById("imagemEvento").value;
            }
        }
    </script>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){ 
            $nome =  $_POST['nomeEvento'];
            $data =  $_POST['dataEvento'];
            $local =  $_POST['localEvento'];
            $hora =  $_POST['horaEvento'];
            $preco =  $_POST['precoEvento'];
            $descricao =  $_POST['descricaoEvento'];
            $imagem = $_FILES["imagemEvento"];
        
            $nomeFinal = time().'.jpg';
            
            //$conn = mysqli_connect("localhost", "id20741728_jessica", "Admin@23", "id20741728_banco");
            $conn= mysqli_connect("localhost", "root", "", "bancophp");
            $sql = "UPDATE eventostech SET nome_evento='$nome', data_evento='$data', local_evento='$local', horario_evento='$hora', preco_evento='$preco', descricao_evento='$descricao' WHERE eventostech.idevento = ".$idEventoEdit.";";
            
            if($imagem != NULL){
                if (move_uploaded_file($imagem['tmp_name'], $nomeFinal)) {
                    $tamanhoImg = filesize($nomeFinal);
                    $mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg));
                    
                    $sql = "UPDATE eventostech SET nome_evento='$nome', data_evento='$data', local_evento='$local', horario_evento='$hora', preco_evento='$preco', descricao_evento='$descricao', imagem_evento = '$mysqlImg' WHERE eventostech.idevento = ".$idEventoEdit.";";
                }
            }

            if($update = mysqli_query($conn, $sql)){
                echo ('<script>Swal.fire("Evento atualizado com sucesso");</script>');
                header("location:homeGestor.php");
            }else{
                echo ('<script>Swal.fire("Erro ao atualizar evento");</script>');
                header("location:homeGestor.php");
            }
        }
    ?>
</body>
</html>