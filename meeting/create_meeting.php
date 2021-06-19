<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';
// Define variables and initialize with empty values
$name = $theme = "";
$nameErr = $themeErr = "";
$msg = "";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $name = trim($_POST["name"]);
    $theme = trim($_POST["theme"]);
    $startDate = trim($_POST["startDate"]);
    $endDate = trim($_POST["endDate"]);
    $biblestudyGroup = trim($_POST["biblestudyGroup"]);
    $data = ['name' => $name, 'theme' => $theme, 'startDate' => $StartDate, 'endDate' => $endDate, 'biblestudyGroup' => $biblestudyGroup];

    $result = $model->insert('meeting', $data);
    $msg = $result['message'];

    //$result['id'] contains the last inserted id
    redirect("list_meeting.php");
}
?>

<?= template_header('Create') ?>

<div class="content">
    <h2>Meeting: New</h2>
    <form action=<?= $_SERVER['PHP_SELF']; ?> method="post">
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
    <p><?= $msg ?></p>

</div>

<?= template_footer() ?>