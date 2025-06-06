<?php
session_start();
extract($_SESSION);
require "../Model/Hae.php";
require "../Model/Professor.php";
$hae = new Hae();
$prof = new Professor();
$formData = $prof->getFormData($id);
$haeData = $hae->getHae($id);

var_dump($formData);
var_dump($haeData);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Enviado</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=edit" />    <script defer src="../assets/js/scriptEnviadoProf.js"></script>
    <!-- Link CDN do jsPDF -->
</head>


<div id="relatorioModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeRelatorioModal()">&times;</span>
        <h2>Escrever Relatório</h2>
        <textarea id="relatorioTextarea" rows="8" cols="50" placeholder="Escreva o relatório aqui..."></textarea><br>
        <button onclick="enviarRelatorio()">Enviar</button>
    </div>
</div>

<body>

    <?php
    require "./components/header.php";
    require "./components/vlibras.php";

    ?>

     <div class="logos">
        <img src="../assets/img/logo_fatec_cor.png" width="13%" alt="">
        <img src="../assets/img/cps.png" width="14%" alt="">
        <svg id="logoCeos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000">
            <defs>
                <clipPath id="a">
                <path d="M0 0h1000v1000H0z"/>
                </clipPath>
            </defs>
            <g clip-path="url(#a)">
                <mask id="b">
                <circle vector-effect="non-scaling-stroke" cx="487" cy="500" r="320" fill="#fff"/>
                </mask>
                <circle vector-effect="non-scaling-stroke" cx="487" cy="500" r="320" fill="none"/>
                <circle vector-effect="non-scaling-stroke" cx="487" cy="500" r="320" fill="none" mask="url(#b)" stroke-width="232" stroke="red" stroke-linecap="square" stroke-miterlimit="3"/>
                <path fill="#F4F4F4" d="M665 407h142v186H665zM336 213l72 105-74 50-71-105zM388 676l-82 96-37-32 82-96z"/>
            </g>
        </svg>
    </div>

    <nav>
        <ul>
            <li><a href="../index.php">Voltar para o Login</a></li>
            <li><a href="edital.php">Inscrição</a></li>
            <li><a href="enviadoprof.php">Acompanhamento</a></li>
        </ul>
    </nav>

    <?php
    require "./components/selectFatec.php";
    ?>


    <!-- Tabela com os dados enviados -->
    <div class="central">
        <table border="1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome do Professor</th>
                    <th>Data de Envio</th>
                    <th>Tipo de Atividade</th>
                    <th>Status</th>
                    <th>Relatório</th> <!-- Nova coluna Relatório -->
                    <th>Edital</th>
                    <th>Arquivo</th>
                </tr>
            </thead>
            <tbody id="formTableBody">
                <?php
                $status = ["indeferido", "parcial", "deferido"];
                foreach ($haeData as $key => $proj) {
                ?>
                <tr>
                    <td><?=$proj["id_projeto"]?></td>
                    <td><?=$formData["nome_pro"]?></td>
                    <td><?=$proj["data_submissao"]?></td>
                    <td><?=$proj["tipo_hae"]?></td>
                    <td><span style="color: green;"><?=$status[$proj["estado"]]?></span></td>
                    <td>
                        <button onclick="openRelatorioModal()">Enviar</button>
                    </td>
                    <td>
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 -960 960 960" width="50px" fill="#e8eaed">
                                <path d="M480-320 280-520l56-58 104 104v-326h80v326l104-104 56 58-200 200ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"></path>
                            </svg>
                        </button>
                    </td>
                    <td>
                        <button>Editar</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
    </div>

    </div>



</body>

</html>