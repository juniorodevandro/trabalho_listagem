<?php


    if (isset($_POST['alterar'])) {
        try {
            $stmt = $conn->prepare(
                'UPDATE cidades SET nome = :nome, codigo = :codigo, estado = :estado WHERE id = :id');
            $stmt->execute(array('nome' => $_POST['nome'], 'codigo' => $_POST['codigo'], 'estado' => $_POST['estado'],
                                'id' => $_GET['id']));
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
 
    if (isset($_GET['id'])) {
        $stmt = $conn->prepare('SELECT A.*, B.sigla
                                      FROM cidades A
                                     INNER JOIN estados B ON B.id = A.estado 
                                     WHERE A.id = :id');
            $stmt->bindParam(':id', ($_GET['id']), PDO::PARAM_INT);
    }
    //$stmt->execute(array('id' => $id));
    $stmt->execute();
    $r = $stmt->fetchAll();
 
    //print_r($r);
?>
<form method="post">
    <input type="text" name="nome" value="<?=$r[0]['nome']?>">
    <input type="number" name="codigo" value="<?=$r[0]['codigo']?>">
    <?php
        if (isset($_GET['id'])){
            $stmt = $conn->prepare('SELECT * FROM estados');                    
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
    ?>
    <div class="form-group">
        <label for="estado">Estado</label>
        <select class="form-control" name="estado" id="estado">
            <option value="">** Selecione **</option>
            <?php
                foreach ($result as $l) {
                    ?>
                        <option selected value="<?=$l['id']?>"><?=$l['sigla']?> - <?=$l['nome']?></option>
                    <?php
                }
            ?>
        </select>
    </div>
    <input type="submit" name="alterar" value="Salvar">
</form>
