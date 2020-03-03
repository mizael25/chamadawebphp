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
        
        
        $alterar = "UPDATE alunos_turmamodalidade SET turmamodalidadeID = '$turmamodalidadeid' WHERE alunocod = $alunoid  "; 
        
        $operacao_alterar = mysqli_query($conecta,$alterar);
        if(!$operacao_alterar) {
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
        <button class="voltar"><a href="../turmas/detalharturma.php?codigo=<?php echo $info_alunos["turmamodalidadeID"] ?>">Voltar</a></button>
        <main> 
            
            <div id="">
                
                
                  <?php
                
                if(empty($info_alunos)) {
                    die ("Não há Disponibilidade"); 
                    // COLOCAR UM SCRIPT AQUI PARA O OCULTAR O FORM ABAIXO E A TABELA
                } else{ ?>
                    <h4 >Nome do Aluno: <?php echo utf8_encode($info_alunos["nomealuno"])  ?></h4>
                    
                    
                    <h4 >Modalidade:<?php echo utf8_encode($info_alunos["nomemodalidade"])  ?></h4>
                    
                    
                    <h4>Dia da Semana Selecionado Atual: <?php echo utf8_encode($info_alunos["dia"])  ?></h4>
                    
                 
                    
                    <h4>Horário Selecionado Atual: <?php echo utf8_encode($info_alunos["horarioinicial"]) . " " . "às" . " " . utf8_encode($info_alunos["horariofinal"]);  ?></h4>
                    
                    
                
                
                
                
                <form name="obterdiasemana" id="buscarDiasemana" method="get" >
                    
                    <?php 
                    
                    $consultads = "SELECT * FROM diasemana ";

                    $resultadods = mysqli_query($conecta, $consultads);
                    ?>
            
                    <br>
                   <select id="diasemana" name="diasemana">
                       
                        <option value="" selected="selected">Selecione um dia da Semana</option>
                        
                        <?php
                            while($linha = mysqli_fetch_assoc($resultadods)) {
                        ?>
                            <option value="<?php echo $linha["diaID"];  ?>">
                                <?php echo utf8_encode($linha["dia"]) ;  ?>
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
                  diasemana.options.selectedIndex = ultimaCategoria; // faz o select usar a opção dessa posição
                }
                mensagem.innerHTML = "A última categoria selecionada é " + diasemana.options[ultimaCategoria].value; // pode ignorar é apenas uma mensagem
              }
              function manipularEnvio() {
                var categoria = diasemana.options.selectedIndex; // armazena a posição daquela categoria em uma variável
                localStorage.setItem('ultima_categoria', categoria); // guarda o valor no navegador
              }
              buscarDiasemana.addEventListener("submit", manipularEnvio); // atribui a função manipularEnvio ao formulário

    
        
    
        </script>
                
                <?php 
                    
                }
                      
            
            
                    
                    $diaselected = " ";
                
                if( isset($_GET["diasemana"]) ) {
                    
                        $modalidadeselected = $info_alunos["modalidadeid"];
                        $diaselected = $_GET["diasemana"];
                    
                        $consultatm = "SELECT * FROM turmamodalidades tmd JOIN turmas tm ON tmd.turmaid = tm.turmaID JOIN horarios hr ON hr.horarioid = tm.horario WHERE tmd.modalidadeid = {$modalidadeselected} AND tm.diasemana = {$diaselected}  ";

                        $resultadotm = mysqli_query($conecta, $consultatm);
                    }
            
                if(empty($resultadotm)){
                            
                            die("");
                            
                        }
                
            ?>
                
            
                <form action="alterarAturmas.php" method="post">
                    
                    <select name="turmamodalidadeid">
                        <option value="" selected="selected">Selecione um Novo Horário </option>
                        <?php
                            while($linha = mysqli_fetch_assoc($resultadotm)) {
                        ?>
                            <option value="<?php echo $linha["turmamodalidadesID"];  ?>">
                                <?php echo utf8_encode($linha["horarioinicial"]) . " " . "às" . " " . utf8_encode($linha["horariofinal"]);  ?>
                            </option>
                        <?php
                            }
                        ?>
                       
                    </select>
                    <input type="hidden" name="alunoid" value="<?php echo utf8_encode($info_alunos["alunocod"])?>">
                    
                    <input type="submit" value="Atualizar">
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