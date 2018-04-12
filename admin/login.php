<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GSCG - Login</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<link href="https://file.myfontastic.com/25femE7xeK8GoTXAmZ4zwY/icons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/aos.css">

	<!-- scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="../js/aos.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			AOS.init({
				easing: 'ease-out-in',
				duration: 800
			});
		});
	</script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="main aos-all">
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <a href="">
                            <h1 data-aos="zoom-in"><img src="../images/logo-login.png"></h1>
                        </a>

                        <p data-aos="zoom-in">SIAVE - Sistema de Acompanhamento das Avaliações dos Eventos</p>
                    </div>
                </div>
            </div>
        </header>
        <main class="main" role="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <p data-aos="zoom-in">Entre com suas credenciais abaixo:</p>
                        <form data-aos="zoom-in" action="acoes.php" method="post">
                            <input type="text" name="login" placeholder="Usuário de rede">
                            <input type="password" name="senha" placeholder="Senha">
							<input type="hidden" value="1" id="tipo_formulario" name="tipo_formulario">
                            <button type="submit">Entrar</button>
                        </form>
						<br />
						<!-- Mensagens de Erro ou Sucesso -->
						<?php 
						if(isset($_SESSION['erro'])){
							$msg_erro = $_SESSION['erro'];
							echo"<p>".$msg_erro."</p>";
							unset($_SESSION['erro']);
						}
						?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>