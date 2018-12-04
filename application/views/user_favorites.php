<body>
  <div class="container skinny">
    <h3 class="green"> Your Favorites </h3>
  </div>
  <div class="offset_text green">
      <h4>Artists</h4>
  </div>
  <hr width="75%" size="8" align="center">
  <?php if(count($fav_artists['artists']) == 0): ?>
    <div class="grey text-center">You haven't picked any favorites artists yet!</div>
  <?php else: ?>
    <?php foreach ($fav_artists['artists'] as $row): ?>
      <div class="container skinny">
      <div class="row">
        <div class="col-3">
          <?php LinkToScoreCard($row["artist_name"], "artist")?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  <?php endif; ?>
  <br>

  <div class="offset_text green">
      <h4>Albums</h4>
  </div>
  <hr width="75%" size="8" align="center">
  <?php if(count($fav_artists['albums']) == 0): ?>
    <div class="grey text-center">You haven't picked any favorites albums yet!</div>
  <?php else: ?>
    <?php foreach ($fav_artists['albums'] as $row):?>
      <div class="container skinny">
      <div class="row">
        <div class="col-2">
          <?php LinkToScoreCard($row["album_name"], "album", $row["artist_name"])?>
        </div>
        <div class="col-sm-auto">
          <span class="grey">by<span>
        </div>
        <div class="col-sm">
          <?php LinkToScoreCard($row['artist_name'], "artist")?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  <?php endif; ?>
  <br>


  <div class="offset_text green">
      <h4>Songs</h4>
  </div>
  <hr width="75%" size="8" align="center">
  <?php if(count($fav_artists['songs']) == 0): ?>
    <div class="grey text-center">You haven't picked any favorites songs yet!</div>
  <?php else: ?>
    <?php foreach ($fav_artists['songs'] as $row):?>
      <div class="container skinny">
      <div class="row">
        <div class="col-2">
          <?php LinkToScoreCard($row["song_name"], "song", $row["artist_name"])?>
        </div>
        <div class="col-sm-auto">
          <span class="grey">by<span>
        </div>
        <div class="col-sm">
          <?php LinkToScoreCard($row['artist_name'], "artist")?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  <?php endif; ?>
  <br>

</body>
