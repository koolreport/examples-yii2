<?php


class MyReport extends \koolreport\KoolReport
{
    use \koolreport\yii2\Friendship;
    //use \koolreport\amazing\Theme;
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

    }
}