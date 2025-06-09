<?php

use \koolreport\processes\ColumnMeta;

class CustomersYears extends \koolreport\KoolReport
{
    use \koolreport\yii2\Friendship;
    function settings()
    {
        $config = include \Yii::getAlias('@app') . "/config/koolreport/config.php";


        return array(
            "dataSources"=>array(
                "automaker"=>$config["automaker"]
            )
        );
    }
    function setup()
    {
        $this->src('automaker')
        ->query('select * from customer_product_dollarsales2')
        ->pipe(new \koolreport\pivot\processes\PivotSQL([
            "column" => "orderYear",
            "row" => "customerName",
            "aggregates"=>array(
                "sum"=>"dollar_sales",
            ),
        ]))
        ->pipe(new ColumnMeta(array(
            "dollar_sales - sum"=>array(
                'type' => 'number',
                "prefix" => "$",
            ),
        )))
        ->pipe($this->dataStore('pivotData'));

    }
}
