<?php if(static::$auth->isAdmin()): ?>
<div class="row add-recipe">
	<p><a href="?page=recipe.create" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Add Recipe</a></p>
</div>
<?php endif; ?>

<div class="row recipes-main">
	<div class="col-md-7 col-sm-12 recipes-main-left">
		<!-- <h1>RECIPES</h1> -->
		<?php if(count($recmain) > 0): ?>
		<?php foreach ($recmain as $recipe): ?>
			<img <?php if ($recipe->poster):?> src="./images/poster/100h/<?= $recipe->poster ?>"<?php else: ?>src="http://placehold.it/500x500" <?php endif; ?> alt="<?= $recipe->title ?> Recipe" class="img-responsive center-block">	
			<!-- <img src="images/KITK-image-2.jpg" class="img-responsive center-block"> -->
	</div>

	<div class="col-md-5 col-sm-12 recipes-main-right clear-fix">
		<img src="http://placehold.it/50x50" class="img-responsive center-block" alt="Recipe Website logo">
		<h1 class="heading-script"><?= $recipe->title; ?></h1>
		<hr class="underline">
			<p><?= $recipe->ingredients; ?></p>

        <?php endforeach; ?>
    
    	<?php else: ?>
        	<p>Recipe currently unavaliable.</p>
    	<?php endif; ?>
	</div>

</div>



<div class="container">

	<h1 class="heading-center" id="smoothies">SMOOTHIES</h1>

	<div class="latest-recipes row">
	<?php if(count($smoothies) > 0): ?>
    
        <?php foreach ($smoothies as $smoothie): ?>
        
            <div class="col-md-3 col-sm-6">
                    <img <?php if ($smoothie->poster):?> src="./images/poster/300h/<?= $smoothie->poster ?>"<?php else: ?>src="http://placehold.it/300x300" <?php endif; ?> alt="<?= $smoothie->title ?> Recipe" class="img-responsive center-block">
                    <h2><?= $smoothie->title; ?></h2>
                    <h4><a href="?page=recipe&amp;id=<?= $smoothie->id; ?>">READ MORE</a></h4>
            </div>
        <?php endforeach; ?>
    

    <?php else: ?>
        <p>Recipe currently unavaliable.</p>
    <?php endif; ?>

    </div><!-- recipes row -->

    <hr>

<!-- Snacks Section -->

	<h1 class="heading-center" id="snacks">SNACKS</h1>

	<div class="latest-recipes row">
	<?php if(count($snacks) > 0): ?>

		<?php foreach ($snacks as $snack): ?>

				<div class="col-md-3 col-sm-6">
	                    <img <?php if ($snack->poster):?> src="./images/poster/300h/<?= $snack->poster ?>"<?php else: ?>src="http://placehold.it/300x300" <?php endif; ?>  alt="<?= $snack->title ?> Recipe" class="img-responsive center-block">
	                    <h2><?= $snack->title; ?></h2>
	                    <h4><a href="?page=recipe&amp;id=<?= $snack->id; ?>">READ MORE</a></h4>
	            </div>
	        <?php endforeach; ?>
	    

	    <?php else: ?>
	        <p>Recipe currently unavaliable.</p>
	    <?php endif; ?>
	</div> <!-- snack row-->

	<hr>

<!-- Desserts Section -->

	<h1 class="heading-center" id="desserts">DESSERTS</h1>

	<div class="latest-recipes row">
	<?php if(count($desserts) > 0): ?>

		<?php foreach ($desserts as $dessert): ?>
				<div class="col-md-3 col-sm-6">
	                    <img <?php if ($dessert->poster):?> src="./images/poster/300h/<?= $dessert->poster ?>" <?php else: ?>src="http://placehold.it/300x300" <?php endif; ?> alt="<?= $dessert->title ?> Recipe" class="img-responsive center-block">
	                    <h2><?= $dessert->title; ?></h2>
	                    <h4><a href="?page=recipe&amp;id=<?= $dessert->id; ?>">READ MORE</a></h4>
	            </div>
	        <?php endforeach; ?>
	    

	    <?php else: ?>
	        <p>Recipe currently unavaliable.</p>
	    <?php endif; ?>
	</div> <!-- desserts row-->

	<hr>


		<!-- <h1 class="heading-center">REQUEST A RECIPE!</h1> -->

<?php if(! static::$auth->check()): ?>

		<h1 class="heading-center">REQUEST A RECIPE!</h1>
      	<p><a href="?page=register">Register</a> or <a href="?page=login">Login</a> to request your favourite recipe.</p>
      


<?php else: ?>

		<div class="newsletter-signup col-centered">
            <h1 class="heading-script">Request a Recipe!</h1>
            <p>Request your favourite recipe!</p>

            <form id="request" action="?page=request" method="POST">
            
            
              <div class="form-group <?php if ($requestform['error']['name']):?> has-error <?php endif; ?>">
                <label for="request-name" class="control-label">Name</label>
                <input class="form-control" id="request-name" name="name" value="<?php echo $requestform['name']; ?>">
                <span id="helpBlock" class="help-block"><?php echo $requestform['error']['name']; ?></span>
              </div>

              <div class="form-group <?php if ($requestform['error']['email']):?> has-error <?php endif ; ?>">
                <label for="email" class="control-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com" value="<?php echo $requestform['email']; ?>">
                <span id="helpBlock" class="help-block"><?php echo $requestform['error']['email']; ?></span>
              </div>

              <div class="form-group <?php if ($requestform['error']['reciperequest']):?> has-error <?php endif ; ?>">
                <label for="request" class="control-label">Recipe Request</label>
                <input type="textarea" class="form-control" id="request" name="reciperequest" value="<?php echo $requestform['reciperequest']; ?>">
                <span id="helpBlock" class="help-block"><?php echo $requestform['error']['reciperequest']; ?></span>
              </div>

              <div class="form-group">
                <button class="btn btn-success">GO</button>
              </div>

            </form>

<?php endif; ?>

        </div>

</div> <!-- container  -->
























