<div id="report_render" style="max-width: 800px;margin: auto;padding: 16px 32px;margin-top: 16px">
    <?php
    class SamplesUtils
    {
        private $seed;

        public function srand($seed)
        {
            $this->seed = $seed;
        }

        public function rand($min = 0, $max = 1)
        {
            $this->seed = ($this->seed * 9301 + 49297) % 233280;
            $random = $min + ($this->seed / 233280) * ($max - $min);
            return $random;
        }

        public function numbers($config = [])
        {
            $min = isset($config['min']) ? $config['min'] : 0;
            $max = isset($config['max']) ? $config['max'] : 1;
            $from = isset($config['from']) ? $config['from'] : [];
            $count = isset($config['count']) ? $config['count'] : 8;
            $decimals = isset($config['decimals']) ? $config['decimals'] : 8;
            $continuity = isset($config['continuity']) ? $config['continuity'] : 1;
            $dfactor = pow(10, $decimals);
            $data = [];

            for ($i = 0; $i < $count; $i++) {
                $value = (isset($from[$i]) ? $from[$i] : 0) + $this->rand($min, $max);
                if ($this->rand() <= $continuity) {
                    $data[] = round($value * $dfactor) / $dfactor;
                } else {
                    $data[] = null;
                }
            }

            return $data;
        }
    }

    $samples = new SamplesUtils();
    if (!isset($_POST['command'])) {
        $samples->srand(110);
    }
    if (isset($_POST['command'])) {
        $samples->srand($_SESSION['seed']);
    }

    $inputs = [
        'min' => -100,
        'max' => 100,
        'count' => 16,
    ];

    $randomDatas = $samples->numbers($inputs);

    $data = [
        ['month' => 'January', 'series1' => $randomDatas[0]],
        ['month' => 'February', 'series1' => $randomDatas[1]],
        ['month' => 'March', 'series1' => $randomDatas[2]],
        ['month' => 'April', 'series1' => $randomDatas[3]],
        ['month' => 'May', 'series1' => $randomDatas[4]],
        ['month' => 'June', 'series1' => $randomDatas[5]],
        ['month' => 'July', 'series1' => $randomDatas[6]],
        ['month' => 'August', 'series1' => $randomDatas[7]],
        ['month' => 'September', 'series1' => $randomDatas[8]],
        ['month' => 'October', 'series1' => $randomDatas[9]],
        ['month' => 'November', 'series1' => $randomDatas[10]],
        ['month' => 'December', 'series1' => $randomDatas[11]],
        ['month' => 'January', 'series1' => $randomDatas[12]],
        ['month' => 'February', 'series1' => $randomDatas[13]],
        ['month' => 'March', 'series1' => $randomDatas[14]],
        ['month' => 'April', 'series1' => $randomDatas[15]]
    ];

    $series = array('month');
    if (!isset($_POST['command'])) {
        $seed = (int)$samples->rand(-100,100);
        $_SESSION['seed'] = $seed;
        $samples->srand($seed);
        $_SESSION['data'] = $data;
        $_SESSION['seriesCount'] = 1;
        $_SESSION['seriesStart'] = 1;
        for ($i = 1; $i <= $_SESSION['seriesCount']; $i++) {
            array_push($series, "series" . $i);
        }
    }

    if (isset($_POST['command']) && $_POST['command'] === 'randomize') {
        $seed = (int)$samples->rand(-100,100);
        $_SESSION['seed'] = $seed;
        $samples->srand($seed);
        for ($i = 1; $i <= $_SESSION['seriesCount']; $i++) {
            $name = "randomData" . $i;
            $$name = $samples->numbers($inputs);
        }
        $count = count($_SESSION['data']);
        for ($i = 0; $i < $count; $i++) {
            for ($j = 1; $j <= $_SESSION['seriesCount']; $j++) {
                $name = "randomData" . $j;
                $_SESSION['data'][$i]['series' . $j] = $$name[$i];
            }
        }
        for ($i = $_SESSION['seriesStart']; $i <= $_SESSION['seriesCount']; $i++) {
            array_push($series, "series" . $i);
        }
    }

    if (isset($_POST['command']) && $_POST['command'] === 'addDataset') {
        $_SESSION['seriesCount'] = $_SESSION['seriesCount'] + 1;
        $seed = (int)$samples->rand(-100,100);
        $_SESSION['seed'] = $seed;
        $samples->srand($seed);
        $randomData = $samples->numbers($inputs);
        $count = count($_SESSION['data']);
        for ($i = 0; $i < $count; $i++) {
            $_SESSION['data'][$i]['series' . $_SESSION['seriesCount']] = $randomData[$i];
        }
        for ($i = $_SESSION['seriesStart']; $i <= $_SESSION['seriesCount']; $i++) {
            array_push($series, "series" . $i);
        }
    }

    if (isset($_POST['command']) && $_POST['command'] === 'removeDataset') {
        if (count($_SESSION['data'][0]) > 1) {
            foreach ($_SESSION['data'] as &$item) {
                array_splice($item, 1, 1);
            }
            $_SESSION['seriesStart'] = $_SESSION['seriesStart'] + 1;
            for ($i = $_SESSION['seriesStart']; $i <= $_SESSION['seriesCount']; $i++) {
                array_push($series, "series" . $i);
            }
        }
    }

    \koolreport\chartjs\ColumnChart::create(array(
        'dataSource' => $_SESSION['data'],
        'columns' => $series,
        "options" => array(
            "legend" => false,
            "tooltips" => array(
                "enabled" => false
            ),
            "elements" => array(
                "rectangle" => array(
                    "backgroundColor" => "function(ctx) {
                    var v = ctx.dataset.data[ctx.dataIndex];
                    var c = v < -50 ? '#D60000' :
                        v < 0 ? '#F46300' :
                        v < 50 ? '#0358B6' :
                        '#44DE28';

                    var alpha = 1 - (1 - Math.abs(v / 150));
                    return Color(c).alpha(alpha).rgbString();
                }",
                    "borderWidth" => 2,
                    "borderColor" => "function(ctx) {
                    var v = ctx.dataset.data[ctx.dataIndex];
                    var c = v < -50 ? '#D60000' :
                        v < 0 ? '#F46300' :
                        v < 50 ? '#0358B6' :
                        '#44DE28';

                    return c;
                }",
                )
            ),
        )
    ));
    ?>
</div>