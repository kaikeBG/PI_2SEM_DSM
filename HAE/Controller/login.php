<?php
extract($_POST);
session_start();
require("../Model/Professor.php");
$prof = new Professor();
if($role == "coordenador"){
    $res = $prof->getCord($username, $password);
    if($res){
        $_SESSION["id"] = $username;
        $_SESSION["nome"] = $res["nome_pro"];
        $_SESSION["fatec"] = $res["idFat_curFat"];
        header("Location: ../View/enviado.php");
        
    }else{
        header("Location: ../index.php?e=1");
    }
}else if($role == "professor"){
    $res = $prof->getProf($username, $password);
    if($res){
        $_SESSION["id"] = $username;
        $_SESSION["nome"] = $res["nome_pro"];
        header("Location: ../View/enviadoProf.php");
    }else{
        header("Location: ../index.php?e=1");
        
    }
}
?>