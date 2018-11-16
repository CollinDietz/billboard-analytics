<?php $this->load->helper('html'); ?>
<?php
if(!isset($_SESSION['pageHistory']))
{
  $_SESSION['pageHistory'] = array(current_url(), site_url(), site_url());
}
else
{
  $_SESSION['pageHistory'][2] = $_SESSION['pageHistory'][1];
  $_SESSION['pageHistory'][1] = $_SESSION['pageHistory'][0];
  $_SESSION['pageHistory'][0] = current_url();
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <?php echo link_tag('assets/css/main.css');?>



  <h1 class="display-4">
    <?php echo "Billboard Analytics" ?>
  </h1>
  <nav class="navbar">
    <ul class="nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url()?>">Home</a>
      </li>
      <li class="nav-item">
        <?php if(isset($_SESSION["user"])): ?>
          <a class="nav-link" href="<?php echo site_url('user/favorites')?>">Your Favorites</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('user/logout')?>">Logout</a>
        <?php else: ?>
          <a class="nav-link" href="<?php echo site_url('login')?>">Login</a>
        <?php endif; ?>
      </li>
    </ul>
    <form class="form-inline" action="<?php echo site_url('search')?>">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q">
      <button class="btn btn-outline-light" type="submit">Search</button>
    </form>
  </nav>
</head>
