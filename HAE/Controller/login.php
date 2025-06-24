<?php
extract($_POST);
session_start();
require("../Model/Professor.php");
$prof = new Professor();
$resC = $prof->getCord($username, $password);
$resP = $prof->getProf($username, $password);

if($resC){
    $_SESSION["id"] = $username;
    $_SESSION["nome"] = $resC["nome_pro"];
    $_SESSION["fatec"] = $resC["idFat_curFat"];
        header("Location: ../View/enviado.php");
}else if($resP){
        $_SESSION["id"] = $username;
        $_SESSION["nome"] = $resP["nome_pro"];
        header("Location: ../View/enviadoProf.php");
        
}else{
        header("Location: ../index.php?e=1");
}
?>