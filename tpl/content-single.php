<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(akina_option('patternimg') || !get_post_thumbnail_id(get_the_ID())) { ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<p class="entry-census"><?php echo poi_time_since(strtotime($post->post_date_gmt)); ?>&nbsp;&nbsp;<?php echo get_post_views(get_the_ID()); ?> 次阅读</p>
		<hr>
	</header><!-- .entry-header -->
	<?php } ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ondemand' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php the_reward(); ?>
	<footer class="post-footer">
		<div class="post-lincenses">
			<a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank" rel="nofollow"><strong>CC BY-NC-SA 4.0</strong></a>
		</div>
		<div class="post-tags">
			<?php if ( has_tag() ) { echo '<i class="iconfont">&#xe68c;</i> '; the_tags('', ' ', ' ');}?>
		</div>
	    <?php get_template_part('layouts/sharelike'); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->