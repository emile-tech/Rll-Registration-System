<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';

$msg = "";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Validate name
    $name = trim($_POST["name"]);
    $capacity = trim($_POST["capacity"]);
    $data = ["name" => $name, "capacity" => $capacity];
    $model->insert('accomodation', $data);
}

?>
<?= template_header('Create') ?>

<div class="content">
    <h2>Accomodation: New</h2>
    <form action=<?= $_SERVER['PHP_SELF']; ?> method="post">
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="" id="name" />
        </div>
        <div>
            <label for="capacity">Capacity</label>
            <input type="number" name="capacity" placeholder="" id="capacity" />
        </div>
        <div>
            <label for="coordinator">Coordinator</label>
            <input type="text" name="coordinator" placeholder="" id="coordinator" />
        </div>
        <div>
            <label for="coordinatorAssistant">Coordinator Assistant</label>
            <input type="text" name="coordinatorAssistant" placeholder="" id="coordinatorAssistant" />
        </div>
        <input type="submit" value="Submit" name="submit">
    </form>


</div>

<?= template_footer() ?>