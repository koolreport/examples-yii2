<?php
use \koolreport\widgets\koolphp\Table;

$currentUrl = Yii::$app->request->url;
$exportExcel = '/' . trim($currentUrl, '/') . '/export?type=excel';
$exportBigSpreadsheet = '/' . trim($currentUrl, '/') . '/export?type=bigspreadsheet';
?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        <h1>Excel Table Rowspan</h1>
        <p class="lead">Exporting table with rowspan option</p>
		<form method="post">
			<button type="submit" class="btn btn-primary" formaction="<?php echo $exportExcel; ?>">Download Excel</button>
			<button type="submit" class="btn btn-primary" formaction="<?php echo $exportBigSpreadsheet; ?>">Download Big Spreadsheet</button>
		</form>
	</div>
	<div class='box-container'>
		<div>
			<?php
			Table::create(array(
				"dataSource" => $this->dataStore('sales'),
				"columns"=>array(
					"customerName",
					"productLine",
					"productName",
					"dollar_sales"=>array(
						"type"=>"number",
					)
				),
				"cssClass"=>array(
					"table"=>"table-bordered"
				),
				"removeDuplicate" => ["customerName", "productLine"],
				"paging"=>array(
					"pageSize"=>10
				)
			));
			?>
		</div>
	</div>
</div>
