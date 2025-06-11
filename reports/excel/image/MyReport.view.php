<?php
$currentUrl = Yii::$app->request->url;
$export = '/' . trim($currentUrl, '/') . '/export';
?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        <h1>Excel Exporting Image</h1>
        <p class="lead">Exporting excel image with template</p>
		<form>
			<button type="submit" class="btn btn-primary" formaction="<?php echo $export; ?>">Download Excel</button>
		</form>
	</div>
	<div class='box-container'>
		<div>
			<img src="<?php echo Yii::$app->homeUrl; ?>/assets/images/bar.png" />
		</div>
	</div>
</div>
