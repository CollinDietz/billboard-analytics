<h1 class="text-center text-capitalize green">
  Billboard Rap Analytics
</h1>

<?php if($message):?>
<p style="color:red"><?php echo $message; ?></p>
<?php endif;?>
<form action="#" method="post" class="green">
  <div class="form-group">
    <label>Username</label>
    <input type="username" class="form-control" name="InputUsername" placeholder="Enter username">
    <small id="emailHelp" class="form-text green">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="InputPassword" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
</form>
</body>