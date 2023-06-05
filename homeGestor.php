<?php 
    $conexao = mysqli_connect("localhost", "root", "", "bancophp");
    if(isset($_GET['id']) > 0){
        $idEventoCancelado =  $_GET['id'];
        $comandoDeletarEvento = ' DELETE FROM eventostech WHERE eventostech.idevento = '.$idEventoCancelado.'; ';
        $comandoDeletarConfirmacao = ' DELETE FROM confirmacaopresencatech WHERE confirmacaopresencatech.idevento = '.$idEventoCancelado.'; ';
        $deleta = mysqli_query($conexao, $comandoDeletarConfirmacao);
        $deleta = mysqli_query($conexao, $comandoDeletarEvento);
    }
?>
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
    <title>Todos os Eventos</title>
</head>
<body>
    <header>
        <h1>Eventos</h1>

        <nav>
            <a href="index.php">Inicio</a>
            <a href="homeGestor.php">Todos os Eventos</a>
            <a href="criarEvento.php">Adicionar novos Eventos</a>
            <a href="presencaGestor.php">Confirmação de Presenca</a>
        </nav>
    </header>
    <main  class="homeGestor mainGestor">
        <table style="border: solid 2px #000000">
            <tr class="th">
                <td>Evento</td>
                <td>Data</td>
                <td>Local</td>
                <td>Preço</td>
                <!-- <td>Descrição</td> -->
                <td>Imagem</td>
                <td>Opções</td>
            </tr>

            <tbody>
                <?php

                    $read = "SELECT * FROM eventostech";
                    $tabelaEventos = mysqli_query($conexao, $read);
                        
                    while($linhaConfirmacao = mysqli_fetch_assoc($tabelaEventos)){
                    ?>
                        <tr>
                            <td><?php echo $linhaConfirmacao['nome_evento'];?></td>
                            <td><?php echo $linhaConfirmacao['data_evento'];?></td>
                            <td><?php echo $linhaConfirmacao['local_evento'];?></td>
                            <td>R$<?php echo $linhaConfirmacao['preco_evento'];?></td>
                            <!-- <td><?php //echo $linhaConfirmacao['descricao_evento'];?></td> -->
                            <td><img src="gera.php?idDetalhes='<?php echo $linhaConfirmacao['idevento']; ?>'"></td>
                            <td>
                                <a href="homeGestor.php?id=<?php echo $linhaConfirmacao['idevento']; ?>">
                                    <button>
                                        Cancelar Evento
                                    </button>
                                </a>
                                <a href="editarEvento.php?id=<?php echo $linhaConfirmacao['idevento']; ?>">
                                    <button>
                                        Editar Evento
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>

    </main>

    <footer>
    </footer>

    <script src="js/script.js"></script>

    
</body>
</html>
