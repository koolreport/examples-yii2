<?php
use \koolreport\pivot\widgets\PivotTable;
use \koolreport\widgets\koolphp\Table;
?>
<div class="report-content">
	<div style='text-align: center;margin-bottom:30px;'>
        <h1>Excel Exporting Hyperlink</h1>
        <p class="lead">Exporting excel hyperlink with template</p>
		<form>
			<button type="submit" class="btn btn-primary" formaction="<?php echo base_url() . uri_string(); ?>/export">Download Excel</button>
		</form>
	</div>
	<div class='box-container'>
		<div>
			<a href="https://www.example.com">Example site</a>
		</div>
	</div>
</div>
