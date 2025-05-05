// Recuperar os dados do localStorage
const formData = JSON.parse(localStorage.getItem("formData"));

if (formData) {
    // Adicionar os dados na tabela
    const tableBody = document.getElementById("formTableBody");

    const newRow = tableBody.insertRow();

    // Adicionar células à nova linha
    newRow.insertCell().textContent = new Date().getTime(); // Id gerado com base no timestamp
    newRow.insertCell().textContent = formData.professor;
    newRow.insertCell().textContent = new Date().toLocaleString(); // Data de envio
    newRow.insertCell().textContent = formData.tipoHAE; // Título da HAE

    // Criar célula para Status (Novo campo)
    const statusCell = newRow.insertCell();
    const statusSelect = document.createElement("select");
    statusSelect.className = "status-select";
    const options = ["Deferido", "Indeferido", "Parcial"];
    options.forEach(option => {
        const optionElement = document.createElement("option");
        optionElement.value = option;
        optionElement.textContent = option.charAt(0).toUpperCase() + option.slice(1);
        statusSelect.appendChild(optionElement);
    });

    // Adicionar o evento de mudança de status
    statusSelect.addEventListener("change", handleStatusChange);

    statusCell.appendChild(statusSelect);

    // Criar célula para o primeiro botão de download
    const downloadCell1 = newRow.insertCell();
    const downloadButton1 = document.createElement('button');
    downloadButton1.innerHTML = `
<svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 -960 960 960" width="50px" fill="#e8eaed">
<path d="M480-320 280-520l56-58 104 104v-326h80v326l104-104 56 58-200 200ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/>
</svg>
`;
    downloadButton1.addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Adicionar título do PDF
        doc.text("Formulário Enviado", 20, 20);

        // Adicionar os dados do formulário ao PDF
        let yPosition = 30;
        for (const key in formData) {
            if (formData.hasOwnProperty(key)) {
                doc.text(`${key}: ${formData[key]}`, 20, yPosition);
                yPosition += 10;
            }
        }

        // Salvar o arquivo com o nome específico
        doc.save("formulario_enviado_1.pdf");
    });
    downloadCell1.appendChild(downloadButton1);

    // Criar célula para o segundo botão de download
    const downloadCell2 = newRow.insertCell();
    const downloadButton2 = document.createElement('button');
    downloadButton2.innerHTML = `
<svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 -960 960 960" width="50px" fill="#e8eaed">
<path d="M480-320 280-520l56-58 104 104v-326h80v326l104-104 56 58-200 200ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/>
</svg>
`;
    downloadButton2.addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Adicionar título do PDF do Relatório Mensal
        doc.text("Relatório Mensal", 15, 15);

        // Adicionar o conteúdo do relatório mensal
        let yPosition = 30;
        const relatorioMensal = `
Relatório Mensal: Novembro de 2024

Este relatório foi gerado com base nos dados fornecidos.

**Resumo:**
- Total de alunos: 120
- Total de aulas realizadas: 15
- Aulas canceladas: 3

**Detalhes:**
As aulas decorreram conforme o planejamento,
com algumas interrupções devido a imprevistos climáticos.
A participação dos alunos foi excelente
 e o desempenho geral foi positivo.

**Recomendações:**
- Melhorar a comunicação sobre os horários das aulas.
- Garantir que as aulas possam ser transferidas para 
outro dia quando houver imprevistos.
`;

        // Adicionar o relatório no PDF
        doc.text(relatorioMensal, 20, yPosition);

        // Salvar o arquivo com o nome específico
        doc.save("Relatorio_Mensal.pdf");
    });
    downloadCell2.appendChild(downloadButton2);

}

// Função para tratar a mudança no status
function handleStatusChange(event) {
    const status = event.target.value;

    if (status === "Parcial" || status === "Indeferido") {
        openJustificationForm();
    }
}

// Função para abrir o formulário de justificativa
function openJustificationForm() {
    document.getElementById("justificationModal").style.display = "block";
}

// Função para fechar o formulário de justificativa
function closeJustificationForm() {
    document.getElementById("justificationModal").style.display = "none";
}

// Função para salvar a justificativa
function submitJustification() {
    const justification = document.getElementById("justification-text").value;
    console.log("Justificativa salva:", justification);
    closeJustificationForm();
}

window.onclick = function (event) {
    if (event.target == document.getElementById("justificationModal")) {
        closeJustificationForm();
    }
};