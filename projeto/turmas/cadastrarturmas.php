<?php require_once("../../conexao/conexao.php"); ?>


<?php
    
    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:../loginmaster.php");
    }
    // fim do teste de seguranca





    // insercao no banco
    if(isset($_POST["professorid"])) {
        
        $modalidadeid = utf8_decode($_POST["modalidadeid"]);
        $turmaid      = utf8_decode($_POST["turmaid"]);
        $professorid  = utf8_decode($_POST["professorid"]);
        
        
        
        $inserir    = "INSERT INTO turmamodalidades (turmaid, modalidadeid, professorid ) VALUES ('$turmaid','$modalidadeid', '$professorid') ";
        
        $operacao_inserir = mysqli_query($conecta,$inserir);
        if(!$operacao_inserir) {
            die("Erro no banco");
        } else {
            header("location:listagemturmas.php");   
        }
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
                      
                 $consultatm = "SELECT * FROM turmas JOIN diasemana ON diasemana.diaID = turmas.diasemana join horarios ON horarios.horarioid = turmas.horario  ";

                        $resultadotm = mysqli_query($conecta, $consultatm);
                    
            
                if(empty($resultadotm)){
                            
                            die("Não há horários");
                            
                        }
                
            ?>
                
            
                <form action="cadastrarturmas.php" method="post">
                    
                    
                    <?php 
                    $consultamd = "SELECT * FROM modalidades ";

                    $resultadomd = mysqli_query($conecta, $consultamd); 
                    ?>
                    
                    
                   <?php $consultapf = "SELECT * FROM professores ";

                    $resultadopf = mysqli_query($conecta, $consultapf);
                    
                    ?>
                    
                    <select name="modalidadeid">
                        <option value="" selected="selected">Selecione uma Modalidade </option>
                        <?php
                            while($linha = mysqli_fetch_assoc($resultadomd)) {
                        ?>
                            <option value="<?php echo $linha["modalidadeID"];  ?>"> 
                                <?php echo utf8_encode($linha["nomemodalidade"]) ;  ?>
                            </option>
                        <?php
                            }
                        ?>
                       
                    </select>
                    
                    <select name="turmaid">
                        <option value="" selected="selected">Selecione o Dia da Semana e Horário </option>
                        <?php
                            while($linha = mysqli_fetch_assoc($resultadotm)) {
                        ?>
                            <option value="<?php echo $linha["turmaID"];  ?>"> 
                                <?php echo utf8_encode($linha["dia"]) ." " . utf8_encode($linha["horarioinicial"]) . " " . "às" . " " . utf8_encode($linha["horariofinal"]);  ?>
                            </option>
                        <?php
                            }
                        ?>
                       
                    </select>
                    
                    <select name="professorid" required>
                        <option value="" selected="selected">Selecione o Professor Responsável </option>
                        <?php
                            while($linha = mysqli_fetch_assoc($resultadopf)) {
                        ?>
                            <option value="<?php echo $linha["professorID"];  ?>"> 
                                <?php echo utf8_encode($linha["nomeprofessor"]) ;  ?>
                            </option>
                        <?php
                            }
                        ?>
                       
                    </select>
                    
                    
                     
                   <input type="submit" value="inserir">
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