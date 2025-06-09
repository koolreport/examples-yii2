<?php
    $drilldown = $this->params["@drilldown"];
?>
<?php if (Yii::$app->request->enableCsrfValidation): ?>
<meta name="csrf-token" content="<?= Yii::$app->request->getCsrfToken() ?>" />
<?php endif; ?><level-title>All countries</level-title>
<?php
    \koolreport\widgets\google\GeoChart::create(array(
        "dataSource"=>$this->dataStore("country_sale"),
        "columns"=>array("country","sale_amount"=>array(
            "label"=>"Sales(USD)",
            "prefix"=>'$',
        )),
        "clientEvents"=>array(
            "rowSelect"=>"function(params){
                $drilldown.next({country:params.selectedRow[0]});
            }",
        ),
        "width"=>"100%",
    ));
?>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>