<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get hidden input value
    $id = $_GET["id"];

    // Validate name
    $firstName = trim($_POST["firstName"]);
    // Validate address address
    $lastName = trim($_POST["lastName"]);
    $data = ['firstName' => $firstName, 'lastName' => $lastName, "id" => $id];
    $result = $model->update('participant', $data);
    $msg = $result['message'];

    header('location: list_participant.php');
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        $result = $model->fetch('participant', $id);

        $participant = $result['rows'];
        // Retrieve individual field value
        $firstName = $participant["firstName"];
        $lastName = $participant["lastName"];
    }
}

?>

<?= template_header('Edit') ?>

<div class="content">
    <h2>Participant: Edit</h2>
    <form action="edit_participant.php?id=<?= $id; ?>" method="post">
        <div>
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" id="firstName" value="<?= $firstName ?>">
        </div>
        <div>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName" value="<?= $lastName ?>">
        </div>
        <input type="submit" value="Submit">
    </form>
</div>

<?= template_footer() ?>