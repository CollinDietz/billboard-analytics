<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style type='text/css'>
.title {
  text-align: center;
  font-size: 300%
}
</style>
</head>

<body>
  <div class="title">
    Billboard Rap Analytics
  </div>


<?php
if($status == False)
{
  echo "<p style=\"color:red;\"> Failed </p>";
}
?>
<form action=<?php echo site_url("login/login_user")?> method="post">
    <div class="form-group">
      <label>Username</label>
      <input type="username" class="form-control" name="InputUsername" placeholder="Enter username">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" class="form-control" name="InputPassword" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</body>

<p> Not a user yet? Register here </p>
<a class="btn btn-primary" href='<?php echo site_url('login/register')?>' role="button">Register</a>
