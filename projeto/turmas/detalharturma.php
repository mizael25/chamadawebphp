<?php require_once("../../conexao/conexao.php"); ?>
<?php
    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:../loginmaster.php");
        
    }
    // fim do teste de seguranca

    if ( isset($_GET["codigo"]) ) {
        $tmdid = $_GET["codigo"];
    } else {
        header("Location: detalharprofessor.php");
    }

    // Consulta ao banco de dados
    $consulta = "SELECT * ";
    $consulta .= "FROM alunos_turmamodalidade atm JOIN alunos ON atm.alunocod = alunos.alunoID WHERE turmamodalidadeID = {$tmdid} ";
    
    $detalhe    = mysqli_query($conecta,$consulta);

    // Testar erro
    if ( !$detalhe ) {
        die("Não há cadastro");
    }
       

     
    
        
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Evolução Esportes</title>
        
        <!-- estilo -->
        <link href="../_css/estilo.css" rel="stylesheet">
        <link href="../_css/produto_detalhe.css" rel="stylesheet">
        <link href="../_css/botao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topomaster.php"); ?>
        <button class="voltar"><a href="listagemturmas.php">Voltar</a></button> 
        <main>  
          
            <div id="detalhe_produto">
                
                
                <?php 
                
                $totalregistros = mysqli_num_rows($detalhe);
                
                if($totalregistros == '0'){
                    
                    echo "Não há Alunos";
                }
                
                
                while($linha = mysqli_fetch_assoc($detalhe)) {    
                                                                    ?>
                <ul>
                    
                    <li>Aluno(a): <?php echo utf8_encode($linha["nomealuno"]) ?> </li>
                     <li>Telefone: <?php echo utf8_encode($linha["telefone"]) ?> </li>
                    <li>Email: <?php echo utf8_encode($linha["email"]) ?> </li>
                    
                </ul>
                <button class="voltar"><a href="../aturmas/alterarAturmas.php?codigo=<?php echo $linha["alunoID"]  ?>">Alterar Horário </a> </button>    
                     <button class="voltar"><a href="../aturmas/excluirAturmas.php?codigo=<?php echo $linha["alunoID"] ?>">Excluir Aluno</a> </button> 
               <?php  }  ?>
            </div>
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>