<?php

class ListOrders extends \koolreport\KoolReport
{
    use \koolreport\yii2\Friendship;
    function settings()
    {
        $config = include \Yii::getAlias('@app') . "/config/koolreport/config.php";

        return array(
            "dataSources"=>array(
                "automaker"=>$config["automaker"],
            ),
        );
    }

    function setup()
    {
        if(isset($this->params["customerNumber"]))
        {
            $this->src("automaker")
            ->query("
                SELECT orderNumber,orderDate,status FROM orders
                WHERE
                customerNumber = :customerNumber
            ")
            ->params(array(
                ":customerNumber"=>$this->params["customerNumber"],
            ))
            ->pipe($this->dataStore("orders"));
        }
    }
}