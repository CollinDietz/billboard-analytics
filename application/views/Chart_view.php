<?php
$this->load->helper('html');
$ALBUM_IDENT = "Album Name";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.js" integrity="sha256-fNXJFIlca05BIO2Y5zh1xrShK3ME+/lYZ0j+ChxX2DA=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
  <?php echo link_tag('assets/css/main.css'); ?>
  <a class="btn btn-sm btn-success" href='<?php echo site_url('login')?>' role="button">Login</a>
</head>

<body class="body">
  <h1 class="text-center text-capitalize green">
    <?php echo $chart_name." For ".date("D M d, Y", strtotime($date)); ?>
  </h1>

    <form action=<?php echo site_url("chart/chart_pick")?> method="post">
      <div class="form-inline justify-content-center">
        <select class="form-control text-capitalize" name="chart">
          <?php foreach ($charts_list as $chart_list_item){

            if ($chart_list_item["chart_name"] == $chart_name)
            {
              echo "<option selected>", $chart_list_item["chart_name"], "</option>";
            }
            else
            {
              echo "<option>", $chart_list_item["chart_name"], "</option>";
            }
          } ?>
        </select>
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

        <button type="submit" class="btn btn-success">See Chart</button>
      </div>
    </form>


  <?php if (count($chart) > 0): ?>
  <table class="table table-dark skinny_table centered">
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
