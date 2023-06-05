<?php

$imagem = $_FILES["imagemEvento"];
$idEvento = $_POST["idevento"];

if($imagem != NULL) {
	$nomeFinal = time().'.jpg';
	if (move_uploaded_file($imagem['tmp_name'], $nomeFinal)) {
		$tamanhoImg = filesize($nomeFinal);

		$mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg));
        //$conn = mysqli_connect("localhost", "id20741728_jessica", "Admin@23", "id20741728_banco");
        $conn= mysqli_connect("localhost", "root", "", "bancophp");

		$sql = "UPDATE eventostech SET imagem_evento = '$mysqlImg' WHERE idevento = ".$idEvento.";";
        

		// unlink($nomeFinal);
        if($executa = mysqli_query($conn, $sql)){
            header("location:editarEvento.php?id=".$idevento);
        }else{
            echo "<script>alert('erro')</script>";
            header("location:editarEvento.php?id=".$idevento);
        }

	}
}
else {
	echo"Você não realizou o upload de forma satisfatória.";
}

?>