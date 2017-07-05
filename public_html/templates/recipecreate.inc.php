<?php

//  object from Movie controller. Holds our data. Now is being used to display errors.

$errors = $recipe->errors; 
// if movie id is set. (Currently not set on this page).
$verb = ( $recipe->id ? "EDIT" : "ADD");
if($recipe->id){
  // if edit
  $submitAction = "?page=recipe.update";
} else {
  // if add
  $submitAction = "?page=recipe.store";
}
?>

  <div class="container">

    <div class="row">
      <div class="col-xs-12 col-md-7">
        <form id="recipecreate" action="<?= $submitAction; ?>" method="POST" enctype="multipart/form-data">
          <?php if($recipe->id): ?>
            <input type="hidden" name="id" value="<?= $recipe->id ?>">
            <?php endif; ?>
              <h1 class="heading-center"><?= $verb; ?> RECIPE</h1>

              <div class="form-group <?php if($errors['title']): ?> has-error <?php endif; ?>">
                <label for="title" class="control-label">Recipe Name</label>
                <input class="form-control" id="title" name="title" placeholder="Green Smoothie" value="<?php echo $recipe->title; ?>">
                <div class="help-block">
                  <?php echo $errors['title']; ?>
                </div>
              </div>

              <div class="form-group <?php if($errors['description']): ?> has-error <?php endif; ?>">
                <label for="description" class="control-label">Description </label>
                <textarea class="form-control" id="description" name="description" placeholder="Description of recipe" rows="5"><?php echo $recipe->description; ?></textarea>
                <div class="help-block"><?php echo $errors['description']; ?></div>
              </div>

              <div class="form-group <?php if($errors['ingredients']): ?> has-error <?php endif; ?>">
                <label for="ingredients" class="control-label">Ingredients </label>
                <textarea class="form-control" id="ingredients" name="ingredients" placeholder="List ingredients" rows="8"><?php echo $recipe->ingredients; ?></textarea>
                <div class="help-block"><?php echo $errors['ingredients']; ?></div>
              </div>

              <div class="form-group <?php if($errors['category']): ?> has-error <?php endif; ?>">
                <label for="category" class="control-label">category </label>
                <textarea class="form-control" id="category" name="category" placeholder="smoothie" rows="1"><?php echo $recipe->category; ?></textarea>
                <div class="help-block"><?php echo $errors['category']; ?></div>
              </div>

              <div class="form-group <?php if($errors['poster']): ?> has-error <?php endif; ?>">
                  <label for="poster" class="control-label">Poster Image </label>
                  <div>
                    <input type="file" class="form-control" id="poster" name="poster">
                  </div>
                  <?php if($recipe->poster != ""): ?>
                    <div>
                      <img src="./images/poster/300h/<?=$recipe->poster ?>" alt="image">
                    </div>
                    <div>
                      <div class="checkbox">
                        <label><input type="checkbox" name="removeImage" value="true">Remove Image</label>
                      </div>
                    </div>

                  <?php else: ?>
                    <div>
                      <p><small>No poster found for this movie</small></p>
                    </div>

                  <?php endif; ?>
                </div>


              <div class="form-group <?php if($errors['tags']): ?> has-error <?php endif; ?>">
                <label for="tags" class="control-label">Tags </label>
                <div id="tags" class="form-control">
                  <script type="text/javascript">
                    var inputTags = "<?= $recipe->tags; ?>";
                  </script>
                </div>
              </div>

              <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>
                   &nbsp;<?= $verb; ?> Recipe</button>
              </div>
        </form>

        <?php if($recipe->id): ?>
          <form action="?page=recipe.destroy" method="POST" class="form-horizontal">
            <div class="form-group">
              <input type="hidden" name="id" value="<?= $recipe->id ?>">
              <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>  &nbsp;Delete Recipe</button>
            </div>
          </form>
          <?php endif; ?>

      </div>
      </div>
      </div>
    
 




