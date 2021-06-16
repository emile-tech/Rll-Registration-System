<?php

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'rll_registration_system');

/* Attempt to connect to MySQL database */
$mysqli = new mysqli('localhost', 'root', '', 'rll_registration_system');

// Check connection
if ($mysqli->connect_error !== NULL) {
    die("ERROR: Could not connect. " . $mysqli->connect_error);
} else {
    echo "Successful";
}
// Include config file
require_once "functions.php";



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get hidden input value
    $id = $_GET["id"];

    // Validate name
    $buffer = trim($_POST["firstName"]);

    $firstName = $buffer;

    // Validate address address
    $buffer = trim($_POST["lastName"]);
    $lastName = $buffer;

    // Prepare an update statement
    $sql = "UPDATE participant SET firstName=?, lastName=? WHERE id=?";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssi", $firstName, $lastName, $id);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records updated successfully. Redirect to landing page
            header("location: list_participant.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        $stmt->close();
    } else {
        echo $mysqli->error;
    }
    // Close connection
    $mysqli->close();
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM participant WHERE id = ?";
        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $firstName = $row["firstName"];
                    $lastName = $row["lastName"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();

        // Close connection
        $mysqli->close();
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
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