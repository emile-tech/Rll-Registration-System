<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';
$fullName = '';
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Get URL parameter
    $id =  trim($_GET["id"]);

    $result = $model->fetch('participant', $id);

    $participant = $result['rows'];

    // Retrieve individual field value
    $fullName = $participant["firstName"] . " " . $participant["lastName"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
            font-family: arial;
        }

        .title {
            color: grey;
            font-size: 18px;
        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }

        button:hover,
        a:hover {
            opacity: 0.7;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="card">
        <img src="../images/ls_logo.png" alt="John" style="width:100%">
        <p><b>Bible Study Group:</b> 4 </p>
        <p><b>Workshop:</b> Abraham </p>
        <p><b>Accomodation:</b> Abraham </p>

        <p>PID: RLLM21-4817272</p>
        <p>bro. </p>
        <h1><?= $fullName ?></h1>
        <p>Reg. date: 29-May-2021 </p>
        </p>
    </div>
</body>

</html>