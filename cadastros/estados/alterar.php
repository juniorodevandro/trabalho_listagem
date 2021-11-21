<?php
    if (isset($_POST['alterar'])) {
        try {
            $stmt = $conn->prepare(
                'UPDATE estados SET nome = :nome, sigla = :sigla WHERE id = :id');
           // $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute(array('nome' => $_POST['nome'], 'sigla' => $_POST['sigla'],
                                'id' => $_GET['id']));
            //$stmt->execute();
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
 
    if (isset($_GET['id'])) {
        $stmt = $conn->prepare('SELECT * FROM estados WHERE id = :id');
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    }
    //$stmt->execute(array('id' => $id));
    $stmt->execute();
    $r = $stmt->fetchAll();
 
    //print_r($r);
?>
<form method="post">
    <input type="text" name="nome" value="<?=$r[0]['nome']?>">
    <input type="text" name="sigla" value="<?=$r[0]['sigla']?>">
    <input type="submit" name="alterar" value="Salvar">
</form>
