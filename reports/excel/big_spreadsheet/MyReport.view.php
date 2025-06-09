<?php

use \koolreport\widgets\koolphp\Table;

$currentPath = Yii::$app->request->pathInfo;
$exportXLSX = '/' . trim($currentPath, '/') . '/export?type=XLSX';
$exportODS = '/' . trim($currentPath, '/') . '/export?type=ODS';
$exportCSV = '/' . trim($currentPath, '/') . '/export?type=CSV';

?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
		<h1>Big Spreadsheet Exporting</h1>
		<p class="lead">Exporting big spreadsheet with template</p>
		<form method="post">
			<input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>">

			<a href="<?= $exportXLSX ?>" class="btn btn-primary">Download XLSX</a>
			<a href="<?= $exportODS ?>" class="btn btn-primary">Download ODS</a>
			<a href="<?= $exportCSV ?>" class="btn btn-primary">>Download CSV</a>
		</form>
	</div>
	<div class='box-container'>
		<div>
			<?php
			Table::create(array(
				"dataSource" => $this->dataStore('sales'),
				"paging" => array(
					"pageSize" => 5
				)
			));
			?>
		</div>
	</div>
</div>