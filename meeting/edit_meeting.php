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
    $theme = trim($_POST["theme"]);
    $data = ['name' => $name, 'theme' => $theme, "id" => $id];
    $result = $model->update('meeting', $data);
    $msg = $result['message'];

    header('location: list_meeting.php');
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        $result = $model->fetch('meeting', $id);

        $meeting = $result['rows'];
        // Retrieve individual field value
        $name = $meeting["name"];
        $theme = $meeting["theme"];
    }
}

?>

<?= template_header('Edit') ?>

<div class="content">
    <h2>Meeting: Edit</h2>
    <form action="edit_meeting.php?id=<?= $id; ?>" method="post">
    <div>
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="John" id="name" />
        </div>
        <div>
            <label for="theme">Theme</label>
            <input type="text" name="theme" placeholder="Enter the meeting Name" id="theme" />
        </div>
        <div>
            <label for="startDate">Start Date</label>
            <input type="date" name="startDate" placeholder="Meeting start Date" id="startDate" />
        </div>
        <div>
            <label for="endDate">End Date</label>
            <input type="date" name="startDate" placeholder="Meeting End Date" id="endDate" />
        </div>
        <div>
            <label for="biblestudyGroups">Bible Study Group</label>
            <input type="number" name="biblestudyGroups" placeholder="Bible Study Groups" id="biblestudyGroups" />
        </div>
        <input type="submit" value="Submit">
    </form>
</div>

<?= template_footer() ?>