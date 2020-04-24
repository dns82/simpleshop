<div class="container">
	<?php if(count($categories) > 0):?>
		<div class="row wrap-categories">
			<div class="col-md-12">
				<h2 class="section-title">Categories</h2>
			</div>
			<div class="col-md-12 list-categories">
				<?php foreach ($categories as $category) : ?>
					<div class="cat-item">
						<a href="<?php echo '/catalog/' . $category->handle; ?>"><img src="/media/categories/<?php echo $category->image; ?>" title="<?php echo $category->category_name; ?>" /></img></a>
						<a href="<?php echo '/catalog/' . $category->handle; ?>"><h3 class="category-name"><?php echo $category->category_name; ?></h3></a>
					</div>
				<?php endforeach?>
			</div>
		</div>
	<?php endif; ?>
	
	<?php echo $products ?>
	
	<?php echo $modals ?>

</div>