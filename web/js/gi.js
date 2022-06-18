function usererror(imagem){

    $(imagem).attr('src', 'img/users/profileDefault.png');
    $(imagem).attr('onerror', null);
    
}
function formatar(nome) {
    const nome1 = nome.toLowerCase().split(' ');
    let nome_formatado = '';
    for (let i = 0; i < nome1.length; i++) {
        nome_formatado += nome1[i][0].toUpperCase() + nome1[i].slice(1);
        if (i != nome1.legth) {
            nome_formatado += ' ';
        }
    }
    return nome_formatado;
}