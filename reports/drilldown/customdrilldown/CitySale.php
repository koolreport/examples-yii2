<?php

class CitySale extends \koolreport\KoolReport
{
    use \koolreport\yii2\Friendship;
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
            SELECT city, sum(amount) as sale_amount
            FROM
                payments
            JOIN
                customers
            ON
                customers.customerNumber = payments.customerNumber
                AND
                country=:country
            GROUP BY 
                city
        ")
        ->params(array(
            ":country"=>$this->params["country"]
        ))
        ->pipe($this->dataStore("city_sale"));
    }
}