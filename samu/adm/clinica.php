<?PHP
// Use only the configured database for this personal copy.
require_once __DIR__ . '/../conexao/conexao.php';

header('Content-Type: text/html; charset=utf-8');

?>
<?php
session_start();
include_once("../seguranca.php");
include_once("../conexao/conexao.php");
seguranca_adm();
?>
<?php

$conexao = $conn;
$banco = mysqli_select_db($conexao, $dbname);
mysqli_set_charset($conexao, 'utf8');

$query = "SELECT * FROM clinica ORDER BY ID DESC";
$result = mysqli_query($conexao, $query);


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../imagens/favicon.jpg" type="image/x-icon" />
    <title>SAMU - Clínica Médica</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- DateTimePicker CSS -->
    <link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <link rel="stylesheet" href="estilo.css">

    <style>
        /* Estilos específicos da página Clínica Médica */
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

        .btn-success-custom {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            border: none;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
        }

        /* Tabela */
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

        /* Modal customizado */
        .modal-header {
            background: linear-gradient(135deg, #c62828 0%, #8e0000 100%);
            color: #fff;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-content {
            border-radius: 15px;
            overflow: hidden;
            border: none;
        }

        /* Formulário */
        .form-label {
            font-weight: 600;
            color: #333;
        }

        .form-control:focus {
            border-color: #c62828;
            box-shadow: 0 0 0 0.2rem rgba(198, 40, 40, 0.25);
        }

        .btn-submit {
            background: linear-gradient(135deg, #c62828 0%, #8e0000 100%);
            border: none;
            color: #fff;
            padding: 12px 30px;
            font-weight: bold;
            width: 100%;
        }

        .btn-submit:hover {
            opacity: 0.9;
            color: #fff;
        }

        /* DataTables customização */
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

        /* Alerta de sessão */
        .alert-session {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <!-- Navbar (mesmo padrão do administrativo.php) -->
    <?php require_once dirname(__DIR__) . '/layout.php'; samuNavbar('', 'clinica.php'); ?>

    <!-- Header da Página -->
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-hospital"></i> Clínica Médica</h1>
            <p>Gerenciamento de ocorrências de clínica médica</p>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="main-content">
        <div class="container">

            <!-- Mensagem de Sessão -->
            <?php if (isset($_SESSION['msg'])): ?>
                <div class="alert alert-session alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> <?php echo $_SESSION['msg'];
                    unset($_SESSION['msg']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            <?php endif; ?>

            <div class="content-card">
                <!-- Logo -->
                <div class="text-center mb-4">
                    <img src="../imagens/logo-jandira.png" alt="Logo Jandira" style="max-width: 200px;">
                </div>

                <!-- Botões de Ação -->
                <div class="d-flex justify-content-end gap-2 mb-4 flex-wrap">
                    <button type="button" class="btn btn-action btn-success-custom" data-bs-toggle="modal"
                        data-bs-target="#myModalcad">
                        <i class="bi bi-plus-circle"></i> Cadastrar
                    </button>
                    <a href="gerarExcel1.php" class="btn btn-action btn-primary-custom">
                        <i class="bi bi-file-earmark-excel"></i> Excel
                    </a>
                    <a href="maps/maps1.php" class="btn btn-action">
                        <i class="bi bi-geo-alt"></i> Mapa
                    </a>
                </div>

                <!-- Tabela -->
                <p class="table-scroll-hint small text-secondary mb-2" id="occurrence-table-hint"><i class="bi bi-arrow-left-right" aria-hidden="true"></i> Role a tabela para os lados para ver todas as colunas.</p>
                <div class="table-responsive occurrence-table" tabindex="0" role="region" aria-label="Tabela de ocorrências" aria-describedby="occurrence-table-hint">
                    <table id="employee_data" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DATA/HORA</th>
                                <th>FUNCIONÁRIO</th>
                                <th>PLANTÃO</th>
                                <th>OCORRÊNCIA</th>
                                <th>N/EVENTO</th>
                                <th>Q.R.U</th>
                                <th>Q.R.A</th>
                                <th>Q.T.H</th>
                                <th>Q.T.I</th>
                                <th>OBS</th>
                                <th>+</th>
                                <th>EDITAR</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="5" style="text-align:right">Total:</th>
                                <th></th>
                                <th colspan="7"></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <!-- Dados carregados via Ajax -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cadastrar -->
    <div class="modal fade" id="myModalcad" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">
                        <i class="bi bi-plus-circle"></i> Cadastrar Ocorrência - Clínica Médica
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form action="enviar_contato.php" method="POST" id="occurrence-create-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="txtdatahora">Data/Hora</label>
                                <div class="input-group date data_formato" data-date-format="dd/mm/yyyy HH:ii:ss">
                                    <input type="text" class="form-control" name="txtdatahora" id="txtdatahora"
                                        placeholder="Data da visita">
                                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="funcionario">Funcionário</label>
                                <input type="text" class="form-control" name="funcionario" id="funcionario"
                                    placeholder="Digite o Nome" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="plantao">Plantão</label>
                                <input type="text" class="form-control" name="plantao" id="plantao"
                                    placeholder="Digite o Plantão" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="ocorrencia">Ocorrência</label>
                                <select class="form-select" name="ocorrencia" id="ocorrencia">
                                    <option>CLINICA MEDICA</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="evento">N°/Evento</label>
                                <input type="text" class="form-control" name="evento" id="evento"
                                    placeholder="Digite o Número do Evento" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="qru">Q.R.U</label>
                                <input type="text" class="form-control" name="qru" id="qru" placeholder="Digite o Q.R.U"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="qra">Q.R.A</label>
                                <input type="text" class="form-control" name="qra" id="qra" placeholder="Digite o Q.R.A"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="qth">Q.T.H</label>
                                <input type="text" class="form-control" name="qth" id="qth" placeholder="Digite o Q.T.H"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="qti">Q.T.I</label>
                                <input type="text" class="form-control" name="qti" id="qti" placeholder="Digite o Q.T.I"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="message">Observação</label>
                                <textarea class="form-control" name="message" id="message" rows="4"
                                    placeholder="Digite a Observação" required></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-submit" id="send_message">
                            <i class="bi bi-send"></i> Enviar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detalhes -->
    <div class="modal fade" id="post_modal" tabindex="-1" aria-labelledby="occurrence-details-title" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="occurrence-details-title"><i class="bi bi-info-circle"></i> Detalhes da Ocorrência</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body" id="post_detail" aria-live="polite">
                    <!-- Conteúdo carregado via Ajax -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="edit-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div id="content-data">
                    <!-- Conteúdo carregado via Ajax -->
                </div>
            </div>
        </div>
    </div>

    <!-- Footer (mesmo padrão do administrativo.php) -->
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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- DateTimePicker JS -->
    <script src="../js/bootstrap-datetimepicker.min.js"></script>
    <script src="../js/locales/bootstrap-datetimepicker.pt-BR.js"></script>

    <script>

        $('.data_formato').datetimepicker({
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            language: "pt-BR"
        });
    </script>

    <script>

        function somenteNumeros(num) {
            var er = /[^0-9.]/;
            er.lastIndex = 0;
            var campo = num;
            if (er.test(campo.value)) {
                campo.value = "";
            }
        }
    </script>


    <script>
        $(document).ready(function () {
            $('#employee_data').DataTable({
                processing: true,
                serverSide: true,
                deferRender: true,
                ajax: {
                    url: 'datatable.php?type=CLINICA%20MEDICA',
                    type: 'POST'
                },
                pageLength: 25,
                lengthMenu: [25, 50, 100],
                order: [[0, 'desc']],
                searchDelay: 300,
                columns: [
                    { data: 0 },
                    { data: 1 },
                    { data: 2 },
                    { data: 3 },
                    { data: 4 },
                    { data: 5 },
                    { data: 6 },
                    { data: 7 },
                    { data: 8 },
                    { data: 9 },
                    { data: 10 },
                    { data: 11, orderable: false, searchable: false },
                    { data: 12, orderable: false, searchable: false }
                ],
                columnDefs: [
                    { targets: [11, 12], orderable: false, searchable: false }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
                }
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            var detailsRequest = 0;
            function fetch_post_data(id) {
                var request = ++detailsRequest;
                var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('post_modal'));
                $('#post_detail').html('<div class="text-center py-4" role="status"><div class="spinner-border text-danger" aria-hidden="true"></div><p class="mt-3 mb-0">Carregando detalhes...</p></div>');
                modal.show();
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: { id: id },
                    dataType: 'html',
                    timeout: 15000
                }).done(function (data) {
                    if (request !== detailsRequest) return;
                    $('#post_detail').html(data.trim() ? data : '<p class="text-secondary mb-0">Não foi possível encontrar esta ocorrência.</p>');
                }).fail(function () {
                    if (request !== detailsRequest) return;
                    $('#post_detail').html('<div class="alert alert-danger mb-0" role="alert">Não foi possível carregar os detalhes. Feche esta janela e tente novamente.</div>');
                });
            }

            $(document).on('click', '.view', function () {
                var id = $(this).attr("id");
                fetch_post_data(id);
            });

            $(document).on('click', '.previous', function () {
                var id = $(this).attr("id");
                fetch_post_data(id);
            });

            $(document).on('click', '.next', function () {
                var id = $(this).attr("id");
                fetch_post_data(id);
            });
        });
    </script>

    <script>
        var editRequest = 0;
        $(document).on('click', '#getEdit', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var request = ++editRequest;
            var header = '<div class="modal-header"><h5 class="modal-title" id="edit-modal-title">Editar Ocorrência</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button></div>';
            var error = '<div class="modal-body"><div class="alert alert-danger mb-0" role="alert">Não foi possível carregar os dados para edição. Feche esta janela e tente novamente.</div></div>';
            $('#content-data').html(header + '<div class="modal-body text-center py-5" role="status" aria-live="polite"><div class="spinner-border text-danger" aria-hidden="true"></div><p class="mt-3 mb-0">Carregando dados da ocorrência...</p></div>');
            var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('myModal'));
            modal.show();
            $.ajax({
                url: 'alterar.php',
                type: 'POST',
                data: 'id=' + id,
                dataType: 'html',
                timeout: 15000
            }).done(function (data) {
                if (request !== editRequest) return;
                var content = $('<div>').append($.parseHTML(data, document, false));
                var valid = content.find('form#occurrence-edit-form').length === 1
                    && content.find('.modal-header #edit-modal-title').length === 1;
                $('#content-data').empty().append(valid ? content.contents() : header + error);
                modal.handleUpdate();
            }).fail(function () {
                if (request !== editRequest) return;
                $('#content-data').html(header + error);
            });
        });
    </script>

</body>

</html>