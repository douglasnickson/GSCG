<?php 
include ("../connection.php");

// Recebendo os dados
$rua = $_POST["rua"];
$numero = $_POST["numero"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$pais = $_POST["pais"];
$cnpj = $_POST["cnpj"];
$nome = $_POST["nome"];
$nome_fantasia = $_POST["nome_fantasia"];
$email = $_POST["email"];
$tel_fixo = $_POST["tel_fixo"];
$tel_celular = $_POST["tel_celular"];

$sql = mysqli_query($conn, "insert into tb_endereco (rua,nr,cidade,estado,pais) VALUES ('".$rua."', ".$numero.", '".$cidade."', '".$estado."', '".$pais."');");
if ($sql) {
    $sql = mysqli_query($conn, "insert into tb_empresa VALUES ('".$cnpj."', '".$nome."', '".$nome_fantasia."', '".$email."', '".$tel_fixo."', '".$tel_celular."');");
    if ($sql) {
        echo "Cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar empresa".mysqli_error($conn);
    }
} else {
    echo "Erro ao cadastrar endereço".mysqli_error($conn);
}

?>