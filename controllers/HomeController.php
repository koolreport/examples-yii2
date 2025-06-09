<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class HomeController extends Controller
{
    public function actionIndex()
    {
        $publicPath = Yii::getAlias('@app/views/home/');
        include $publicPath . '/index_reports.php';
    }

    public function actionCustomReport()
    {
        $report = new \app\reports\MyReport();
        $report->run();
        return $this->render('customReport', [
            'report_content' => $report->render()
        ]);
    }

    public function actionReport()
    {
        $baseUrl = Yii::$app->request->getBaseUrl();
        $currentUrl = Yii::$app->request->getUrl();
        $appPath = Yii::getAlias('@app');
        $relativePath = ltrim(str_replace($baseUrl, '', $currentUrl), '/');
        $reportPath = $appPath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativePath) . DIRECTORY_SEPARATOR;
        ob_start();
        include $reportPath . 'run.php';
        $reportContent = ob_get_clean();
        return $this->render('report', [
            'report_content' => $reportContent
        ]);
    }

    public function actionExport()
    {
        $reportPath = $this->getReportBasePath();
        if (file_exists($reportPath . 'export.php')) {
            include $reportPath . 'export.php';
        } elseif (file_exists($reportPath . 'exportPDF.php')) {
            include $reportPath . 'exportPDF.php';
        } elseif (file_exists($reportPath . 'exportExcel.php')) {
            include $reportPath . 'exportExcel.php';
        }
    }

    public function actionExportPdf()
    {
        $reportPath = $this->getReportBasePath();
        if (file_exists($reportPath . 'exportPDF.php')) {
            include $reportPath . 'exportPDF.php';
        }
    }

    public function actionExportExcel()
    {
        $reportPath = $this->getReportBasePath();
        if (file_exists($reportPath . 'exportExcel.php')) {
            include $reportPath . 'exportExcel.php';
        }
    }

    private function getReportBasePath()
    {
        $baseUrl = Yii::$app->request->hostInfo . Yii::$app->request->baseUrl;
        $url = Yii::$app->request->absoluteUrl;
        $reportPath = str_replace($baseUrl, Yii::getAlias('@app'), $url);
        $reportPath = rtrim($reportPath, '/');
        $reportPath = substr($reportPath, 0, strrpos($reportPath, '/')) . '/';
        return $reportPath;
    }
}
