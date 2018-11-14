<?php $this->load->helper('html'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <?php echo link_tag('assets/css/main.css');?>

</head>

<body class="body">
  <h1 class="text-center green">
    <?php echo $artist_name ?>
  </h1>
  <?php include_once("main_nav_bar.php") ?>

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


  <br>
  <h1>All Time Stats</h1>
  <table class="table table-dark skinny_table centered">
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

  <br>
  <h1>Per Chart Stats</h1>
  <table class="table table-dark skinny_table centered">
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
          <?php echo $row["FirstApperance"] ?>
        </td>
        <td>
          <?php echo $row["MostRecentApperance"] ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <br>
  <h1>Per Album Stats</h1>
  <table class="table table-dark skinny_table centered">
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
      <?php echo $row["album_name"];?>
      <?php endif;?>
    </td>
      <td> <?php echo ucwords(str_replace("-", " ",  $row["chart_name"])) ?> </td>
      <td> <?php echo $row["FirstAppearance"]?> </td>
      <td> <?php echo $row["MostRecentApperance"]?> </td>
      <td> <?php echo $row["WeeksOnChart"] ?> </td>
      <td> <?php echo $row["MinRank"] ?> </td>
      <td> <?php echo $row["MaxRank"] ?> </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
  </table>

  <br>
  <h1>Per Song Stats</h1>
  <table class="table table-dark skinny_table centered">
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
      foreach ($SongApperancesStats as $row):?>
      <tr>
      <td>
        <?php if($currSong != $row["song_name"]): ?>
        <?php  $currSong = $row["song_name"]; ?>
        <?php echo $row["song_name"];?>
        <?php endif;?>
      </td>
        <td> <?php echo ucwords(str_replace("-", " ",  $row["chart_name"])) ?> </td>
        <td> <?php echo $row["FirstAppearance"]?> </td>
        <td> <?php echo $row["MostRecentApperance"]?> </td>
        <td> <?php echo $row["WeeksOnChart"] ?> </td>
        <td> <?php echo $row["MinRank"] ?> </td>
        <td> <?php echo $row["MaxRank"] ?> </td>
      </tr>
      <?php endforeach; ?>
  </tbody>
  </table>

</body>
