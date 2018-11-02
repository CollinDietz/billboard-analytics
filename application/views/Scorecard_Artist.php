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

  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Chart',''],
          <?php foreach($data as $dp): ?>
          [<?php echo "'".ucwords($dp[0])."',"; echo $dp[1].",";?>],
          <?php endforeach; ?>
        ]);

        var options = {
          chart: {
            title: 'Entries Per Chart',
            textStyle:{color: '#FFFFFF'}
          },
          backgroundColor : "black",
          vAxis: {
              gridlines: {
                  color: 'transparent'
              },
              textStyle:{color: '#FFFFFF'}
          },
          hAxis: {
              textStyle:{color: '#FFFFFF'}
          },
          colors: ['#828282'],
          legend: {position: 'none'},
          titleTextStyle: {
            color: '#FFFFFF'
        }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
  </script>

</body>
