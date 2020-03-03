<?php require_once("../conexao/conexao.php"); ?>

<?php
    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:loginprofessor.php");
    }
    // fim do teste de seguranca

    // Determinar localidade BR
    setlocale(LC_ALL, 'pt_BR');

    $professorid = $_SESSION["user_portal"];

    //consulta a tabela turmamodalidades, turmas, dia semana, horários , modalidade.

    $consultatm = "SELECT * FROM turmamodalidades tmd JOIN turmas tm ON tmd.turmaid = tm.turmaID JOIN diasemana ds ON tm.diasemana = ds.diaID JOIN horarios hrs ON tm.horario = hrs.horarioid JOIN modalidades md ON tmd.modalidadeid = md.modalidadeID  WHERE tmd.professorid = {$professorid} ORDER BY ds.diaID ASC ";



    $resultadotm = mysqli_query($conecta, $consultatm);


   


    
   
    
    




    


    
    
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Evolução</title>
        
        <!-- estilo -->
        <link href="_css/estilo2.css" rel="stylesheet">
        <link href="../_css/botao.css" rel="stylesheet">
       
        
        
        
   
    </head>

    <body>
        
        <?php include_once("_incluir/topoprofessor.php"); ?>
         <div class="menu">
                 <ul>
                      <li><a href="turmasprofessor.php" >Turmas</a></li>
                      <li><a href="chamadaprofessor.php">Chamadas</a></li>
                 </ul>     
                      
              </div>   
        
        <main>
          
            
            
            <div> 
            <?php
                if(!$resultadotm) {
                    die("Não há turmas");   
                }
                
                
                
               
                
                
                
                
                
            ?>
                
                
                <table border="12">
                      <tr>
                        <th>Modalidade</th>
                        <th>Dia da Semana</th> 
                        <th>Horário</th>
                      </tr>
                         
                           <?php
                         while ($dadostm = mysqli_fetch_assoc($resultadotm)){
                    ?>
                   
                      <tr>
                     
                        <td>
                            
                            
                          <?php
                             
                            echo utf8_encode($dadostm["nomemodalidade"]);       ?></td>
                            <td><?php
                                
                    
                        
                    
                    
                                echo utf8_encode($dadostm["dia"]);      ?>
                             
                                
                             
                             </td>
                            <td >
                          
                          <?php
                             
                    
                        
                    
                    
                                echo  $dadostm["horarioinicial"] . " " . "às" . " " . $dadostm["horariofinal"];  
                             
                                
                             
                             
                             
                             ?>
                          
                          
                          </td>
                      </tr>
                      <?php 
                         }
                        ?>
                    </table>
                      
            </div>
            
        </main>

        <?php include_once("_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>