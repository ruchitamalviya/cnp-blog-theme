<section>
<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

		<?php the_excerpt(); ?>

		<?php the_post_thumbnail(); ?>	
		<div class="entry-content">
			<?php echo get_the_content();?>
		</div>
</section>
