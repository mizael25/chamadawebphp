<?php require_once("../../conexao/conexao.php"); ?>
<?php

    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:loginmaster.php");
    }
    // fim do teste de seguranca
    
    if( isset($_POST["nomeprofessor"]) ) {
        $professorid = $_POST["professorid"];
        
        
        $exclusao = "DELETE FROM professores WHERE professorID = $professorid ; ";
        
        $con_exclusao = mysqli_query($conecta,$exclusao);
        if(!$con_exclusao) {
            die("Registro não excluído");
        } else {
            header("location:listagemprofessor.php");   
        }
    }

    
    
     // Consulta a tabela de professores
    $professor= "SELECT * ";
    $professor .= "FROM professores ";
    if(isset($_GET["codigo"]) ) {
        $id = $_GET["codigo"];
        $professor .= "WHERE professorID = {$id} ";
    } else {
        $professor .= "WHERE professorID = 4 ";
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
                 
                <form action="excluirprofessor.php" method="post">
                    <h2>Exclusão do Professor</h2>
                     
                    <label for="nomeprofessor">Nome do Professor:</label>
                    <input type="text" name="nomeprofessor" value="<?php echo utf8_encode($info_professor["nomeprofessor"])  ?>" >
                    
                    <label for="datanascimento">Data de Nascimento:</label>
                    <input type="date" name="datanascimento" value="<?php echo utf8_encode($info_professor["datanascimento"])  ?>" >
                     
                    <label for="email">Email: </label>
                    <input type="email" name="email" value="<?php echo utf8_encode($info_professor["email"])  ?>" >
                    
                    <input type="hidden" name="professorid" value="<?php echo $info_professor["professorID"] ?>">
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