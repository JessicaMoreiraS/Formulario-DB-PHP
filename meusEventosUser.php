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
    <title>Meus Eventos</title>
</head>
<body>
<?php
    $conexao = mysqli_connect("localhost", "root", "", "bancophp");

    if(isset($_GET['id'])){
        $idEventoCancelaPresenca =  $_GET['id'];
        
        if($idEventoCancelaPresenca > 0){
            $comandoDeletar = ' DELETE FROM confirmacaopresencatech WHERE confirmacaopresencatech.idconfirmacao = '.$idEventoCancelaPresenca.';';
            $deleta = mysqli_query($conexao, $comandoDeletar);
        }
    }
?>
    <header>
        <h1>Meus eventos</h1>
        <p name="nomeUser" id="nomeUser"></p>

        <nav>
            <a href="index.php">Inicio</a>
            <a href="homeUser.php">Todos os Eventos</a>
            <a href="meusEventosUser.php">Meus eventos</a>
        </nav>
    </header>
    <main class="mainMeusEventos mainUser">
        <table style="border: solid 2px #000000">
            <tr class="th">
                <td>Evento</td>
                <td>Data</td>
                <td>Local</td>
                <td>Preço</td>
                <td>Cancelamento</td>
            </tr>

            <tbody>
                <?php
                    session_start();
                    $idAcesso = $_SESSION['idAcesso'];

                    $read = "SELECT * FROM confirmacaopresencatech RIGHT JOIN eventostech ON confirmacaopresencatech.idevento = eventostech.idevento WHERE confirmacaopresencatech.idusuario = ".$idAcesso.";";
                    
                    $tabelaConfirmacao = mysqli_query($conexao, $read);
                        
                    while($linhaConfirmacao = mysqli_fetch_assoc($tabelaConfirmacao)){
                    ?>
                        <tr>
                            <td><?php echo $linhaConfirmacao['nome_evento'];?></td>
                            <td><?php echo $linhaConfirmacao['data_evento'];?></td>
                            <td><?php echo $linhaConfirmacao['local_evento'];?></td>
                            <td>R$ <?php echo $linhaConfirmacao['preco_evento'];?></td>
                            <td>
                                <a href="meusEventosUser.php?id=<?php echo $linhaConfirmacao['idconfirmacao']; ?> ">
                                    <button>
                                        Cancelar Presença
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
