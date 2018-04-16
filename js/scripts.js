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

// Confirma a exclusão
function onDelete(id) {
    var op = confirm ("Você realmente deseja excluir a empresa?");
    if (op == true) {
        var req;
    
        if(window.XMLHttpRequest) {
            req = new XMLHttpRequest();
         } else if(window.ActiveXObject) {
            req = new ActiveXObject("Microsoft.XMLHTTP");
         }

         var url = "../admin/acoes.php?acao=4&id=" + id;
         req.open("GET", url, true);

         req.onreadystatechange = function() {  
            if(req.readyState == 1) {
                document.getElementById('resultado').innerHTML = 'Excluindo empresa...';
            }
         
            if(req.readyState == 4 && req.status == 200) {
                var resposta = req.responseText;
                document.getElementById('resultado').innerHTML = "<div class='alert alert-warning' style='text-align:center;' role='alert'>"+resposta+"</div>";
            }
        } 
         req.send(null);

    }
    return;
}