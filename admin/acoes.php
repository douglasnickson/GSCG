<?php 
include ("../connection.php");

// Variaveis
$erro = false;
$sucesso = false;
$tipo = $_POST["tipo_formulario"];

// Verifica se os dados foram enviados
if (!isset($_POST) || empty($_POST)) {
    $erro = "Nenhum dado foi enviado!";
}

// Verifica se existem campos em branco
foreach ($_POST as $chave => $valor) {
    $$chave = trim(strip_tags($valor));
    if (empty($valor)) {
        $erro = "Preencha todos os campos";
    }
}

if ($tipo == 1) {
    cadastrarEmpresa();
}

function cadastrarEmpresa () {
    include ("../connection.php");

    // Recebendo os dados
    $rua            = addslashes($_POST["rua"]);
    $numero         = addslashes($_POST["numero"]);
    $cidade         = addslashes($_POST["cidade"]);
    $estado         = addslashes($_POST["estado"]);
    $pais           = addslashes($_POST["pais"]);
    $cnpj           = addslashes(limpaCaracteres($_POST["cnpj"]));
    $nome           = addslashes($_POST["nome"]);
    $nome_fantasia  = addslashes($_POST["nome_fantasia"]);
    $email          = addslashes($_POST["email"]);
    $tel_fixo       = addslashes(limpaCaracteres($_POST["tel_fixo"]));
    $tel_celular    = addslashes(limpaCaracteres($_POST["tel_celular"]));

    $sql = mysqli_query($conn, "insert into tb_endereco (rua,nr,cidade,estado,pais) VALUES ('".$rua."', ".$numero.", '".$cidade."', '".$estado."', '".$pais."');");
    if ($sql) {
        $sql = mysqli_query($conn, "insert into tb_empresa VALUES ('".$cnpj."', '".$nome."', '".$nome_fantasia."', '".$email."', '".$tel_fixo."', '".$tel_celular."');");
        if ($sql) {
            $sucesso = "Cadastrado com sucesso!";
            header ("location: index.php?sucesso=$sucesso");
        } else {
            $erro = "Erro ao cadastrar empresa".mysqli_error($conn);
        }
    } else {
        $erro = "Erro ao cadastrar endereço".mysqli_error($conn);
    }
    header ("location: index.php?erro=$erro");
}
function atualizarEmpresa () {}
function deletarEmpresa () {}
function logout () {}

//Funcao que remove a pontuacao do cpf
function limpaCaracteres($valor){
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    $valor = str_replace("(", "", $valor);
    $valor = str_replace(")", "", $valor);
    return $valor;
}

?>