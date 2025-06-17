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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordenador</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <script defer src="../assets/js/scriptEnviado.js"></script> -->

</head>

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
    <div id="fundoEscuro" style="
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100vw; height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;">
    </div>
    <div id="modalRetorno"  style="position: fixed; display: none; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 50%; overflow-y: auto; background-color: white; padding: 20px; box-shadow: 0 0 30px rgba(0,0,0,0.1); border-radius: 10px;   z-index: 1000;">
            <form action="../Controller/enviarRetorno.php" method="post">
                <div id="camposModalRetorno">
                    <span class="fechar" onclick="fecharRetorno()">&times;</span>
                    <label for="retorno">Retorno</label>
                    <textarea name="retorno" id="retorno" rows="8"></textarea>
                    <label for="status">status</label>
                    <Select name="status">
                        <option value="0">indeferido</option>
                        <option value="1">parcialmente deferido</option>
                        <option value="2">deferido</option>
                    </Select>
                </div>
                <input type="text" style="display: none;" id="id_proj" name="id_proj">
                <button type="submit">enviar</button>
            </form>
    </div>

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
                            <button onclick="mostrarHae(<?= $key ?>)"><span class="material-icons" alt="visualizar">visibility</span></button>
                    </td>
                    <td>
                        <?php
                        if($proj["estado"] == 0){
                            ?>
                                <button class="btn" onclick="modalRetorno(<?=$proj['id_projeto']?>)"><span class="material-icons" alt="enviar">send</span></button>
                            <?php
                        }
                        ?>
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
                        $valor = $cur["nome_mat"] . " - " . $cur["nome_cur"] . " - " . $cur["nome_cur"];
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

        function modalRetorno(id){
            document.querySelector("#modalRetorno").style.display = "block";
            document.querySelector("#id_proj").value = id;
        }
        function fecharRetorno(){
            document.querySelector("#modalRetorno").style.display = "none";
        }
    </script>
</body>

</html>