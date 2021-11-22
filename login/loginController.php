<?php
    session_start();
    
    include_once "../bibliotecas/parametros.php";
    include_once "../bibliotecas/conexao.php";

    $login = (isset($_POST['login'])) ? $_POST['login'] : '';
    $senha = (isset($_POST['password'])) ? $_POST['password'] : '';
    
    $queryLogin = $conn->prepare ("select *
                                     from usuarios
                                    where login = '$login'
                                      and password = '$senha'");                                 
   
    $queryLogin->execute();
    $row = $queryLogin->fetch(PDO::FETCH_ASSOC);

    if (($row['password'] == $senha)) {     
        $_SESSION['usuario'] = $login;
        $_SESSION['senha'] = $senha;
        header('Location: ../index.php');
    } else {    
       header('Location: login.php?success=F');
        exit();
    } 
