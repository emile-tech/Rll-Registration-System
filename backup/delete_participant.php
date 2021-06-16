<?php
include_once "config.php";
include_once "functions.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET["id"];
    if (isset($_GET["confirm"])) {
        if ($_GET["confirm"] == "yes") {
            // Prepare a delete statement
            $sql = "DELETE FROM participant WHERE id = ?";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) {
                    // Records deleted successfully. Redirect to landing page
                    header("location: list_participant.php");
                    exit();
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                    echo $mysqli->error;
                }
            } else {
                echo $mysqli->error;
            }
        }
    } else {
        $sql = "SELECT * FROM participant WHERE id=?";
        if ($stmt = $mysqli->prepare($sql)) {
            $id = trim($_GET["id"]);
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $participant = $result->fetch_assoc();
                }
            } else {
                echo  $mysqli->error;
            }
        } else {
            // Close connection
            $mysqli->close();
            echo  $mysqli->error;
            exit();
        }
    }




    // Close statement
    $stmt->close();

    // Close connection
    $mysqli->close();
}
?>
<?= template_header('Delete Paricipant') ?>

<div class="content delete">
    <h2>Patcipant: Delete</h2>
    <p><b>ID: </b><?= $participant['id'] ?></p>
    <p><b>First Name:</b> <?= $participant['firstName']; ?></p>
    <p><b>Last Name:</b> <?= $participant['lastName']; ?></p>


    <p>Are you sure you want to delete this participant?</p>
    <div class="yesno">
        <a href="<?= $_SERVER["PHP_SELF"] ?>?id=<?= $participant['id'] ?>&confirm=yes">Yes</a>
        <a href="list_participant.php">No</a>
    </div>
</div>

<?= template_footer() ?>