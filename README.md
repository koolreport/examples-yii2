# KoolReport in Yii2

Yii2 is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling.

KoolReport is reporting framework and can be integrated into Yii2 or any other MVC framework. KoolReport help you to create data report faster and easier.

In this repository, we would like to demonstrate how KoolReport can be used in Yii2.


# Installation

## By downloading .zip file

1. [Download](https://www.koolreport.com/packages/yii2)
2. Unzip the zip file
3. Copy the folder `yii2` into `koolreport` folder so that look like below

```bash
koolreport
├── core
├── yii2
```

## By composer

```
composer require koolreport/core
composer require koolreport/yii2
```
or install `koolreport/pro` if you have a license for it

```
composer require koolreport/pro
```

# Create reports using friendship trait for setting up assets and datasources

1. Inside `app` directory, create `reports` subdirectory to hold your reports.
2. Create `MyReport.php` and `MyReport.view.php` inside `reports` directory. Please see the contents of two files in our repository.
3. Add \koolreport\yii2\Friendship trait to your report like following:

```
class MyReport extends \koolreport\KoolReport
{
    use \koolreport\yii2\Friendship;
    ...
```
This trait would help the report to publish js, css assets to Yii2's `web` directory in a subdirectory called `koolreport_assets` as well as allow using Yii2's database settings in the report.

## Create route and action

In `config/web.php`, create a route to your report and its action with a controller:

```
        'urlManager' => [
            'rules' => [
                [
                    'pattern' => 'customReport',
                    'route' => 'home/custom-report',
                    'suffix' => '',
                ],
```

In the `HomeController` controller (`controllers/HomeController.php`), create the action method:

```
    public function actionCustomReport()
    {
        $report = new \app\reports\MyReport();
        $report->run();
        return $this->render('customReport', [
            'report_content' => $report->render()
        ]);
    }
```
Create the report view `views/home/customReport.php` and put your report content anywhere you like:

```
<html>
...
<?php echo $report_content; ?>
</html>
```

All done!

## View result

Put your CodeIgniter app on your server/localhost. Then you can access after running

```
http://locahost/examples-yii2/web/customReport
```

![combochart](combochart.png)

## CSRF field/token in form submissions and xhr requests

In reports with form submission or xhr request users need to add csrf field/token to the form and request for server response to work.

For example, adding csrf field to form:

```
    <form method="post">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>">
```
or add csrf token to request:

```
    <script>
        subReport.update("SaleByCountriesReport", {
            <?php echo Yii::$app->request->csrfParam; ?>: "<?php echo Yii::$app->request->getCsrfToken(); ?>"
        });
```
or set csrf token in jQuery's ajax setup:

```
<meta name="csrf-token" content="<?= Yii::$app->request->getCsrfToken() ?>" />
...
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
```

# Summary

KoolReport is a great php reporting framework. You can use KoolReport alone with pure php or inside any modern MVC frameworks like Yii2, CakePHP, CodeIgniter, Yii2. If you have any questions regarding KoolReport, free free to contact us at [our forum](https://www.koolreport.com/forum/topics) or email to [support@koolreport.com](mailto:support@koolreport.com).

__Happy Reporting!__