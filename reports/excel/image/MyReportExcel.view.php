<?php
    $sheet1 = "Sales by Customer";
?>
<div sheet-name="<?php echo $sheet1; ?>">
    <div range="A1:C5">
        <?php
        \koolreport\excel\Image::create(array(
            'path' => Yii::$app->basePath . '/web/assets/images/bar.png', // must have

            // "range" => "B2:D4", // overrides width, height if exists
            // 'coordinate' => 'B2', // default: A1
            // 'coordinate2' => 'D4', // default: '', // overrides width, height if exists

            // 'offsetX' => 50, // default: 0
            // 'offsetX2' => 50, // default: 0
            // 'offsetY' => 100, // default: 0
            // 'offsetY2' => 100, // default: 0
            
            // 'width' => 300, // default: 0
            // 'height' => 300, // default: 0
            // 'resizeProportional' => false, // default: true
            
            // 'name' => 'name', // default: ''
            // 'description' => 'description', // default: ''
            // 'roration' => 0, // default: 0
            // 'hyperlink' => null, //Hyperlink object, default: null
            // 'shadow' => null, //Shadown object, default: null
            // 'shadowVisible' => true, // default: false
            // 'shadowDirection' => 45, // default: 0
        ));
        ?>
    </div>
</div>