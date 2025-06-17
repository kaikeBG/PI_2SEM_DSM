<?php
session_start();
extract($_SESSION);
require "../Model/Hae.php";
require "../Model/Cronograma.php";
require "../Model/Professor.php";
$hae = new Hae();
$cron = new Cronograma();
$prof = new Professor();
$formData = $prof->getFormData($id);
$haeData = $hae->getHae($id);

//  var_dump($cursos);
// var_dump($formData);
// var_dump($haeData);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Enviado</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script defer src="../assets/js/scriptEnviadoProf.js"></script>
    <!-- Link CDN do jsPDF -->
</head>



<body>
    <div id="RetornoModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="fecharRetorno()">&times;</span>
            <h2>Retorno</h2>
            <textarea id="relatorioTextarea" readonly rows="8" cols="50" placeholder="Escreva o relatório aqui..."></textarea><br>
        </div>
    </div>
    
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
                    <path d="M0 0h1000v1000H0z" />
                </clipPath>
            </defs>
            <g clip-path="url(#a)">
                <mask id="b">
                    <circle vector-effect="non-scaling-stroke" cx="487" cy="500" r="320" fill="#fff" />
                </mask>
                <circle vector-effect="non-scaling-stroke" cx="487" cy="500" r="320" fill="none" />
                <circle vector-effect="non-scaling-stroke" cx="487" cy="500" r="320" fill="none" mask="url(#b)" stroke-width="232" stroke="red" stroke-linecap="square" stroke-miterlimit="3" />
                <path fill="#F4F4F4" d="M665 407h142v186H665zM336 213l72 105-74 50-71-105zM388 676l-82 96-37-32 82-96z" />
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
                    <th>Retorno</th> <!-- Nova coluna Relatório -->
                    <th>Edital</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody id="formTableBody">
                <?php
                $status = ["indeferido", "parcial", "deferido"];
                foreach ($haeData as $key => $proj) {
                ?>
                    <tr>
                        <td><?= $proj["id_projeto"] ?></td>
                        <td><?= $formData["nome_pro"] ?></td>
                        <td><?= $proj["data_submissao"] ?></td>
                        <td><?= $proj["tipo_hae"] ?></td>
                        <td><span style="color: green;"><?= $status[$proj["estado"]] ?></span></td>
                        <td>
<<<<<<< HEAD
                            <button onclick="abrirModalRelatorio()"><span class="material-icons">send</span></button>
=======
                            <?php
                                if($proj['retorno']){
                                    ?>
                                        <button onclick="mostrarRetorno(`<?=$proj['retorno']?>`)">Ver</button>
                                    <?php
                                }
                            ?>
>>>>>>> d6adda6dfa8e7f37d872e52236496b6caf6c8dfe
                        </td>
                        <td>
                            <button onclick="mostrarHae(<?= $key ?>)"><span class="material-icons">visibility</span></button>
                        </td>
                        <td>
<<<<<<< HEAD
                            <button ><a href="../View/editarHAE.php?idProj=<?= $proj['id_projeto'] ?>" class="sem-estilo"><span class="material-icons" >edit</span></a></button>
=======
                        <?php
                            if($proj["estado"] == 1){
                        ?>
                            <button onclick=""><a href="../View/editarHAE.php?idProj=<?= $proj['id_projeto'] ?>">Editar</a></button>
                            <?php
                            }
                            ?>
>>>>>>> d6adda6dfa8e7f37d872e52236496b6caf6c8dfe
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

    </div>
    <script>
        const dadosHae = []
        function mostrarRetorno(texto){
            document.querySelector('#RetornoModal').style.display = "block"
            document.querySelector('#relatorioTextarea').innerHTML = texto;
        }
        function fecharRetorno(){
                document.querySelector('#RetornoModal').style.display = "none"
        }
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

    <script>
        function abrirModalRelatorio() {
            document.getElementById("relatorioModal").style.display = "block";
        }
        function closeRelatorioModal(){
            document.getElementById("relatorioModal").style.display = "none";
        }
    </script>
</body>

</html>