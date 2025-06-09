<?php

use yii\helpers\Html;

$public_path = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR;
$appPath = Yii::getAlias('@app');
$urlPath = Yii::$app->request->getPathInfo();

$report_path = rtrim($appPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . ltrim($urlPath, DIRECTORY_SEPARATOR);

$exampleFile = $report_path . DIRECTORY_SEPARATOR . '_example.json';

if (file_exists($exampleFile)) {
    $example = json_decode(file_get_contents($exampleFile), true);
} else {
    $example = [];
}

include $public_path . "helpers/common.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="KoolReport is an intuitive and flexible Open Source PHP Reporting Framework for faster and easier data report delivery.">
    <meta name="author" content="KoolPHP Inc">
    <meta name="keywords" content="php reporting framework">
    <link rel="shortcut icon" href="<?php echo $root_url; ?>/assets/images/bar.png">
    <title>
        <?php
        if (!empty($example["title"])) {
            echo htmlspecialchars($example["title"]) . " - ";
        }
        ?>
        KoolReport Examples &amp; Demonstration
    </title>

    <link href="<?php echo $root_url; ?>/assets/fontawesome/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $root_url; ?>/assets/simpleline/simple-line-icons.min.css" rel="stylesheet">
    <link href="<?php echo $root_url; ?>/assets/css/tomorrow.css" rel="stylesheet">

    <link href="<?php echo $root_url; ?>/assets/theme/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $root_url; ?>/assets/theme/css/main.css" rel="stylesheet">

    <script type="text/javascript" src="<?php echo $root_url; ?>/assets/theme/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $root_url; ?>/assets/theme/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="<?php echo $root_url; ?>/assets/js/highlight.min.js"></script>
    <script type="text/javascript" src="<?php echo $root_url; ?>/assets/js/showdown.js"></script>
</head>

<body>
    <?php include $public_path . "helpers/nav.php"; ?>
    <?php include $public_path . "helpers/online_link.php"; ?>
    <main role="main" class="container">
        <?php
        echo $report_content;
        ?>
        <?php
        include $public_path . "helpers/example_meta.php";
        ?>
    </main>
    <?php include $public_path . "helpers/footer.php"; ?>
    <script type="text/javascript">
        hljs.initHighlightingOnLoad();
    </script>
</body>

</html>