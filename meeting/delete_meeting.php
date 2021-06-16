<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET["id"];
    $meeting = null;
    if (isset($_GET["confirm"])) {
        if ($_GET["confirm"] == "yes") {
            $model->delete('meeting', $id);
            header('location: list_meeting.php');
        }
    } else {
        $sql = "SELECT * FROM meeting WHERE id=?";
        $result = $model->fetch('meeting', $id);
        $meeting = $result['rows'];
    }
}


?>
<?= template_header('Delete Meeting') ?>

<div class="content delete">
    <h2>Meeting: Delete</h2>
    <p><b>ID: </b><?= $meeting['id'] ?></p>
    <p><b>Name:</b> <?= $meeting['name']; ?></p>
    <p><b>Theme:</b> <?= $meeting['theme']; ?></p>


    <p>Are you sure you want to delete this meeting?</p>
    <div class="yesno">
        <a href="<?= $_SERVER["PHP_SELF"] ?>?id=<?= $meeting['id'] ?>&confirm=yes">Yes</a>
        <a href="list_meeting.php">No</a>
    </div>
</div>

<?= template_footer() ?>