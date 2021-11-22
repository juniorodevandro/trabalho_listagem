<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 

    if (!isset($_SESSION['usuario']) and (!isset($_SESSION['senha']))){
        header('Location: login/login.php');
    } 
    
    include "bibliotecas/parametros.php";
    include "bibliotecas/conexao.php";
    
    include LAYOUTS.'header.php';
    include LAYOUTS.'menu.php';
    
    if (!isset($_GET['offset'])){
        $_GET['offset'] = 1;
    }

    if (!isset($_GET['pagina']))
        include LAYOUTS.'home.php';
    else
        include CADASTROS.$_GET['modulo'].'/'.$_GET['pagina'].'.php';

    if((isset($_GET['pagina'])) and ($_GET['pagina'] == 'listagem')){
        if ($_GET['offset'] > 1){
            ?>
            <button><a href="?offset=<?php echo $_GET['offset'] - 1 . '&modulo=' . $_GET['modulo'] . '&pagina=' . $_GET['pagina'] ; ?>">Anterior</a></button>
            <button><a href="?offset=<?php echo $_GET['offset'] + 1 . '&modulo=' . $_GET['modulo'] . '&pagina=' . $_GET['pagina'] ; ?>">Próximo</a></button>
            <?php
        }else{
            ?>
            <button><a href="?offset=<?php echo $_GET['offset'] + 1 . '&modulo=' . $_GET['modulo'] . '&pagina=' . $_GET['pagina'] ; ?>">Próximo</a></button>
        <?php
    }}
    include LAYOUTS.'footer.php';   