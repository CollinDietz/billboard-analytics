<body>
  <div class="container skinny">
    <h2 class="green"> Your Favorites </h2>
  </div>
  <hr width="75%" size="8" align="center">
  <?php if(count($fav_artists) == 0): ?>
    <div class="green text-center">You haven't picked any favorites yet!</div>
  <?php else: ?>
    <?php foreach ($fav_artists as $row):
      $name = str_replace(" ", "_", $row["artist_name"]);
      $link = site_url("/scorecard/artist/$name")?>
      <div class="container skinny">
      <div class="row">
        <div class="col-3">
            <a href= <?php echo "$link"?>> <?php echo $row["artist_name"]?> </a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  <?php endif; ?>
</body>
