<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.js" integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

<body class="body">
  <br>
  <h3 class="text-center green">
    <?php echo $chart_name_norm." For ".date("D M d, Y", strtotime($date)); ?>
  </h3>

  <nav class="nav">
    <ul class="nav mx-auto">
      <?php foreach ($charts_list as $row): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url()."/chart/view/".str_replace(" ", "-", strtolower($row["chart_name"]))."/".$date?>"><?php echo $row["chart_name"] ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </nav>

    <form action=<?php echo site_url("chart/chart_pick")?> method="post">
      <div class="form-inline justify-content-center">
        </select>
          <input type="hidden" name="chart" value="<?php echo $chart_name?>">
          <div id="sandbox-container">
          <div class="input-group date">
            <input type="text" class="form-control" name="date" value=<?php echo date("m/d/Y", strtotime($date)) ?>><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
          </div>
        </div>
          <script>
            $('#sandbox-container .input-group.date').datepicker({
              endDate: "+7d",
              daysOfWeekDisabled: "0,1,2,3,4,5",
              daysOfWeekHighlighted: "6",
              todayHighlight: true,
              autoclose: true,
              orientation: "bottom auto"
            });
          </script>

        <button type="submit" class="btn btn-outline-light btn-select ml-sm-2">See Chart</button>
      </div>
    </form>


  <div class="container">
    <div class="row justify-content-center">
      <?php if(isset($prev_week)): ?>
        <div class="col-5 text-center">
          <a href="<?php echo site_url("chart/view/$chart_name/$prev_week")?>">Prev Week</a>
        </div>
      <?php endif; ?>
      <span></span>
      <?php if(isset($next_week)): ?>
        <div class="col-5 text-center">
          <a href="<?php echo site_url("chart/view/$chart_name/$next_week")?>">Next Week</a>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <?php if (count($chart) > 0): ?>
  <table class="table table-dark skinny centered">
    <thead>
      <tr>
        <th>#</th>
        <th>
          <?php echo $entry_type ?>
        </th>
        <th>Artist</th>
      </tr>
    </thead>


    <tbody>
      <?php foreach ($chart as $row): array_map('htmlentities', $row); ?>
      <tr>
        <td>
          <?php echo $row["position"]?>
        </td>
        <td>
          <?php
            if($IsAlbums)
            {
              LinkToScoreCard($row['album_name'], "album", $row["artist_name"]);
            }
            else
            {
              LinkToScoreCard($row['song_name'], "song", $row["artist_name"]);
            }
          ?>
        </td>
        <td>
          <?php LinkToScoreCard($row["artist_name"], "artist")?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>

  <body>
