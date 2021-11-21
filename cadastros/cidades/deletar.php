<?php
    if (isset($_POST['deletar'])) {
        try {
            $stmt = $conn->prepare(
                'DELETE FROM cidades WHERE id = :id');
            //$stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute(array('id' => $_GET['id']));
            //$stmt->execute();
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
        $stmt = $conn->prepare('SELECT A.*, B.sigla
                                  FROM cidades A
                                 INNER JOIN estados B ON B.id = A.estado 
                                 WHERE A.id = :id');
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    }
    //$stmt->execute(array('id' => $id));
    $stmt->execute();
    $r = $stmt->fetchAll();
?>
<form method="post">
    <input type="text" name="nome" value="<?=$r[0]['nome']?>" disabled>
    <input type="text" name="codigo" value="<?=$r[0]['codigo']?>" disabled>
    <input type="text" name="sigla" value="<?=$r[0]['sigla']?>" disabled>
    Deseja realmente excluír esse cadastro?
    <input type="submit" name="deletar" value="Confirmar">
</form>
