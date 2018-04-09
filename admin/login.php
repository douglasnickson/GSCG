<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GSCG - Login</title>
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
<div class="container">
	<div class="row justify-content-center align-items-center">
	  	<div class="cadastro-info">
			<hr />
	  		<h4 style="text-align:center;">Por Favor, Faça o login para acessar o sistema.</h4>
	  		<hr />
		    <form method="post" action="acoes.php">
	            <div class="form-group">
	                <label for="login">Login:</label>
	                <input type="text" class="form-control" id="login" name="login"  maxlength="14" placeholder="Digite o Login" required>
	            </div>
	            <div class="form-group">
	                <label for="senha">Senha:</label>
	                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a Senha" required>
	            </div>       
				<br />
				<button type="submit" class="btn btn-lg btn-block btn-info" id="enviar">Entrar</button>				
                <input type="hidden" value="1" id="tipo_formulario" name="tipo_formulario">
		    </form>
			<br />
			<div id="resultado"></div>
			<!-- Mensagens de Erro ou Sucesso -->
		</div>   
	</div>  
</div>
</body>
</html>