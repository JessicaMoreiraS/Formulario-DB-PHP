<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Banco de Dados - POST</title>
    <style>
        body{
            background-color: beige;
        }
    </style>
</head>
<body>
    <head>
        <h1>PHP com Banco de Dados</h1>
    </head>
    <main>
        <form action="" method=POST>
            <input type="text" id=nome name="nome" placeholder= nome>
            <input type="tel" name="telefone" placeholder="Telefone">
            <input type="text" name="cpf" placeholder="CPF">
            <select name="nomeEvento">
                <option value="none">Escolha um evento</option>
                <option value="techweek">Tech week</option>
                <option value="mobileworldcongress ">Mobile World Congress</option>
                <option value="cio100awards ">CIO 100 Awards</option>
                <option value="nerdweek">Nerd week</option>
                <option value="digitalexposaopaulo ">Digital Expo São Paulo</option>
                <option value="developerweek ">DeveloperWeek</option>
            </select>

            <input type="submit" value="enviar">
        </form>
    </main>
    <footer>

    </footer>

    <script>
        console.log("oii")
    </script>

    <?php
        //rot é raiz (pq no xampp nao precisa do usuario)
        //Criar a conexão com Banco de dados
        $conn = mysqli_connect("localhost", "root", "", "bancodadosphp");   //conn é de conexao / mysqli_connect() é padrão

        //verifica se o formulario foi enviado pelo metodo POST
        if($_SERVER["REQUEST_METHOD"] == "POST"){   //$_SERVER["REQUEST_METHOD"] vefica o metodo do formulario
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $cpf = $_POST['cpf'];
            $senha = $_POST['senha'];


            //Cria os valores que foram digitados no input e insere o registro na tabela
            $sql = "INSERT INTO $nomeEvento (cpf, nome, telefone, senha) VALUES ('$cpf', '$nome', '$telefone', '$senha')";


            //Verifica se foi enviado ou se ocorreu erro
            if(mysqli_query($conn, $sql)){
                echo "Registro inserido com sucesso";
            }else{
                echo "Eroo ao inserir";
            }
        }
    ?>
</body>
</html>