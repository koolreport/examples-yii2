<?php

namespace app\components;

use Yii;
use yii\base\Component;

class ReportRoutes extends Component
{
    public function init()
    {
        parent::init();
        
        $publicPath = Yii::getAlias('@webroot');
        $menuFile = $publicPath . '/reports.json';
        
        if (file_exists($menuFile)) {
            $menu = json_decode(file_get_contents($menuFile), true);
            $this->processMenu($menu);
        }
    }

    protected function processMenu($menu)
    {
        foreach ($menu as $section_name => $section) {
            foreach ($section as $group_name => $group) {
                foreach ($group as $sname => $surl) {
                    if (is_string($surl)) {
                        $surl = rtrim($surl, "/");
                        $this->addRoutes($surl);
                    } else {
                        foreach ($surl as $tname => $turl) {
                            $turl = rtrim($turl, "/");
                            $this->addRoutes($turl);
                        }
                    }
                }
            }
        }
    }

    protected function addRoutes($url)
    {
        $urlManager = Yii::$app->urlManager;
        
        // Add main report route
        $urlManager->addRules([
            [
                'pattern' => $url,
                'route' => 'home/report',
                'verb' => ['GET', 'POST']
            ],
            [
                'pattern' => "$url/export",
                'route' => 'home/export',
                'verb' => ['GET', 'POST']
            ],
            [
                'pattern' => "$url/exportPDF",
                'route' => 'home/exportPDF',
                'verb' => ['GET', 'POST']
            ],
            [
                'pattern' => "$url/exportExcel",
                'route' => 'home/exportExcel',
                'verb' => ['GET', 'POST']
            ],
        ]);
    }
} 