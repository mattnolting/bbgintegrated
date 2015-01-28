<?php get_header(); ?>
<!--	<div class="sidebar">--><?php //get_sidebar(); ?><!--</div>-->
<article id="content">

<?php the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="entry-content">
<?php 
/*if ( has_post_thumbnail() ) {
the_post_thumbnail();
} */
?>

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