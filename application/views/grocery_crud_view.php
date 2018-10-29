<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <?php
foreach($css_files as $file): ?>
  <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />

  <?php endforeach; ?>
  <?php foreach($js_files as $file): ?>

  <script src="<?php echo $file; ?>"></script>
  <?php endforeach; ?>

  <style type='text/css'>
    body {
      font-family: Arial;
      font-size: 14px;
    }

    a {
      color: blue;
      text-decoration: none;
      font-size: 14px;
    }

    a:hover {
      text-decoration: underline;
    }

    .btn-group-wrap {
      text-align: center;
      vertical-align: bottom;
    }
  </style>
</head>

<body>
  <!-- Beginning header -->
  <div class="btn-group-wrap">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a class="btn btn-primary" href='<?php echo base_url('admin/artists')?>' role="button">Artists</a>
        <a class="btn btn-primary" href='<?php echo base_url('admin/albums')?>' role="button">Albums</a>
        <a class="btn btn-primary" href='<?php echo base_url('admin/songs')?>' role="button">Songs</a>
        <a class="btn btn-primary" href='<?php echo base_url('admin/charts')?>' role="button">Charts</a>
        <a class="btn btn-primary" href='<?php echo base_url('admin/charted')?>' role="button">Charting</a>
    </div>
  </div>
   <!-- End of header-->
        <div style='height:20px;'></div>
        <div>
          <?php echo $output; ?>
        </div>
        <!-- Beginning footer -->
        <div>Footer</div>
        <!-- End of Footer -->
</body>

</html>
