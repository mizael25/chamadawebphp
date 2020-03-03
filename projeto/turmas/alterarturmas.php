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
        $turmaid      = utf8_decode($_POST["turmaid"]);
        $professorid      = utf8_decode($_POST["professorid"]);
        
       
        
        
        $alterar = "UPDATE turmamodalidades SET turmaid = '$turmaid', professorid = '$professorid' WHERE turmamodalidadesID = $turmamodalidadeid  "; 
        
        $operacao_alterar = mysqli_query($conecta,$alterar);
        if(!$operacao_alterar) {
            die("Erro no banco");
        } else {
            header("location:listagemturmas.php");   
        }
    }

     
    
    

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

    // consulta professores
    $professores = "SELECT * ";
    $professores .= "FROM professores ";
    $lista_professores = mysqli_query($conecta, $professores);
    if(!$lista_professores) {
       die("erro no banco"); 
    }

    // consulta turmas
    

    $turmas = "SELECT * FROM turmas JOIN diasemana ON diasemana.diaID = turmas.diasemana join horarios ON horarios.horarioid = turmas.horario ";
    $lista_turmas = mysqli_query($conecta, $turmas);
    if(!$lista_turmas) {
       die("erro no banco"); 
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
        <link href="../_css/botao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topomaster.php"); ?>
        <button class="voltar"><a href="listagemturmas.php">Voltar</a></button> 
        <main> 
            
            <div id="">
                
                  <?php
                
                if(empty($info_tmd)) {
                    die ("Não há Disponibilidade"); 
                    // COLOCAR UM SCRIPT AQUI PARA O OCULTAR O FORM ABAIXO E A TABELA
                } else{ ?>
                
                    <form action="alterarturmas.php" method="post">
                
                    <label for="nomemodalidade">Modalidade:</label>
                    <input type="text" name="nomemodalidade" value="<?php echo utf8_encode($info_tmd["nomemodalidade"])  ?>" >
                    <label for="turmaid">Dia e Horário Atual</label>
                    <select name="turmaid">
                        
                        <?php
                            $minhaturma = $info_tmd["turmaID"];
                            while($linha = mysqli_fetch_assoc($lista_turmas)) {
                                $turma_principal = $linha["turmaID"];
                                if($minhaturma == $turma_principal) {    
                        ?>
                            <option value="<?php echo $linha["turmaID"];  ?>" selected="selected"><?php echo utf8_encode($linha["dia"]) ." " . utf8_encode($linha["horarioinicial"]) . " " . "às" . " " . utf8_encode($linha["horariofinal"]);  ?> </option>
                            
                            <?php
                                } else {
                            ?>
                        
                            <option value="<?php echo $linha["turmaID"];  ?>"> 
                                <?php echo utf8_encode($linha["dia"]) ." " . utf8_encode($linha["horarioinicial"]) . " " . "às" . " " . utf8_encode($linha["horariofinal"]);  ?>
                            </option>
                        <?php
                                        }
                            }
                        ?>
                       
                    </select>    
                        
                    <label for="professorid">Professor Atual: </label>
                    <select id="professorid" name="professorid"> 
                        <?php 
                            
                            $meuprofessor = $info_tmd["professorID"];
                            while($linha = mysqli_fetch_assoc($lista_professores)) {
                                $professor_principal = $linha["professorID"];
                                if($meuprofessor == $professor_principal) {
                        ?>
                            <option value="<?php echo $linha["professorID"] ?>" selected>
                                <?php echo utf8_encode($linha["nomeprofessor"]) ?>
                            </option>
                        <?php
                                } else {
                        ?>
                            <option value="<?php echo $linha["professorID"] ?>" >
                                <?php echo utf8_encode($linha["nomeprofessor"]) ?>
                            </option>                        
                        <?php 
                                }
                            }
                        ?>
                    </select>
                    
                    <input type="hidden" name="tmdid" value="<?php echo utf8_encode($info_tmd["turmamodalidadesID"])?>">
                    
                    <input type="submit" value="Atualizar">
                        
                     </form>    
                
                <?php 
                    
                }
                 ?>
                
            </div>
            
        </main>
        
        
        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>