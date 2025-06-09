<?php

class SaleByCountriesReport extends \koolreport\KoolReport
{
    use \koolreport\yii2\Friendship;
    public function settings()
    {
        $config = include \Yii::getAlias('@app') . "/config/koolreport/config.php";


        return array(
            "dataSources"=>array(
                "automaker"=>$config["automaker"]
            )
        );
    }
}