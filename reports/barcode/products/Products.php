<?php


use \koolreport\processes\Filter;

class Products extends \koolreport\KoolReport
{
    use \koolreport\yii2\Friendship;
    function settings()
    {
        return array(
            "dataSources"=>array(
                "products"=>array(
                'filePath' => Yii::getAlias('@app/databases/products.csv'),
                'fieldSeparator' => '|',
                'class' => "\koolreport\datasources\CSVDataSource"      
                ),
            )
        );
    }
    
    function setup()
    {
        $node = $this->src('products')
        ->pipe(new Filter(array(
            array('productLine', '=', 'Ships'),
        )))
        ->pipe($this->dataStore('products'));  
    }
}
