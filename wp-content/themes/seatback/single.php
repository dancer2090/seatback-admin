<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header();
$categories = get_categories();
?>

	<?while ( have_posts() ) : the_post();?>
	<?php
		$categories = get_the_category();
		$category_id = $categories[0]->cat_ID;	
	?>

	<?endwhile;?>

<?php get_footer(); ?>
