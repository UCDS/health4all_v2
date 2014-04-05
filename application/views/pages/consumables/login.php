	<div class="col-xs-6 col-md-offset-3">
      <?php echo form_open('home/login',array('class'=>'form-signin','role'=>'form')); ?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="form-control" placeholder="Username" name="username" required autofocus><br />
        <input type="password" class="form-control" placeholder="Password" name="password" required><br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
	  </div>