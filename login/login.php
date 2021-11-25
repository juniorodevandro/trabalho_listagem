<?php
    if (isset($_GET['success']) and $_GET['success'] == 'F')
?>
        <script>window.alert('Usuário e/ou senha incorretos!')</script>
        

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="../bibliotecas/style/style.css">

<div>
    <div class="main-page login-page FlexContainer"> 
    <br>
        <div class="login-body FlexItem">
            <h1 class="Bootstrap heading (2rem = 32px)">Login</h1>
            <form method="post" action="../login/loginController.php">

                <div class="inner-addon left-addon pullBottomLogin">
                    <input type="text" name="login" id="usuario" class="form-control" placeholder="Usuário" required>
                </div>
                <div class="inner-addon left-addon">
                    <input type="password" name="password" id="senha" style="border-right:none;" data-toggle="password" class="form-control" data-placement="after" placeholder="Senha" required> 
                </div>
                <input type="submit" name="logar" value="Entrar" >
            </form>
            
            <form method="post" action="../login/cadastrar.php">
                <input type="submit" id="cadastrar" name="cadastrar" value="Cadastrar" >
            <form>
        </div>
    </div>
</div>
    