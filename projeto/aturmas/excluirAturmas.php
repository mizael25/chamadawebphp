<?php require_once("../../conexao/conexao.php"); ?>


<?php
    
    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:../loginmaster.php");
    }
    // fim do teste de seguranca





    // insercao no banco
    if(isset($_POST["turmamodalidadeid"])) {
        $turmamodalidadeid      = utf8_decode($_POST["turmamodalidadeid"]);
        $alunoid  = utf8_decode($_POST["alunoid"]);
        
        
        $deletar = "DELETE FROM alunos_turmamodalidade WHERE alunocod = '$alunoid' AND turmamodalidadeID = '$turmamodalidadeid'  "; 
        
        $operacao_deletar = mysqli_query($conecta,$deletar);
        if(!$operacao_deletar) {
            die("Erro no banco");
        } else {
            header("location:../turmas/listagemturmas.php");   
        }
    }

     //selecao de turmas
    
    

    // selecao de alunosturmasmd
    
    $aln = "SELECT * ";
    $aln .= "FROM alunos_turmamodalidade atm JOIN turmamodalidades tmd ON atm.turmamodalidadeID = tmd.turmamodalidadesID JOIN  turmas tm ON tmd.turmaid = tm.turmaID JOIN horarios hr ON hr.horarioid = tm.horario JOIN modalidades md ON md.modalidadeID = tmd.modalidadeid JOIN diasemana ds ON ds.diaID = tm.diasemana JOIN alunos ";
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
        <title></title>
        
        <!-- estilo -->
        <link href="../_css/estilo.css" rel="stylesheet">
        <link href="../_css/crud.css" rel="stylesheet">
        <link href="../_css/botao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topomaster.php"); ?>
        
        <main> 
            <a href="../turmas/detalharturma.php?codigo=<?php echo $info_alunos["turmamodalidadeID"] ?>">Voltar</a>
            <div id="">
                
                 
                <form action="excluirAturmas.php" method="post">
                    
                    
                    <?php
                
                if(empty($info_alunos)) {
                    die ("Não há Disponibilidade"); 
                    // COLOCAR UM SCRIPT AQUI PARA O OCULTAR O FORM ABAIXO E A TABELA
                } else{ ?>
                <label for="nomealuno">Nome do Aluno:</label>
                    <input type="text" name="nomealuno" value="<?php echo utf8_encode($info_alunos["nomealuno"])  ?>" >
                    
                    <label for="nomemodalidade">Modalidade:</label>
                    <input type="text" name="nomemodalidade" value="<?php echo utf8_encode($info_alunos["nomemodalidade"])  ?>" >
                    <label for="diasemana">Dia da Semana Selecionado Atual</label>
                    <input type="text" name="diasemana" value="<?php echo utf8_encode($info_alunos["dia"])  ?>" >
                    
                    <label for="nomehorario">Horário Selecionado Atual</label>
                    <input type="text" name="nomehorario" value="<?php echo utf8_encode($info_alunos["horarioinicial"]) . " " . "às" . " " . utf8_encode($info_alunos["horariofinal"]);  ?>" >
                    
                    <input type="hidden" name="turmamodalidadeid" value="<?php echo utf8_encode($info_alunos["turmamodalidadeID"])?>">
                    
                    <input type="hidden" name="alunoid" value="<?php echo utf8_encode($info_alunos["alunocod"])?>">
                    
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