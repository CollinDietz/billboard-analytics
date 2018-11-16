<body class="body">
  <h2 class="text-center green">
    <?php echo $chart_name_norm." For ".date("D M d, Y", strtotime($date)); ?>
  </h2>

  <nav class="navbar">
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
              autoclose: true
            });
          </script>

        <button type="submit" class="btn btn-outline-light ml-sm-2">See Chart</button>
      </div>
    </form>


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
            if($entry_type == $ALBUM_IDENT)
            {
              echo $row['album_name'];
            }
            else
            {
              echo $row['song_name'];
            }
          ?>
        </td>
        <td>
          <?php
          $name = str_replace(" ", "_", $row["artist_name"]);
          $artist_link = site_url("/scorecard/artist/$name");?>
          <a href= <?php echo "$artist_link>".$row["artist_name"]?> </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>

  <body>
