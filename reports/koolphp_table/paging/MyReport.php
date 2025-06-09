<?php



//Step 2: Creating Report class
class MyReport extends \koolreport\KoolReport
{
    use \koolreport\yii2\Friendship;
    protected function settings()
    {
        return array(
            "dataSources"=>array(
                "long_data"=>array(
                    "class"=>'\koolreport\datasources\CSVDataSource',
                    "fieldSeparator"=>"|",
                    'filePath'=>dirname(__FILE__)."/../../../databases/products.csv",
                )

            )
        );
    }
    protected function setup()
    {
        $this->src("long_data")
        ->pipe($this->dataStore("long_data"));
    }    
}