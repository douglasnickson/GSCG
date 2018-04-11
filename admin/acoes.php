<?php 
include ("../connection.php");

// Variaveis
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

// Saindo do sistema
if (isset($_GET['sair'])){
    if ($_GET['sair'] == "ok"){
        session_start();
        session_destroy();
        unset($_SESSION['logado']);
        $_SESSION['erro'] = "Até Mais!!";
        header("Location: login.php");
    }
}

switch ($tipo) {
    case '1':
        login();
        break;
    case '2':
        cadastrarEmpresa();
        break;
    case '3':
        atualizarEmpresa();
        break;
    case '4':
        deletarEmpresa();
        break;
    default:
        echo "Alternativa Invalida!!";
        break;
}

function login () {
    session_start();
    include ("../connection.php");
    if ((isset($_POST['login'])) && (isset($_POST['senha']))) {
        $login = addslashes($_POST['login']);
        $senha = addslashes($_POST['senha']);

        $query = mysqli_query ($conn, "select nome, senha from tb_usuario where nome = '".$login."' and senha = '".$senha."';");

        if ($query) {
            $_SESSION['logado'] = "Logado com Sucesso!";
            header("Location: index.php");
        } else {
            $_SESSION['erro'] = "Login ou Senha Invalido!".mysqli_error($conn);
            header("Location: login.php");
        }
    } else {
        $_SESSION['erro'] = "Preencha todos os Campos!";
        header("Location: login.php");
    }

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
    $tel_fixo       = addslashes(limpaCaracteres($_POST["tel_fixo"]));
    $tel_celular    = addslashes(limpaCaracteres($_POST["tel_celular"]));

    $sql = mysqli_query($conn, "insert into tb_empresa VALUES ('".$cnpj."', '".$nome."', '".$nome_fantasia."', '".$tel_fixo."', '".$tel_celular."');");
    if ($sql) {
        $sql = mysqli_query($conn, "insert into tb_endereco (id_empresa,rua,nr,cidade,estado,pais) VALUES ('".$cnpj."', '".$rua."', ".$numero.", '".$cidade."', '".$estado."', '".$pais."');");
        if ($sql) {
            $sucesso = "Cadastrado com sucesso!";
            header ("location: index.php?sucesso=$sucesso");
        } else {
            $erro = "Erro ao cadastrar empresa".mysqli_error($conn);
            header ("location: index.php?erro=$erro");
        }
    } else {
        $erro = "Erro ao cadastrar endereço".mysqli_error($conn);
        header ("location: index.php?erro=$erro");
    }
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
    $valor = str_replace(" ", "", $valor);
    return $valor;
}

?>