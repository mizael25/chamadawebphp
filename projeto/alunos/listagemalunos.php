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

    // Consulta ao banco de dados
    $alunos = "SELECT * FROM alunos ";
    
    if ( isset($_GET["alunos"]) ) {
        $nome_aluno = $_GET["alunos"];
        $alunos .= "WHERE nomealuno LIKE '%{$nome_aluno}%' ";
    }
    $resultado = mysqli_query($conecta, $alunos);
    if(!$resultado) {
        die("Falha na consulta ao banco");   
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listagem Alunos</title>
        
        <!-- estilo -->
        <link href="../_css/estilo.css" rel="stylesheet">
        <link href="../_css/botao.css" rel="stylesheet">
        <link href="../_css/produtos.css" rel="stylesheet">
        <link href="../_css/produto_pesquisa.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topomaster.php"); ?>
        <button class="css3button"> <a href="cadastraralunos.php">Cadastrar Alunos</a></button> 
        <main>
            <div id="janela_pesquisa">
                <form action="listagemalunos.php" method="get">
                    <input type="text" name="alunos" placeholder="Pesquisa">
                    <input type="image"  src="../assets/botao_search.png">
                </form>
            </div>
            
            <div id="listagem_produtos"> 
            <?php
                while($linha = mysqli_fetch_assoc($resultado)) {
            ?>
                <ul>
                    
                    <li><h3><?php echo utf8_encode($linha["nomealuno"]) ?></h3></li>
                    <li>Nome do Responsável: <?php echo $linha["nomeresponsavel"] ?></li>
                    
                    <li>CPF : <?php echo $linha["cpf"] ?></li>
                    <li>Telefone : <?php echo $linha["telefone"] ?></li>
                    <li>Usuário : <?php echo $linha["usuario"] ?></li>
                    <li>Senha : <?php echo $linha["senha"] ?></li>
                    
                     <button class="voltar"><a href="alteraralunos.php?codigo=<?php echo $linha["alunoID"]  ?>">Alterar</a> </button>   
                     <button class="voltar"><a href="excluiralunos.php?codigo=<?php echo $linha["alunoID"] ?>">Excluir</a> </button> 
                    
                </ul>
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