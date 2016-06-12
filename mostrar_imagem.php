<?php
include 'conexao.php';
$PicNum = $_GET["PicNum"];

$sqlI = "SELECT * FROM pessoas WHERE foto=$PicNum";
$resultadoI = ($conexao, $sqlI);

$row = mysql_fetch_object($result);
	Header( "Content-type: image/gif");
	echo $row->PES_IMG; 
?>
