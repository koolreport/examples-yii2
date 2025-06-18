<?php
use \koolreport\widgets\koolphp\Table;
use \koolreport\datagrid\DataTables;

$currentUrl = Yii::$app->request->url;
$exportExcel = '/' . trim($currentUrl, '/') . '/export?type=excel';
$exportBigSpreadsheet = '/' . trim($currentUrl, '/') . '/export?type=bigspreadsheet';
?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        <h1>Excel Table Complex Header</h1>
        <p class="lead">Exporting table with complex headers</p>
		<form method="post">
			<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
			<button type="submit" class="btn btn-primary" formaction="<?php echo $exportExcel; ?>">Download Excel</button>
			<button type="submit" class="btn btn-primary" formaction="<?php echo $exportBigSpreadsheet; ?>t">Download Big Spreadsheet</button>
		</form>
	</div>
	<div class='box-container'>
		<div>
			<?php
			DataTables::create(array(
				"dataSource" => $this->dataStore('orders'),
				"columns"=>array(
					"productName",
					"orderYear" => ["label" => "Date-Year"],
					"orderMonth" => ["label" => "Date-Month"],
					"orderDay" => ["label" => "Date-Day"],
					"dollar_sales"=>array(
						"type"=>"number",
						"decimals" => 2,
					)
				),
				"complexHeaderLabels" => true,
				"options" => [
					"paging" => true,
					"order" => [[4, 'desc']],
					"columnDefs" => [
						[
							"targets" => [4],
							"type" => "num-fmt",
						]
					]
				]
			));
			?>
		</div>
	</div>
</div>
