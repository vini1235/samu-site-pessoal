<?php
function samuNavbar(string $prefix = '', string $active = ''): void {
    $assets = $prefix . '../';
    $links = ['administrativo.php'=>'Início','clinica.php'=>'Clínica Médica','trauma.php'=>'Trauma','obstetricia.php'=>'Obstetrícia','pediatria.php'=>'Pediatria','ortopedia.php'=>'Ortopedia','psiquiatria.php'=>'Psiquiatria','usuario.php'=>'Usuários'];
    if ((string) ($_SESSION['usuarioNiveisAcessoId'] ?? '') !== '1') {
        unset($links['usuario.php']);
    }
    ?>
    <nav class="navbar navbar-expand-xl navbar-dark"><div class="container">
    <a class="navbar-brand" href="<?= $prefix ?>administrativo.php"><img src="<?= $assets ?>imagens/samu-192_logo.png" alt="SAMU"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Abrir menu"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarNav"><ul class="navbar-nav ms-auto">
    <?php foreach ($links as $path=>$label): ?><li class="nav-item"><a class="nav-link<?= $active === $path ? ' active' : '' ?>" <?= $active === $path ? 'aria-current="page"' : '' ?> href="<?= $prefix . $path ?>"><?= $label ?></a></li><?php endforeach; ?>
    <li class="nav-item ms-xl-3"><a class="btn btn-logout" href="<?= $prefix ?>sair.php">Sair</a></li></ul></div></div></nav>
    <?php
}
function samuPageStart(string $title, string $description, string $prefix = '', string $active = ''): void {
    $assets = $prefix . '../';
    header('Content-Type: text/html; charset=utf-8');
    ?><!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SAMU — <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="icon" href="<?= $assets ?>imagens/favicon.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $prefix ?>estilo.css">
    <link rel="stylesheet" href="<?= $assets ?>css/samu-pages.css">
    </head><body><?php samuNavbar($prefix,$active); ?>
    <header class="hero-section"><div class="container"><h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1><p><?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></p></div></header>
    <main class="container py-4">
    <?php
}
function samuFooter(): void { ?><footer>
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
    </footer><?php }
function samuPageEnd(string $prefix = ''): void {
    ?></main><?php samuFooter(); ?>
    <script src="<?= $prefix ?>../js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php
}
