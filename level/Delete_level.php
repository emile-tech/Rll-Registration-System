<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET["id"];
    $level = null;
    if (isset($_GET["confirm"])) {
        if ($_GET["confirm"] == "yes") {
            $model->delete('level', $id);
            header('location: list_level.php');
        }
    } else {
        $sql = "SELECT * FROM level WHERE id=?";
        $result = $model->fetch('level', $id);
        $level = $result['rows'];
    }
}


?>
<?= template_header('Delete Level') ?>

<div class="content delete">
    <h2>Level: Delete</h2>
    <p><b>ID: </b><?= $gender['id'] ?></p>
    <p><b>Name:</b> <?= $gender['name']; ?></p>



    <p>Are you sure you want to delete this Level?</p>
    <div class="yesno">
        <a href="<?= $_SERVER["PHP_SELF"] ?>?id=<?= $level['id'] ?>&confirm=yes">Yes</a>
        <a href="list_level.php">No</a>
    </div>
</div>

<?= template_footer() ?>