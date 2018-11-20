<body class="body">
  <h3 class="text-center green">
    <?php echo $artist_name ?>
  </h3>
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
    <li class="nav-item">
      <a class="nav-link" id="charts-tab" data-toggle="tab" href="#charts" role="tab" aria-controls="charts" aria-selected="false">Charts</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="albums-tab" data-toggle="tab" href="#albums" role="tab" aria-controls="albums" aria-selected="false">Albums</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="songs-tab" data-toggle="tab" href="#songs" role="tab" aria-controls="albums" aria-selected="false">Songs</a>
    </li>
  </ul>
  </div>
  <br>

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="home-tab">
      <div class="grey">
        <div class="google_chart" id="columnchart_material"></div>
      </div>

      <script type="text/javascript">
        google.charts.load('current', {
          'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Chart', ''],
            <?php foreach($data as $dp): ?> [<?php echo "'".ucwords($dp[0])."',"; echo $dp[1].",";?>],
            <?php endforeach; ?>
          ]);

          var options = {
            chart: {
              title: 'Entries Per Chart',
              textStyle: {
                color: '#FFFFFF'
              }
            },
            backgroundColor: "black",
            vAxis: {
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
            colors: ['#828282'],
            legend: {
              position: 'none'
            },
            titleTextStyle: {
              color: '#FFFFFF'
            }
          };

          var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

          chart.draw(data, google.charts.Bar.convertOptions(options));
        }
      </script>

      <h3>All Time Stats</h3>
      <table class="table table-dark skinny centered">
        <thead>
          <tr>
            <th># Chart Entries</th>
            <th># Weeks on the Charts</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <?php echo $AllTimeChartsStats['NumberOfEntries']?>
            </td>
            <td>
              <?php echo $AllTimeChartsStats['NumberOfWeeks']?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="charts" role="tabpanel" aria-labelledby="charts-tab">
      <h3>Per Chart Stats</h3>
      <table class="table table-dark skinny centered">
        <thead>
          <tr>
            <th>Chart</th>
            <th>First Apperance</th>
            <th>Most Recent Apperance</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($ChartApperancesStats as $row):?>
          <tr>
            <td>
              <?php echo ucwords(str_replace("-", " ",  $row["chart_name"])) ?>
            </td>
            <td>
              <?php LinkToChartByDate($row["chart_name"], $row["FirstApperance"])?>
            </td>
            <td>
              <?php LinkToChartByDate($row["chart_name"], $row["MostRecentApperance"])?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="albums" role="tabpanel" aria-labelledby="albums-tab">
      <?php if(count($AlbumApperancesStats) > 0):?>
      <h3>Per Album Stats</h3>
      <table class="table table-dark skinny centered">
        <thead>
          <tr>
            <th>Album Name</th>
            <th>Chart</th>
            <th>First Apperance</th>
            <th>Most Recent</th>
            <th>Total Weeks</th>
            <th>Lowest Rank</th>
            <th>Peak Rank</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $currSong = "";
          foreach ($AlbumApperancesStats as $row):?>
          <tr>
            <td>
              <?php if($currSong != $row["album_name"]): ?>
              <?php  $currSong = $row["album_name"]; ?>
              <?php LinkToScoreCard($row["album_name"], "album", $artist_name)?>
              <?php endif;?>
            </td>
            <td>
              <?php echo ucwords(str_replace("-", " ",  $row["chart_name"])) ?>
            </td>
            <td>
              <?php LinkToChartByDate($row["chart_name"], $row["FirstAppearance"])?>
            </td>
            <td>
              <?php LinkToChartByDate($row["chart_name"], $row["MostRecentApperance"])?>
            </td>
            <td>
              <?php echo $row["WeeksOnChart"] ?>
            </td>
            <td>
              <?php echo $row["LowestRank"] ?>
            </td>
            <td>
              <?php echo $row["BestRank"] ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif;?>
    </div>
    <div class="tab-pane fade" id="songs" role="tabpanel" aria-labelledby="songs-tab">
      <?php if(count($SongApperancesStats) > 0):?>
      <h3>Per Song Stats</h3>
      <table class="table table-dark skinny centered">
        <thead>
          <tr>
            <th>Song Name</th>
            <th>Chart</th>
            <th>First Apperance</th>
            <th>Most Recent</th>
            <th>Total Weeks</th>
            <th>Lowest Rank</th>
            <th>Peak Rank</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $currSong = "";
            foreach ($SongApperancesStats as $row):?>
          <tr>
            <td>
              <?php if($currSong != $row["song_name"]): ?>
              <?php  $currSong = $row["song_name"]; ?>
              <?php LinkToScoreCard($row["song_name"], "song", $artist_name)?>
              <?php endif;?>
            </td>
            <td>
              <?php echo ucwords(str_replace("-", " ",  $row["chart_name"])) ?>
            </td>
            <td>
              <?php LinkToChartByDate($row["chart_name"], $row["FirstAppearance"])?>
            </td>
            <td>
              <?php LinkToChartByDate($row["chart_name"], $row["MostRecentApperance"])?>
            </td>
            <td>
              <?php echo $row["WeeksOnChart"] ?>
            </td>
            <td>
              <?php echo $row["LowestRank"] ?>
            </td>
            <td>
              <?php echo $row["BestRank"] ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif;?>
    </div>
  </div>

</body>
