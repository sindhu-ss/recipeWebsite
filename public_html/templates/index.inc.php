<div class="logo-banner">
    <img src="http://placehold.it/100x100" class="img-responsive center-block" alt="Recipe Website logo">
    <h1>Maria's Kitchen</h1>
</div>

<!-- Slider main container -->
<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide"><img src="http://placehold.it/200x200"></div>
        <div class="swiper-slide"><img src="http://placehold.it/200x200"></div>
        <div class="swiper-slide"><img src="http://placehold.it/200x200"></div>
        <div class="swiper-slide"><img src="http://placehold.it/200x200"></div>
        <div class="swiper-slide"><img src="http://placehold.it/200x200"></div>
        <div class="swiper-slide"><img src="http://placehold.it/200x200"></div>
        <div class="swiper-slide"><img src="http://placehold.it/200x200"></div>
        
    </div>

    
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    
    <!-- If we need scrollbar -->
    <div class="swiper-scrollbar"></div>
</div>


<!-- Types icons -->

<div class="container">

<!-- Latest Recipes -->
<h1 class="heading-center">POPULAR RECIPES</h1>


<?php if(count($recipes) > 0): ?>

    <div class="popular-recipes row">
    
        <?php foreach ($recipes as $recipe): ?>
        
            <div class="col-md-3 col-sm-6">
                    <img <?php if ($recipe->poster):?> src="./images/poster/300h/<?= $recipe->poster ?>" <?php else: ?>src="http://placehold.it/300x300" <?php endif; ?> alt="<?= $recipe->title ?> Recipe" class="img-responsive center-block">
                    <h2><?= $recipe->title; ?></h2>
                     <h4><a href="?page=recipe&amp;id=<?= $recipe->id; ?>">READ MORE</a></h4>
            </div>
        <?php endforeach; ?>
    

    <?php else: ?>
        <p>Recipe currently unavaliable.</p>
    <?php endif; ?>

    </div>

<hr>


<div class="row container-newsletter">
    <div class="vertical-line col-md-6 col-sm-12 col-xs-12">
        <div class="newsletter-signup col-centered">
            <h1><span class="newsletter-heading">Subscribe to our</span> <span>NEWSLETTER</span></h1>

            <p>Sign up below for a monthly newsletter including recipes, give aways and more!</p>

            <form id="newsletter" action="?page=newsletter" method="POST">
            
            <div class="form-group <?php if ($newsletter['error']['name']):?>has-error <?php endif; ?>">

                <label for="newsletter-name" class="control-label">Name</label>
                  <input class="form-control" id="newsletter-name" name="name" value="<?php echo $newsletter['name']; ?>">
                  <span id="helpBlock" class="help-block"><?php echo $newsletter['error']['name']; ?></span>
            </div>

              <div class="form-group <?php if ($newsletter['error']['email']):?> has-error <?php endif ; ?>">
                <label for="email" class="control-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com" value="<?php echo $newsletter['email']; ?>">
                  <span id="helpBlock" class="help-block"><?php echo $newsletter['error']['email']; ?></span>
              </div>

              <div class="form-group">
                <button class="btn btn-success">GO</button>
              </div>
            </form>

        </div>
        
    </div>

    

    <div class="newsletter-right col-md-6 col-sm-12 col-xs-12">

    <?php if(! static::$auth->check()): ?>

      <h1 class="heading-center">REQUEST A RECIPE!</h1>
      <p><a href="?page=register">Register</a> or <a href="?page=login">Login</a> to request your favourite recipe.</p> 


    <?php else: ?>
      
      <h1 class="heading-center">REQUEST A RECIPE!</h1>
      <p><a href="?page=recipes#request">Click here</a> to request your favourite recipe.</p>


    <?php endif; ?>
        
    </div>    


</div> <!-- newsletter row  -->



</div> <!-- Fixed width container -->





