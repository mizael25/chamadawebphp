<?php require_once("../../conexao/conexao.php"); ?>

<?php
    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:../loginmaster.php");
    }
    // fim do teste de seguranca

    // Determinar localidade BR
    setlocale(LC_ALL, 'pt_BR');

 
    
    
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listagem Turmas</title>
        
        <!-- estilo -->
        <link href="../_css/estilo.css" rel="stylesheet">
        <link href="../_css/produtos.css" rel="stylesheet">
        <link href="../_css/produto_pesquisa.css" rel="stylesheet">
        <link href="../_css/botao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topomaster.php"); ?>
        <button class="voltar"><a href="cadastrarturmas.php">Cadastrar Turmas</a></button>
        <main>
            
            
            <form action="listagemturmas.php" method="get" id="buscarTurmas">
                    
                    
                    <?php 
                    $consultamd = "SELECT * FROM modalidades ";

                    $resultadomd = mysqli_query($conecta, $consultamd); 
                    ?>
                    <label>Escolha uma Modalidade</label>
                    <select name="modalidadeid" id="modalidade">
                        <option value="" selected="selected" >Selecione uma Modalidade </option>
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
                
                    <input class="voltar" type="submit" value="Pesquisar">
                </form>
                
                <script> 
                            // aguarda a página ser carregada para depois chamar essa função
                      window.onload = function() {
                        var ultimaCategoria = localStorage.getItem('ultima_categoria'); // pega o valor que está guardado e atribui a uma variável
                        if (ultimaCategoria) { // verifica se o valor da variável é verdadeiro (qualquer valor que não seja false, null ou undefined)
                          modalidade.options.selectedIndex = ultimaCategoria; // faz o select usar a opção dessa posição
                        }
                        mensagem.innerHTML = "A última categoria selecionada é " + modalidade.options[ultimaCategoria].value; // pode ignorar é apenas uma mensagem
                      }
                      function manipularEnvio() {
                        var categoria = modalidade.options.selectedIndex; // armazena a posição daquela categoria em uma variável
                        localStorage.setItem('ultima_categoria', categoria); // guarda o valor no navegador
                      }
                      buscarTurmas.addEventListener("submit", manipularEnvio); // atribui a função manipularEnvio ao formulário

    
        
    
        </script>
                    
                   <?php
            
                    if ( isset($_GET["modalidadeid"]) ) {
                        
                     $modalidadeid = $_GET["modalidadeid"];
                     $pmodalidade = "SELECT * FROM turmamodalidades tmd JOIN turmas tm ON tmd.turmaid = tm.turmaID JOIN modalidades md ON md.modalidadeID = tmd.modalidadeid JOIN professores ON professores.professorID = tmd.professorid JOIN horarios ON horarios.horarioid = tm.horario JOIN diasemana ON diasemana.diaID = tm.diasemana WHERE tmd.modalidadeid = {$modalidadeid} ";
    
                     $resultado = mysqli_query($conecta, $pmodalidade);
                        
                    }
            
            
                    if(empty($resultado)){
                         
                         echo "Por favor Selecione uma Modalidade!";
                         
                        
                        }else{
                        ?>
            
                    <?php  while($linha = mysqli_fetch_assoc($resultado)) {         ?>
                    <ul>
                    
                    <li> Dia da Semana e Horário: <?php echo utf8_encode($linha["dia"]) . " " . utf8_encode($linha["horarioinicial"]) . " " . "às" . " " . utf8_encode($linha["horariofinal"])         ?></li>
                    <li>Professor Responsável: <?php echo utf8_encode($linha["nomeprofessor"]) ?> </li>
                     <button class="voltar"> <a href="alterarturmas.php?codigo=<?php echo $linha["turmamodalidadesID"]   ?>">Alterar Turma </a></button>    
                     <button class="voltar"><a href="excluirturmas.php?codigo=<?php echo $linha["turmamodalidadesID"]   ?>">Excluir Turma</a></button>
                     <button class="voltar"><a href="../aturmas/cadastrarAturmas.php?codigo=<?php echo $linha["turmamodalidadesID"]   ?>">Cadastrar Alunos </a> </button>
                     <button class="voltar"><a href="detalharturma.php?codigo=<?php echo $linha["turmamodalidadesID"]   ?>">Detalhar Turma</a> </button>   
                         
                    
                    </ul>
            
                  <?php } } ?>
             </main>

        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>