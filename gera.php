<?php
//RECEBE PARÂMETRO 
$id = $_GET["idDetalhes"];

//CONECTA AO MYSQL 
//$conn = mysqli_connect("localhost", "id20741728_jessica", "Admin@23", "id20741728_banco");
$conn = mysqli_connect("localhost", "root", "", "bancophp");

//EXIBE IMAGEM 
$sql = mysqli_query($conn, "SELECT imagem_evento FROM eventostech WHERE idevento = ".$id."");

$row = mysqli_fetch_array($sql); 
$tipo = "jpg";//$row["tipo"]; 
$bytes = $row["imagem_evento"];

//EXIBE IMAGEM 
header("Content-type: ".$tipo."");

echo $bytes;
// $linhaMostrar = mysqli_fetch_assoc($sql))
?>
