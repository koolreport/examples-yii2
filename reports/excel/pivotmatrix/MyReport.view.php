<?php

use \koolreport\pivot\widgets\PivotMatrix;

$currentUrl = Yii::$app->request->url;
$export = '/' . trim($currentUrl, '/') . '/export';
?>
<form method="post">
	<div class="report-content">
		<div style='text-align: center;margin-bottom:30px;'>
			<h1>Excel Exporting Template</h1>
			<p class="lead">Exporting pivot matrix with template</p>
			<button type="submit" class="btn btn-primary" formaction="<?php echo $export; ?>">Download Excel</button>
			<input type="hidden" name="koolPivotUpdate" value="1" />
			<input type="hidden" name="<?php echo Yii::$app->request->csrfParam ?>" content="<?php echo Yii::$app->request->getCsrfToken(); ?>" />
		</div>
		<div class='box-container'>
			<div>
				<?php
				PivotMatrix::create(array(
					"name" => "PivotMatrix1",
					"dataSource" => $this->dataStore('salesPivot'),
					"showDataHeaders" => true,
				));
				?>
			</div>
		</div>
	</div>
</form>