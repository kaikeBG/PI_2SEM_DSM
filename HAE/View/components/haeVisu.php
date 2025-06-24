<div id="fundoHaeVisu" style="
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100vw; height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 998;"
    onclick="closeVisu()">
</div>
<div id="haeVisu" style="position: fixed; display: none; top: 50%; left: 50%; transform: translate(-50%, -50%); height: 70%; width: 50%; overflow-y: auto; background-color: white; padding: 20px; box-shadow: 0 0 30px rgba(0,0,0,0.1); border-radius: 10px; z-index: 999;">
    <!-- Parte 1 -->
    <span class="fechar" onclick="closeVisu()">&times;</span>

    <h1>Visualizar - H.A.E.</h1>
    <div>
        <label for="professor">Professor(a):</label>
        <input disabled type="text" id="professor" name="professor" value="">
    </div>
    <div>
        <label for="email">E-mail:</label>
        <input disabled type="email" id="email" name="email" value="">
    </div>


    <label for="rg">R.G.:</label>
    <input disabled type="text" id="rg" name="rg" value="">

    <label for="matricula">Matrícula:</label>
    <input disabled type="text" id="matricula" name="matricula" value="">

    <label for="hora-aula">Hora-aula semanal na Fatec:</label>
    <input disabled type="number" id="hora-aula" name="hora-aula" value="">

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
                <td style="width: 20%;">
                    <label for="">1º Mês</label>
                </td>
                <td><input disabled type="text" id="atividade1" name="atividade-agosto"
                        placeholder="Descreva a atividade"></td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    <label for="">2º Mês</label>
                </td>
                <td><input disabled type="text" id="atividade2" name="atividade-agosto"
                        placeholder="Descreva a atividade"></td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    <label for="">3º Mês</label>
                </td>
                <td><input disabled type="text" id="atividade3" name="atividade-agosto"
                        placeholder="Descreva a atividade"></td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    <label for="">4º Mês</label>
                </td>
                <td><input disabled type="text" id="atividade4" name="atividade-agosto"
                        placeholder="Descreva a atividade"></td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    <label for="">5º Mês</label>
                </td>
                <td><input disabled type="text" id="atividade5" name="atividade-setembro"
                        placeholder="Descreva a atividade"></td>
            </tr>
            <tr>
                <td style="width: 20%;">
                    <label for="">6º Mês</label>
                </td>
                <td><input disabled type="text" id="atividade6" name="atividade-outubro"
                        placeholder="Descreva a atividade"></td>
            </tr>
        </tbody>
    </table>

</div>

<script defer>
    const meses = [
        "janeiro",
        "fevereiro",
        "março",
        "abril",
        "maio",
        "junho",
        "julho",
        "agosto",
        "setembro",
        "outubro",
        "novembro",
        "dezembro"
    ];

    const prof = document.querySelector("#professor");
    const rg = document.querySelector("#rg");
    const matri = document.querySelector("#matricula");
    const horaAula = document.querySelector("#hora-aula");
    const haeVisu = document.querySelector("#haeVisu");
    const email = document.querySelector("#email");

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


    const atividade1 = document.querySelector("#atividade1");

    const atividade2 = document.querySelector("#atividade2");

    const atividade3 = document.querySelector("#atividade3");

    const atividade4 = document.querySelector("#atividade4");

    const atividade5 = document.querySelector("#atividade5");

    const atividade6 = document.querySelector("#atividade6");

    const fundoHaeVisu = document.getElementById("fundoHaeVisu");


    function mostrarHae(chave) {
        // Parte 2 - Curso e período
        prof.value = dadosHae[chave]["nome_pro"];
        rg.value = dadosHae[chave]["rg_pro"];
        matri.value = dadosHae[chave]["id_pro"];
        horaAula.value = dadosHae[chave]["tempoHae"];
        selectTipoHae.value = dadosHae[chave]["tipo_hae"];
        email.value = dadosHae[chave]["email_pro"];
        tipoHae.value = dadosHae[chave]["tipo_hae"];


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


        atividade1.value = dadosHae[chave]["atv1"]
        atividade2.value = dadosHae[chave]["atv2"]
        atividade3.value = dadosHae[chave]["atv3"]
        atividade4.value = dadosHae[chave]["atv4"]
        atividade5.value = dadosHae[chave]["atv5"]
        atividade6.value = dadosHae[chave]["atv6"]

        haeVisu.style.display = "block"
        fundoHaeVisu.style.display = "block";
    }

    function closeVisu() {
        haeVisu.style.display = "none";
        fundoHaeVisu.style.display = "none";
    }
</script>