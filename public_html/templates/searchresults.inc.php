<div class="container">
<div class="row">
	<div class="col-xs-12">
		<h1 class="heading-center">Search Results for '<?= $q; ?>':</h1>
		<?php if(count($recipes) > 0): ?>
			<div class="row">
			<div class="col-md-7">
			<ol>
				<?php foreach ($recipes as $recipe) :?>
					<li>
						<h3>
							<a href="./?page=recipe&amp;id=<?= $recipe->id; ?>">
							<?= $recipe->title; ?></a>
						</h3>

						<ul class="list-inline">
							<?php foreach ($recipe->getTags() as $tag): ?>
								<li><span class="label label-default"><?= $tag->tag; ?></span></li>
							<?php endforeach; ?>
						</ul>
					</li>
				<?php endforeach; ?>
			</ol>
		<?php else: ?>
			<p>Weirdly enough, there are no recipes to display. Spooky!!! </p>
		<?php endif; ?>	
		</div>
		</div>


	</div>
</div>
</div>