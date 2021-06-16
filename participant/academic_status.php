<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['submit'])) {
    if ($_POST['academicStatus'] == 'inCollege') {
        redirect('create_participant.php');
    } else {
        redirect('create_participant_graduate.php');
    }
}

?>
<?= template_header('Academic Status') ?>
<div class="content">
    <h2>Academic Status</h2>
    <form action=<?= $_SERVER['PHP_SELF']; ?> method="post">
        <div>
            <label>In College: </label><input type="radio" name="academicStatus" value="inCollege" />
        </div>
        <div>
            <label>Graduate: </label><input type="radio" name="academicStatus" value="graduate" /><br />
        </div>
        <input type="submit" value="PROCEED >>" name="submit" />
    </form>
</div>
<?= template_footer() ?>