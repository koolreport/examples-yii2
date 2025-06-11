<?php
use \koolreport\widgets\koolphp\Table;

$currentUrl = Yii::$app->request->url;
$exportExcel = '/' . trim($currentUrl, '/') . '/export?type=excel';
?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        <h1>Excel Exporting Image and Hyperlink Columns</h1>
        <p class="lead">Exporting excel table with image and hyperlink columns</p>
		<form method="post">
			<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
			<button type="submit" class="btn btn-primary" formaction="<?php echo $exportExcel; ?>">Download Excel</button>
		</form>
	</div>
	<div class='box-container'>
		<div>
			<?php
			Table::create(array(
				"dataSource" => $this->dataStore('orders'),
				"columns"=>array(
					"productName",
					"dollar_sales"=>array(
						"type"=>"number",
					),
					'image' => [
						'type' => 'string',
						'formatValue' => function($value, $row, $ckey) {
							return '<img src="' . Yii::$app->homeUrl . '/assets/images/bar.png" height="40px" />';
						},
					],
					'url' => [
						'formatValue' => function ($value, $row, $ckey) {
							return '<a href="https://www.example.com">Example site</a>';
						},
					]
				),
				"paging"=>array(
					"pageSize"=>5
				)
			));
			?>
		</div>
	</div>
</div>
