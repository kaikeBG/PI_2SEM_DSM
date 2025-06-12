<div id="haeVisu" style="position: fixed; display: none; top: 50%; left: 50%; transform: translate(-50%, -50%); height: 70%; width: 50%; overflow-y: auto; background-color: white; padding: 20px; box-shadow: 0 0 30px rgba(0,0,0,0.1); border-radius: 10px;">
    <!-- Parte 1 -->
    <span class="fechar" onclick="closeVisu()">&times;</span>

    <h1>Visualizar - H.A.E.</h1>
    <div>
        <label for="professor">Professor(a):</label>
        <input disabled type="text" id="professor" name="professor" value="<?= $formData["nome_pro"] ?>">
    </div>
    <div>
        <label for="email">E-mail:</label>
        <input disabled type="email" id="email" name="email" value="<?= $formData["email_pro"] ?>">
    </div>


    <label for="rg">R.G.:</label>
    <input disabled type="text" id="rg" name="rg" value="<?= $formData["rg_pro"] ?>">

    <label for="matricula">Matrícula:</label>
    <input disabled type="text" id="matricula" name="matricula" value="<?= $formData["id_pro"] ?>">

    <label for="hora-aula">Hora-aula semanal na Fatec:</label>
    <input disabled type="number" id="hora-aula" name="hora-aula" value="<?= $formData["tempoHae"] ?>">

    <label for="outras-fatecs">Tem aula atribuída em outra(s) Fatec(s)?</label>
    <select id="outras-fatecs" name="outras-fatecs" disabled>
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

    <label for="tipoHae">Tipo de HAE que está solicitando:</label>
    <input disabled id="tipoHae" name="tipoHae" type="text" required>


    <!-- P arte 2 -->

    <label for="opcao">Escolha uma curso:</label>
    <input disabled id="opcao" name="opcao" type="text">

    <div id="containerNumero" style=" margin-top: 10px;">
        <label for="numero">Qtd. de H.A.E. para Estágio Supervisionado:</label>
        <input disabled type="number" id="numeroHAE" name="numeroHAE">
    </div>


    <div class="titulo-sessao">Período do Projeto</div>
    <label for="inicio">Início do Projeto:</label>
    <input disabled type="date" id="inicio" name="inicio" required>

    <label for="termino">Término do Projeto:</label>
    <input disabled type="date" id="termino" name="termino" required>

    <div class="titulo-sessao">Metas Relacionadas ao Projeto</div>
    <div class="form-group">
        <label for="metas">Descreva as metas do projeto:</label>
        <textarea disabled id="metas" name="metas" rows="3"></textarea>
    </div>


    <!-- Parte 3 -->

    <div class="titulo-sessao">Objetivos do Projeto</div>
    <textarea disabled id="objetivos" name="objet" rows="3"></textarea>

    <div class="titulo-sessao">Justificativas do Projeto</div>
    <textarea disabled id="justificativas" name="just" rows="3"></textarea>

    <div class="titulo-sessao">Recursos Materiais e Humanos</div>
    <textarea disabled id="recursos" name="recur" rows="3"></textarea>

    <div class="titulo-sessao">Resultado Esperado</div>
    <textarea disabled id="resultado" name="resul" rows="2"></textarea>

    <div class="titulo-sessao">Metodologia</div>
    <textarea disabled id="metodologia" name="metodo" rows="2"></textarea>

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
                    <select id="mes" name="mes1">
                        <option value="">-- Selecione o mês -- </option>
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
                <td><input disabled type="text" id="atividade-agosto" name="atividade-agosto"
                        placeholder="Descreva a atividade"></td>
            </tr>
            <tr>
                <td>
                    <select id="mes" name="mes2">
                        <option value="">-- Selecione o mês -- </option>
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
                <td><input disabled type="text" id="atividade-agosto" name="atividade-agosto"
                        placeholder="Descreva a atividade"></td>
            </tr>
            <tr>
                <td>
                    <select id="mes" name="mes3">
                        <option value="">-- Selecione o mês -- </option>
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
                <td><input disabled type="text" id="atividade-agosto" name="atividade-agosto"
                        placeholder="Descreva a atividade"></td>
            </tr>
            <tr>
                <td>
                    <select id="mes" name="mes4">
                        <option value="">-- Selecione o mês -- </option>
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
                <td><input disabled type="text" id="atividade-agosto" name="atividade-agosto"
                        placeholder="Descreva a atividade"></td>
            </tr>
            <tr>
                <td>
                    <select id="mes" name="mes5">
                        <option value="">-- Selecione o mês -- </option>
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
                <td><input disabled type="text" id="atividade-setembro" name="atividade-setembro"
                        placeholder="Descreva a atividade"></td>
            </tr>
            <tr>
                <td>
                    <select id="mes" name="mes6">
                        <option value="">-- Selecione o mês -- </option>
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
                <td><input disabled type="text" id="atividade-outubro" name="atividade-outubro"
                        placeholder="Descreva a atividade"></td>
            </tr>
        </tbody>
    </table>

</div>

<script defer>
    const haeVisu = document.querySelector("#haeVisu")

    // Parte 1 - Informações do professor
    const inputProfessor = document.querySelector("#professor");
    const inputEmail = document.querySelector("#email");
    const inputRg = document.querySelector("#rg");
    const inputMatricula = document.querySelector("#matricula");
    const inputHoraAula = document.querySelector("#hora-aula");
    const selectOutrasFatecs = document.querySelector("#outras-fatecs");
    const selectTipoHae = document.querySelector("#tipoHae");

    // Parte 2 - Curso e período
    const inputCurso = document.querySelector("#opcao");
    const inputQtdHae = document.querySelector("#numeroHAE");
    const inputInicioProjeto = document.querySelector("#inicio");
    const inputTerminoProjeto = document.querySelector("#termino");
    const textareaMetas = document.querySelector("#metas");

    // Parte 3 - Detalhes do projeto
    const textareaObjetivos = document.querySelector("#objetivos");
    const textareaJustificativas = document.querySelector("#justificativas");
    const textareaRecursos = document.querySelector("#recursos");
    const textareaResultado = document.querySelector("#resultado");
    const textareaMetodologia = document.querySelector("#metodologia");


    function mostrarHae(chave) {
        // Parte 2 - Curso e período
        selectTipoHae.value = dadosHae[chave]["tipo_hae"];


        inputCurso.value = dadosHae[chave]["id_curFat"]
        inputQtdHae.value = dadosHae[chave]["qtd_horas"]
        inputInicioProjeto.value = dadosHae[chave]["data_inicio"]
        inputTerminoProjeto.value = dadosHae[chave]["data_termino"]
        textareaMetas.value = dadosHae[chave]["metas"]

        // Parte 3 - Detalhes do projeto
        textareaObjetivos.value = dadosHae[chave]["objetivos"]
        textareaJustificativas.value = dadosHae[chave]["justificativas"]
        textareaRecursos.value = dadosHae[chave]["recursos"]
        textareaResultado.value = dadosHae[chave]["resultado_esperado"]
        textareaMetodologia.value = dadosHae[chave]["metodologia"]

        haeVisu.style.display = "block"
    }

    function closeVisu(){
        haeVisu.style.display = "none"
    }
</script>