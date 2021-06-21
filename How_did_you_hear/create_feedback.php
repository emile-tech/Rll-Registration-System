<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';
// Define variables and initialize with empty values
$name = "";

$msg = "";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $name = trim($_POST["name"]);
    $data = ['name' => $name,];

    $result = $model->insert('How_did_you_hear', $data);
    $msg = $result['message'];

    //$result['id'] contains the last inserted id
    //redirect("list_meeting.php");
}
?>

<?= template_header('Create') ?>

<div class="content">
    <h2>How did you hear about the Meeting?</h2>
    <form action=<?= $_SERVER['PHP_SELF']; ?> method="post">
        <div>
        <label for="name">Name</label>
        <input type="text" name="name"  id="name" />
        </div>
        <input type="submit" value="Submit">
    </form>
    <p><?= $msg ?></p>

</div>

<?= template_footer() ?>