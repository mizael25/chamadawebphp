<?php require_once("../../conexao/conexao.php"); ?>
<?php
    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:../loginmaster.php");
        
    }
    // fim do teste de seguranca

    if ( isset($_GET["codigo"]) ) {
        $professorid = $_GET["codigo"];
    } else {
        header("Location: detalharprofessor.php");
    }

    // Consulta ao banco de dados
    $consulta = "SELECT * ";
    $consulta .= "FROM professores ";
    $consulta .= "WHERE professorID = {$professorid} ";
    $detalhe    = mysqli_query($conecta,$consulta);

    // Testar erro
    if ( !$detalhe ) {
        die("Não há cadastro");
    }
        $detalheprofessor = mysqli_fetch_assoc($detalhe);

     $data = $detalheprofessor["datanascimento"] ;

    
        



      function data($data){
        return date("d/m/Y", strtotime($data));
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
        <button class="voltar"><a href="listagemprofessor.php">Voltar</a></button>
        <main>  
            <div id="detalhe_produto">
                   
                <ul>
                    
                    <li><h2>Professor:<?php echo utf8_encode($detalheprofessor["nomeprofessor"])  ?></h2></li>
                    
                    <li>Data de Nascimento: <?php echo data($data) ?> </li>
                     <li>Email: <?php echo utf8_encode($detalheprofessor["email"]) ?> </li>
                     <li>Usuário: <?php echo utf8_encode($detalheprofessor["usuario"]) ?> </li>
                    <li>Senha: <?php echo utf8_encode($detalheprofessor["senha"]) ?> </li>
                    
                </ul>
                <button class="voltar"><a href="alterarprofessor.php?codigo=<?php echo $detalheprofessor["professorID"]  ?>">Alterar</a></button>    
                     <button class="voltar"><a href="excluirprofessor.php?codigo=<?php echo $detalheprofessor["professorID"] ?>">Excluir</a> </button>
               
            </div>
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>