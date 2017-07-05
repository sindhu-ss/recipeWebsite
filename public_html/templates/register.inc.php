<?php
//  object from Movie controller. Holds our data. Now is being used to display errors.
$errors = $user->errors; 

?>
<div class="container-fluid reg-page">
<div class="container reg-form">
  <h1 class="heading-script">Sign up</h1>

  <form id="registerNewUser" action="?page=auth.store" method="POST">

  <!-- User Name -->
    <div class="row">
      <div class="form-group <?php if($errors['username']): ?> has-error <?php endif; ?>">
        <label for="username" class="control-label">User Name</label>
        <input class="form-control" id="username" name="username" value="<?php echo $user->username; ?>">
        <span id="username-message"></span>
      </div>
    </div>

  <!-- Email -->
    <div class="row">
      <div class="form-group <?php if($errors['email']): ?> has-error <?php endif; ?>">
        <label for="email" class="control-label">Email Address</label>
        <input class="form-control" id="email" name="email" placeholder="example@example.com" value="<?php echo $user->email; ?>">
        <div class="help-block"><?php echo $errors['email']; ?></div>
        <span id="email-message"></span>
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

  <!-- Password match -->

    <div class="row">
      <div class="form-group <?php if($errors['password2']): ?> has-error <?php endif; ?>">
        <label for="password2" class="control-label">Confirm Password</label>
          <input type="password" class="form-control" id="password2" name="password2">
          <div class="help-block"><?php echo $errors['password2']; ?></div>
      </div>
    </div>

      <div class="form-group">
          <button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Sign up</button>
      </div>
  </form>
</div>
</div>









