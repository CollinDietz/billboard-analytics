<?php if($message):?>
<p style="color:red"><?php echo $message; ?></p>
<?php endif;?>
<form action="#" method="post" class="white">
  <div class="form-group">
    <label>Username</label>
    <input type="username" class="form-control" name="InputUsername" placeholder="Enter username">
    <small id="emailHelp" class="form-text white">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="InputPassword" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-outline-light btn-select"><?php echo $button_text?></button>
</form>
