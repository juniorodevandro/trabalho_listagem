<?php
    if (isset($_POST['gravar'])) {
        try {
            $stmt = $conn->prepare(
                'INSERT INTO estados (nome,sigla) values (:nome,:sigla)');
            //$stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute(array('nome' => $_POST['nome'],'sigla' => $_POST['sigla']));
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

        <label for="sigla">Sigla</label>
        <input type="text" class="form-control" name="sigla" id="sigla" placeholder="Sigla">
    </div>
    <input type="submit" name="gravar" value="Gravar">
</form>
