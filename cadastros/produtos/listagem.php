<?php
    $Pagina = $_GET['offset'] * 5;
    $Offset = $Pagina - 5;
    if (isset($_GET['id']))
        $id = $_GET['id'];
 
    try {
        if (isset($id)) {
            $stmt = $conn->prepare('select * 
                                      from produto 
                                     where id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        } else {
            $stmt = $conn->prepare('select * 
                                      from produto
                                     limit :offset,:pag ');
            $stmt->bindParam(':offset',$Offset, PDO::PARAM_INT);
            $stmt->bindParam(':pag', $Pagina, PDO::PARAM_INT); 
        }
        $stmt->execute();
 
        $result = $stmt->fetchAll();
?>
<table border="1" class="table table-striped">
<tr>
            <td>Id</td>
            <td>Nome</td>
            <td>Marca</td>
            <td>Estoque</td>
            <td>Valor</td>
            <td>Valor em estoque</td>
            <td>Ação</td>
</tr>
<?php
        if ( count($result) ) {
            foreach($result as $row) {
                ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['nome']?></td>
                    <td><?=$row['marca']?></td>
                    <td><?=$row['estoque']?></td>
                    <td><?=$row['valor']?></td>
                    <td><?=$row['valorestoque']?></td>
                    <td>
                        <a href="?modulo=produtos&pagina=alterar&id=<?=$row['id']?>">Alterar</a>
                        <a href="?modulo=produtos&pagina=deletar&id=<?=$row['id']?>">Excluir</a>
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
