<?php

use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\ColumnChart;

$currentUrl = Yii::$app->request->url;
$export = '/' . trim($currentUrl, '/') . '/export';
?>

<div class="report-content">
    <div class="text-center">
        <h1>Cash In Report</h1>
        <p class="lead">This example show how to set PDF's header and footer</p>
        <a href="<?= $export ?>" class="btn btn-primary">Download PDF</a>
    </div>
    <hr />

    <?php
    ColumnChart::create(array(
        "dataStore" => $this->dataStore('sale_by_month'),
        "columns" => array(
            "payment_date" => array(
                "label" => "Month",
                "type" => "datetime",
                "format" => "Y-n",
                "displayFormat" => "F, Y",
            ),
            "amount" => array(
                "label" => "Amount",
                "type" => "number",
                "prefix" => "$",
            )
        ),
        "width" => "100%",
    ));
    ?>

    <?php
    Table::create(array(
        "dataStore" => $this->dataStore('sale_by_month'),
        "columns" => array(
            "payment_date" => array(
                "label" => "Month",
                "type" => "datetime",
                "format" => "Y-n",
                "displayFormat" => "F, Y",
            ),
            "amount" => array(
                "label" => "Amount",
                "type" => "number",
                "prefix" => "$",
            )
        ),
        "cssClass" => array(
            "table" => "table table-hover table-bordered"
        )
    ));
    ?>
</div>