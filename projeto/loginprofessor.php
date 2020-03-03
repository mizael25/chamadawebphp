<?php require_once("../conexao/conexao.php"); ?>
<?php
    // adicionar variaveis de sessao
    session_start();

    if ( isset( $_POST["usuario"] )  ) {
        $usuario    = $_POST["usuario"];
        $senha      = $_POST["senha"];    
        
        $login = "SELECT * ";
        $login .= "FROM professores ";
        $login .= "WHERE usuario = '{$usuario}' and senha = '{$senha}' ";
    
        $acesso = mysqli_query($conecta, $login);
        if ( !$acesso ) {
            die("Falha na consulta ao banco");
        }
        
        $informacao = mysqli_fetch_assoc($acesso);
        
        if ( empty($informacao) ) {
            $mensagem = "Login sem sucesso.";
        } else {
            $_SESSION["user_portal"] = $informacao["professorID"];
            header("location:turmasprofessor.php");
        }
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP FUNDAMENTAL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/login.css" rel="stylesheet">
        
    </head>

    <body>
        <header>
            <div id="header_central">
                <img src="">
                <img src="">
            </div>
        </header>
        
        <main>
            <div id="janela_login">
                <form action="loginprofessor.php" method="post">
                    <h2>Tela de Login</h2>
                    <input type="text" name="usuario" placeholder="Usuário">
                    <input type="password" name="senha" placeholder="Senha">
                    <input type="submit" value="Login">
                
                    <?php
                        if ( isset($mensagem)) { 
                    ?>
                        <p><?php echo $mensagem ?></p>
                    
                    <?php
                        }
                    ?>                    
                
                
                </form>
            </div>
        </main>

        <footer>
            <div id="footer_central">
                <p>Evolução Esportes - 2019</p>
            </div>
        </footer>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>