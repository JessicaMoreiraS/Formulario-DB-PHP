<?php 
    $conn = mysqli_connect("localhost", "root", "", "bancophp");   // Criar a conexão  - xampp
    $nomeTabela = 'eventostech';
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){   
        $nome = $_POST['nomeEvento'];
        $data = $_POST['dataEvento'];
        $horario = $_POST['horarioEvento'];
        $local = $_POST['localEvento'];
        $preco = $_POST['precoEvento'];
        $descricao = $_POST['descricaoEvento'];
        $imagem = $_FILES['imagemEvento'];

        $nomeFinal = time().'.jpg';

        if($nome != "" && $data !="" && $local!="" && $preco != "" && $descricao != ""){
            if($imagem != NULL){
                if (move_uploaded_file($imagem['tmp_name'], $nomeFinal)) {
                    $tamanhoImg = filesize($nomeFinal);
                    $mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg));
                    
                    $sql = "INSERT INTO $nomeTabela (nome_evento, data_evento, local_evento, horario_evento, preco_evento, descricao_evento, imagem_evento) VALUES ('$nome', '$data', '$horario', '$local', '$preco', '$descricao', '$mysqlImg')";
                        
                    if(mysqli_query($conn, $sql)){
                        echo ('<script>Swal.fire("Adicionado com sucesso");</script>');
                        header("location:homeGestor.php");
                    }else{
                        echo ('<script>Swal.fire("Erro ao inserir");</script>');
                    }
                }
            }else{
                echo ('<script>Swal.fire("Selecione uma imagem valida");</script>');
            }
        }else{
            echo ('<script>Swal.fire("Preencha todos os campos");</script>');
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Criar Eventos</title>
</head>
<body>
    <header>
        <h1>Criar Evento</h1>
        <p name="nomeUser" id="nomeUser"></p>

        <nav>
            <a href="index.php">Inicio</a>
            <a href="homeGestor.php">Todos os Eventos</a>
            <a href="criarEvento.php">Adicionar novos Eventos</a>
            <a href="presencaGestor.php">Confirmação de Presenca</a>
        </nav>
    </header>
    <main  class="mainCriarEvento mainGestor">
        <form method="POST" enctype="multipart/form-data">
            <div class="boxContainerForm">
                <div class="containerForm">
                    <input type="text" name="nomeEvento" placeholder="nome do evento"> 
                    <input type="date" name="dataEvento" placeholder="data"> 
                    <input type="time" name="horarioEvento" placeholder="horario"> 
                    <input type="text" name="localEvento" placeholder="local"> 
                    <input type="number" name="precoEvento" placeholder="preço"> 
                </div>
                <div class="containerForm">
                    <textarea  type="text" name="descricaoEvento" placeholder="Descrição"></textarea>
                    <label for="imagemEvento" class="imagemEvento">
                        <div class="buttonFake">
                            <img class="img" src="imagens/camera.png">
                            Escolha uma imagem
                        </div>
                    </label>
                    <input class="none" type="file" name="imagemEvento" id="imagemEvento" onchange="carregaNomeImg()">
                    <p id="descricaoImg"></p>
                </div>
            </div>

            <input type="submit" value="Cadastrar" class="btnFormG">
        </form>
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

</body>
</html>
