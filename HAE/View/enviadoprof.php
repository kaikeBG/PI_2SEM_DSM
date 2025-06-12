<?php
session_start();
extract($_SESSION);
require "../Model/Hae.php";
require "../Model/Professor.php";
$hae = new Hae();
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
    <script defer src="../assets/js/scriptEnviadoProf.js"></script>
    <!-- Link CDN do jsPDF -->
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
                        <td><?= $proj["id_projeto"] ?></td>
                        <td><?= $formData["nome_pro"] ?></td>
                        <td><?= $proj["data_submissao"] ?></td>
                        <td><?= $proj["tipo_hae"] ?></td>
                        <td><span style="color: green;"><?= $status[$proj["estado"]] ?></span></td>
                        <td>
                            <label class="upload-btn">
                                Enviar<input type="file" id="file-upload-1" accept="application/pdf, image/*, .docx, .xlsx" onchange="updateFileName(event, 1)">
                            </label><span class="file-name" id="file-name-1"></span>
                        </td>
                        <td>
                            <button onclick="mostrarHae(<?=$key?>)">Ver</button>
                        </td>
                        <td>
                            <button onclick=""><a href="../View/editarHAE.php?idProj=<?=$proj['id_projeto']?>">Editar</a></button>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
        <!-- Modal de Edição do Formulário -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeEditForm()">&times;</span>
                <h2>Editar Informações</h2>
                <form id="editForm" class="editForm">
                    <label for="edit-id">ID:</label>
                    <input type="text" id="edit-id" name="id" disabled><br>

                    <label for="edit-name">Nome do Professor:</label>
                    <input type="text" id="edit-name" name="professor"><br>

                    <label for="edit-date">Data de Envio:</label>
                    <input type="text" id="edit-date" name="date" disabled><br>

                    <label for="edit-type">Título da HAE:</label>
                    <input type="text" id="edit-type" name="title"><br>

                    <button type="submit">Salvar</button>
                </form>
            </div>
        </div>
    </div>

    </div>
    <script>
        const dadosHae = []
        <?php
        foreach ($haeData as $key => $proj) {
        ?>
        dadosHae.push(
            {
                <?php
                    foreach ($proj as $key => $value) {
                        $valor = $value;
                        if($key == "id_curFat"){
                            $cur = $prof->getUniCurProf($id, $value);
                            $valor = $cur["nome_mat"]." - ".$cur["nome_cur"];
                        }
                ?>
                        <?=$key?>: "<?=$valor?>",
                <?php
                    }
                ?>
            }
        )
        <?php
        }
        ?>
    </script>


</body>

</html>