<?php
function samuAuxiliaryMenu(string $prefix = ''): void
{
    if (!in_array($prefix, ['', '../'], true)) { throw new InvalidArgumentException('Caminho de menu inválido.'); }
    $links = ['administrativo.php'=>'Home', 'clinica.php'=>'Clínica médica', 'trauma.php'=>'Trauma',
        'obstetricia.php'=>'Obstetrícia', 'pediatria.php'=>'Pediatria', 'ortopedia.php'=>'Ortopedia',
        'psiquiatria.php'=>'Psiquiatria', 'usuario.php'=>'Usuários', 'arquivos.php'=>'Downloads',
        'arquivo/index.php'=>'Envio de arquivos', 'sair.php'=>'Sair'];
    echo '<nav class="pushy pushy-left" data-focus="#first-link"><div class="pushy-content"><ul>';
    foreach ($links as $path=>$label) {
        echo '<li class="pushy-link"><a' . ($path === 'administrativo.php' ? ' id="first-link"' : '') . ' href="' . $prefix . $path . '">' . $label . '</a></li>';
    }
    echo '</ul></div></nav>';
}
