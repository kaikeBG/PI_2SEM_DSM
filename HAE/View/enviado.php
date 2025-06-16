<?php
session_start();
extract($_SESSION);
require "../Model/Hae.php";
require "../Model/Cronograma.php";
require "../Model/Professor.php";
$hae = new Hae();
$prof = new Professor();
$cron = new Cronograma();

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
    <title>Coordenador</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=reply" />

    <!-- <script defer src="../assets/js/scriptEnviado.js"></script> -->

</head>

<div id="modalRetorno"  style="display:none;">
        <form action="../Controller/enviarRetorno.php" method="post">
            <div id="camposModalRetorno">
                <label for="retorno">Retorno</label>
                <textarea name="retorno" id="retorno"></textarea>
                <label for="status">status</label>
                <Select name="status">
                    <option value="0">indeferido</option>
                    <option value="1">parcialmente deferido</option>
                    <option value="2">deferido</option>
                </Select>
            </div>
            <button type="submit">enviar</button>
        </form>
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
            <li><a href="enviado.php">Acompanhamento</a></li>
        </ul>
    </nav>

    <?php
    require "./components/selectFatec.php";
    require "./components/haeVisu.php";
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
                    <th>Edital</th>
                    <th>Retorno</th>
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
                            <button onclick="mostrarHae(<?= $key ?>)">Ver</button>
                    </td>
                    <td>
                        <button>Enviar</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
                        <script>
        const dadosHae = []

        <?php
        foreach ($haeData as $key => $proj) {
        ?>
            dadosHae.push({
                <?php
                foreach ($proj as $key => $value) {
                    $valor = $value;
                    if ($key == "id_curFat") {
                        $cur = $prof->getUniCurProf($id, $value);
                        $valor = $cur["nome_mat"] . " - " . $cur["nome_cur"];
                    }
                    if($key == "id_projeto"){
                        $cronogras = $cron->getCronograma($valor);
                        ?>
                        mes1:<?=$cronogras[0]["mes"]?>,
                        mes2:<?=$cronogras[1]["mes"]?>,
                        mes3:<?=$cronogras[2]["mes"]?>,
                        mes4:<?=$cronogras[3]["mes"]?>,
                        mes5:<?=$cronogras[4]["mes"]?>,
                        mes6:<?=$cronogras[5]["mes"]?>,
                        atv1:"<?=$cronogras[0]["atividade"]?>",
                        atv2:"<?=$cronogras[1]["atividade"]?>",
                        atv3:'<?=$cronogras[2]["atividade"]?>',
                        atv4:"<?=$cronogras[3]["atividade"]?>",
                        atv5:"<?=$cronogras[4]["atividade"]?>",
                        atv6:"<?=$cronogras[5]["atividade"]?>",
                        <?php
                    }


                    ?>
                    <?= $key ?>: "<?= $valor ?>",
                <?php
                }
                ?>
            })
        <?php
        }
        ?>
    </script>
</body>

</html>