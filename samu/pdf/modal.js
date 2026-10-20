
/*
 * Função que carrega após o DOM estiver carregado.
 * Como estou usando o ajaxForm no formulário, é aqui que eu o configuro.
 * Basicamente somente digo qual função será chamada quando os dados forem postados com sucesso.
 * Se o retorno for igual a 1, então somente recarrego a janela.
 */
$(function(){
    $('#formulario_clientes').ajaxForm({
        success: function(data) {
            if (data == 1) {

                //se for sucesso, simplesmente recarrego a página. Aqui você pode usar sua imaginação.
                document.location.href = document.location.href;

            }
        }
    });
});

//Aqui eu seto uma variável javascript com o base_url do CodeIgniter, para usar nas funções do post.
var base_url = "<?= base_url() ?>";

/*
 *	Esta função serve para preencher os campos do cliente na janela flutuante
 * usando jSon.
 */
function carregaDadosClienteJSon(id_cliente){
    $.post(base_url+'/index.php/clientes/dados_cliente', {
        id_cliente: id_cliente
    }, function (data){
        $('#nome').val(data.nome);
        $('#email').val(data.email);
        $('#id_cliente').val(data.id_cliente);//aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente.
    }, 'json');
}

function janelaEditarCliente(id_cliente){

    //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
    carregaDadosClienteJSon(id_cliente);

    $('#modalEditarCliente').modal('show');
}