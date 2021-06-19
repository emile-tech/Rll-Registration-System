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
    $startDate = trim($_POST["startDate"]);
    $endDate = trim($_POST["endDate"]);
    $biblestudyGroups = trim($_POST["biblestudyGroups"]);
    $data = ['meeting' => $name, 'theme' => $theme, 'startDate' => $startDate, 'endDate' => $endDate, 'biblestudyGroups' => $biblestudyGroups, "id" => $id];
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
        $startDate = $meeting["startDate"];
        $endDate = $meeting["endDate"];
        $bibleStudyGroups = $meeting["bibleStudyGroups"];
    }
}

?>

<?= template_header('Edit') ?>

<div class="content">
    <h2>Meeting: Edit</h2>
    <form action="edit_meeting.php?id=<?= $id; ?>" method="post">
    <div>
            <label for="meeting">Name</label>
            <input type="text" name="meeting" id="meeting" value="<?= $name ?>">
        </div>
        <div>
            <label for="theme">Theme</label>
            <input type="text" name="theme" id="theme" value="<?= $theme ?>">
        </div>
        <div>
            <label for="startDate">Start Date</label>
            <input type="date" name="startDate" id="startDate" value="<?= $startDate ?>">
        </div>
        <div>
            <label for="endDate"> End Date</label>
            <input type="date" name="endDate" id="endDate" value="<?= $endDate ?>">
        </div>
        <div>
            <label for="bibleStudyGroups"> Bible Study Groups</label>
            <input type="number" name="bibleStudyGroups" id="bibleStudyGroups" value="<?= $bibleStudyGroups ?>">
        </div>
        <input type="submit" value="Submit">
    </form>
</div>

<?= template_footer() ?>