<?php



use \koolreport\KoolReport;
use \koolreport\processes\Filter;
use \koolreport\processes\TimeBucket;
use \koolreport\processes\Group;
use \koolreport\processes\Limit;

class SakilaRental extends \koolreport\KoolReport
{
    use \koolreport\yii2\Friendship;
    use \koolreport\export\Exportable;
    
    public function settings()
    {
        return array(
            "dataSources"=>array(
                "export1"=>array(
                    "class"=>'\koolreport\datasources\CSVDataSource',
                    'filePath'=>dirname(__FILE__)."/dataSakila.csv",
                )
            )
        );
    }   
    protected function setup()
    {
        $this->src('export1')
        ->pipe(new TimeBucket(array(
            "payment_date"=>"month"
        )))
        ->pipe(new Group(array(
            "by"=>"payment_date",
            "sum"=>"amount"
        )))
        ->pipe($this->dataStore('sale_by_month'));
    } 
}