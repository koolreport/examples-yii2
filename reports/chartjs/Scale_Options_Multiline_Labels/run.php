<?php

require_once "MyReport.php";
$report = new MyReport;
$report->run();
$report->render();
?>

<html>

<head>
    <title>
        Line Chart
    </title>
</head>

<body>
</body>

</html>