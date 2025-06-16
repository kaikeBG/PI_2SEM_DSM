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
var_dump($_POST);

$idProj = $hae->editHae($idProj, $id, $opcao, $numeroHAE, $_POST["tipo-hae"], $inicio, $termino, $metas, $objet, $just, $recur, $resul, $metodo);

$cronogramas = $cron->getCronograma($idProj);
var_dump($cronogramas);
$cron->updateCronograma($cronogramas[0]["id_cronograma"], $mes1, $atividade1);
$cron->updateCronograma($cronogramas[1]["id_cronograma"], $mes2, $atividade2);
$cron->updateCronograma($cronogramas[2]["id_cronograma"], $mes3, $atividade3);
$cron->updateCronograma($cronogramas[3]["id_cronograma"], $mes4, $atividade4);
$cron->updateCronograma($cronogramas[4]["id_cronograma"], $mes5, $atividade5);
$cron->updateCronograma($cronogramas[5]["id_cronograma"], $mes6, $atividade6);

header("Location: ../View/enviadoprof.php");
?>