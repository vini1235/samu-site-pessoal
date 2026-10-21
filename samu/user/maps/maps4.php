<?php
session_start();
include_once("../../seguranca.php");
include_once("../../conexao/conexao.php");
seguranca_user();

$conexao = $conn;
mysqli_set_charset($conexao, 'utf8');

$query = "SELECT * FROM markers4 ORDER BY ID DESC";
$result = mysqli_query($conexao, $query);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../imagens/favicon.jpg" type="image/x-icon" />
    <title>SAMU - Mapas Pediatria</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="../estilo.css">

    <style>
        .page-header {
            background: linear-gradient(135deg, #c62828 0%, #8e0000 100%);
            color: #fff;
            padding: 40px 0;
            text-align: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .page-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .content-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .btn-action {
            background: linear-gradient(135deg, #c62828 0%, #8e0000 100%);
            border: none;
            color: #fff;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(198, 40, 40, 0.4);
            color: #fff;
        }

        #employee_data thead {
            background: linear-gradient(135deg, #c62828 0%, #8e0000 100%);
            color: #fff;
        }

        #employee_data thead th {
            color: #fff;
            font-weight: bold;
            padding: 15px 10px;
            white-space: nowrap;
            border: none;
        }

        #employee_data tbody tr:hover {
            background-color: rgba(198, 40, 40, 0.1);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #c62828 0%, #8e0000 100%) !important;
            color: #fff !important;
            border: none !important;
            border-radius: 5px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #ef5350 !important;
            color: #fff !important;
            border: none !important;
        }

        .map-frame,
        .map-form-frame {
            display: block;
            width: 100%;
            border: 0;
            border-radius: 10px;
        }

        .map-frame {
            height: 65vh;
            min-height: 320px;
            max-height: 700px;
        }

        .map-form-frame {
            height: 720px;
        }

        .map-form-frame-compact {
            height: 400px;
        }

        @media (max-width: 575.98px) {
            .map-form-frame {
                height: 760px;
            }

            .map-form-frame-compact {
                height: 440px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php require_once dirname(__DIR__, 2) . '/layout.php'; samuNavbar('../', 'pediatria.php'); ?>

    <!-- Header da Página -->
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-geo-alt-fill"></i> Mapa de Ocorrências - Pediatria</h1>
            <p>Visualização geográfica das ocorrências de pediatria</p>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="main-content">
        <div class="container">

            <?php if (isset($_SESSION['msg'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar aviso"></button>
                </div>
            <?php endif; ?>

            <!-- Mapa -->
            <div class="content-card">
                <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-4">
                    <h4 class="mb-0"><i class="bi bi-map me-2"></i>Visualização do Mapa</h4>
                    <a href="maps4.php" class="btn btn-action">
                        <i class="bi bi-arrow-clockwise me-2"></i>Atualizar Mapa
                    </a>
                </div>
                <iframe src="../../maps4/index.php" class="map-frame" width="100%" height="700" title="Mapa de ocorrências de Pediatria"></iframe>
            </div>

            <!-- Formulário -->
            <div class="content-card">
                <h4 class="mb-4"><i class="bi bi-plus-circle me-2"></i>Formulário de Registro</h4>
                <div class="text-center">
                    <iframe src="../../maps4/form.php" class="map-form-frame" width="100%" height="720" title="Registrar localização de ocorrência de Pediatria"></iframe>
                </div>
            </div>

            <!-- Tabela -->
            <div class="content-card">
                <h4 class="mb-4"><i class="bi bi-table me-2"></i>Tabela de Registros</h4>
                <div class="table-responsive">
                    <table id="employee_data" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>NOME/OCORRÊNCIA</th>
                                <th>ENDEREÇO</th>
                                <th>LATITUDE</th>
                                <th>LONGITUDE</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_array($result)): ?>
                                <tr>
                                    <td><?php echo $row["name"]; ?></td>
                                    <td><?php echo $row["address"]; ?></td>
                                    <td><?php echo $row["lat"]; ?></td>
                                    <td><?php echo $row["lng"]; ?></td>
                                    <td>
                                        <a href="../deletemaps4.php?cod=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este registro?')">
                                            <i class="bi bi-trash me-1"></i>Apagar
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#employee_data').DataTable({
                pageLength: 25,
                order: [[0, 'desc']],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
                }
            });
        });
    </script>
</body>

</html>