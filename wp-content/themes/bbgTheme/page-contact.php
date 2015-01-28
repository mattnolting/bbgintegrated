<?php
/**
 * Template Name: Contact
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<article id="content">
	<div class="contact-header">
		<div class="logo"><a href="http://bbgintegrated.com/wordpress/"><img src="<?php bloginfo('template_directory'); ?>/images/contact-logo.png" /></a></div>
	</div>
<?php the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<?php if(is_page('work') || is_child('work')){?>
	<div class="mainarea2"><?php the_content(); ?></div>
	<?php wp_nav_menu( array('menu' => 'work_nav' , 'menu_class' => 'work_nav' ) );?>
<?php }else{?>
	<div class="mainarea"><?php the_content() ?></div>
<?php }?>

<?php /*wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'blankslate' ) . '&after=</div>')*/ ?>
<?php /*edit_post_link( __( 'Edit', 'blankslate' ), '<div class="edit-link">', '</div>' )*/ ?>
</div>
</div>
<?php /*comments_template( '', true );*/ ?>
</article>

<?php get_footer(); ?>