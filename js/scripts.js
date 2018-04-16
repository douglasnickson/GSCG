//Adiciona a pontuacao do CNPJ
$(document).ready(function(){
    var $cnpj = $("#cnpj");
    $cnpj.mask('00.000.000/0000-00', {reverse: true});
});

// Adiciona mascara do tel fixo
$(document).ready(function(){
    var $tel_fixo = $("#tel_fixo");
    $tel_fixo.mask('0000-0000');
});

// Adiciona mascara do tel celular
$(document).ready(function(){
    var $tel_celular = $("#tel_celular");
    $tel_celular.mask('(00) 00000-0000');
});