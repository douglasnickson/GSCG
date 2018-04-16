<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GSCP - Home</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php 
        if (isset($_SESSION['logado'])){
    ?>
    <div class="container content">
        <div class="row">
            <div class="col-sm-4"><img class="logomarca" src="../images/sebrae-logo.png"></div>
            <div class="col-sm-8"><h2 class="fonte-titulos" style="line-height:90px;">Formulário de Cadastro das Empresas</h2></div>
        </div>
        <hr>
        <a href="index.php"><button type="submit" class="btn btn-lg btn-info" id="enviar">Home</button></a>
        <hr>
        <form action="acoes.php" method="post">
            <input type="hidden" name="acao" value="2">
            <div class="row">
                <div class="col-sm-6">
                    <h4><b>Dados da Empresa</b></h4>
                    <hr>
                    <div class="form-group">
                        <label for="cnpj"><b>CNPJ:</b></label>
                        <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Digite o CNPJ" required>
                    </div>
                    <div class="form-group">
                        <label for="nome"><b>Razão Social:</b></label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome da empresa" required>
                    </div>  
                    <div class="form-group">
                        <label for="nome_fantasia"><b>Nome Fantasia:</b></label>
                        <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia"  placeholder="Digite o nome fantasaia da empresa (Opcional)">
                    </div>  
                    <div class="form-group">
                        <label for="tel_fixo"><b>Telefone Fixo:</b></label>
                        <input type="text" class="form-control" id="tel_fixo" name="tel_fixo" placeholder="Digite o telefone fixo (Opcional)">
                    </div>
                    <div class="form-group">
                        <label for="tel_celular"><b>Telefone Celular:</b></label>
                        <input type="text" class="form-control" id="tel_celular" name="tel_celular" placeholder="Digite o telefone fixo (Opcional)">
                    </div>
                    <div class="form-group">
                        <label for="responsavel"><b>Responsável:</b></label>
                        <input type="text" class="form-control" id="responsavel" name="responsavel" placeholder="Digite o nome do responsável (Opcional)">
                    </div>
                    <div class="form-group">
                        <label for="email"><b>E-Mail:</b></label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Digite o E-mail (Opcional)">
                    </div>      
                </div>
                <div class="col-sm-6">
                    <h4><b>Endereço da Empresa</b></h4>
                    <hr>
                    <div class="form-group">
                        <label for="rua"><b>Rua:</b></label>
                        <input type="text" class="form-control" id="rua" name="rua"  placeholder="Digite o nome da rua" required>
                    </div>
                    <div class="form-group">
                        <label for="numero"><b>Número:</b></label>
                        <input type="text" class="form-control" id="numero" name="numero"  placeholder="Digite o número" required>
                    </div>
                    <div class="form-group">
                        <label for="bairro"><b>Bairro:</b></label>
                        <input type="text" class="form-control" id="bairro" name="bairro"  placeholder="Digite o nome do bairro (Opcional)">
                    </div>
                    <div class="form-group">
                        <label for="complemento"><b>Complemento:</b></label>
                        <input type="text" class="form-control" id="complemento" name="complemento"  placeholder="Digite o complemento (Opcional)">
                    </div>
                    <div class="form-group">
                        <label for="cidade"><b>Cidade:</b></label>
                        <input type="text" class="form-control" id="cidade" name="cidade"  placeholder="Digite o nome da cidade" required>
                    </div> 
                    <div class="form-group">
                        <label for="estado"><b>Estado:</b></label>
                        <select class="custom-select mr-sm-2 mb-2" name="estado" id="estado">
                            <option value="PB">PB</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="pais"><b>Pais:</b></label>
                        <input type="text" class="form-control" id="pais" name="pais"  placeholder="Digite o nome do pais" required>
                    </div> 
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                        <button type="submit" class="btn btn-lg btn-block btn-info" id="enviar">Cadastrar Informações</button>				
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
    </div>
    <?php 

    } else {
        $_SESSION['erro'] = "Faça o login para acessar o sistema!";
        header("Location: login.php");
    }

    ?>
<!-- Scripts do JS -->
<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/jquery.mask.js"></script>
<script type="text/javascript" src="../js/scripts.js"></script>

</body>
</html>