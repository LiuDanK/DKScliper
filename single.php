<?php
get_header(); ?>
	<div id="primary" class="content-area">
		<?php get_breadcrumbs();?>
		<main id="main" class="site-main" role="main">
			<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'tpl/content', 'single' );
			get_template_part('layouts/sidebox');
			get_template_part('layouts/post','nextprev');  
		    get_template_part('layouts/authorprofile'); 
		endwhile; // End of the loop.
		?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
