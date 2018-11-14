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
  <?php include_once("main_nav_bar.php") ?>
  <h2 class="text-center green">
    <?php echo "Results for ".$query ?>
  </h2>

  <?php function show_results($results_array, $header, $endpoint, $itemkey, $include_artist, $max_size){?>
    <?php if(count($results_array) > 0): ?>
    <hr width="75%" size="8" align="center">
    <div class="row offset_text">
        <h3><?php echo $header ?></h3>
    </div>

    <?php foreach ($results_array as $row): ?>
      <?php
      $name = str_replace(" ", "_", $row[$itemkey]);
      $link = site_url("/scorecard/$endpoint/$name");?>
      <div class="container skinny">
      <div class="row">
        <div class="col-3">
            <a href= <?php echo "$link"?>> <?php echo $row[$itemkey]?> </a>
        </div>
            <?php if($include_artist == True):
              $aname = $row['artist_name'];
              $link_aname = str_replace(" ", "_", $aname)
              ?>
        <div class="col-md-auto">
              <span class="grey">by<span>
        </div>
        <div class="col-sm">
              <a href= <?php echo site_url("/scorecard/artist/$link_aname") ?>> <?php echo $aname ?> </a>
        </div>
            <?php endif; ?>
      </div>
    </div>
    <?php endforeach; endif;?>
    <?php if(count($results_array) == $max_size): ?>
      <form class="form-inline">
        <?php foreach ($_GET as $key => $value): ?>
          <?php if($key != "num_$endpoint"): ?>
          <input type="hidden" name="<?php echo $key ?>"  value="<?php echo $value ?>">
        <?php endif; endforeach; ?>

        <button class="btn btn-sm btn-outline-light offset_text"
         onclick="document.myform.submit();"
         name=<?php echo "num_$endpoint"?>
         value="<?php echo count($results_array)+$max_size; ?>">Show more</button>
      </form>
    <?php endif; ?>
  <?php }?>

  <?php show_results($ArtistResults, "Artists", "artist", "artist_name", false, $num_artist);?>
  <?php show_results($AlbumsResults, "Albums", "album", "album_name", true, $num_album);?>
  <?php show_results($SongsResults, "Songs", "song", "song_name", true, $num_song);?>
  <?php show_results($ChartsResults, "Charts", "chart", "chart_name", false, $num_chart);?>

</body>
