<?php $this->load->helper('html'); ?>
<?php
if(!isset($_SESSION['pageHistory']))
{
  $_SESSION['pageHistory'] = array(current_url_full(), site_url(), site_url());
}
else if($_SESSION['pageHistory'][0] != current_url_full())
{
  $_SESSION['pageHistory'][2] = $_SESSION['pageHistory'][1];
  $_SESSION['pageHistory'][1] = $_SESSION['pageHistory'][0];
  $_SESSION['pageHistory'][0] = current_url_full();
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
  <?php echo link_tag('assets/css/main.css');?>

  <nav class="navbar navbar-expand-md fixed-top bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url()?>">Home</a>
          </li>
            <?php if(isset($_SESSION["user"])): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('user/favorites')?>">Your Favorites</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('user/logout')?>">Logout</a>
            </li>
            <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('login')?>">Login</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="mx-auto order-0">
      <span class="navbar-brand green">Billboard Analytics</span>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <form class="form-inline" action="<?php echo site_url('search')?>">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q">
                <button class="btn btn-outline-light btn-select" type="submit">Search</button>
              </form>
            </li>
        </ul>
    </div>
</nav>
</head>
