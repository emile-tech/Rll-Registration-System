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
    $result = $model->update('how_did_you_hear', $data);
    $msg = $result['message'];

    header('location: list_feedback.php');
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        $result = $model->fetch('how_did_you_hear', $id);

        $how_did_you_hear = $result['rows'];
        // Retrieve individual field value
        $name = $how_did_you_hear["name"];
        
    }

}

?>

<?= template_header('Edit') ?>

<div class="content">
    <h2>Feedback: Edit</h2>
    <form action="edit_feedback.php?id=<?= $id; ?>" method="post">
    <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" ?>
    </div>
        <input type="submit" value="Submit">
    </form>
</div>

<?= template_footer() ?>