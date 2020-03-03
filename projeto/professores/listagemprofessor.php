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
    $professor = "SELECT * FROM professores ";
    
    if ( isset($_GET["professor"]) ) {
        $nome_professor = $_GET["professor"];
        $professor .= "WHERE nomeprofessor LIKE '%{$nome_professor}%' ";
    }
    $resultado = mysqli_query($conecta, $professor);
    if(!$resultado) {
        die("Falha na consulta ao banco");   
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listagem Professores</title>
        
        <!-- estilo -->
        <link href="../_css/estilo.css" rel="stylesheet">
        <link href="../_css/produtos.css" rel="stylesheet">
        <link href="../_css/produto_pesquisa.css" rel="stylesheet">
        <link href="../_css/botao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topomaster.php"); ?>
        
        <main>
            <div id="janela_pesquisa">
                    <button class="voltar"><a href="cadastrarprofessor.php">Cadastrar Professor</a></button>
                <form action="listagemprofessor.php" method="get">
                    <input type="text" name="professor" placeholder="Pesquisa">
                    <input type="image"  src="../assets/botao_search.png">
                </form>
            </div>
            
            <div id="listagem_produtos"> 
            <?php
                while($linha = mysqli_fetch_assoc($resultado)) {
            ?>
                <ul>
                    
                    <li><h3><?php echo utf8_encode($linha["nomeprofessor"]) ?></h3></li>
                    <li>Email: <?php echo utf8_encode($linha["email"]) ?></li>
                    <button class="voltar"><a href="detalharprofessor.php?codigo=<?php echo $linha["professorID"]  ?>">Detalhar</a></button>
                    <button class="voltar"><a href="alterarprofessor.php?codigo=<?php echo $linha["professorID"]  ?>">Alterar</a></button>    
                     <button class="voltar"><a href="excluirprofessor.php?codigo=<?php echo $linha["professorID"] ?>">Excluir</a></button> 
                    
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