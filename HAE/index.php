<?php
session_start();
session_unset();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="assets/css/styles.css">
  <style>
    /* Adicionando estilos específicos para centralizar o formulário de login */
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f4f4f4;
      margin: 0;
    }

  </style>
</head>
<body>
  <?php
  // require "../View/components/vlibras.php"; <-- Está dando erro no login, não sei o motivo
  ?>
  <div class="login-container">
    <h2>Login do Edital</h2>
    <form action="./Controller/login.php" method="POST" id="loginForm">
      <input type="text" name="username" placeholder="Usuário" required>
      <input type="password" name="password" placeholder="Senha" required>

      <div>
        <input type="radio" name="role" value="coordenador" id="coordenador" required>
        <label for="coordenador">Coordenador</label>

        <input type="radio" name="role" value="professor" id="professor" required>
        <label for="professor">Professor</label>
      </div>

      <button type="submit" onclick="handleLogin()">Entrar</button>
    </form>
  </div>

  <script>
    function handleLogin() {
      event.preventDefault(); // Impede o envio imediato do formulário

      const coordenador = document.getElementById("coordenador").checked;
      const professor = document.getElementById("professor").checked;

      if (coordenador || professor) {
         document.getElementById("loginForm").submit();
      } else {
        alert("Selecione uma função para continuar!");
      }
    }
  </script>
</body>
</html>
