$(document).ready(function () {
    $("input[name='cpf']").blur(function () {
        var $nome_aluno = $("input[name='nome']");
        var $rg = $("input[name='sus']");
        var cpf = $(this).val();
        
        $.getJSON('proc_pesq_user.php', {sus},
            function(retorno){
                $nome_aluno.val(retorno.nome);
                $rg.val(retorno.nome);
            }
        );        
    });
});