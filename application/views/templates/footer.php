<footer>
  <hr width="75%" size="8" align="center">
  <br><br><br>
  <div class="row justify-content-center">
  <div class="col-4">
    <button class="btn btn-sm btn-outline-light btn-remove" type="button" data-toggle="collapse" data-target="#collapseExample">
      Report Error
    </button>
  </div>
  </div>

  <br>
  <div class="collapse" id="collapseExample">
    <div class="row justify-content-center">
      <div class="col-4">
        <form action=<?php echo site_url("report") ?> method="post">
          <div class="form-group">
            <label class="green" for="exampleFormControlTextarea1">Describe the issue</label>
            <textarea class="form-control centered" name="info" rows="3"></textarea>
          </div>
          <input type="hidden" name="url" value="<?php echo current_url_full()?>">
          <button type="submit" class="btn btn-sm btn-outline-light btn-select">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <br><br>
</footer>
