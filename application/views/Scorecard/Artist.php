<?php $this->load->helper('html'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>

  <?php echo link_tag('assets/css/main.css');?>

  <style>
  .ct-label {
    color: white;
}

.ct-grid{
  stroke: white;
}

.ct-series-a .ct-bar {
  stroke: #1DB954;
  stroke-width: 60px;
}


  </style>
</head>

<body class="body">
  <h1 class="text-center green">
    <?php echo $artist_name ?>
  </h1>
  <div class="d-flex justify-content-center">
  <div class="ct-chart ">
  </div>
</div>
  <script>
  var data = {
  labels: [ "<?php echo ucwords(implode("\", \"", array_map("ucwords", $charts))); ?>"],
  series: [[<?php echo implode(",", $counts); ?>]]
};

var options = {
  width: 600,
  height: 400,
};

new Chartist.Bar('.ct-chart', data, options);
  </script>

</body>
