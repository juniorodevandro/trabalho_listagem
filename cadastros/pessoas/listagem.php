<?php
    if (isset($_GET['id']))
        $id = $_GET['id'];
 
    try {
        if (isset($id)) {
            $stmt = $conn->prepare('select * 
                                      from pessoas 
                                     where id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        } else {
            $stmt = $conn->prepare('select * 
                                      from pessoas');
        }
        $stmt->execute();
        $result = $stmt->fetchAll();
?>
<table border="1" class="table table-striped">
<tr>
            <td>Id</td>
            <td>Nome</td>
            <td>Ação</td>
</tr>
<?php
        if ( count($result) ) {
            foreach($result as $row) {
                ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['nome']?></td>
                    <td>
                        <a href="?modulo=pessoas&pagina=alterar&id=<?=$row['id']?>">Alterar</a>
                        <a href="?modulo=pessoas&pagina=deletar&id=<?=$row['id']?>">Excluir</a>
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
