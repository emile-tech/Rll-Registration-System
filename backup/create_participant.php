<?php
// Include config file
require_once "config.php";
require_once 'functions.php';
// Define variables and initialize with empty values
$firstName = $lastName = "";
$firstNameErr = $lastNameErr = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $sql = "INSERT INTO participant (firstName, lastName) VALUES (?, ?)";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $firstName, $lastName);
    $stmt->execute();

    // $buffer = trim($_POST["firstName"]);
    // if (empty($buffer)) {
    //     $firstNameErr = "Please enter a First Name.";
    // } else {
    //     $firstName = $buffer;
    // }

    // $buffer = trim($_POST["lastName"]);
    // if (empty($buffer)) {
    //     $lastNameErr = "Please enter a Last Name.";
    // } else {
    //     $lastName = $buffer;
    // }

    // // Check input errors before inserting in database
    // if (empty($firstNameErr) && empty($lastNameErr)) {
    //     // Prepare an insert statement
    //     $sql = "INSERT INTO participant (firstName, lastName) VALUES (?, ?)";

    //     if ($stmt = $mysqli->prepare($sql)) {
    //         // Bind variables to the prepared statement as parameters
    //         $stmt->bind_param("ss", $paramFistName, $paramLastName);

    //         // Set parameters
    //         $paramFistName = $firstName;
    //         $paramLastName = $lastName;


    //         // Attempt to execute the prepared statement
    //         if ($stmt->execute()) {
    //             // Records created successfully. Redirect to landing page
    //             header("location: create_participant.php");
    //             exit();
    //         } else {
    //             echo "Oops! Something went wrong. Please try again later.";
    //             $mysqli->error;
    //         }
    //     }

    //     // Close statement
    //     $stmt->close();
    // }

    // // Close connection
    // $mysqli->close();
}
?>

?>
<?= template_header('Create') ?>

<div class="content">
    <h2>Participant: New</h2>
    <form action="create_participant.php" method="post">
        <div>
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" placeholder="John" id="firstName">
        </div>
        <div>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" placeholder="Doe" id="lastName">
        </div>
        <input type="submit" value="Submit">
    </form>
    <?php if ($msg) : ?>
        <p><?= $msg ?></p>
    <?php endif; ?>
</div>

<?= template_footer() ?>