<?php get_header(); ?>
<div id="content">
<!--<div class="sidebar"><?php /*get_sidebar(); */?></div>-->
<div class="mainarea">
	<?php get_template_part( 'nav', 'above' ); ?>
    <?php while ( have_posts() ) : the_post() ?>
    <?php get_template_part( 'entry' ); ?>
    <?php /*comments_template();*/ ?>
    <?php endwhile; ?>
    <?php get_template_part( 'nav', 'below' ); ?>
</div>
</div>
<?php get_footer(); ?>