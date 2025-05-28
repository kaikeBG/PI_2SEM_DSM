

function showPopup(message){
    const modal = document.querySelector("#popupAviso");
    let popupMessage = document.createElement("p")
    popupMessage.innerText = message
    modal.children[0].appendChild(popupMessage);
    modal.style.display = "block";
}

function closePopup(){
    const modal = document.querySelector("#popupAviso");
    modal.children[0].removeChild(modal.children[0].children[1]);
    modal.style.display = "none";
}

// Função para verificar se a parte anterior foi preenchida corretamente
function checkPartCompleted(partId) {
    const fields = document.querySelectorAll(`#${partId} input, #${partId} select, #${partId} textarea`);
    for (const field of fields) {
        if (!field.value) {
            return false; // Caso algum campo não esteja preenchido
        }
    }

    return true; // Todos os campos estão preenchidos
}


function validarDatas() {
    const inicio = document.getElementById("inicio").value;
    const termino = document.getElementById("termino").value;

    if (inicio && termino && termino < inicio) {
        showPopup("A data de término não pode ser anterior à data de início."); 
        return false;
    } else {
        return true;
    }
}


function mostrarInput() {
    const selecao = document.getElementById("opcao").value;
    const campoNumero = document.getElementById("numero");
    const containerNumero = document.getElementById("containerNumero");

    if (selecao !== "") {
        containerNumero.style.display = "block";
    
    } else {
        containerNumero.style.display = "none";
        
    }
}

// Função para atualizar a barra de progresso
function updateProgressBar() {
    const totalParts = 3;
    let completedParts = 0;
    for (let i = 1; i <= totalParts; i++) {
        if (checkPartCompleted(`part-${i}`)) {
            completedParts++;
        }
    }
    const progress = (completedParts / totalParts) * 100;
    document.getElementById("progress-bar").style.width = progress + "%";
}


// Função de navegação entre as partes
document.querySelector("#next-1").addEventListener("click", function () {
    if (checkPartCompleted("part-1")) {
        document.getElementById("part-1").style.display = "none";
        document.getElementById("part-2").style.display = "block";
        updateProgressBar();
    } else {
                showPopup("PPor favor, preencha todos os campos antes de enviar.");
    }
});

document.querySelector("#next-2").addEventListener("click", function () {
         if(!validarDatas()){
            return
         }
        
    if (checkPartCompleted("part-2")) {
        document.getElementById("part-2").style.display = "none";
        document.getElementById("part-3").style.display = "block";
        updateProgressBar();
    } else {
                showPopup("Por favor, preencha todos os campos antes de enviar.");
    }
});

document.querySelector("#prev-1").addEventListener("click", function () {
    document.getElementById("part-2").style.display = "none";
    document.getElementById("part-1").style.display = "block";
});

document.querySelector("#prev-2").addEventListener("click", function () {
    document.getElementById("part-3").style.display = "none";
    document.getElementById("part-2").style.display = "block";
});

// Validação geral ao submeter o formulário

function validateForm() {
    event.preventDefault()
    if (!checkPartCompleted("part-1") || !checkPartCompleted("part-2") || !checkPartCompleted("part-3")) {
        alert("Por favor, preencha todos os campos antes de enviar.");
        return false;
    }

    if (validarDatas()) {
        alert("A data de término não pode ser anterior à data de início.");
        return false;
    };

    // Coletando os dados do formulário
    const formData = {
        professor: document.querySelector("#professor").value,
        email: document.querySelector("#email").value,
        rg: document.querySelector("#rg").value,
        matricula: document.querySelector("#matricula").value,
        horaAula: document.querySelector("#hora-aula").value,
        outrasFatecs: document.querySelector("#outras-fatecs").value,
        tipoHAE: document.querySelector("#tipo-hae").value,
        metas: document.querySelector("#metas").value,
        objetivos: document.querySelector("#objetivos").value,
        justificativas: document.querySelector("#justificativas").value,
        recursos: document.querySelector("#recursos").value,
        resultado: document.querySelector("#resultado").value,
        metodologia: document.querySelector("#metodologia").value
    };

    // Armazenar os dados no localStorage
    localStorage.setItem("formData", JSON.stringify(formData));

    window.location.href = "enviadoprof.php";

}
function gerarPDF() {
    const professor = document.getElementById("professor").value;
    const email = document.getElementById("email").value;
    const rg = document.getElementById("rg").value;
    const matricula = document.getElementById("matricula").value;
    const horaAula = document.getElementById("hora-aula").value;
    const outrasFatecs = document.getElementById("outras-fatecs").value;
    const tipoHAE = document.getElementById("tipo-hae").value;
    const metas = document.getElementById("metas").value;
    const objetivos = document.getElementById("objetivos").value;
    const justificativas = document.getElementById("justificativas").value;
    const recursos = document.getElementById("recursos").value;
    const resultado = document.getElementById("resultado").value;
    const metodologia = document.getElementById("metodologia").value;

    const doc = new jsPDF();

    // Adicionando título e dados do formulário no PDF
    doc.setFontSize(18);
    doc.text("Formulário HAE", 20, 20);

    doc.setFontSize(12);
    doc.text("Professor(a): " + professor, 20, 30);
    doc.text("E-mail: " + email, 20, 40);
    doc.text("RG: " + rg, 20, 50);
    doc.text("Matrícula: " + matricula, 20, 60);
    doc.text("Hora-aula semanal: " + horaAula, 20, 70);
    doc.text("Aula em outras Fatecs: " + outrasFatecs, 20, 80);
    doc.text("Tipo de HAE: " + tipoHAE, 20, 90);

    // Adicionando mais seções
    doc.text("Metas do Projeto: " + metas, 20, 110);
    doc.text("Objetivos do Projeto: " + objetivos, 20, 120);
    doc.text("Justificativas: " + justificativas, 20, 130);
    doc.text("Recursos: " + recursos, 20, 140);
    doc.text("Resultado Esperado: " + resultado, 20, 150);
    doc.text("Metodologia: " + metodologia, 20, 160);

    // Salvar o PDF
    doc.save("formulario_hae.pdf");
}




/* teste codigo mais completo, porém nao funcional ate o momento, nao considerar


function checkPartCompleted(partId) {
    const fields = document.querySelectorAll(`#${partId} input, #${partId} select, #${partId} textarea`);
    for (const field of fields) {
        console.log(`Verificando campo: ${field.id}`);
        if (!field.value && !field.classList.contains('optional')) {
            console.log(`Campo ${field.id} não preenchido ou obrigatório.`);
            return false; // Caso algum campo não esteja preenchido
        }
    }
    console.log(`Parte ${partId} está completa.`);
    return true; // Todos os campos estão preenchidos
}

// Função para validar se ao menos um dos campos de curso foi preenchido na Parte 2
function checkCursoHoraPreenchido() {
    const cursos = ['#cst-gti', '#cst-gpi', '#cst-ge', '#cst-dsm'];
    let preenchido = false;
    cursos.forEach(curso => {
        const campo = document.querySelector(curso);
        console.log(`Verificando campo de curso: ${campo.id}, valor: ${campo.value}`);
        if (campo && campo.value) {
            preenchido = true; // Se qualquer campo de curso estiver preenchido
        }
    });
    return preenchido; // Retorna true se algum campo de curso foi preenchido
}

// Função para desabilitar os campos de hora dos outros cursos
function desabilitarCamposCurso(except) {
    const cursos = ['#cst-gti', '#cst-gpi', '#cst-ge', '#cst-dsm'];
    cursos.forEach(curso => {
        const campo = document.querySelector(curso);
        if (campo.id !== except) {
            console.log(`Desabilitando campo: ${campo.id}`);
            campo.disabled = true; // Desabilita o campo de hora dos outros cursos
        }
    });
}

// Função para habilitar todos os campos de hora dos cursos
function habilitarTodosCamposCurso() {
    const cursos = ['#cst-gti', '#cst-gpi', '#cst-ge', '#cst-dsm'];
    cursos.forEach(curso => {
        const campo = document.querySelector(curso);
        console.log(`Habilitando campo: ${campo.id}`);
        campo.disabled = false; // Habilita todos os campos de hora
    });
}

// Adicionando evento para monitorar mudanças nos campos de hora de curso
document.querySelectorAll('#cst-gti, #cst-gpi, #cst-ge, #cst-dsm').forEach(campo => {
    campo.addEventListener('input', function () {
        if (this.value) {
            desabilitarCamposCurso(this.id); // Desabilita os outros campos ao preencher um
        } else {
            habilitarTodosCamposCurso(); // Habilita todos os campos quando o campo for apagado
        }
    });
});

// Função para atualizar a barra de progresso
function updateProgressBar() {
    const totalParts = 3;
    let completedParts = 0;

    // Verifica se as partes estão preenchidas corretamente
    for (let i = 1; i <= totalParts; i++) {
        if (checkPartCompleted(`part-${i}`)) {
            completedParts++;
        }
    }

    // Atualiza a largura da barra de progresso com base na parte completada
    const progress = (completedParts / totalParts) * 100;
    console.log(`Progresso: ${progress}%`);
    document.getElementById("progress-bar").style.width = `${progress}%`;
}

// Função de navegação entre as partes
document.querySelector("#next-1").addEventListener("click", function () {
    if (checkPartCompleted("part-1")) {
        document.getElementById("part-1").style.display = "none";
        document.getElementById("part-2").style.display = "block";
        updateProgressBar(); // Atualiza a barra de progresso ao passar para a Parte 2
    } else {
        alert("Por favor, preencha todos os campos obrigatórios da Parte 1.");
    }
});

document.querySelector("#next-2").addEventListener("click", function () {
    const inicio = document.getElementById("inicio").value;
    const termino = document.getElementById("termino").value;
    const metas = document.getElementById("metas").value;

    if (!inicio || !termino || !metas) {
        alert("Por favor, preencha todos os campos obrigatórios da Parte 2.");
        return; // Impede o avanço para a Parte 3
    }

    if (checkCursoHoraPreenchido()) {
        document.getElementById("part-2").style.display = "none";
        document.getElementById("part-3").style.display = "block";
        updateProgressBar(); // Atualiza a barra de progresso ao passar para a Parte 3
    } else {
        alert("Por favor, insira a hora em pelo menos um curso.");
    }
});

document.querySelector("#prev-1").addEventListener("click", function () {
    document.getElementById("part-2").style.display = "none";
    document.getElementById("part-1").style.display = "block";
    updateProgressBar(); // Atualiza a barra de progresso ao voltar para a Parte 1
});

document.querySelector("#prev-2").addEventListener("click", function () {
    document.getElementById("part-3").style.display = "none";
    document.getElementById("part-2").style.display = "block";
    updateProgressBar(); // Atualiza a barra de progresso ao voltar para a Parte 2
});

// Validação geral ao submeter o formulário
function validateForm() {
    console.log("Validando formulário...");
    if (!checkPartCompleted("part-1") || !checkPartCompleted("part-2") || !checkPartCompleted("part-3")) {
        alert("Por favor, preencha todos os campos antes de enviar.");
        return false;
    }

    // Coletando os dados do formulário
    const formData = {
        professor: document.querySelector("#professor").value,
        email: document.querySelector("#email").value,
        rg: document.querySelector("#rg").value,
        matricula: document.querySelector("#matricula").value,
        horaAula: document.querySelector("#hora-aula").value,
        outrasFatecs: document.querySelector("#outras-fatecs").value,
        tipoHAE: document.querySelector("#tipo-hae").value,
        metas: document.querySelector("#metas").value,
        objetivos: document.querySelector("#objetivos").value,
        justificativas: document.querySelector("#justificativas").value,
        recursos: document.querySelector("#recursos").value,
        resultado: document.querySelector("#resultado").value,
        metodologia: document.querySelector("#metodologia").value
    };

    // Armazenar os dados no localStorage
    localStorage.setItem("formData", JSON.stringify(formData));

    // Redirecionar para a página de sucesso
    window.location.href = "enviadoprof.html";

    return false; // Impede o envio tradicional do formulário
}

// Função para salvar os dados no localStorage e redirecionar para a página de sucesso
function saveToLocalStorage() {
    const professor = document.getElementById("professor").value;
    const email = document.getElementById("email").value;
    const rg = document.getElementById("rg").value;
    const matricula = document.getElementById("matricula").value;
    const horaAula = document.getElementById("hora-aula").value;
    const outrasFatecs = document.getElementById("outras-fatecs").value;
    const tipoHAE = document.getElementById("tipo-hae").value;
    const metas = document.getElementById("metas").value;
    const objetivos = document.getElementById("objetivos").value;
    const justificativas = document.getElementById("justificativas").value;
    const recursos = document.getElementById("recursos").value;
    const resultado = document.getElementById("resultado").value;
    const metodologia = document.getElementById("metodologia").value;

    localStorage.setItem("professor", professor);
    localStorage.setItem("email", email);
    localStorage.setItem("rg", rg);
    localStorage.setItem("matricula", matricula);
    localStorage.setItem("horaAula", horaAula);
    localStorage.setItem("outrasFatecs", outrasFatecs);
    localStorage.setItem("tipoHAE", tipoHAE);
    localStorage.setItem("metas", metas);
    localStorage.setItem("objetivos", objetivos);
    localStorage.setItem("justificativas", justificativas);
    localStorage.setItem("recursos", recursos);
    localStorage.setItem("resultado", resultado);
    localStorage.setItem("metodologia", metodologia);

    // Gerar PDF
    const doc = new jsPDF();
    doc.text(`Professor: ${professor}`, 10, 10);
    doc.text(`E-mail: ${email}`, 10, 20);
    doc.text(`RG: ${rg}`, 10, 30);
    doc.text(`Matrícula: ${matricula}`, 10, 40);
    doc.text(`Horas de Aula: ${horaAula}`, 10, 50);
    doc.text(`Outras Fatecs: ${outrasFatecs}`, 10, 60);
    doc.text(`Tipo de HAE: ${tipoHAE}`, 10, 70);
    doc.text(`Metas: ${metas}`, 10, 80);
    doc.text(`Objetivos: ${objetivos}`, 10, 90);
    doc.text(`Justificativas: ${justificativas}`, 10, 100);
    doc.text(`Recursos: ${recursos}`, 10, 110);
    doc.text(`Resultado Esperado: ${resultado}`, 10, 120);
    doc.text(`Metodologia: ${metodologia}`, 10, 130);

    // Gerar o PDF
    doc.save('relatorio.pdf');
}*/
