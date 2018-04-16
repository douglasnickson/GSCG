<?php 
session_start();
if (isset($_SESSION['logado'])){
    include("../connection.php");
    include("../funcoes.php");
  }
?>
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
<?php 
    if (isset($_SESSION['logado'])){
?>
    <div class="container content">
        <div class="row">
            <div class="col-sm-4"><img class="logomarca" src="../images/sebrae-logo.png"></div>
            <div class="col-sm-8"><h2 class="fonte-titulos" style="line-height:90px;">Sistema de Gerencimanto do Google Maps</h2></div>
        </div>
        <hr>
        <a href="cadastrar.php"><button type="submit" class="btn btn-lg btn-info" id="enviar">Cadastrar Empresa</button></a>
        <a href="acoes.php?acao=5"><button type="submit" class="btn btn-lg btn-success" id="enviar">Sair do Sistema</button></a>
        <br><br>	
        <table class="table table-sm table-hover admin-home" style="color: grey;">
            <tr>
                <td><b>CNPJ</b></td>
                <td><b>Nome</b></td>
                <td><b>Nome Fantasia</b></td>
                <td><b>Tel Fixo</b></td>
                <td><b>Tel Celular</b></td>
                <td><b>Ações</b></td>
            </tr>
            <?php
            $query = mysqli_query ($conn, "select * from tb_empresa");
            while ($result = mysqli_fetch_array($query)) {
                echo "<tr>
                    <td>".mask($result['cnpj'],'##.###.###/####-##')."</td>
                    <td>".$result['nome']."</td>
                    <td>".$result['nome_fantasia']."</td>
                    <td>".mask($result['tel_fixo'], '####-####')."</td>
                    <td>".mask($result['tel_celular'], '(##) #####-####')."</td>
                    <td>
                        <a href='atualizar.php?tipo_formulario=3&id=".$result['id']."'><i class='fas fa-pencil-alt'></i></a>
                        <a href='acoes.php?tipo_formulario=4&id=".$result['id']."'><i class='fas fa-minus-circle'></i></a>
                    </td>
                </tr>";
            }
            ?>
        </table>
        	<!-- Mensagens de Erro ou Sucesso -->
			<?php 
				if(isset($_SESSION['erro'])){
					$msg_erro = $_SESSION['erro'];
                    echo"<div class='alert alert-danger' style='text-align:center;' role='alert'>".$msg_erro."</div>";
                    unset($_SESSION['erro']);
				} else if (isset($_SESSION['sucesso'])) {
                    $msg_sucesso = $_SESSION['sucesso'];
                    echo"<div class='alert alert-success' style='text-align:center;' role='alert'>".$msg_sucesso."</div>";
                    unset($_SESSION['sucesso']);
                }
			?>
    </div>
<?php 
    } else {
        $_SESSION['erro'] = "Faça o login para acessar o sistema!";
        header("Location: login.php");
    }
?>
<script defer src="../fontawesome/svg-with-js/js/fontawesome-all.js"></script>
</body>
</html>