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

$cron->newCronograma($idProj, "1", $atividade1);
$cron->newCronograma($idProj, "2", $atividade2);
$cron->newCronograma($idProj, "3", $atividade3);
$cron->newCronograma($idProj, "4", $atividade4);
$cron->newCronograma($idProj, "5", $atividade5);
$cron->newCronograma($idProj, "6", $atividade6);

header("Location: ../View/enviadoprof.php");
?>