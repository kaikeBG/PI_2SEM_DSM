<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordenador</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script defer src="../assets/js/scriptEnviado.js"></script>
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
            <li><a href="enviado.php">Acompanhamento</a></li>
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
                    <th>Edital</th>
                    <th>Relatorio</th>
                </tr>

            </thead>
            <tbody id="formTableBody">
                <!-- Linhas serão adicionadas aqui dinamicamente -->
            </tbody>
        </table>

        <!-- Popup de Justificativa -->
        <div id="justificationModal" class="justification-modal">
            <div class="justification-modal-content">
                <span class="close" onclick="closeJustificationForm()">&times;</span>
                <h2>Justificativa para Status </h2>
                <textarea id="justification-text" rows="4" cols="50"
                    placeholder="Escreva sua justificativa..."></textarea><br>
                <button onclick="submitJustification()">Salvar Justificativa</button>
            </div>
        </div>
    </div>

</body>

</html>