<?php
    session_start();
    extract($_SESSION);
    require("../Model/Professor.php");
    $prof = new Professor();
    $cur = $prof->getCurProf($id);
    $formData = $prof->getFormData($id);
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
    <script src="../assets/js/script.js" defer></script> <!-- Carrega o JS externo -->

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
    </div>

    <nav>
        <ul>
            <li><a href="../index.php">Voltar para o Login</a></li>
            <li><a href="edital.php">Inscrição</a></li>
            <li><a href="enviadoprof.php">Acompanhamento</a></li>
        </ul>
    </nav>

    <div class="central">
        <!-- Barra de Progresso -->
        <div class="progress-container">
            <div class="progress-bar" id="progress-bar"></div>
        </div>

        <form name="haeForm" onsubmit="return validateForm()">
            <!-- Parte 1 -->
            <div class="form-part active" id="part-1">
                <h1>Inscrição - H.A.E.</h1>

                <label for="professor">Professor(a):</label>
                <input type="text" id="professor" name="professor" value="<?=$formData["nome_pro"]?>" disabled>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="<?=$formData["email_pro"]?>" disabled>

                <label for="rg">R.G.:</label>
                <input type="text" id="rg" name="rg" value="<?=$formData["rg_pro"]?>" disabled>

                <label for="matricula">Matrícula:</label>
                <input type="text" id="matricula" name="matricula" value="<?=$formData["id_pro"]?>" disabled>

                <label for="hora-aula">Hora-aula semanal na Fatec:</label>
                <input type="number" id="hora-aula" name="hora-aula" value="<?=$formData["tempoHae"]?>" disabled>

                <label for="outras-fatecs">Tem aula atribuída em outra(s) Fatec(s)?</label>
                <select id="outras-fatecs" name="outras-fatecs" required>
                    <option value="">Selecione</option>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </select>

                <label for="tipo-hae">Tipo de HAE que está solicitando:</label>
                <select id="tipo-hae" name="tipo-hae" required>
                    <option value="Estágio Supervisionado">Estágio Supervisionado</option>
                    <option value="Trabalho de Graduação">Trabalho de Graduação</option>
                </select>

                <button type="button" id="next-1" class="next-btn">Próximo</button>
            </div>

            <!-- Parte 2 -->
            <div class="form-part" id="part-2">
                <label for="opcao">Escolha uma curso:</label>
                    <select id="opcao" name="opcao" onchange="mostrarInput()">
                     <?php
                     foreach ($cur as $key => $curso) {
                     ?>
                     <option value="<?=$curso["id_matCurFat"]?>"><?=$curso["nome_mat"]?> de <?=$curso["nome_cur"]?></option>
                    <?php
                     }
                     ?>
                    </select>

                <div id="containerNumero" style="display: none; margin-top: 10px;">
                    <label for="numero">Qtd. de H.A.E. para Estágio Supervisionado:</label>
                    <input type="number" id="numeroHAE" name="numeroHAE" disabled>
                </div>


                <div class="titulo-sessao">Período do Projeto</div>
                <label for="inicio">Início do Projeto:</label>
                <input type="date" id="inicio" name="inicio" required>

                <label for="termino">Término do Projeto:</label>
                <input type="date" id="termino" name="termino" required onblur="validarDatas()">

                <div class="titulo-sessao">Metas Relacionadas ao Projeto</div>
                <div class="form-group">
                    <label for="metas">Descreva as metas do projeto:</label>
                    <textarea id="metas" rows="3"></textarea>
                </div>

                <button type="button" id="prev-1" class="next-btn">Voltar</button>
                <button type="button" id="next-2" class="next-btn">Próximo</button>
            </div>

            <!-- Parte 3 -->
            <div class="form-part" id="part-3">
                <div class="titulo-sessao">Objetivos do Projeto</div>
                <textarea id="objetivos" rows="3"></textarea>

                <div class="titulo-sessao">Justificativas do Projeto</div>
                <textarea id="justificativas" rows="3"></textarea>

                <div class="titulo-sessao">Recursos Materiais e Humanos</div>
                <textarea id="recursos" rows="3"></textarea>

                <div class="titulo-sessao">Resultado Esperado</div>
                <textarea id="resultado" rows="2"></textarea>

                <div class="titulo-sessao">Metodologia</div>
                <textarea id="metodologia" rows="2"></textarea>

                <div class="titulo-sessao">Cronograma de Execução</div>
                <table>
                    <thead>
                        <tr>
                            <th>Mês</th>
                            <th>Atividade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select id="mes" name="mes1">
                                    <option value="Janeiro">Janeiro</option>
                                    <option value="Fevereiro">Fevereiro</option>
                                    <option value="Março">Março</option>
                                    <option value="Abril">Abril</option>
                                    <option value="Maio">Maio</option>
                                    <option value="Junho">Junho</option>
                                    <option value="Julho">Julho</option>
                                    <option value="Agosto">Agosto</option>
                                    <option value="Setembro">Setembro</option>
                                    <option value="Outubro">Outubro</option>
                                    <option value="Novembro">Novembro</option>
                                    <option value="Dezembro">Dezembro</option>
                                </select>
                            </td>
                            <td><input type="text" id="atividade-agosto" name="atividade-agosto"
                                    placeholder="Descreva a atividade"></td>
                        </tr>
                        <tr>
                            <td>
                                <select id="mes" name="mes2">
                                    <option value="Janeiro">Janeiro</option>
                                    <option value="Fevereiro">Fevereiro</option>
                                    <option value="Março">Março</option>
                                    <option value="Abril">Abril</option>
                                    <option value="Maio">Maio</option>
                                    <option value="Junho">Junho</option>
                                    <option value="Julho">Julho</option>
                                    <option value="Agosto">Agosto</option>
                                    <option value="Setembro">Setembro</option>
                                    <option value="Outubro">Outubro</option>
                                    <option value="Novembro">Novembro</option>
                                    <option value="Dezembro">Dezembro</option>
                                </select>
                            </td>
                            <td><input type="text" id="atividade-setembro" name="atividade-setembro"
                                    placeholder="Descreva a atividade"></td>
                        </tr>
                        <tr>
                            <td>
                                <select id="mes" name="mes3">
                                    <option value="Janeiro">Janeiro</option>
                                    <option value="Fevereiro">Fevereiro</option>
                                    <option value="Março">Março</option>
                                    <option value="Abril">Abril</option>
                                    <option value="Maio">Maio</option>
                                    <option value="Junho">Junho</option>
                                    <option value="Julho">Julho</option>
                                    <option value="Agosto">Agosto</option>
                                    <option value="Setembro">Setembro</option>
                                    <option value="Outubro">Outubro</option>
                                    <option value="Novembro">Novembro</option>
                                    <option value="Dezembro">Dezembro</option>
                                </select>
                            </td>
                            <td><input type="text" id="atividade-outubro" name="atividade-outubro"
                                    placeholder="Descreva a atividade"></td>
                        </tr>
                    </tbody>
                </table>

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
