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
        <form action="" method=GET>
            <input type="text" name="cpf" placeholder="CPF">
            <input type="text" name="senha" placeholder="Senha"> 

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


        $result_tabela = "SELECT * FROM usuarios";

        //Excutar a consulta SQL e armazenar o resultado em uma variavel
        $resultado_tabela = mysqli_query($conn, $result_tabela);    //query significa consulta

        //Encontrar usuario
        while($row_usuario = mysqli_fetch_assoc($resultado_tabela)){
            if($row_usuario['cpf'] == $cpf && $row_usuario['cpf'] == $senha){
                $idUsuarioEncontado = $row_usuario['id'];
            }else{
                echo "<script>alert('usuario não encontrado. Por favor realize seu cadastro')</script>";
            }
        }



        //verifica se o formulario foi enviado pelo metodo POST
        if($_SERVER["REQUEST_METHOD"] == "GET"){   //$_SERVER["REQUEST_METHOD"] vefica o metodo do formulario
            $cpf = $_POST['cpf'];
            $senha = $_POST['senha'];

            $query_select = "SELECT cpf FROM usuarios WHERE cpf = '$cpf'";
            $select = mysql_query($query_select,$conn);
            $array = mysql_fetch_array($select);
            $logarray = $array['cpf'];


            //Cria os valores que foram digitados no input e insere o registro na tabela
            $sql = "SELECT cpf, senha,
                    FROM usuarios,
                    HAVING cpf = $cpf AND senha= $senha";


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