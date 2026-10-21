<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="imagens/favicon.jpg" type="image/x-icon" />
  <title>SAMU-JANDIRA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/signin.css" rel="stylesheet">
</head>

<body>
  <div class="main-container">
    <div class="content-wrapper">
      <!-- Logo e Título -->
      <div class="logo-title-main">
        <h1>
          <img class="brand-city" src="imagens/logo prefeitura de jandira   azul 2b4ebb-01.png" alt="Prefeitura de Jandira">
          <span class="site-title">SAMU JANDIRA</span>
          <img class="brand-samu" src="imagens/samu-192_logo.png" alt="SAMU 192">
        </h1>
        <p class="subtitle">Sistema de Atendimento Móvel de Urgência</p>
      </div>

      <!-- Card de Login -->
      <div class="login-card">
        <div class="login-header">
          <h2>Acesso ao Sistema</h2>
        </div>

        <div class="login-body">
          <form class="form-signin" method="POST" action="valida.php">

            <div class="mb-4">
              <label for="inputEmail" class="form-label">E-mail</label>
              <input
                type="email"
                name="txt_usuario"
                id="inputEmail"
                class="form-control"
                placeholder="Digite seu e-mail"
                autocomplete="username"
                required
                autofocus>
            </div>

            <div class="mb-4">
              <label for="inputPassword" class="form-label">Senha</label>
              <input
                type="password"
                name="txt_senha"
                id="inputPassword"
                class="form-control"
                placeholder="Digite sua senha"
                autocomplete="current-password"
                required>
            </div>

            <div class="d-grid">
              <button class="btn btn-lg btn-login" type="submit">
                Acessar Sistema
              </button>
            </div>
            <p class="text-center text-danger">
              <?php
              if (isset($_SESSION['loginErro'])) {
                echo $_SESSION['loginErro'];
                unset($_SESSION['loginErro']);
              }
              ?>
            </p>

            <p class="text-center text-success">
              <?php
              if (isset($_SESSION['loginDeslogado'])) {
                echo $_SESSION['loginDeslogado'];
                unset($_SESSION['loginDeslogado']);
              }
              ?>
            </p>

          </form>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-3 footer-section">
            <h5>Prefeitura de Jandira</h5>
            <p>Rua Elton Silva, 1000 Centro - Jandira - SP</p>
            <p>Seg à Sex, 08h às 17h</p>
            <p>(11) 4619-8200</p>
          </div>

          <div class="col-md-3 footer-section">
            <h5>Governo</h5>
            <p><a href="https://portal.jandira.sp.gov.br/Prefeitos">Nossos Prefeitos</a></p>
            <p><a href="https://portal.jandira.sp.gov.br/Secretarios">Nossos Secretários</a></p>
          </div>

          <div class="col-md-3 footer-section">
            <h5>Serviços</h5>
            <p><a href="https://portal.jandira.sp.gov.br/Cidadao">Cidadão</a></p>
            <p><a href="https://portal.jandira.sp.gov.br/Empresas">Empresas</a></p>
            <p><a href="https://portal.jandira.sp.gov.br/Servidor">Servidores</a></p>
          </div>

          <div class="col-md-3 footer-section">
            <h5>Consultas</h5>
            <p><a href="https://leideacesso.etransparencia.com.br/jandira.prefeitura.sp/TDAPortalClient.aspx?417">Portal da Transparência</a></p>
            <p><a href="https://portal.jandira.sp.gov.br/Concursos">Concurso Público</a></p>
            <p><a href="https://portal.jandira.sp.gov.br/Decretos">Decretos Municipais</a></p>
            <p><a href="https://leismunicipais.com.br/legislacao-municipal/5019/leis-de-jandira/">Leis Municipais</a></p>
            <p><a href="https://portal.jandira.sp.gov.br/historia">Conheça Jandira</a></p>
            <p><a href="https://portal.jandira.sp.gov.br/Telefones">Telefones Úteis</a></p>
            <p><a href="https://portal.jandira.sp.gov.br/perguntas-frequentes">Perguntas Frequentes</a></p>
          </div>
        </div>

        <div class="footer-bottom">
          <p class="mb-0">© 2025 Prefeitura de Jandira — Mantido pela Secretaria de Tecnologia.</p>
        </div>
      </div>
    </footer>
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
