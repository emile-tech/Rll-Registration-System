<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET["id"];
    $participant = null;
    if (isset($_GET["confirm"])) {
        if ($_GET["confirm"] == "yes") {
            $model->delete('participant', $id);
            header('location: list_participant.php');
        }
    } else {
        $sql = "SELECT * FROM participant WHERE id=?";
        $result = $model->fetch('participant', $id);
        $participant = $result['rows'];
    }
}


?>
<?= template_header('Delete Paricipant') ?>

<div class="content delete">
    <h2>Patcipant: Delete</h2>
    <p><b>ID: </b><?= $participant['id'] ?></p>
    <p><b>First Name:</b> <?= $participant['firstName']; ?></p>
    <p><b>Last Name:</b> <?= $participant['lastName']; ?></p>


    <p>Are you sure you want to delete this participant?</p>
    <div class="yesno">
        <a href="<?= $_SERVER["PHP_SELF"] ?>?id=<?= $participant['id'] ?>&confirm=yes">Yes</a>
        <a href="list_participant.php">No</a>
    </div>
</div>

<?= template_footer() ?>