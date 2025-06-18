<?php
use \koolreport\widgets\koolphp\Table;
use \koolreport\sparklines\Pie;

$currentUrl = Yii::$app->request->url;
$exportExcel = '/' . trim($currentUrl, '/') . '/export?type=excel';
?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
		<h1>Excel Exporting Charts in Table</h1>
		<p class="lead">Exporting table with chart column</p>
		<form method="post">
			<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
			<button type="submit" class="btn btn-primary" formaction="<?php echo $exportExcel; ?>">Download Excel</button>
		</form>
	</div>
	<div class='box-container'>
		<div>
			<?php
			Table::create(array(
				"dataSource" => $this->dataStore('salesQuarterProduct'),
				"columns" => array(
					"productName",
					"Q1",
					"Q2",
					"Q3",
					"Q4",
					"Chart" => [
						"formatValue" => function ($value, $row, $cKey) {
							return Pie::create(array(
								"data" => [
									$row['Q1'],
									$row['Q2'],
									$row['Q3'],
									$row['Q4']
								],
								"width" => "60px",
								"height" => "60px",
							));
						},
					],
				),
			));
			?>
		</div>
	</div>
</div>