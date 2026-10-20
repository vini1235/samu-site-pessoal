
function sem_acento(e,args)
{
    if (document.all){var evt=event.keyCode;} // caso seja IE
    else{var evt = e.charCode;} 	// do contrário deve ser Mozilla
    var valid_chars = '0123456789abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYK-_/^~´`@.'+args;      // criando a lista de teclas permitidas
    var chr= String.fromCharCode(evt);      // pegando a tecla digitada
    if (valid_chars.indexOf(chr)>-1 ){return true;} // se a tecla estiver na lista de permissão permite-a
    // para permitir teclas como <BACKSPACE> adicionamos uma permissão para
    // códigos de tecla menores que 09 por exemplo (geralmente uso menores que 20)
    if (valid_chars.indexOf(chr)>-1 || evt < 9){return true;}
    if (valid_chars.indexOf(chr)>30 || evt <35){return true;} //permite a tecla espaço
    return false;   // do contrário nega
}
