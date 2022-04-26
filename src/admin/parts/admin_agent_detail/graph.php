<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@next/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<section style="width:400px;">
    <canvas id="applies_chart"></canvas>
</section>
<script>
    var ctx = document.getElementById('applies_chart');
    var applies_chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月',],
            datasets: [{
                label: '申込数',
                data: [20, 35, 40, 30, 45, 35, 40,40,40,40,40,40,], //カレンダーに表示されている年の月毎のデータをデータベースからとってくる
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