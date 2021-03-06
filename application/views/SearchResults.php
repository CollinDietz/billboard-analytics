<body class="body">
  <h3 class="text-center green">
    <?php echo "Results for ".$query ?>
  </h3>

  <?php function show_results($results_array, $header, $endpoint, $itemkey, $include_artist, $max_size){?>
    <?php if(count($results_array) > 0): ?>
    <hr width="75%" size="8" align="center">
    <div class="row offset_text">
        <h3><?php echo $header ?></h3>
    </div>

    <?php foreach ($results_array as $row): ?>
      <div class="container skinny">
      <div class="row">
        <div class="col-3">
          <?php if($include_artist == True):?>
            <?php LinkToScoreCard($row[$itemkey], $endpoint, $row['artist_name'])?>
          <?php else: ?>
            <?php LinkToScoreCard($row[$itemkey], $endpoint)?>
          <?php endif;?>
        </div>
          <?php if($include_artist == True):?>
        <div class="col-md-auto">
          <span class="grey">by<span>
        </div>
        <div class="col-sm">
          <?php LinkToScoreCard($row['artist_name'], "artist")?>
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
