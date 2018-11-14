<h1>
  <?php echo "Billboard Analytics" ?>
</h1>
<nav class="navbar">
  <ul class="nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url()?>">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url('login')?>">Login</a>
    </li>
  </ul>
  <form class="form-inline" action="<?php echo site_url('search')?>">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q">
    <button class="btn btn-outline-light" type="submit">Search</button>
  </form>
</nav>
