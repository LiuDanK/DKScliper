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
