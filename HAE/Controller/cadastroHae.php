<?php
session_start();

require "../Model/Hae.php";
require "../Model/Cronograma.php";
require "../Model/Professor.php";
$prof = new Professor();
$cron = new Cronograma();
$hae = new Hae();

extract($_SESSION);
extract($_POST);
var_dump($_SESSION);
var_dump($_POST);

$idProj = $hae->newHae($id, $opcao, $numeroHAE, $tipoHae, $inicio, $termino, $metas, $objet, $just, $recur, $resul, $metodo);

$cron->newCronograma($idProj, $mes1, $atividade1);
$cron->newCronograma($idProj, $mes2, $atividade2);
$cron->newCronograma($idProj, $mes3, $atividade3);
$cron->newCronograma($idProj, $mes4, $atividade4);
$cron->newCronograma($idProj, $mes5, $atividade5);
$cron->newCronograma($idProj, $mes6, $atividade6);

header("Location: ../View/enviadoprof.php");
?>