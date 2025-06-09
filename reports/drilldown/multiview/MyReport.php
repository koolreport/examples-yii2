<?php

use \koolreport\processes\TimeBucket;
use \koolreport\processes\Group;

class MyReport extends \koolreport\KoolReport
{
    use \koolreport\yii2\Friendship;
    use \koolreport\amazing\Theme;
    function settings()
    {
        //Get default connection from config.php
        $config = include \Yii::getAlias('@app') . "/config/koolreport/config.php";

        return array(
            "dataSources"=>array(
                "automaker"=>$config["automaker"]
            )
        );

    }
    function setup()
    {
        $this->src("automaker")->query("
            select paymentDate, amount from payments
        ")
        ->pipe(new TimeBucket(array(
            "paymentDate"=>"month",
        )))
        ->pipe(new Group(array(
            "by"=>"paymentDate",
            "sum"=>"amount",
        )))
        ->pipe($this->dataStore("sale"));

    }
}