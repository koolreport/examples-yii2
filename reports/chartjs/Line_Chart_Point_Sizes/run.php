<?php
// if (session_status() !== PHP_SESSION_ACTIVE) session_start();

require_once "MyReport.php";
$report = new MyReport;
$report->run();
$report->render();
?>

<html>

<head>
    <title>
        Different Point Sizes 
    </title>
</head>

<body>
</body>

</html>