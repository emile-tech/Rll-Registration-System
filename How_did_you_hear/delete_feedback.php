<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET["id"];
    $how_did_you_hear = null;
    if (isset($_GET["confirm"])) {
        if ($_GET["confirm"] == "yes") {
            $model->delete('how_did_you_hear', $id);
            header('location: list_feedback.php');
        }
    } else {
        $sql = "SELECT * FROM meeting WHERE id=?";
        $result = $model->fetch('how_did_you_hear', $id);
        $how_did_you_hear = $result['rows'];
    }
}


?>
<?= template_header('Delete Feedback') ?>

<div class="content delete">
    <h2>Feedback: Delete</h2>
    <p><b>ID: </b><?= $how_did_you_hear['id'] ?></p>
    <p><b>Name:</b> <?= $how_did_you_hear['name']; ?></p>



    <p>Are you sure you want to delete this feedback?</p>
    <div class="yesno">
        <a href="<?= $_SERVER["PHP_SELF"] ?>?id=<?= $how_did_you_hear['id'] ?>&confirm=yes">Yes</a>
        <a href="list_feedback.php">No</a>
    </div>
</div>

<?= template_footer() ?>