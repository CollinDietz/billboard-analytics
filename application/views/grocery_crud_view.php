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
        <?php include_once("nav_bar.php") ?>
        <div style='height:20px;'></div>
        <div>
          <?php echo $output; ?>
        </div>
        <!-- Beginning footer -->
        <div>Footer</div>
        <!-- End of Footer -->
</body>

</html>
