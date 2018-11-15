<?php
$this->load->helper('html');
?>
<!DOCTYPE html>

<?php
  header('Refresh:5; url= '. site_url("/login"));
?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <?php echo link_tag('assets/css/main.css'); ?>
</head>

<body class="body">
  <h1 class="text-center text-capitalize green">
    Billboard Analytics
  </h1>

  <h2 class="text-center text-capitalize green">Registration Success</h2>
  <h3 class="text-center green">Loading....</h3>
</body
