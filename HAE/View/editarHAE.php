<?php
session_start();
extract($_SESSION);
extract($_GET);
require("../Model/Professor.php");
require("../Model/Cronograma.php");
require("../Model/Hae.php");
$prof = new Professor();
$cron = new Cronograma();
$hae = new Hae();
$cur = $prof->getCurProf($id);
$formData = $prof->getFormData($id);
$haeData = $hae->getOneHae($idProj);
$haeData = $haeData[0];
$cronograma = $cron->getCronograma($idProj);

if($haeData["tipo_hae"] == "Trabalho de Graduação"){
    $grad = "selected";
    $esta = "";
}else{
    $esta = "selected";
    $grad = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edital</title>
    <link rel="stylesheet" type="text/css"
        href="https://www.saopaulo.sp.gov.br/barra-govsp/css/rodape-padrao-govsp.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://saopaulo.sp.gov.br/barra-govsp/css/top-padrao-govsp-v2.min.css?vs=3.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" defer></script>
    <script src="../assets/js/scriptEditarHae.js" defer></script> <!-- Carrega o JS externo -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>

</head>

<body>

    <?php
    require "./components/header.php";
    require "./components/vlibras.php";
    require "./components/modal.php";
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
    ?>

    <div class="central">
        <!-- Barra de Progresso -->
        <div class="progress-container">
            <div class="progress-bar" id="progress-bar"></div>
        </div>


        <form name="haeForm"  method="post" action="../Controller/editarHae.php">
            <!-- Parte 1 -->
            <div class="form-part active" id="part-1">
                <h1>Editar - H.A.E.</h1>

                <label for="professor">Professor(a):</label>
                <input type="text" id="professor" name="professor" value="<?= $formData["nome_pro"] ?>" readonly>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="<?= $formData["email_pro"] ?>" readonly>

                <label for="rg">R.G.:</label>
                <input type="text" id="rg" name="rg" value="<?= $formData["rg_pro"] ?>" readonly>

                <label for="matricula">Matrícula:</label>
                <input type="text" id="matricula" name="matricula" value="<?= $formData["id_pro"] ?>" readonly>

                <label for="hora-aula">Hora-aula semanal na Fatec:</label>
                <input type="number" id="hora-aula" name="hora-aula" value="<?= $formData["tempoHae"] ?>" readonly>

                <label for="outras-fatecs">Tem aula atribuída em outra(s) Fatec(s)?</label>
                <select id="outras-fatecs" name="outras-fatecs" required>
                    <?php
                    $fats = $prof->getFats($id);
                    if (count($fats) > 1) {
                    ?>
                        <option value="Sim">Sim</option>
                    <?php
                    } else {
                    ?>
                        <option value="Não">Não</option>
                    <?php
                    }
                    ?>
                </select>

                <label for="tipo-hae">Tipo de HAE que está solicitando:</label>
                <select id="tipo-hae" name="tipo-hae" required>
                    <option <?=$esta?> value="Estágio Supervisionado">Estágio Supervisionado</option>
                    <option <?=$grad?> value="Trabalho de Graduação">Trabalho de Graduação</option>
                </select>

                <button type="button" id="next-1" class="next-btn">Próximo</button>
            </div>

            <!-- Parte 2 -->
            <div class="form-part" id="part-2">
                <label for="opcao">Escolha uma curso:</label>
                <select id="opcao" name="opcao" onchange="mostrarInput()">
                    <?php
                    foreach ($cur as $key => $curso) {
                        $selectCur = "";
                        if($curso["id_matCurFat"] == $haeData["id_curFat"]){
                        $selectCur = "selected";

                        }
                    ?>
                        <option <?=$selectCur?> value="<?= $curso["id_matCurFat"] ?>"><?= $curso["nome_mat"] ?> // <?= $curso["nome_cur"] ?></option>
                    <?php
                    }
                    ?>
                </select>

                <div id="containerNumero" style="margin-top: 10px;">
                    <label for="numero">Qtd. de H.A.E. para Estágio Supervisionado:</label>
                    <input type="number" id="numeroHAE" value="<?=$haeData["qtd_horas"]?>" name="numeroHAE">
                </div>


                <div class="titulo-sessao">Período do Projeto</div>
                <label for="inicio">Início do Projeto:</label>
                <input type="date" id="inicio" name="inicio" value="<?=$haeData["data_inicio"]?>" required>

                <label for="termino">Término do Projeto:</label>
                <input type="date" id="termino" name="termino" value="<?=$haeData["data_termino"]?>" required>

                <div class="titulo-sessao">Metas Relacionadas ao Projeto</div>
                <div class="form-group">
                    <label for="metas">Descreva as metas do projeto:</label>
                    <textarea id="metas" rows="3" name="metas" ><?=$haeData["metas"]?></textarea>
                </div>

                <button type="button" id="prev-1" class="next-btn">Voltar</button>
                <button type="button" id="next-2" class="next-btn">Próximo</button>
            </div>

            <!-- Parte 3 -->
            <div class="form-part" id="part-3">
                <div class="titulo-sessao">Objetivos do Projeto</div>
                <textarea id="objetivos" name="objet"  rows="3"><?=$haeData["objetivos"]?></textarea>

                <div class="titulo-sessao">Justificativas do Projeto</div>
                <textarea id="justificativas" name="just" rows="3" ><?=$haeData["justificativas"]?></textarea>

                <div class="titulo-sessao">Recursos Materiais e Humanos</div>
                <textarea id="recursos" rows="3" name="recur"><?=$haeData["recursos"]?></textarea>

                <div class="titulo-sessao">Resultado Esperado</div>
                <textarea id="resultado" rows="2" name="resul"><?=$haeData["resultado_esperado"]?></textarea>

                <div class="titulo-sessao">Metodologia</div>
                <textarea id="metodologia" rows="2" name="metodo"><?=$haeData["metodologia"]?></textarea>

                <div class="titulo-sessao">Cronograma de Execução</div>
                <table>
                    <thead>
                        <tr>
                            <th>mês</th>
                            <th>Atividade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php
                                $m1 = "";
                                $m2 = "";
                                $m3 = "";
                                $m4 = "";
                                $m5 = "";
                                $m6 = "";
                                $m7 = "";
                                $m8 = "";
                                $m9 = "";
                                $m10 = "";
                                $m11 = "";
                                $m12 = "";
                                $selectMes = "m".$cronograma[0]["mes"];
                                $$selectMes = "selected";
                                ?>
                                <select id="mes" name="mes1">
                                    <option <?=$m1?> value="1">Janeiro</option>
                                    <option <?=$m2?> value="2">Fevereiro</option>
                                    <option <?=$m3?> value="3">Março</option>
                                    <option <?=$m4?> value="4">Abril</option>
                                    <option <?=$m5?> value="5">Maio</option>
                                    <option <?=$m6?> value="6">Junho</option>
                                    <option <?=$m7?> value="7">Julho</option>
                                    <option <?=$m8?> value="8">Agosto</option>
                                    <option <?=$m9?> value="9">Setembro</option>
                                    <option <?=$m10?> value="10">Outubro</option>
                                    <option <?=$m11?> value="11">Novembro</option>
                                    <option <?=$m12?> value="12">Dezembro</option>
                                </select>
                            </td>
                            <td><input type="text" id="atividade-agosto" name="atividade1"
                                    placeholder="Descreva a atividade" value="<?=$cronograma[0]["atividade"]?>"></td>
                        </tr>
                        <tr>
                                                        <td>
                                <?php
                                $m1 = "";
                                $m2 = "";
                                $m3 = "";
                                $m4 = "";
                                $m5 = "";
                                $m6 = "";
                                $m7 = "";
                                $m8 = "";
                                $m9 = "";
                                $m10 = "";
                                $m11 = "";
                                $m12 = "";
                                $selectMes = "m".$cronograma[1]["mes"];
                                $$selectMes = "selected";
                                ?>
                                <select id="mes" name="mes2">
                                    <option <?=$m1?> value="1">Janeiro</option>
                                    <option <?=$m2?> value="2">Fevereiro</option>
                                    <option <?=$m3?> value="3">Março</option>
                                    <option <?=$m4?> value="4">Abril</option>
                                    <option <?=$m5?> value="5">Maio</option>
                                    <option <?=$m6?> value="6">Junho</option>
                                    <option <?=$m7?> value="7">Julho</option>
                                    <option <?=$m8?> value="8">Agosto</option>
                                    <option <?=$m9?> value="9">Setembro</option>
                                    <option <?=$m10?> value="10">Outubro</option>
                                    <option <?=$m11?> value="11">Novembro</option>
                                    <option <?=$m12?> value="12">Dezembro</option>
                                </select>
                            </td>
                            <td><input type="text" id="atividade-agosto" name="atividade2"
                                    placeholder="Descreva a atividade" value="<?=$cronograma[1]["atividade"]?>"></td>
                        </tr>
                        <tr>
                                                        <td>
                                <?php
                                $m1 = "";
                                $m2 = "";
                                $m3 = "";
                                $m4 = "";
                                $m5 = "";
                                $m6 = "";
                                $m7 = "";
                                $m8 = "";
                                $m9 = "";
                                $m10 = "";
                                $m11 = "";
                                $m12 = "";
                                $selectMes = "m".$cronograma[2]["mes"];
                                $$selectMes = "selected";
                                ?>
                                <select id="mes" name="mes3">
                                    <option <?=$m1?> value="1">Janeiro</option>
                                    <option <?=$m2?> value="2">Fevereiro</option>
                                    <option <?=$m3?> value="3">Março</option>
                                    <option <?=$m4?> value="4">Abril</option>
                                    <option <?=$m5?> value="5">Maio</option>
                                    <option <?=$m6?> value="6">Junho</option>
                                    <option <?=$m7?> value="7">Julho</option>
                                    <option <?=$m8?> value="8">Agosto</option>
                                    <option <?=$m9?> value="9">Setembro</option>
                                    <option <?=$m10?> value="10">Outubro</option>
                                    <option <?=$m11?> value="11">Novembro</option>
                                    <option <?=$m12?> value="12">Dezembro</option>
                                </select>
                            </td>
                            <td><input type="text" id="atividade-agosto" name="atividade3"
                                    placeholder="Descreva a atividade" value="<?=$cronograma[2]["atividade"]?>"></td>
                        </tr>
                        <tr>
                                                        <td>
                                <?php
                                $m1 = "";
                                $m2 = "";
                                $m3 = "";
                                $m4 = "";
                                $m5 = "";
                                $m6 = "";
                                $m7 = "";
                                $m8 = "";
                                $m9 = "";
                                $m10 = "";
                                $m11 = "";
                                $m12 = "";
                                $selectMes = "m".$cronograma[3]["mes"];
                                $$selectMes = "selected";
                                ?>
                                <select id="mes" name="mes4">
                                    <option <?=$m1?> value="1">Janeiro</option>
                                    <option <?=$m2?> value="2">Fevereiro</option>
                                    <option <?=$m3?> value="3">Março</option>
                                    <option <?=$m4?> value="4">Abril</option>
                                    <option <?=$m5?> value="5">Maio</option>
                                    <option <?=$m6?> value="6">Junho</option>
                                    <option <?=$m7?> value="7">Julho</option>
                                    <option <?=$m8?> value="8">Agosto</option>
                                    <option <?=$m9?> value="9">Setembro</option>
                                    <option <?=$m10?> value="10">Outubro</option>
                                    <option <?=$m11?> value="11">Novembro</option>
                                    <option <?=$m12?> value="12">Dezembro</option>
                                </select>
                            </td>
                            <td><input type="text" id="atividade-agosto" name="atividade4"
                                    placeholder="Descreva a atividade" value="<?=$cronograma[3]["atividade"]?>"></td>
                        </tr>
                        <tr>
                                                        <td>
                                <?php
                                $m1 = "";
                                $m2 = "";
                                $m3 = "";
                                $m4 = "";
                                $m5 = "";
                                $m6 = "";
                                $m7 = "";
                                $m8 = "";
                                $m9 = "";
                                $m10 = "";
                                $m11 = "";
                                $m12 = "";
                                $selectMes = "m".$cronograma[4]["mes"];
                                $$selectMes = "selected";
                                ?>
                                <select id="mes" name="mes5">
                                    <option <?=$m1?> value="1">Janeiro</option>
                                    <option <?=$m2?> value="2">Fevereiro</option>
                                    <option <?=$m3?> value="3">Março</option>
                                    <option <?=$m4?> value="4">Abril</option>
                                    <option <?=$m5?> value="5">Maio</option>
                                    <option <?=$m6?> value="6">Junho</option>
                                    <option <?=$m7?> value="7">Julho</option>
                                    <option <?=$m8?> value="8">Agosto</option>
                                    <option <?=$m9?> value="9">Setembro</option>
                                    <option <?=$m10?> value="10">Outubro</option>
                                    <option <?=$m11?> value="11">Novembro</option>
                                    <option <?=$m12?> value="12">Dezembro</option>
                                </select>
                            </td>
                            <td><input type="text" id="atividade-agosto" name="atividade5"
                                    placeholder="Descreva a atividade" value="<?=$cronograma[4]["atividade"]?>"></td>
                        </tr>
                        <tr>
                                                        <td>
                                <?php
                                $m1 = "";
                                $m2 = "";
                                $m3 = "";
                                $m4 = "";
                                $m5 = "";
                                $m6 = "";
                                $m7 = "";
                                $m8 = "";
                                $m9 = "";
                                $m10 = "";
                                $m11 = "";
                                $m12 = "";
                                $selectMes = "m".$cronograma[5]["mes"];
                                $$selectMes = "selected";
                                ?>
                                <select id="mes" name="mes6">
                                    <option <?=$m1?> value="1">Janeiro</option>
                                    <option <?=$m2?> value="2">Fevereiro</option>
                                    <option <?=$m3?> value="3">Março</option>
                                    <option <?=$m4?> value="4">Abril</option>
                                    <option <?=$m5?> value="5">Maio</option>
                                    <option <?=$m6?> value="6">Junho</option>
                                    <option <?=$m7?> value="7">Julho</option>
                                    <option <?=$m8?> value="8">Agosto</option>
                                    <option <?=$m9?> value="9">Setembro</option>
                                    <option <?=$m10?> value="10">Outubro</option>
                                    <option <?=$m11?> value="11">Novembro</option>
                                    <option <?=$m12?> value="12">Dezembro</option>
                                </select>
                            </td>
                            <td><input type="text" id="atividade-agosto" name="atividade6"
                                    placeholder="Descreva a atividade" value="<?=$cronograma[5]["atividade"]?>"></td>
                        </tr>
                    </tbody>
                </table>
                    <input type="text" require style="display: none;" name="idProj" value="<?=$haeData["id_projeto"]?>">
                <button type="button" id="prev-2" class="next-btn">Voltar</button>
                <button type="submit" class="submit-btn">Enviar Formulário</button>
            </div>
        </form>
    </div>

    <section id="govsp-rodape">
        <div class="container rodape">
            <div class="logo-rodape">
                <a href="https://www.saopaulo.sp.gov.br/">
                    <img src="https://www.saopaulo.sp.gov.br/barra-govsp/img/logo-rodape-governo-do-estado-sp.png"
                        alt="site do Governo de São Paulo" width="206" height="38">
                </a>
            </div>
        </div>
    </section>
</body>

</html>