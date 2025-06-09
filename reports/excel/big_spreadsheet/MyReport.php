<?php


class MyReport extends \koolreport\KoolReport
{
    use \koolreport\yii2\Friendship;
    use \koolreport\excel\BigSpreadsheetExportable;

    function settings()
    {
        return array(
            "dataSources" => array(
                "dollarsales"=>array(
                    'filePath' => Yii::getAlias('@app/databases/customer_product_dollarsales2.xlsx'),
                    'class' => '\koolreport\excel\BigSpreadsheetDataSource'      
                ), 
            )
        );
    }    function setup()
    {
        $node = $this->src('dollarsales')
        ->pipe($this->dataStore('sales'));
    }
}
