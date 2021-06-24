<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get hidden input value
    $id = $_GET["id"];

    // Validate name
    $name = trim($_POST["name"]);
    // Validate address address
    $data = ['name' => $name];
    $result = $model->update('level', $data);
    $msg = $result['message'];

    header('location: list_level.php');
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        $result = $model->fetch('level', $id);

        $level = $result['rows'];
        // Retrieve individual field value
        $name = $level["name"];
    }
}

?>

<?= template_header('Edit') ?>

<div class="content">
    <h2>Level: Edit</h2>
    <form action="edit_level.php?id=<?= $id; ?>" method="post">
    <div>
            <label for="name">Level</label>
            <input type="text" name="name" id="name" value="<?= $name ?>">
        </div>
        <input type="submit" value="Submit">
    </form>
</div>

<?= template_footer() ?>