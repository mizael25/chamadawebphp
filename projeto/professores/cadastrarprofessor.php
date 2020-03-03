<?php require_once("../../conexao/conexao.php"); ?>


<?php
    
    // teste de segurança
    session_start();
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:../loginmaster.php");
    }
    // fim do teste de seguranca





    // insercao no banco
    if(isset($_POST["nomeprofessor"])) {
        $nomeprofessor      = utf8_decode($_POST["nomeprofessor"]);
        $datanascimento   = utf8_decode($_POST["datanascimento"]);
        $email     = $_POST["email"];
        $usuario       = $_POST["usuario"];
        $senha      = $_POST["senha"];
        
        
        
       
        
        
        $inserir    = "INSERT INTO professores (nomeprofessor, datanascimento, email, usuario, senha) VALUES ('$nomeprofessor', '$datanascimento', '$email','$usuario','$senha')";
        
        
        $operacao_inserir = mysqli_query($conecta,$inserir);
        if(!$operacao_inserir) {
            die("Erro no banco");
        } else {
            header("location:listagemprofessor.php");   
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
        <link href="../_css/inclusao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topomaster.php"); ?>
        <button class="voltar"><a href="listagemprofessor.php">Voltar</a></button>
        <main> 
            <div id="janela_formulario">
                
            
            
                <form action="cadastrarprofessor.php" method="post">
                    <input required type="text" name="nomeprofessor" placeholder="Nome do Professor">
                    <input required type="date" name="datanascimento" placeholder="Data de Nascimento">
                    <input required type="email" name="email" placeholder="E-mail">
                    <input required type="text" name="usuario" placeholder="Usuário">  
                     <input required type="text" name="senha" placeholder="Senha">
                    
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