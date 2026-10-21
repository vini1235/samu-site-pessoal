<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include_once("seguranca.php");
include_once("../conexao/conexao.php");
seguranca_adm();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../imagens/favicon.jpg" type="image/x-icon" />
    <title>SAMU - Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <!-- Navbar -->
    <?php require_once dirname(__DIR__) . '/layout.php'; samuNavbar('', 'administrativo.php'); ?>

    <!-- Hero -->
    <div class="hero-section">
        <div class="container">
            <h1>Sistema de Ocorrência SAMU Jandira</h1>
            <p>Gestão integrada de atendimento móvel de urgência</p>
        </div>
    </div>

    <!-- Main -->
    <div class="main-content">
        <div class="container">

            <!--Cards -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="card-icon">
                                <i class="bi bi-headset"></i>
                            </div>
                            <h5 class="card-title">Suporte T.I Saúde</h5>
                            <p class="card-text">Sistema de help desk. Envie um novo chamado para o departamento de suporte T.I Saúde.</p>
                            <a href="http://200.152.69.40/suporte" target="_blank" class="btn btn-card">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="card-icon">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <h5 class="card-title">Sistema de Holerite</h5>
                            <p class="card-text">Acesse seu holerite como funcionário da Prefeitura de Jandira de forma rápida e segura.</p>
                            <a href="https://portal.conam.com.br/rhjandira/login.php" target="_blank" class="btn btn-card">Acessar</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="card-icon">
                                <i class="bi bi-file-earmark-spreadsheet"></i>
                            </div>
                            <h5 class="card-title">Backup de Dados</h5>
                            <p class="card-text">Base de dados SAMU Jandira em formato Excel para consulta e backup.</p>
                            <a href="gerarExcel.php" class="btn btn-card">Gerar Excel</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos-->
            <div class="section-header">
                <h2>Gráficos de Ocorrências</h2>
                <p>Acompanhe as estatísticas do SAMU Jandira em tempo real</p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-lg-12">
                    <div class="chart-container">
                        <iframe title="Gráfico de ocorrências por especialidade" src="../adm/grafico/grafico2.php" width="100%" height="500"></iframe>
                    </div>
                </div>
            </div>

            <!-- Telefones-->
            <div class="section-header">
                <h2>Telefones das Unidades de Saúde</h2>
                <p>Contatos das unidades de saúde de Jandira</p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-lg-8 mx-auto">
                    <div class="table-responsive" tabindex="0" role="region" aria-label="Tabela de contatos; role horizontalmente para ver todas as colunas">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Unidade</th>
                                    <th>Telefone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>UBS Alvorada</td>
                                    <td>4789-7280</td>
                                </tr>
                                <tr>
                                    <td>UBS Analândia</td>
                                    <td>4707-2572</td>
                                </tr>
                                <tr>
                                    <td>UBS Brotinho</td>
                                    <td>4707-4869</td>
                                </tr>
                                <tr>
                                    <td>UBS Eunice</td>
                                    <td>4707-4873</td>
                                </tr>
                                <tr>
                                    <td>UBS Gabriela</td>
                                    <td>4707-2394</td>
                                </tr>
                                <tr>
                                    <td>UBS Fátima</td>
                                    <td>4618-5036</td>
                                </tr>
                                <tr>
                                    <td>UBS Sagrado</td>
                                    <td>4789-7541</td>
                                </tr>
                                <tr>
                                    <td>UBS Tereza</td>
                                    <td>4618-0726</td>
                                </tr>
                                <tr>
                                    <td>UBS Vale do Sol</td>
                                    <td>4618-0488</td>
                                </tr>
                                <tr>
                                    <td>UBS Ouro Verde</td>
                                    <td>4707-1013</td>
                                </tr>
                                <tr>
                                    <td>AMMEJ</td>
                                    <td>4619-5339</td>
                                </tr>
                                <tr>
                                    <td>CAPS</td>
                                    <td>4789-4249</td>
                                </tr>
                                <tr>
                                    <td>C.R.H</td>
                                    <td>4707-4651</td>
                                </tr>
                                <tr>
                                    <td>C.R.M</td>
                                    <td>4619-6283</td>
                                </tr>
                                <tr>
                                    <td>Almoxarifado Saúde</td>
                                    <td>4789-4978</td>
                                </tr>
                                <tr>
                                    <td>Plantão Ambulância</td>
                                    <td>4789-2561</td>
                                </tr>
                                <tr>
                                    <td>Farmácia Central</td>
                                    <td>4707-3467</td>
                                </tr>
                                <tr>
                                    <td>SAMU</td>
                                    <td>4707-1667</td>
                                </tr>
                                <tr>
                                    <td>Secretaria de Saúde</td>
                                    <td>4619-9433</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Mapa-->
            <div class="section-header">
                <h2>Localização das Unidades</h2>
                <p>Mapa das unidades de saúde de Jandira</p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-lg-10 mx-auto">
                    <div class="map-container">
                        <iframe title="Mapa das unidades de saúde de Jandira" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d29262.848326012183!2d-46.90715165!3d-23.53767965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sunidades%20de%20sa%C3%BAde%20em%20Jandira%20SP!5e0!3m2!1spt-BR!2sbr!4v1792525391214!5m2!1spt-BR!2sbr" width="100%" height="500"></iframe>
                    </div>
                </div>
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

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>