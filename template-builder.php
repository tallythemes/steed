<?php
/**
 * Template Name: Builder
 *
 * @package WordPress
 * @subpackage steed
 * @since 1.0
 */
?>
<?php get_header(); ?>
	<?php steed_site_header(); ?>
    <?php steed_before_site_content(array('in_class' => 'no-sidebar', 'class' => 'no-padding')); ?>

		<?php steed_before_primary_content(); ?>
        
				<?php
					while ( have_posts() ) : the_post();
                    	the_content();
        
                    endwhile; // End of the loop.
                ?>

		<?php steed_after_primary_content(); ?>
        
	<?php steed_after_site_content(); ?>
	<?php steed_site_footer(); ?>
<?php get_footer(); ?>