<?php require_once("../../conexao/conexao.php"); ?>
<?php

    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:../loginmaster.php");
    }
    // fim do teste de seguranca


    if( isset($_POST["nomealuno"]) ) {
        $nomealuno       = utf8_decode($_POST["nomealuno"]);
        $datanascimento   = utf8_decode($_POST["datanascimento"]);
        $nomeresponsavel    = utf8_decode($_POST["nomeresponsavel"]);
        $cpf    = utf8_decode($_POST["cpf"]);
        $email     = $_POST["email"];
        $endereco       = $_POST["endereco"];
        $complemento       = $_POST["complemento"];
        $numero       = $_POST["numero"];
        $cidade       = $_POST["cidade"];
        $estadoid       = $_POST["estadoid"];
        $cep       = $_POST["CEP"];
        $telefone       = $_POST["telefone"];
        $usuario       = $_POST["usuario"];
        $senha      = $_POST["senha"];
        
        $alunoid = $_POST["alunoID"];
        
        
        // Objeto para alterar
        $alterar = "UPDATE alunos SET nomealuno = '$nomealuno', datanascimento_aluno = '$datanascimento', nomeresponsavel = '$nomeresponsavel', cpf = '$cpf', email = '$email', endereco = '$endereco', complemento = '$complemento', numero = '$numero', cidade = '$cidade', estadoID = '$estadoid', cep = '$cep', telefone = '$telefone', usuario = '$usuario', senha = '$senha' WHERE alunoID = $alunoid  ";
        
        $operacao_alterar = mysqli_query($conecta, $alterar);
        if(!$operacao_alterar) {
            die("Erro na alteracao");   
        } else {
            header("location:listagemalunos.php");   
        }
        
    }

    // Consulta a tabela de alunos
    $aln = "SELECT * ";
    $aln .= "FROM alunos ";
    if(isset($_GET["codigo"]) ) {
        $id = $_GET["codigo"];
        $aln .= "WHERE alunoID = {$id} ";
    } else {
        $aln .= "WHERE alunoID = 2 ";
    }
    
    $con_alunos = mysqli_query($conecta,$aln);
    if(!$con_alunos) {
        die("Erro na consulta");
    }

    $info_alunos = mysqli_fetch_assoc($con_alunos);

    // consulta aos estados
    $estados = "SELECT * ";
    $estados .= "FROM estados ";
    $lista_estados = mysqli_query($conecta, $estados);
    if(!$lista_estados) {
       die("erro no banco"); 
    }

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Evolução Esportes</title>
        
        <!-- estilo -->
        <link href="../_css/estilo.css" rel="stylesheet">
        <link href="../_css/alteracao.css" rel="stylesheet">
        <link href="../_css/botao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topomaster.php"); ?>
        <button class="voltar"><a href="listagemalunos.php">Voltar</a></button>
        <main>  
            <div id="janela_formulario">
                <form action="alteraralunos.php" method="post">
                    <h2>Alteração de Aluno</h2>
                    
                    <label for="nomealuno">Nome do Aluno</label>
                    <input type="text" name="nomealuno" value="<?php echo utf8_encode($info_alunos["nomealuno"])  ?>" >
                    
                    <label for="datanascimento">Data de Nascimento</label>
                    <input type="date" name="datanascimento" value="<?php echo utf8_encode($info_alunos["datanascimento_aluno"])  ?>" >
                    
                    <label for="nomeresponsavel">Responsável</label>
                    <input type="text" name="nomeresponsavel" value="<?php echo utf8_encode($info_alunos["nomeresponsavel"])  ?>" >
                    
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" value="<?php echo utf8_encode($info_alunos["cpf"])  ?>" >
                    
                    <label for="email">E-mail</label>
                    <input type="email" name="email" value="<?php echo utf8_encode($info_alunos["email"])  ?>" placeholder="E-mail">
                    
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" value="<?php echo utf8_encode($info_alunos["endereco"])  ?>" placeholder="Endereço">
                    
                    <label for="complemento">Complemento</label>
                    <input type="text" name="complemento" value="<?php echo utf8_encode($info_alunos["complemento"])  ?>" placeholder="Complemento">
                    
                    <label for="numero">Número</label>
                    <input type="number" name="numero" value="<?php echo utf8_encode($info_alunos["numero"])  ?>" placeholder="Número">
                    
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" value="<?php echo utf8_encode($info_alunos["cidade"])  ?>" placeholder="Cidade">
                    
                    
                    <label for="estadoid">Estado</label>
                    <select id="estadoid" name="estadoid"> 
                        <?php 
                            $meuestado = $info_alunos["estadoID"];
                            while($linha = mysqli_fetch_assoc($lista_estados)) {
                                $estado_principal = $linha["estadoID"];
                                if($meuestado == $estado_principal) {
                        ?>
                            <option value="<?php echo $linha["estadoID"] ?>" selected>
                                <?php echo utf8_encode($linha["nomeestado"]) ?>
                            </option>
                        <?php
                                } else {
                        ?>
                            <option value="<?php echo $linha["estadoID"] ?>" >
                                <?php echo utf8_encode($linha["nomeestado"]) ?>
                            </option>                        
                        <?php 
                                }
                            }
                        ?>
                    </select>
                     <label for="CEP">CEP</label>
                     <input type="text" name="CEP" value="<?php echo utf8_encode($info_alunos["cep"])  ?>" placeholder="CEP">
                     <label for="telefone">Telefone</label>
                     <input type="number" name="telefone" value="<?php echo utf8_encode($info_alunos["telefone"])  ?>" placeholder="telefone">
                     <label for="usuario">Usuário</label>
                     <input type="text" name="usuario" value="<?php echo utf8_encode($info_alunos["usuario"])  ?>" placeholder="Usuário">
                     <label for="senha">Senha</label>
                     <input type="text" name="senha" value="<?php echo utf8_encode($info_alunos["senha"])  ?>" placeholder="Senha">
                    
                    
                    <input type="hidden" name="alunoID" value="<?php echo $info_alunos["alunoID"] ?>">
                    <input type="submit" value="Confirmar alteração">                    
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