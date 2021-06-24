<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET["id"];
    $how_did_you_hear = null;
    if (isset($_GET["confirm"])) {
        if ($_GET["confirm"] == "yes") {
            $model->delete('gender', $id);
            header('location: list_gender.php');
        }
    } else {
        $sql = "SELECT * FROM gender WHERE id=?";
        $result = $model->fetch('gender', $id);
        $gender = $result['rows'];
    }
}


?>
<?= template_header('Delete Gender') ?>

<div class="content delete">
    <h2>Gender: Delete</h2>
    <p><b>ID: </b><?= $gender['id'] ?></p>
    <p><b>Name:</b> <?= $gender['name']; ?></p>



    <p>Are you sure you want to delete this gender?</p>
    <div class="yesno">
        <a href="<?= $_SERVER["PHP_SELF"] ?>?id=<?= $how_did_you_hear['id'] ?>&confirm=yes">Yes</a>
        <a href="list_gender.php">No</a>
    </div>
</div>

<?= template_footer() ?>