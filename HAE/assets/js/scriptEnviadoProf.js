
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

            // Criar célula para o Status (Somente exibição para o professor)
            const statusCell = newRow.insertCell();
            const statusText = document.createElement("span");
            statusText.textContent = "Status não definido"; // O status inicial

            // Atribuir o status conforme o coordenador (exemplo)
            // Aqui podemos ter uma lógica mais elaborada, por enquanto estamos mostrando o status do formulário
            // com base no que foi enviado pelo coordenador. Por exemplo, podemos simular com dados no localStorage.
            const status = formData.status || "deferido";  // Caso não tenha, ele assume "definido"
            switch (status) {
                case "deferido":
                    statusText.textContent = "Deferido";
                    statusText.style.color = "green";
                    break;
                case "indeferido":
                    statusText.textContent = "Indeferido";
                    statusText.style.color = "red";
                    break;
                case "parcial":
                    statusText.textContent = "Parcial";
                    statusText.style.color = "orange";
                    break;
                default:
                    statusText.textContent = "Status não definido";
                    break;
            }

            statusCell.appendChild(statusText);

            // Criar a célula para o botão de upload de arquivo
            const uploadCell = newRow.insertCell();
            const uploadButton = document.createElement('label');
            uploadButton.classList.add('upload-btn');  // Adiciona a classe estilizada

            // Adiciona o ícone ao botão
            uploadButton.innerHTML = `
                Enviar
                <input type="file" id="file-upload-${newRow.rowIndex}" accept="application/pdf, image/*, .docx, .xlsx" onchange="updateFileName(event, ${newRow.rowIndex})">
            `;

            // Adicionar o nome do arquivo ao lado do botão
            const fileNameDisplay = document.createElement('span');
            fileNameDisplay.classList.add('file-name');
            fileNameDisplay.id = `file-name-${newRow.rowIndex}`;
            uploadCell.appendChild(uploadButton);
            uploadCell.appendChild(fileNameDisplay);

            // Criar a célula para o botão de download
            const downloadCell = newRow.insertCell();
            const downloadButton = document.createElement('button');
            downloadButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 -960 960 960" width="50px" fill="#e8eaed">
                    <path d="M480-320 280-520l56-58 104 104v-326h80v326l104-104 56 58-200 200ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/>
                </svg>
            `;
            downloadButton.addEventListener('click', function () {
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

                doc.save("formulario_enviado.pdf");
            });
            downloadCell.appendChild(downloadButton);

            // Criar a célula para o botão de editar
            const editCell = newRow.insertCell();
            const editButton = document.createElement('button');
            editButton.textContent = 'Editar';

            // Adicionar o evento de clique para o botão de editar
            editButton.addEventListener('click', function () {
                // A função openEditForm agora é chamada com os dados da linha
                window.location.href = "../view/editarHAE.php";
            });
            editCell.appendChild(editButton);
        }

        //Função para abrir o formulário de edição e preencher os campos com as informações
       

        // Função para atualizar o nome do arquivo no botão
        function updateFileName(event, rowIndex) {
            const fileInput = event.target;
            const fileNameDisplay = document.getElementById(`file-name-${rowIndex}`);
            const file = fileInput.files[0];

            if (file) {
                fileNameDisplay.textContent = file.name;  // Exibe o nome do arquivo
            } else {
                fileNameDisplay.textContent = '';  // Caso o usuário não selecione nenhum arquivo
            }
        }