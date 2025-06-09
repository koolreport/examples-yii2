<?php
//Step 1: Load KoolReport

use \koolreport\processes\Limit;
use \koolreport\processes\Sort;
use \koolreport\processes\Map;
use \koolreport\cube\processes\Cube;
use \koolreport\cube\processes\SuperCube;
use \koolreport\core\Utility as Util;

//Step 2: Creating Report class
class MyReport extends \koolreport\KoolReport
{
    function settings()
    {
        return array(
            "dataSources" => array(
                "dollarsales"=>array(
                    'filePath' => __DIR__ . '/../../../databases/customer_product_dollarsales2.csv',
                    'fieldSeparator' => ';',
                    'class' => "\koolreport\datasources\CSVDataSource"      
                ), 
            )
        );
    }
    function setup()
    {
        $this->src('dollarsales')
        ->pipe($this->dataStore('origin'));
        
        //multi row fields
        $this->src('dollarsales')->pipe(new SuperCube(array(
            "rows" => "productLine, productName",
            "columns" => "orderYear, orderQuarter",
            "sum" => "dollar_sales",
        )))
        ->pipe($this->dataStore('result'));
    }
}