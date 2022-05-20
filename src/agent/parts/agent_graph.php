<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@next/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<div style="width:400px;">
    <canvas id="applies_chart"></canvas>
</div>
<?php
$calender_array = [];
for ($month = 1; $month <= 12; $month++) {
    $month = $adjust->double($month);
    $calender_stmt = $db->prepare("select count(apply_id) from apply_list where agent_id=? and apply_time between ? and ?;");
    $calender_stmt->bindValue(1, $_SESSION['agent_id']);
    $calender_stmt->bindValue(2, $_GET['year'] . '-' . $month . '-01 00:00:00');
    $calender_stmt->bindValue(3, $_GET['year'] . '-' . $month . '-' . date('t', strtotime($_GET['year'] . '-' . $month)) . ' 23:59:59');
    $calender_stmt->execute();
    array_push($calender_array, $calender_stmt->fetchAll()[0]['count(apply_id)']);
}
?>
<script>
    var ctx = document.getElementById('applies_chart');
    var applies_chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月',],
            datasets: [{
                label: '申込数',
                data: [
                    <?php echo $calender_array[0];?>,
                    <?php echo $calender_array[1];?>,
                    <?php echo $calender_array[2];?>, 
                    <?php echo $calender_array[3];?>, 
                    <?php echo $calender_array[4];?>, 
                    <?php echo $calender_array[5];?>, 
                    <?php echo $calender_array[6];?>,
                    <?php echo $calender_array[7];?>,
                    <?php echo $calender_array[8];?>,
                    <?php echo $calender_array[9];?>,
                    <?php echo $calender_array[10];?>,
                    <?php echo $calender_array[11];?>,
                ], //カレンダーに表示されている年の月毎のデータをデータベースからとってくる
                borderColor: '#f88',
            }, ],
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: <?php if (isset($_GET['year'])) {echo $_GET['year'];} else {echo date('Y');};?>+'年の月毎の申込数の推移',
                    color: 'black',
                    padding: {
                        top: 5,
                        bottom: 5
                    },
                    font: {
                        family: '"Arial", "Times New Roman"',
                        size: 12,
                    },
                }
            },
            y: {
                min: 0,
                max: 100,
            },
        },
    });
</script>