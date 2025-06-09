<?php



//Step 2: Creating Report class
class MyReport extends \koolreport\KoolReport
{
    use \koolreport\yii2\Friendship;
    use \koolreport\bootstrap4\Theme;
    public function settings()
    {
        //Get default connection from config.php
        $config = include \Yii::getAlias('@app') . "/config/koolreport/config.php";


        return array(
            "dataSources"=>array(
                "automaker"=>$config["automaker"]
            )
        );
    }   
    protected function setup()
    {
        $this->src('automaker')
        ->query("SELECT employeeNumber, firstName,lastName,jobTitle, extension from employees")
        ->pipe($this->dataStore("employees"));
    } 

}