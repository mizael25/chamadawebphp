<?php require_once("../../conexao/conexao.php"); ?>
<?php

    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:../loginmaster.php");
    }
    // fim do teste de seguranca
    
    if( isset($_POST["nomealuno"]) ) {
        $alunoid = $_POST["alunoID"];
        echo $alunoid;
        
        $exclusao = "DELETE FROM alunos WHERE alunoID = $alunoid ; ";
        
        $con_exclusao = mysqli_query($conecta,$exclusao);
        if(!$con_exclusao) {
            die("Registro não excluído");
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
                <form action="excluiralunos.php" method="post">
                    <h2>Exclusão do Aluno</h2>
                    
                    <label for="nomealuno">Nome do Aluno</label>
                    <input type="text" name="nomealuno" value="<?php echo utf8_encode($info_alunos["nomealuno"])  ?>" >
                    
                    <label for="datanascimento">Data de Nascimento</label>
                    <input type="date" name="datanascimento" value="<?php echo utf8_encode($info_alunos["datanascimento_aluno"])  ?>" >
                    
                    <label for="nomeresponsavel">Responsável</label>
                    <input type="text" name="nomeresponsavel" value="<?php echo utf8_encode($info_alunos["nomeresponsavel"])  ?>" >
                    
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" value="<?php echo utf8_encode($info_alunos["cpf"])  ?>" >

                    

                    <input type="text" name="alunoID" value="<?php echo $info_alunos["alunoID"] ?>">
                    <input type="submit" value="Confirmar exclusão">                    
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