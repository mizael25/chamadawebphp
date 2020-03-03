<?php require_once("../../conexao/conexao.php"); ?>
<?php

    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:../loginmaster.php");
    }
    // fim do teste de seguranca


    if( isset($_POST["nomeprofessor"]) ) {
        $nomeprofessor       = utf8_decode($_POST["nomeprofessor"]);
        $datanascimento   = utf8_decode($_POST["datanascimento"]);
        $email     = $_POST["email"];
        $usuario       = $_POST["usuario"];
        $senha      = $_POST["senha"];
        $professorid = $_POST["professorid"];
        
        
        // Objeto para alterar
        $alterar = "UPDATE professores SET nomeprofessor = '$nomeprofessor', datanascimento = '$datanascimento', email = '$email', usuario = '$usuario', senha = '$senha' WHERE professorID = $professorid  ";
        
        $operacao_alterar = mysqli_query($conecta, $alterar);
        if(!$operacao_alterar) {
            die("Erro na alteracao");   
        } else {
            header("location:listagemprofessor.php");   
        }
        
    }

    // Consulta a tabela de professor
    $professor = "SELECT * ";
    $professor .= "FROM professores ";
    if(isset($_GET["codigo"]) ) {
        $id = $_GET["codigo"];
        $professor .= "WHERE professorID = {$id} ";
    } else {
        $professor .= "WHERE professorID = 2 ";
    }
    
    $con_professor = mysqli_query($conecta,$professor);
    if(!$con_professor) {
        die("Erro na consulta");
    }

    $info_professor = mysqli_fetch_assoc($con_professor);

    

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
        <button class="voltar"><a href="listagemprofessor.php">Voltar</a></button> 
        <main> 
            
            <div id="janela_formulario">
                <form action="alterarprofessor.php" method="post">
                    <h2>Alteração de Professor</h2>
                    
                    <label for="nomeprofessor">Nome do Professor: </label>
                    <input type="text" name="nomeprofessor" value="<?php echo utf8_encode($info_professor["nomeprofessor"])  ?>" >
                    
                    <label for="datanascimento">Data de Nascimento: </label>
                    <input type="date" name="datanascimento" value="<?php echo utf8_encode($info_professor["datanascimento"])  ?>" >
                    
                    <label for="email">E-mail: </label>
                    <input type="email" name="email" value="<?php echo utf8_encode($info_professor["email"])  ?>" placeholder="E-mail">
                    
                    
                     <label for="usuario">Usuário: </label>
                     <input type="text" name="usuario" value="<?php echo utf8_encode($info_professor["usuario"])  ?>" placeholder="Usuário">
                     <label for="senha">Senha: </label>
                     <input type="text" name="senha" value="<?php echo utf8_encode($info_professor["senha"])  ?>" placeholder="Senha">
                    
                    
                    <input type="hidden" name="professorid" value="<?php echo $info_professor["professorID"] ?>">
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