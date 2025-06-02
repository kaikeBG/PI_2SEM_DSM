<?php
session_start();

require "../Model/Hae.php";
require "../Model/Professor.php";
$prof = new Professor();
$hae = new Hae();

extract($_SESSION);
extract($_POST);
var_dump($_SESSION);
var_dump($_POST);

$hae->newHae($id, $opcao, $numeroHAE, $tipoHae, $inicio, $termino, $metas, $objet, $just, $recur, $resul, $metodo);
header("Location: ../View/enviadoprof.php");
?>