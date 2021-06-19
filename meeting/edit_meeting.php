<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get hidden input value
    $id = $_GET["id"];

    // Validate name
    $meeting = trim($_POST["meeting"]);
    // Validate address address
    $theme = trim($_POST["theme"]);
    $data = ['meeting' => $meeting, 'theme' => $theme, "id" => $id];
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
        $meeting = $meeting["meeting"];
        $theme = $theme["theme"];
    }
}

?>

<?= template_header('Edit') ?>

<div class="content">
    <h2>Meeting: Edit</h2>
    <form action="edit_meeting.php?id=<?= $id; ?>" method="post">
    <div>
            <label for="meeting">Meeting</label>
            <input type="text" meeting="meeting" placeholder="Meeting" id="meeting" />
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