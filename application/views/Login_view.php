<?php
$this->load->helper('html');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <?php echo link_tag('assets/css/main.css'); ?>
</head>

<body class="body">
  
<?php require_once("loginForm.php"); ?>

<p class="green"> Not a user yet? Register here </p>
<a class="btn btn-success" href='<?php echo site_url('login/register')?>' role="button">Register</a>
