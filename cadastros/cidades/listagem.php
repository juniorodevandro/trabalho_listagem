<?php
    if (isset($_GET['id']))
        $id = $_GET['id'];
 
    try {
        if (isset($id)) {
            $stmt = $conn->prepare('select a.*, 
                                           b.sigla
                                      from cidades A
                                     inner join estados b on b.id = a.estado
                                     where a.id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        } else {
            $stmt = $conn->prepare('select a.*, 
                                           b.sigla
                                      from cidades A
                                     inner join estados b on b.id = a.estado');
        }
        $stmt->execute();
 
        $result = $stmt->fetchAll();
?>
<table border="1" class="table table-striped">
<tr>
            <td>Id</td>
            <td>Nome</td>
            <td>Codigo</td>
            <td>Estado</td>
            <td>Ação</td>
</tr>
<?php
        if ( count($result) ) {
            foreach($result as $row) {
                ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['nome']?></td>
                    <td><?=$row['codigo']?></td>
                    <td><?=$row['sigla']?></td>
                    <td>
                        <a href="?modulo=cidades&pagina=alterar&id=<?=$row['id']?>">Alterar</a>
                        <a href="?modulo=cidades&pagina=deletar&id=<?=$row['id']?>">Excluir</a>
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
