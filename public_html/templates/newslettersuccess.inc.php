<?php

if($_GET['page'] == 'request') {
  // if recipe request
  $successContent = "Thank-you for requesting a recipe! The recipe will be published soon!";
} else {
  // if newsletter sign up
  $successContent = "Thank-you for signing up to our newsletter. Every month you will receive updates & new recipes!";
}
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Thank-you <?= $_POST['name'] ?>!</h1>
			<p><?= $successContent ?></p>
			<br>
		</div>
	</div>
</div>