<?php
    if (isset($_POST['gravar'])) {
        $ValorEstoque = $_POST['valor'] * $_POST['estoque'];
        try {
            $stmt = $conn->prepare(
                'insert into produto (nome, criador, estoque, marca, valor, valorestoque) values (:nome,:criador,:estoque,:marca,:valor,:valorestoque)');
             $stmt->execute(array('nome' => $_POST['nome'],'criador' => 1,'estoque' => $_POST['estoque'],
                                  'marca' => $_POST['marca'],'valor' => $_POST['valor'],'valorestoque' => $ValorEstoque));

        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
?>
<form method="post">
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required>

        <label for="marca">Marca</label>
        <input type="text" class="form-control" name="marca" id="marca" placeholder="Marca" required>

        <label for="valor">Valor</label>
        <input type="number" min="1" step="any" class="form-control" name="valor" id="valor" placeholder="Valor" required>

        <label for="estoque">Estoque</label>
        <input type="number" class="form-control" name="estoque" id="estoque" placeholder="Estoque" required>

    </div>
    <input type="submit" name="gravar" value="Gravar">
</form>
