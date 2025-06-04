<?php
session_start();
require "../Model/Professor.php";

$prof = new Professor();

// Aqui usamos o ID do professor logado, vindo da sessão
$idProf = $_SESSION['id']; // adapte se o nome da sessão for diferente

$fatecs = $prof->getFats($idProf);

if ($fatecs) {
    // Se for apenas uma fatec (fetch e não fetchAll), transforme em array
    if (!isset($fatecs[0])) $fatecs = [$fatecs];

    foreach ($fatecs as $fatec) {
        echo "<option value='{$fatec['id_fat']}'>{$fatec['nome_fat']}</option>";
    }
} else {
    echo "<option disabled>Nenhuma Fatec encontrada</option>";
}