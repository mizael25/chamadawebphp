<?php require_once("../conexao/conexao.php"); ?>

<?php
    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:loginprofessor.php");
    }
    // fim do teste de seguranca


    // Determinar localidade BR
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $professorid = $_SESSION["user_portal"];

    //consulta a tabela alunosturmamodalidades, turmamodalidade, turmas, diasemana, horarios e alunos

    $diasemanaatual = date("N");
    
?>

 
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Evolução</title>
        
        <!-- estilo -->
        <link href="_css/estilo2.css" rel="stylesheet">
        
        
    </head>

    <body>
        <?php include_once("_incluir/topoprofessor.php"); ?>
        <div class="menu">
                 <ul>
                     <li> <a href="turmasprofessor.php" >Turmas</a></li>
                     <li><a href="chamadaprofessor.php">Chamadas</a></li>
                 </ul>     
                      
              </div> 
        <main>
            
             
            
            <p>Data:<?php echo date('d/m/Y') ?> </p>
            
            
            <?php 
                    $consultatmhr = "SELECT DISTINCT hrs.* FROM alunos_turmamodalidade atm JOIN turmamodalidades tmd ON atm.turmamodalidadeID = tmd.turmamodalidadesID JOIN turmas tm ON tmd.turmaid = tm.turmaID JOIN diasemana ds ON tm.diasemana = ds.diaID JOIN horarios hrs ON tm.horario = hrs.horarioid JOIN alunos ON atm.alunocod = alunos.alunoID WHERE tmd.professorid = {$professorid} AND ds.diaID = {$diasemanaatual}";

                    $resultadotmhr = mysqli_query($conecta, $consultatmhr);  ?>
            
            
            <?php
                if(empty($resultadotmhr)) {
                    die ("Não há turmas"); 
                    // COLOCAR UM SCRIPT AQUI PARA O OCULTAR O FORM ABAIXO E A TABELA
                }else{
            
               
            ?>
            
            <form name="obterhorario" id="buscarHorarios" method="get" >
            
                    <select name="horario" id="horarios">
                        
                        <option value="" selected>Selecione um horário</option>
                        <?php
                            while($linha = mysqli_fetch_assoc($resultadotmhr)) {
                        ?>
                            <option value="<?php echo $linha["horarioid"];  ?>">
                                <?php echo utf8_encode($linha["horarioinicial"]) . " " . "às" . " " . utf8_encode($linha["horariofinal"]);  ?>
                            </option>
                        <?php
                            }
                        ?>                        
                    </select>
                
                
                
                <input type="submit" value="Buscar"  />
            </form>
            
            
            
             <script> 
            // aguarda a página ser carregada para depois chamar essa função
      window.onload = function() {
        var ultimaCategoria = localStorage.getItem('ultima_categoria'); // pega o valor que está guardado e atribui a uma variável
        if (ultimaCategoria) { // verifica se o valor da variável é verdadeiro (qualquer valor que não seja false, null ou undefined)
          horarios.options.selectedIndex = ultimaCategoria; // faz o select usar a opção dessa posição
        }
        mensagem.innerHTML = "A última categoria selecionada é " + horarios.options[ultimaCategoria].value; // pode ignorar é apenas uma mensagem
      }
      function manipularEnvio() {
        var categoria = horarios.options.selectedIndex; // armazena a posição daquela categoria em uma variável
        localStorage.setItem('ultima_categoria', categoria); // guarda o valor no navegador
      }
      buscarHorarios.addEventListener("submit", manipularEnvio); // atribui a função manipularEnvio ao formulário
    
    
        
    
        </script>
            <?php 
                      }
            
            
                    $horarioselected = " ";
                
                if( isset($_GET["horario"]) ) {
                    
                    
                        $horarioselected = $_GET["horario"];
                    
                        $consultapchamada = "SELECT * FROM alunos_turmamodalidade atm JOIN turmamodalidades tmd ON atm.turmamodalidadeID = tmd.turmamodalidadesID JOIN turmas tm ON tmd.turmaid = tm.turmaID JOIN diasemana ds ON tm.diasemana = ds.diaID JOIN horarios hrs ON tm.horario = hrs.horarioid JOIN alunos ON atm.alunocod = alunos.alunoID WHERE tmd.professorid = {$professorid} AND ds.diaID = {$diasemanaatual} AND hrs.horarioid = {$horarioselected} ";

                        $resultadopchamada = mysqli_query($conecta, $consultapchamada);
                    
                }
            
            
                if(empty($resultadopchamada)){
                            
                            die("Não há registros");
                            
                            
                        }
            
            ?>
                   
            <div class="container"> 
            
                <form  method="post">
                    
                <table border="1">
                      <tr>
                        <th>Aluno(a)</th>
                        <th>Presente?</th> 
                        <th>Desempenho</th>
                      </tr>
                    
                          <?php
        
                            //Conta a quantidade de registros
                          //Consulta Alunos - atm.alunoID  
    
                        $consultaregistros = "SELECT atm.alunocod FROM alunos_turmamodalidade atm JOIN turmamodalidades tmd ON atm.turmamodalidadeID = tmd.turmamodalidadesID JOIN turmas tm ON tmd.turmaid = tm.turmaID JOIN diasemana ds ON tm.diasemana = ds.diaID JOIN horarios hrs ON tm.horario = hrs.horarioid JOIN alunos ON atm.alunocod = alunos.alunoID WHERE tmd.professorid = {$professorid} AND ds.diaID = {$diasemanaatual} AND hrs.horarioid = {$horarioselected} ";
                        
                        
                        $resultadoregistros = mysqli_query($conecta, $consultaregistros);
                    
                    
                        $totalregistros = mysqli_num_rows($resultadoregistros);
                    
                    
                         while($linha = mysqli_fetch_assoc($resultadopchamada)) {
                             
                             $aluno = "aluno" . $linha["alunoID"]; 
                             $presenca = "presenca" . $linha["alunoID"]; 
                             $desempenho = "desempenho" . $linha["alunoID"];
                             $classedsp = "classedmp" . $linha["alunoID"];
                             
                             
                             $aaluno[] = $aluno;
                             $apresenca[] = $presenca; 
                             $adesempenho[] = $desempenho;
    
                        ?>
                    
                      <tr>
                     
                        <td>
                            
                            <span> <?php echo utf8_encode($linha["nomealuno"])  ?></span>
                            <input type="hidden" value="<?php echo utf8_encode($linha["alunoturmamodalidadeID"])  ?>" name="<?php echo $aluno ?>" id="" readonly="readonly"  ?>
                        </td>
                        <td>
                            <input type="radio" id="" name="<?php echo $presenca ;  ?>" value="1">SIM
                            <input type="radio" name="<?php echo $presenca; ?>" checked value="0"> NÃO 
                        </td>
                          
                        <td>
                            <input type="radio" class="<?php echo $classedsp ;?>" name="<?php echo $desempenho; ?>" value="1">Bom 
                            <input type="radio" class="<?php echo $classedsp ;?>" name="<?php echo $desempenho ;?>" value="2">Muito Bom
                            <input type="radio" class="<?php echo $classedsp ;?>" name="<?php echo $desempenho ;?>" value="3"> Ótimo 
                            <input type="radio" class="<?php echo $classedsp ;?>" name="<?php echo $desempenho ;?>" value="4"> Excelente 
                            <input type="radio" class="<?php echo $classedsp ;?>" name="<?php echo $desempenho ;?>" value="5"> Perfeito
                            <input type="radio" style="visibility:hidden" checked class="<?php echo $classedsp ;?>" name="<?php echo $desempenho ;?>" value="6">
                            
                        </td>
                      </tr>
                    
                    <?php
                    
                    ?>
                       
                    <input type="hidden" value="<?php echo date('Y-m-d')  ?>" name="dataatual" id="dataatual" readonly="readonly"  ?>
                    
                     <?php

                   }
                       
                        ?> 
                    
                    </table> 
                    
                                        <input type="submit" value="Confirmar"> 
                                        <input type="reset" value="Limpar" />

                    
                </form>
                    
            </div>
            
            <?php
                    
                     ?>
            
        </main>

        <?php include_once("_incluir/rodape.php"); ?>  
        
        
    </body>
    <?php

            if( isset($_POST["dataatual"]) ) {
                
              
                
                $i=0;
                
                while($i < $totalregistros ){
                
                $alunomodalidadeid[] = $_POST[$aaluno[$i]];
                $data        = $_POST["dataatual"];
                $presencaid[]       = $_POST[$apresenca[$i]];
                $desempenhoid[]   = $_POST[$adesempenho[$i]];
                    
                $i++;    
                    
                }
                
                $values = '';
                
                for ($i = 0; $i < $totalregistros; $i++) {
                    
                    $values .=  sprintf("('$alunomodalidadeid[$i]', '$data', '$presencaid[$i]', '$desempenhoid[$i]'),");
                    
                    }
                
                //Função utilizada pra remover a última vírgula 
                $values = substr($values, 0, -1);
                
                $inserir    = "INSERT INTO chamadas ";
                $inserir    .= "(alunoturmamodalidade_id,dataatual,presenca,desempenho) VALUES " . $values;
                
                $operacao_inserir = mysqli_query($conecta,$inserir);
                if(!$operacao_inserir) {
                die("Erro no banco");
                }
                
                
            }

        ?>
      
            
    
</html>
    
<?php
    // Fechar conexao
    mysqli_close($conecta);
?>