<body class="body">
  <h3 class="text-center green">
    <?php echo $name ?>
  </h3>
  <div class="text-center">
    <span class="grey text-center">by<span>
      <?php LinkToScoreCard($artist_name, "artist")?>
  </div>
  <?php if(isset($_SESSION["user"])): ?>
  <form class="form-inline justify-content-center" action="" method="post">
    <?php if($IsFavorite): ?>
    <button class="btn btn-sm btn-outline-light btn-remove" name="action" value="unfavorite">Unfavorite</button>
    <?php else: ?>
    <button class="btn btn-sm btn-outline-light btn-select" name="action" value="favorite">Favorite</button>
    <?php endif; ?>
  </form>
  <?php endif; ?>

  <div class="skinny mx-auto">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" id="charts-tab" data-toggle="tab" href="#charts" role="tab" aria-controls="charts" aria-selected="false">Charts</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="albums-tab" data-toggle="tab" href="#albums" role="tab" aria-controls="albums" aria-selected="false">Albums</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="songs-tab" data-toggle="tab" href="#songs" role="tab" aria-controls="albums" aria-selected="false">Songs</a>
    </li> -->
  </ul>
  </div>
  <br>

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="home-tab">
      <div class="grey">
        <div class="google_chart" id="linechart_material"></div>
      </div>

      <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
            google.charts.setOnLoadCallback(drawChart);

          function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Day');
            <?php foreach($lineData['charts'] as $key => $value): ?>
            data.addColumn('number', '<?php echo $value['chart_name'] ?>');
            <?php endforeach; ?>

            data.addRows([
              <?php foreach($lineData['data'] as $date => $posistions): ?>
                  [
                    new Date(<?php echo date('Y', strtotime($date))?>, <?php echo intval(date('m', strtotime($date)))-1?>, <?php echo date('d', strtotime($date))?>),
                    <?php foreach ($posistions as $chart => $posistion): ?><?php echo $posistion ?>,<?php endforeach; ?>
                  ],
              <?php endforeach; ?>

            ]);

            var options = {
              chart: {
                title: 'Life Time Performance',
                textStyle: {
                  color: '#FFFFFF'
                }
              },
              backgroundColor: "black",
              vAxis: {
                format:';###',
                gridlines: {
                  color: 'transparent'
                },
                textStyle: {
                  color: '#FFFFFF'
                }
              },
              hAxis: {
                textStyle: {
                  color: '#FFFFFF'
                }
              },
              colors: ['#828282','#1DB954'],
              titleTextStyle: {
                color: '#FFFFFF'
              },
            };

            var chart = new google.charts.Line(document.getElementById('linechart_material'));

            chart.draw(data, google.charts.Line.convertOptions(options));
          }
      </script>
    </div>
  </div>
</body>
