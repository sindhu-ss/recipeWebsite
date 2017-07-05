<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?php if ($page_title) { echo $page_title ;} ?></title>

    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/swiper.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better MOBILE display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">
            <img alt="Brand" src="http://placehold.it/30x30">
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="./" <?php if($page === "index"): ?>class="active"<?php endif ;?>>Home</a></li>
            <li><a href="?page=recipes" <?php if($page === "recipes"): ?>class="active"<?php endif ;?>>Recipes</a></li>
            <li <?php if($page === "blog"): ?>class="active"<?php endif ;?>><a href="?page=blog">Blog</a></li>
            <li <?php if($page === "contact"): ?>class="active"<?php endif ;?>><a href="?page=contact">Contact</a></li>
          </ul>
          
          

          <!-- Search bar -->
        <form method="GET" action="./" class="navbar-form navbar-right" role="search">
          <div class="form-group input-group">
          <input type="hidden" name="page" value="search">
            <input name="q" type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn">
            
          <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
          </span>
          </div>
        </form>

          <ul class="nav navbar-nav navbar-right">
          <?php if(! static::$auth->check()): ?>
            <li><a href="?page=register"  <?php if($page === "auth.register"): ?>class="active" <?php endif ;?>>Register</a></li>
            <li><a href="?page=login"  <?php if($page === "auth.login"): ?>class="active" <?php endif ;?>>Login</a></li>
          <?php else: ?>
            <li><a href="#" class="active"><?= static::$auth->user()->username; ?></a></li>
            <li><a href="?page=logout" class="active">Logout</a></li>
          <?php endif; ?>
          </ul>


        </div><!-- /.navbar-collapse -->
    </nav>



    <?php $this->content(); ?>


    <footer class="row">
      <div class="col-md-4">
        <ul>
          <li><a href="?page=home">Home</a></li>
          <li>&#8226;</li>
          <li><a href="?page=recipes">Recipes</a></li>
          <li>&#8226;</li>
          <li>Blog</li>
          <li>&#8226;</li>
          <li>Contact</li>
        </ul>
      </div>

      <div class="col-md-4">
        <p><span>&copy; Maria's Kitchen</span></p>
      </div>

      <div class="col-md-4">
        <p><i class="fa fa-facebook" aria-hidden="true"></i>&nbsp; &nbsp;<i class="fa fa-instagram" aria-hidden="true"></i></p>
      </div>
    </footer>

      </div><!-- /.container-fluid -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
    <script src="js/bootstrap.min.js"></script>
    <script src="js/live-validation.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/taggle.min.js"></script>
    <script src="js/main.js"></script>
    <script>
      var mySwiper = new Swiper ('.swiper-container', {
        
        direction: 'horizontal',
        slidesPerView: 'auto',
        // paginationClickable: true,
        // spaceBetween: 30,
        freeMode: true,
        freeModeSticky: true,
         
        // Navigation arrows
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        
        scrollbar: '.swiper-scrollbar'
      });

    </script>
  </body>
</html>















