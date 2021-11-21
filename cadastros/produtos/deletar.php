<?php
    if (isset($_POST['deletar'])) {
        try {
            $stmt = $conn->prepare(
                'delete from produto where id = :id');
            $stmt->execute(array('id' => $_GET['id']));

            ?>
                <div class="alert alert-success" role="alert">
                    Sucesso! O registro foi deletado.
                </div>
            <?php
            exit();
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
 
    if (isset($_GET['id'])) {
        $stmt = $conn->prepare('select * 
                                  from produto 
                                 where id = :id');
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    }
    $stmt->execute();
    $r = $stmt->fetchAll();
?>
<form method="post">
    <input type="text" name="nome" value="<?=$r[0]['nome']?>" disabled>
    Deseja realmente excluir esse cadastro?
    <input type="submit" name="deletar" value="Confirmar">
</form>
