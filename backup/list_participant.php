<?php
// Include config file
require_once "config.php";
require 'functions.php';
$sql = "SELECT * FROM participant";
$participants = $mysqli->query($sql);
?>

<?= template_header('List') ?>

<div class="content read">
    <h2>Participants: List</h2>
    <a href="create_participant.php" class="create-contact">Create Participant</a>


    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($participants as $participant) : ?>
                <tr>
                    <td><?= $participant['id'] ?></td>
                    <td><?= $participant['firstName'] ?></td>
                    <td><?= $participant['lastName'] ?></td>
                    <td class="actions">
                        <a href="edit_participant.php?id=<?= $participant['id'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="delete_participant.php?id=<?= $participant['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
            <?php endforeach;
            ?>
        </tbody>
    </table>
</div>

<?= template_footer() ?>