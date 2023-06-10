<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <h1 class="page-header">
        <?php echo $title[0]; ?>
    </h1>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-gradient-green mat-shadow">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">JUMLAH MEMBER</div>
                    <div class="stats-number mb-1"><?php echo number_format($all_visitors);?></div>
                    <div class="stats-progress progress">
                        <div class="progress-bar full-width"></div>
                    </div>
                    <div class="stats-desc">Member baru bulan ini : <?php echo $visitor_this_month; ?> member</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-gradient-blue mat-shadow">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-chalkboard-teacher"></i></div>
                <div class="stats-content">
                    <div class="stats-title">ANTRIAN ANDA</div>
                    <div class="stats-number mb-1">28</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar full-width"></div>
                    </div>
                    <div class="stats-desc">Level aktif : 2</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-gradient-purple mat-shadow">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-graduation-cap fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">SALDO ANDA</div>
                    <div class="stats-number mb-1">2,800,000</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar full-width"></div>
                    </div>
                    <div class="stats-desc">Bulan ini Rp 1,000,000</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="widget widget-stats bg-gradient-black mat-shadow">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-copy fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">WITHDRAWAL</div>
                    <div class="stats-number mb-1">2,000,000</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar full-width"></div>
                    </div>
                    <div class="stats-desc">Withdraw terakhir 20 Agustus 2020</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="widget-chart without-sidebar bg-black mat-shadow">
                <div class="widget-chart-content m-r-0">
                    <h4 class="chart-title" style="float:left">
                        Visitors Analytics
                        <small>Graph Total Visitors This Month</small>
                    </h4>
                    <h4 class="chart-title text-right">
                        <?php echo number_format($all_visitors);?>
                        <small>Total Visitors All Time</small>
                    </h4>
                    <div>
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-inverse mat-shadow" data-sortable-id="index-1">
                <div class="panel-heading p-t-10" style="height:63px;">
                    <h4 class="panel-title" style="font-size:24px;padding-top:10px;">
                        Browser Stats
                    </h4>
                </div>
                <div class="list-group">
                    <a href="javascript:;" class="list-group-item list-group-item-inverse d-flex justify-content-between align-items-center text-ellipsis">
                        1. Google Chrome
                        <span class="badge f-w-500 bg-gradient-green f-s-10"><?php echo number_format($chrome_visitor,2);?>%</span>
                    </a> 
                    <a href="javascript:;" class="list-group-item list-group-item-inverse d-flex justify-content-between align-items-center text-ellipsis">
                        2. Mozilla Firefox
                        <span class="badge f-w-500 bg-gradient-orange f-s-10"><?php echo number_format($firefox_visitor,2);?>%</span>
                    </a>
                    <a href="javascript:;" class="list-group-item list-group-item-inverse d-flex justify-content-between align-items-center text-ellipsis">
                        3. Internet Explorer
                        <span class="badge f-w-500 bg-gradient-blue f-s-10"><?php echo number_format($explorer_visitor,2);?>%</span>
                    </a>
                    <a href="javascript:;" class="list-group-item list-group-item-inverse d-flex justify-content-between align-items-center text-ellipsis">
                        4. Safari
                        <span class="badge f-w-500 bg-gradient-purple f-s-10"><?php echo number_format($safari_visitor,2);?>%</span>
                    </a>
                    <a href="javascript:;" class="list-group-item list-group-item-inverse d-flex justify-content-between align-items-center text-ellipsis">
                        5. Opera
                        <span class="badge f-w-500 bg-gradient-red f-s-10"><?php echo number_format($opera_visitor,2);?>%</span>
                    </a>
                    <a href="javascript:;" class="list-group-item list-group-item-inverse d-flex justify-content-between align-items-center text-ellipsis">
                        6. Robot
                        <span class="badge f-w-500 f-s-10"><?php echo number_format($robot_visitor,2);?>%</span>
                    </a>
                    <a href="javascript:;" class="list-group-item list-group-item-inverse d-flex justify-content-between align-items-center text-ellipsis">
                        7. Others
                        <span class="badge f-w-500 bg-gradient-grey f-s-10"><?php echo number_format($other_visitor,2);?>%</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script>
    $(document).ready(function() {
        var myLine = document.getElementById("canvas").getContext("2d");
        var lineChartData = {
            labels : <?php echo $tnggl; ?>,
            datasets : [
                {
                    fillColor: "rgba(34,186,160,0.2)",
                    strokeColor: "rgba(34,186,160,1)",
                    pointColor: "rgba(34,186,160,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(18,175,203,1)",
                    data : <?php echo $value; ?>
                }
            ]
        }

        var canvas = new Chart(myLine).Line(lineChartData, {
            scaleShowGridLines : true,
            scaleGridLineColor : "rgba(0,0,0,.05)",
            scaleGridLineWidth : 0,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            bezierCurve : true,
            bezierCurveTension : 0.4,
            pointDot : true,
            pointDotRadius : 4,
            pointDotStrokeWidth : 1,
            pointHitDetectionRadius : 2,
            datasetStroke : true,
            tooltipCornerRadius: 2,
            datasetStrokeWidth : 2,
            datasetFill : true,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            maintainAspectRatio: true,
            responsive: true
        });
    });
</script>