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
        
        $inserir    = "INSERT INTO alunos_turmamodalidade (turmamodalidadeID, alunocod) VALUES ('$turmamodalidadeid', '$alunoid')";
        
        $operacao_inserir = mysqli_query($conecta,$inserir);
        if(!$operacao_inserir) {
            die("Erro no banco");
        } else {
            header("location:../turmas/listagemturmas.php");   
        }
    }

     
    
    

    // selecao de alunos
    $select = "SELECT * FROM alunos ";
    
    $lista_alunos = mysqli_query($conecta, $select);
    if(!$lista_alunos) {
        die("Erro no banco");
    }
    
        if(isset($_GET["codigo"]) ) {
           $tmdid = $_GET["codigo"];
                                
                            }

        $tmd0 = "SELECT tmd.modalidadeid FROM turmamodalidades tmd JOIN turmas tm ON tmd.turmaid = tm.turmaID JOIN modalidades md ON md.modalidadeID = tmd.modalidadeid JOIN professores ON professores.professorID = tmd.professorid JOIN horarios ON horarios.horarioid = tm.horario JOIN diasemana ON diasemana.diaID = tm.diasemana WHERE tmd.turmamodalidadesID = {$tmdid} ";
                                
        $resultadotmd0 = mysqli_query($conecta, $tmd0);
            if(!$resultadotmd0) {
             die("Erro");   
        }
        
        $infotmd = mysqli_fetch_assoc($resultadotmd0);





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
         <button class="voltar"><a href="../turmas/listagemturmas.php?modalidadeid=<?php echo $infotmd["modalidadeid"] ;?>">Voltar</a></button>   
        <main> 
            <div id="">
                
                <form action="cadastrarAturmas.php" method="post">
                    
                    
                        
                        <?php
                    
                            
                                
                                $tmd = "SELECT * FROM turmamodalidades tmd JOIN turmas tm ON tmd.turmaid = tm.turmaID JOIN modalidades md ON md.modalidadeID = tmd.modalidadeid JOIN professores ON professores.professorID = tmd.professorid JOIN horarios ON horarios.horarioid = tm.horario JOIN diasemana ON diasemana.diaID = tm.diasemana WHERE tmd.turmamodalidadesID = {$tmdid} ";
                                
                                $resultadotmd = mysqli_query($conecta, $tmd);
                                if(!$resultadotmd) {
                                    die("Erro");   
                                }
                                
                                     
                           
                        
                        ?>
                    <?php  while($linha = mysqli_fetch_assoc($resultadotmd)) {   ?>
                    <a href="../turmas/listagemturmas.php?modalidadeid=<?php echo $linha["modalidadeid"];?>">Voltar</a>
                    <ul>
                    
                    <li> Dia da Semana e Horário: <?php echo utf8_encode($linha["dia"]) . " " . utf8_encode($linha["horarioinicial"]) . " " . "às" . " " . utf8_encode($linha["horariofinal"])         ?></li>
                    <li>Professor Responsável: <?php echo utf8_encode($linha["nomeprofessor"]) ?> </li>
                        
                     </ul>
                    
                    <input name="turmamodalidadeid" type="hidden" value="<?php echo utf8_encode($linha["turmamodalidadesID"])?>">
                    
        
            
                  <?php  } ?>
                       
                   
                    
                    <select name="alunoid" required>
                        <option selected="selected">Selecione um Aluno(a)</option>
                        <?php
                            while($linha2 = mysqli_fetch_assoc($lista_alunos)) {
                        ?>
                            <option value="<?php echo $linha2["alunoID"];  ?>">
                                <?php echo utf8_encode($linha2["nomealuno"]);  ?>
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