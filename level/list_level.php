<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';
$result = $model->fetchAll('level');
$levels = $result['rows'];
?>

<?= template_header('Level List') ?>

<div class="content read">
    <h2>Level: List</h2>
    <a href="create_level.php" class="create-contact">Create Level</a>


    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($levels as $level) : ?>
                <tr>
                    <td><?= $level['id'] ?></td>
                    <td><?= $level['name'] ?></td>
                    <td class="actions">
                        <a href="edit_level.php?id=<?= $level['id'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="delete_level.php?id=<?= $level['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
            <?php endforeach;
            ?>
        </tbody>
    </table>
</div>

<?= template_footer() ?>