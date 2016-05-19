<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
if($data==[])
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load("current", {packages:["timeline"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

        var container = document.getElementById('timeline');
        var chart = new google.visualization.Timeline(container);
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn({ type: 'string', id: 'Courier' });
        dataTable.addColumn({ type: 'string', id: 'Region' });
        dataTable.addColumn({ type: 'date', id: 'Start' });
        dataTable.addColumn({ type: 'date', id: 'End' });
        dataTable.addRows([
            <?php
                foreach ($data as $key=>$value){
                    print_r($value);
                }
            ?>
        ]);

        chart.draw(dataTable);
    }
</script>
<div class="site-index">
    <div id="timeline" style="height: 180px;"></div>
</div>
