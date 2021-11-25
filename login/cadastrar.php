<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<?php
  include_once "../bibliotecas/parametros.php";
  include_once "../bibliotecas/conexao.php";
  
    if (isset($_POST['gravar'])) {
        $queryLogin = $conn->prepare('select 1
                                        from usuarios
                                       where login = :login');
        $queryLogin->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
        $queryLogin->execute();
        $query = $queryLogin->fetchAll();                                       

        if ($query = 1) {
            echo `<div class="alert alert-danger" role="alert">`;
            echo    "Erro! Já existe um usuário cadastrado para esse login!" . "<br>" . "Login: " . $_POST['login'];
            echo `</div>`;
        } else {
            try {
                $stmt = $conn->prepare(
                    'insert into usuarios (login, email, nome, password) values (:login, :email, :nome, md5(:password))');
                $stmt->execute(array('login' => $_POST['login'], 'email' => $_POST['email'],'nome' => $_POST['nome'],
                                    'password' => $_POST['senha']));
            
                echo `<div class="alert alert-success" role="alert">`;
                echo    "Sucesso! O usuário " . $_POST['login'] . " foi cadastrado com sucesso!";
                echo `</div>`;

            } catch(PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }
        }
    }
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<form method="post">
    <div class="form-group">
    <table class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required>
        <label for="Email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
        <label for="login">Login</label>
        <input type="text" min="1" step="any" class="form-control" name="login" id="login" placeholder="Login" required>
        <label for="Senha">Senha</label>
        <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
    </table>
    </div>
    <input type="submit" class= "btn btn-success" name="gravar" value="Gravar">
</form>
