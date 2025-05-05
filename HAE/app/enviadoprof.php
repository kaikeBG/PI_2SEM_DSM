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
    require "../components/header.php";
    require "../components/vlibras.php";

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
                <!-- Linhas serão adicionadas aqui dinamicamente -->
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



</body>

</html>