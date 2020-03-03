<?php require_once("../../conexao/conexao.php"); ?>


<?php
    
    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:../loginmaster.php");
    }
    // fim do teste de seguranca





    // insercao no banco
    if(isset($_POST["tmdid"])) {
        $turmamodalidadeid      = utf8_decode($_POST["tmdid"]);
        
        
        
        $deletar = "DELETE FROM turmamodalidades WHERE turmamodalidadesID = '$alunoid' "; 
        
        $operacao_deletar = mysqli_query($conecta,$deletar);
        if(!$operacao_deletar) {
            die("Erro no banco");
        } else {
            header("location:listagemturmas.php");   
        }
    }

     //selecao de turmas
    
    

    // selecao de turmamodalidades
    
    $tmd = "SELECT * ";
    $tmd .= "FROM turmamodalidades tmd JOIN turmas tm ON tmd.turmaid = tm.turmaID JOIN modalidades md ON md.modalidadeID = tmd.modalidadeid JOIN professores ON professores.professorID = tmd.professorid JOIN horarios ON horarios.horarioid = tm.horario JOIN diasemana ON diasemana.diaID = tm.diasemana ";
    if(isset($_GET["codigo"]) ) {
        $id = $_GET["codigo"];
        $tmd .= "WHERE turmamodalidadesID = {$id} ";
    } else {
        $tmd .= "WHERE turmamodalidadesID = 1 ";
    }
    
    $con_tmd = mysqli_query($conecta,$tmd);
    if(!$con_tmd) {
        die("Erro na consulta");
    }

    $info_tmd = mysqli_fetch_assoc($con_tmd);
    
    
    
    
    
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <!-- estilo -->
        <link href="../_css/estilo.css" rel="stylesheet">
        <link href="../_css/crud.css" rel="stylesheet">
        <link href="../_css/botao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topomaster.php"); ?>
        <button class="voltar"><a href="listagemturmas.php">Voltar</a></button> 
        <main>
          <a href="listagemturmas.php">Voltar</a> 
            <div id="">
                
                 
                <form action="excluirturmas.php" method="post">
                    
                    
                    <?php
                
                if(empty($info_tmd)) {
                    die ("Não há turmas"); 
                    // COLOCAR UM SCRIPT AQUI PARA O OCULTAR O FORM ABAIXO E A TABELA
                } else{ ?>
                
                    
                    <label for="nomemodalidade">Modalidade:</label>
                    <input type="text" name="nomemodalidade" value="<?php echo utf8_encode($info_tmd["nomemodalidade"])  ?>" >
                    <label for="diasemana">Dia da Semana Selecionado Atual</label>
                    <input type="text" name="diasemana" value="<?php echo utf8_encode($info_tmd["dia"])  ?>" >
                    
                    <label for="nomehorario">Horário Selecionado Atual</label>
                    <input type="text" name="nomehorario" value="<?php echo utf8_encode($info_tmd["horarioinicial"]) . " " . "às" . " " . utf8_encode($info_tmd["horariofinal"]);  ?>" >
                    
                    <label for="nomeprofessor">Professor Responsável:</label>
                    <input type="text" name="nomeprofessor" value="<?php echo utf8_encode($info_tmd["nomeprofessor"])  ?>" >
                    
                    <input type="hidden" name="tmdid" value="<?php echo utf8_encode($info_tmd["turmamodalidadesID"])?>">
                    
                    <input type="submit" value="Remover">
                </form>
                <?php } ?>
            </div>
            
        </main>
        
        
        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>