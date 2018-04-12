<?php 
session_start();
$erro = "";

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

// Validando o tipo de ação
if (isset($_POST["tipo_formulario"])) {
    $tipo = $_POST["tipo_formulario"];
} else if (isset($_GET["tipo_formulario"])) {
    $tipo = $_GET["tipo_formulario"];
} else {
    $erro = "Informe o tipo da ação!";
}

if ((!$tipo == 3) || (!$tipo == 4) ) {
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
}
if ($erro == "") {
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
} else {
    $_SESSION['erro'] = $erro;
    header("Location: index.php");
}



function login () {
    session_start();
    include ("../connection.php");

    if ((isset($_POST['login'])) && (isset($_POST['senha']))) {
        $login = addslashes($_POST['login']);
        $senha = addslashes($_POST['senha']);

        $query = mysqli_query ($conn, "select nome, senha from tb_usuario where nome = '".$login."' and senha = '".$senha."';") or die("erro ao selecionar");

        if (mysqli_num_rows($query) > 0) {
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
    session_start();
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

    $sql = mysqli_query($conn, "insert into tb_empresa (cnpj, nome, nome_fantasia, tel_fixo, tel_celular) VALUES ('".$cnpj."', '".$nome."', '".$nome_fantasia."', '".$tel_fixo."', '".$tel_celular."');");
    if ($sql) {
        $sql_id = mysqli_query($conn, "select id from tb_empresa where cnpj = ".$cnpj);
        $linha = mysqli_fetch_assoc($sql_id);
        $sql = mysqli_query($conn, "insert into tb_endereco (id_empresa,rua,nr,cidade,estado,pais) VALUES ('".$linha['id']."', '".$rua."', ".$numero.", '".$cidade."', '".$estado."', '".$pais."');");
        if ($sql) {
            $_SESSION['sucesso'] = "Cadastrado com sucesso!";
            header ("location: index.php");
        } else {
            $_SESSION['erro'] = "Erro ao cadastrar empresa".mysqli_error($conn);
            header ("location: index.php");
        }
    } else {
        $_SESSION['erro'] = "Erro ao cadastrar endereço".mysqli_error($conn);
        header ("location: index.php");
    }
}
function atualizarEmpresa () {
    session_start();
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
    $id = $_POST['id'];

    $query = mysqli_query($conn, "update tb_empresa set cnpj='".$cnpj."', nome='".$nome."', nome_fantasia='".$nome_fantasia."', tel_fixo='".$tel_fixo."', tel_celular='".$tel_celular."' where id = ".$id.";");
    if ($query) {
        $query = mysqli_query($conn, "update tb_endereco set rua='".$rua."', nr='".$numero."', cidade='".$cidade."', estado='".$estado."', pais='".$pais."' where id_empresa = ".$id.";");
        if ($query) {
            $_SESSION['sucesso'] = "Atualizado com sucesso!";
            header ("location: index.php");
        } else {
            $_SESSION ['erro'] = "Erro ao atualizar o endereço da empresa ".mysqli_error($conn);
            header ("location: index.php");
        }
    } else {
        $_SESSION ['erro'] = "Erro ao atualizar os dados da empresa ".mysqli_error($conn);
        header ("location: index.php");
    }
}
function deletarEmpresa () {
    session_start();
    include ("../connection.php");
    $id = $_GET['id'];
    $query = mysqli_query($conn, "delete from tb_endereco where id_empresa = ".$id);
    if ($query) {
        $query = mysqli_query($conn, "delete from tb_empresa where id = ".$id);
        if ($query) {
            $_SESSION ['sucesso'] = "Empresa deletada com sucesso!";
            header ("location: index.php");
        } else {
            $_SESSION ['erro'] = "Erro ao deletar o endereço da empresa ".mysqli_error($conn);
            header ("location: index.php");
        }
    } else {
        $_SESSION ['erro'] = "Erro ao deletar a empresa ".mysqli_error($conn);
        header ("location: index.php");
    }
}
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