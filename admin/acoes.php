<?php 
/**
 * Metodos de gerenciamento da aplicação
 * @author Douglas Nickson Moura de Araújo - douglas.nickson1@gmail.com
 * @copyright Douglas Nickson - 2018
 * @since 13/04/2018
 * @version "1.0"
 */

session_start();

// Recebendo o tipo de acao
if (isset($_POST["acao"])) { $acao = $_POST["acao"]; }
else if (isset($_GET["acao"])) { $acao = $_GET["acao"]; }

switch ($acao) {
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
        $id = $_GET['id'];
        deletarEmpresa($id);
        break;
    case '5':
        logout();
        break;
    default:
        break;
}

// Metodo que faz o login no sistema
function login () {
    session_start();
    include ("../connection.php");

    // Verificando se os dados foram informados
    if ((!empty($_POST['login'])) || (!empty($_POST['senha']))) {
        $login = addslashes($_POST['login']);
        $senha = addslashes($_POST['senha']);

        // Busca os dados no banco de dados
        $query = mysqli_query ($conn, "select nome, senha from tb_usuario where nome = '".$login."' and senha = '".$senha."';") or die("erro ao selecionar");

        // Caso o retorno seja diferente de 0 autentica o usuario
        if (mysqli_num_rows($query) > 0) {
            $_SESSION['logado'] = "Logado com Sucesso!";
            header("Location: index.php");
            return;
        }
        $_SESSION['erro'] = "Login ou Senha incorreto ".mysqli_error($conn);
        header("Location: login.php");
        return;
    }
    $_SESSION['erro'] = "Preencha todos os campos!";
    header("Location: login.php");
}

// Metodo que faz logout do sistema
function logout () {
    session_start();
    session_destroy();
    unset($_SESSION['logado']);
    session_start();
    $_SESSION['erro'] = "Deslogado com sucesso, até mais!";
    header("Location: login.php");
}

// Metodo que cadastra a empresa no BD
function cadastrarEmpresa () {
    session_start();
    include ("../connection.php");

    // Recebendo os dados
    $rua            = addslashes($_POST["rua"]);
    $numero         = addslashes($_POST["numero"]);
    $bairro         = addslashes($_POST["bairro"]);
    $complemento    = addslashes($_POST["complemento"]);
    $cidade         = addslashes($_POST["cidade"]);
    $estado         = addslashes($_POST["estado"]);
    $pais           = addslashes($_POST["pais"]);
    $razao_social   = addslashes($_POST["nome"]);
    $nome_fantasia  = addslashes($_POST["nome_fantasia"]);
    $responsavel    = addslashes($_POST["responsavel"]);
    $email          = addslashes($_POST["email"]);
    $cnpj           = addslashes(limpaCaracteres($_POST["cnpj"]));
    $tel_fixo       = addslashes(limpaCaracteres($_POST["tel_fixo"]));
    $tel_celular    = addslashes(limpaCaracteres($_POST["tel_celular"]));

    // Verificando se existe dados vazios
    if ((empty($rua)) || (empty($numero)) || (empty($cidade)) || (empty($estado)) || (empty($pais)) || (empty($razao_social)) || (empty($cnpj))) {
        $_SESSION['erro'] = "Erro: Preencha todos os campos obrigatórios";
        header ("location: index.php");
        return;
    }

    // Inserindo dados da empresa no BD
    $query = mysqli_query($conn, "INSERT INTO tb_empresa (cnpj, razao_social, nome_fantasia, tel_fixo, tel_celular, responsavel, email) 
                        VALUES ('".$cnpj."', '".$razao_social."', '".$nome_fantasia."', '".$tel_fixo."', '".$tel_celular."', '".$responsavel."', '".$email."');");
    // Se nao tiver erro
    if ($query) { 
        // Buscando o id da empresa cadastrada
        $id_empresa = mysqli_query($conn, "SELECT id FROM tb_empresa WHERE cnpj = ".$cnpj);
        $result = mysqli_fetch_assoc($id_empresa);

        // Cadastrando o endereco da empresa
        $query = mysqli_query($conn, "INSERT INTO tb_endereco (id_empresa,rua,numero,cidade,estado,pais,bairro,complemento)
                            VALUES ('".$result['id']."', '".$rua."', '".$numero."', '".$cidade."', '".$estado."', '".$pais."', '".$bairro."', '".$complemento."');");
        // Verifica se foi inserido
        if ($query) {
            $_SESSION['sucesso'] = "Empresa cadastrada com sucesso!";
            header ("location: index.php");
            return;
        }
        // Mensagem de erro
        $_SESSION['erro'] = "Erro ao cadastrar empresa ".mysqli_error($conn);
        header ("location: index.php");
        return;
    }
    // Mensagem de erro
    $_SESSION['erro'] = "Erro ao cadastrar endereço ".mysqli_error($conn);
    header ("location: index.php");
    return;
}

function atualizarEmpresa () {
    session_start();
    include ("../connection.php");

    // Recebendo os dados
    $id            = addslashes($_POST["id"]);
    $rua            = addslashes($_POST["rua"]);
    $numero         = addslashes($_POST["numero"]);
    $bairro         = addslashes($_POST["bairro"]);
    $complemento    = addslashes($_POST["complemento"]);
    $cidade         = addslashes($_POST["cidade"]);
    $estado         = addslashes($_POST["estado"]);
    $pais           = addslashes($_POST["pais"]);
    $razao_social   = addslashes($_POST["nome"]);
    $nome_fantasia  = addslashes($_POST["nome_fantasia"]);
    $responsavel    = addslashes($_POST["responsavel"]);
    $email          = addslashes($_POST["email"]);
    $cnpj           = addslashes(limpaCaracteres($_POST["cnpj"]));
    $tel_fixo       = addslashes(limpaCaracteres($_POST["tel_fixo"]));
    $tel_celular    = addslashes(limpaCaracteres($_POST["tel_celular"]));

    // Verificando se existe dados vazios
    if ((empty($rua)) || (empty($numero)) || (empty($cidade)) || (empty($estado)) || (empty($pais)) || (empty($razao_social)) || (empty($cnpj))) {
        $_SESSION['erro'] = "Erro: Preencha todos os campos obrigatórios";
        header ("location: index.php");
        return;
    }

    // Atualizando os dados da empresa
    $query = mysqli_query($conn, "UPDATE tb_empresa SET cnpj='".$cnpj."', razao_social='".$razao_social."', nome_fantasia='".$nome_fantasia."', tel_fixo='".$tel_fixo."', tel_celular='".$tel_celular."', responsavel='".$responsavel."', email='".$email."' WHERE id = ".$id.";");
    if($query) {
        // Atualizando o endereco da empresa
        $query = mysqli_query($conn, "UPDATE tb_endereco SET rua='".$rua."', numero='".$numero."', cidade='".$cidade."', estado='".$estado."', pais='".$pais."', bairro='".$bairro."', complemento='".$complemento."' WHERE id_empresa = ".$id.";");
        // Sucesso
        if($query) {
            $_SESSION['sucesso'] = "Atualizado com sucesso!";
            header ("location: index.php");
            return;
        }
        // Mensagem de erro
        $_SESSION ['erro'] = "Erro ao atualizar o endereço da empresa ".mysqli_error($conn);
        header ("location: index.php");
        return;
    }
    // Mensagem de erro
    $_SESSION ['erro'] = "Erro ao atualizar os dados da empresa ".mysqli_error($conn);
    header ("location: index.php");
    return;
}

function deletarEmpresa ($id) {
    include ("../connection.php");
    $query = mysqli_query($conn, "delete from tb_endereco where id_empresa = ".$id);
    if ($query) {
        $query = mysqli_query($conn, "delete from tb_empresa where id = ".$id);
        if ($query) {
            echo "Empresa deletada com sucesso!";
            return;
        }
        echo "Erro ao deletar o endereço da empresa ".mysqli_error($conn);
        return;
    }
    echo "Erro ao deletar a empresa ".mysqli_error($conn);
    return;
}

// Funcao que remove a pontuacao do cpf
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