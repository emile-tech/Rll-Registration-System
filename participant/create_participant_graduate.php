<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';
// Define variables and initialize with empty values
$firstName = $lastName = "";
$firstNameErr = $lastNameErr = "";
$msg = "";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $firstName = trim($_POST["firstName"]);
    $lastName = trim($_POST["lastName"]);
    $data = ['firstName' => $firstName, 'lastName' => $lastName];

    $result = $model->insert('participant', $data);
    $msg = $result['message'];

    //$result['id'] contains the last inserted id
    redirect('tag.php?id=' . $result['id']);
}
?>
<?= template_header('Create') ?>

<div class="content">
    <h2>Participant(Graduate): New</h2>
    <form action=<?= $_SERVER['PHP_SELF']; ?> method="post">
        <div>
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" placeholder="John" id="firstName" />
        </div>
        <div>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" placeholder="Doe" id="lastName" />
        </div>
        <input type="submit" value="Submit">
    </form>
    <p><?= $msg ?></p>

</div>

<?= template_footer() ?>