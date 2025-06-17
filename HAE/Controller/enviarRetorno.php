<?php
require "../Model/Hae.php";
$hae = new Hae();

extract($_POST);
$hae->retornoHae($id_proj, $status, $retorno);
header("Location: ../View/enviado.php");


?>