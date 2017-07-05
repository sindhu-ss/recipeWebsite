<?php
$errors = $user->errors; 

?>
<div class="container-fluid reg-page">
<div class="container reg-form">
  <h1 class="heading-script">Login</h1>
  <?php if($error): ?>
    <div class="alert alert-danger" role="alert">Incorrect email or password. Please try again.</div>
  <?php endif; ?>

  <form id="registerNewUser" action="?page=auth.attempt" method="POST">

  <!-- Email -->
    <div class="row">
      <div class="form-group <?php if($errors['email']): ?> has-error <?php endif; ?>">
        <label for="email" class="control-label">Email</label>
        <input class="form-control" id="email" name="email" placeholder="example@example.com" value="<?php echo $user->email; ?>">
        <div class="help-block"><?php echo $errors['email']; ?></div>
      </div>
    </div>

  <!-- Password -->
    <div class="row">
      <div class="form-group <?php if($errors['password']): ?> has-error <?php endif; ?>">
        <label for="password" class="control-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        <div class="help-block"><?php echo $errors['password']; ?></div>
      </div>
    </div>



      <div class="form-group">
          <button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Login</button>
      </div>
  </form>
</div>
</div>









