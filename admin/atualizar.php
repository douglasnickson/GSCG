<?php 
session_start();
include ("../connection.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GSCP - Atualizar Informações</title>
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
        $id = $_GET['id'];
        $query = mysqli_query($conn, "select * from tb_empresa inner join tb_endereco on tb_empresa.id = tb_endereco.id_empresa where tb_empresa.id = ".$id);
        $result = mysqli_fetch_array($query)
    ?>
    <div class="container cadastro-info">
        <form action="acoes.php" method="post">
            <input type="hidden" name="tipo_formulario" value="3">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Endereço da Empresa</h4>
                    <hr>
                    <div class="form-group">
                        <label for="rua">Rua:</label>
                        <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $result['rua']; ?>" placeholder="Digite o nome da rua" required>
                    </div>
                    <div class="form-group">
                        <label for="numero">Número:</label>
                        <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $result['nr']; ?>"  placeholder="Digite o número" required>
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade:</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $result['cidade']; ?>"  placeholder="Digite o nome da cidade" required>
                    </div> 
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <select class="custom-select mr-sm-2 mb-2" name="estado" id="estado">
                            <option value="<?php echo $result['estado']; ?>"><?php echo $result['estado']; ?></option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="pais">Pais:</label>
                        <input type="text" class="form-control" id="pais" name="pais" value="<?php echo $result['pais']; ?>" placeholder="Digite o nome do pais" required>
                    </div> 
                </div>
                <div class="col-sm-6">
                    <h4>Dados da Empresa</h4>
                    <hr>
                    <div class="form-group">
                        <label for="cnpj">CNPJ:</label>
                        <input type="text" class="form-control" id="cnpj" name="cnpj" value="<?php echo $result['cnpj']; ?>" placeholder="Digite o CNPJ" required>
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $result['nome']; ?>" placeholder="Digite o nome da empresa" required>
                    </div>  
                    <div class="form-group">
                        <label for="nome_fantasia">Nome Fantasia:</label>
                        <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" value="<?php echo $result['nome_fantasia']; ?>" placeholder="Digite o nome fantasaia da empresa" required>
                    </div>  
                    <div class="form-group">
                        <label for="tel_fixo">Telefone Fixo:</label>
                        <input type="text" class="form-control" id="tel_fixo" name="tel_fixo" value="<?php echo $result['tel_fixo']; ?>" placeholder="Digite o telefone fixo" required>
                    </div>
                    <div class="form-group">
                        <label for="tel_celular">Telefone Celular:</label>
                        <input type="text" class="form-control" id="tel_celular" name="tel_celular" value="<?php echo $result['tel_celular']; ?>" placeholder="Digite o telefone fixo" required>
                    </div>      
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                        <button type="submit" class="btn btn-lg btn-block btn-info" id="enviar">Atualizar Informações</button>				
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