<?php
    if (isset($_POST['gravar'])) {
        try {
            $stmt = $conn->prepare(
                'INSERT INTO cidades (nome,codigo,estado) values (:nome,:sigla,:estado)');
            //$stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute(array('nome' => $_POST['nome'],'sigla' => $_POST['codigo'], 'estado' => $_POST['estado']));
            //$stmt->execute();
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
?>
<form method="post">
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">

        <label for="codigo">Codigo</label>
        <input type="number" class="form-control" name="codigo" id="codigo" placeholder="Codigo">

    <?php
        $stmt = $conn->prepare('SELECT * FROM estados');
        $stmt->execute();
        $result = $stmt->fetchAll();
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
    </div>
    <input type="submit" name="gravar" value="Gravar">
</form>
