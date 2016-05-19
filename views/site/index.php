<?php
use dosamigos\datepicker\DateRangePicker;
/* @var $this yii\web\View */

$this->title = 'График поездок';

if($data==[]){

}
else {
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load("current", {packages: ["timeline"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

            var container = document.getElementById('timeline');
            var chart = new google.visualization.Timeline(container);
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn({type: 'string', id: 'Courier'});
            dataTable.addColumn({type: 'string', id: 'Region'});
            dataTable.addColumn({type: 'date', id: 'Start'});
            dataTable.addColumn({type: 'date', id: 'End'});
            dataTable.addRows([
                <?php
                foreach ($data as $key => $value) {
                    print_r($value);
                }
                ?>
            ]);

            chart.draw(dataTable);
        }
    </script>
    <div class="site-index">
        <div style="margin-bottom: 100px">
            <form method="post">
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>">
                <div>Выберите период просмотра поездок</div>
                <?= DateRangePicker::widget([
                    'name' => 'date_from',
                    'value' => '2016-05-01',
                    'nameTo' => 'date_to',
                    'valueTo' => '2016-06-01',
                    'clientOptions' => [
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);?>
                <input type="submit" class="btn btn-primary" style="float: right; margin: 20px;">
            </form>
        </div>
        <div id="timeline" style="height: 600px;"></div>
    </div>
    <?php
}