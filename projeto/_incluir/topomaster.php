<header>
    <div id="header_central">
        <?php
            if ( isset($_SESSION["user_portal"])  ) {
                $user = $_SESSION["user_portal"];
                
                $saudacao = "SELECT user ";
                $saudacao .= "FROM usuarios ";
                $saudacao .= "WHERE usuarioID = {$user} ";
                
                $saudacao_login = mysqli_query($conecta,$saudacao);
                if(!$saudacao_login) {
                    die("Falha no banco");   
                }
                
                $saudacao_login = mysqli_fetch_assoc($saudacao_login);
                $nome = $saudacao_login["user"];
                
        ?>
            <div id="header_saudacao"><h5>Bem vindo, <?php echo $nome ?> - <button class="voltar"><a href="../sairmaster.php">Sair</a></button></h5></div>
        <?php
            }
        ?>
        <link href="../_css/estilo2.css" rel="stylesheet">
        <div class="menu">
        <ul>
            <li><a href="../alunos/listagemalunos.php">Alunos</a></li>
            <li><a href="../turmas/listagemturmas.php">Turmas</a></li>
            <li><a href="../professores/listagemprofessor.php">Professores</a></li>
        </ul>
            
        </div>    
        
        
        
        <img src="">
        <img src="">
    </div>
</header>