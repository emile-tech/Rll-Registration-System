<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';
$result = $model->fetchAll('gender');
$genders = $result['rows'];
?>

<?= template_header('Gender List') ?>

<div class="content read">
    <h2>Genders: List</h2>
    <a href="create_gender.php" class="create-contact">Create Gender</a>


    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($genders as $gender) : ?>
                <tr>
                    <td><?= $gender['id'] ?></td>
                    <td><?= $gender['name'] ?></td>
                    <td class="actions">
                        <a href="edit_gender.php?id=<?= $gender['id'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="delete_gender.php?id=<?= $gender['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
            <?php endforeach;
            ?>
        </tbody>
    </table>
</div>

<?= template_footer() ?>