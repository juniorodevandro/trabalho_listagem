<?php
    if (isset($_GET['id']))
        $id = $_GET['id'];
 
    try {
        if (isset($id)) {
            $stmt = $conn->prepare('SELECT * FROM estados WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        } else {
            $stmt = $conn->prepare('SELECT * FROM estados');
        }
        $stmt->execute();

 
        $result = $stmt->fetchAll();
?>
<table border="1" class="table table-striped">
<tr>
            <td>Id</td>
            <td>Nome</td>
            <td>Sigla</td>
            <td>Ação</td>
</tr>
<?php
        if ( count($result) ) {
            foreach($result as $row) {
                ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['nome']?></td>
                    <td><?=$row['sigla']?></td>
                    <td>
                        <a href="?modulo=estados&pagina=alterar&id=<?=$row['id']?>">Alterar</a>
                        <a href="?modulo=estados&pagina=deletar&id=<?=$row['id']?>">Excluir</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "Nenhum resultado retornado.";
        }
?>
</table>
<?php
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
