<?php require_once("../../conexao/conexao.php"); ?>


<?php
    
    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:../loginmaster.php");
    }
    // fim do teste de seguranca





    // insercao no banco
    if(isset($_POST["nomealuno"])) {
        $nomealuno       = utf8_decode($_POST["nomealuno"]);
        $datanascimento   = utf8_decode($_POST["datanascimento"]);
        $nomeresponsavel    = utf8_decode($_POST["nomeresponsavel"]);
        $cpf    = utf8_decode($_POST["cpf"]);
        $email     = $_POST["email"];
        $endereco       = $_POST["endereco"];
        $complemento       = $_POST["complemento"];
        $numero       = $_POST["numero"];
        $cidade       = $_POST["cidade"];
        $estado       = $_POST["estado"];
        $cep       = $_POST["CEP"];
        $telefone       = $_POST["telefone"];
        $usuario       = $_POST["usuario"];
        $senha      = $_POST["senha"];
        
        
        
       
        
        
        $inserir    = "INSERT INTO alunos (nomealuno, datanascimento_aluno, nomeresponsavel, cpf, email , endereco, complemento, numero, cidade, estadoID, cep, telefone, usuario, senha) VALUES ('$nomealuno', '$datanascimento', '$nomeresponsavel', '$cpf', '$email','$endereco','$complemento','$numero','$cidade','$estado','$cep','$telefone','$usuario','$senha')";
        
        
        $operacao_inserir = mysqli_query($conecta,$inserir);
        if(!$operacao_inserir) {
            die("Erro no banco");
        } else {
            header("location:listagemalunos.php");   
        }
    }

    // selecao de estados
    $select = "SELECT estadoID, nomeestado ";
    $select .= "FROM estados ";
    $lista_estados = mysqli_query($conecta, $select);
    if(!$lista_estados) {
        die("Erro no banco");
    }

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <!-- estilo -->
        <link href="../_css/estilo.css" rel="stylesheet">
        <link href="../_css/crud.css" rel="stylesheet">
        <link href="../_css/inclusao.css" rel="stylesheet">
        <link href="../_css/botao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topomaster.php"); ?>
        <button class="voltar"><a href="listagemalunos.php">Voltar</a></button>
        <main> 
            
            <div id="janela_formulario">
            
                <form action="cadastraralunos.php" method="post">
                    <input type="text" required name="nomealuno" placeholder="Nome do Aluno">
                    <input type="date" required name="datanascimento" placeholder="Data de Nascimento">
                    <input type="text" required name="nomeresponsavel" placeholder="Nome do Responsável">
                    <input type="text" required name="cpf" placeholder="CPF do Responsável ">
                    <input type="email" required name="email" placeholder="E-mail">
                    <input type="text" required name="endereco" placeholder="Endereço">
                    <input type="text" name="complemento" placeholder="Complemento">
                    <input type="number" required name="numero" placeholder="Número">
                    <input type="text" required name="cidade" placeholder="Cidade">
                    <select required name="estado">
                        <?php
                            while($linha = mysqli_fetch_assoc($lista_estados)) {
                        ?>
                            <option value="<?php echo $linha["estadoID"];  ?>">
                                <?php echo utf8_encode($linha["nomeestado"]);  ?>
                            </option>
                        <?php
                            }
                        ?>
                       
                    </select>
                     <input required type="number" name="CEP" placeholder="CEP">
                     <input type="number" required name="telefone" placeholder="telefone">
                     <input type="text" required name="usuario" placeholder="Usuário">  
                     <input type="text" required name="senha" placeholder="Senha">
                    
                    <input type="submit" value="Cadastrar">
                </form>
            </div>
            
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>