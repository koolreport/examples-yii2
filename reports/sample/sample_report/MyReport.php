<?php



//Step 2: Creating Report class
class MyReport extends \koolreport\KoolReport
{
    use \koolreport\yii2\Friendship;
    protected function settings()
    {
        return array(
            "dataSources"=>array(
                
            )
        );
    }
    protected function setup()
    {

    }
}