<header>
    <div id="header_central">
        <?php
            if ( isset($_SESSION["user_portal"])  ) {
                $user = $_SESSION["user_portal"];
                
                $saudacao = "SELECT nomealuno ";
                $saudacao .= "FROM alunos ";
                $saudacao .= "WHERE alunoID = {$user} ";
                
                $saudacao_login = mysqli_query($conecta,$saudacao);
                if(!$saudacao_login) {
                    die("Falha no banco");   
                }
                
                $saudacao_login = mysqli_fetch_assoc($saudacao_login);
                $nome = $saudacao_login["nomealuno"];
                
        ?>
            <link href="_css/botao.css" rel="stylesheet">
            <div id="header_saudacao"><h5>Bem vindo, <?php echo $nome ?> - <button class="voltar"><a href="sair.php">Sair</a></button></h5></div>
        <?php
            }
        ?>
        
        
        
        <img src="">
        <img src="">
    </div>
</header>