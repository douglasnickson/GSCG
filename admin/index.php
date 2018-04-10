<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GSCG - ADMIN</title>
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
    <div class="container cadastro-info">
        <h4 style="text-align:center;">Seja bem vindo ao Sistema ADM.</h4>		
        <hr>
        <a href="cadastrar.php"><button type="submit" class="btn btn-lg btn-info" id="enviar">Cadastrar Empresa</button></a>
        <br><br>	
        <table class="table table-sm table-hover admin-home" style="color: grey;">
            <tr>
                <td><b>CNPJ</b></td>
                <td><b>Nome</b></td>
                <td><b>Tel Fixo</b></td>
                <td><b>Tel Celular</b></td>
                <td><b>Ações</b></td>
            </tr>
            <tr>
                <td>1111111</td>
                <td>Teste</td>
                <td>9999999</td>
                <td>8888888</td>
                <td>
                    <a href="atualizar.php"><i class="fas fa-pencil-alt"></i></a>
                    <a href="deletar.php"><i class="fas fa-minus-circle"></i></a>
                </td>
            </tr>
            <tr>
                <td>1111111</td>
                <td>Teste</td>
                <td>9999999</td>
                <td>8888888</td>
                <td>
                    <a href="atualizar.php"><i class="fas fa-pencil-alt"></i></a>
                    <a href="deletar.php"><i class="fas fa-minus-circle"></i></a>
                </td>
            </tr>
        </table>
        	<!-- Mensagens de Erro ou Sucesso -->
			<?php 
				if(isset($_GET['erro'])){
					$msg_erro = $_GET['erro'];
                    echo"<div class='alert alert-danger' style='text-align:center;' role='alert'>".$msg_erro."</div>";
                    unset($_GET['erro']);
				} else if (isset($_GET['sucesso'])) {
                    $msg_sucesso = $_GET['sucesso'];
                    echo"<div class='alert alert-success' style='text-align:center;' role='alert'>".$msg_sucesso."</div>";
                    unset($_GET['sucesso']);
                }
			?>
    </div>
    <script defer src="../fontawesome/svg-with-js/js/fontawesome-all.js"></script>
</body>
</html>