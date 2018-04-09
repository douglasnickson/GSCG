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
    <div class="container cadastro-info">
        <form action="acoes.php" method="post">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Endereço da Empresa</h4>
                    <hr>
                    <div class="form-group">
                        <label for="rua">Rua:</label>
                        <input type="text" class="form-control" id="rua" name="rua"  placeholder="Digite o nome da rua" required>
                    </div>
                    <div class="form-group">
                        <label for="numero">Número:</label>
                        <input type="text" class="form-control" id="numero" name="numero"  placeholder="Digite o número" required>
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade:</label>
                        <input type="text" class="form-control" id="cidade" name="cidade"  placeholder="Digite o nome da cidade" required>
                    </div> 
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <select class="custom-select mr-sm-2 mb-2" name="estado" id="estado">
                            <option value="1">PB</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="pais">Pais:</label>
                        <input type="text" class="form-control" id="pais" name="pais"  placeholder="Digite o nome do pais" required>
                    </div> 
                </div>
                <div class="col-sm-6">
                    <h4>Dados da Empresa</h4>
                    <hr>
                    <div class="form-group">
                        <label for="cnpj">CNPJ:</label>
                        <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Digite o CNPJ" required>
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome da empresa" required>
                    </div>  
                    <div class="form-group">
                        <label for="nome_fantasia">Nome Fantasia:</label>
                        <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia"  placeholder="Digite o nome fantasaia da empresa" required>
                    </div>  
                    <div class="form-group">
                        <label for="email">E-Mail:</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Digite o e-mail da empresa" required>
                    </div>  
                    <div class="form-group">
                        <label for="tel_fixo">Telefone Fixo:</label>
                        <input type="text" class="form-control" id="tel_fixo" name="tel_fixo" placeholder="Digite o telefone fixo" required>
                    </div>
                    <div class="form-group">
                        <label for="tel_celular">Telefone Celular:</label>
                        <input type="text" class="form-control" id="tel_celular" name="tel_celular" placeholder="Digite o telefone fixo" required>
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
<!-- Scripts do JS -->
<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/jquery.mask.js"></script>
<script type="text/javascript" src="../js/scripts.js"></script>

</body>
</html>