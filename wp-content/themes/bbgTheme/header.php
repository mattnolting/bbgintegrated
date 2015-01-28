<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title(' | ', true, 'right'); ?></title>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/style-update.css" >

<?php wp_enqueue_script("jquery"); ?>
<?php wp_head(); ?>

<!--<script type="text/javascript" src="--><?php //bloginfo('template_directory'); ?><!--/js/jquery-1.4.3.min.js"></script>-->
<?php
	$ga_script = ot_get_option( 'ga_tracking' );

	echo $ga_script ? $ga_script : null;
?>
</head>

<?php
	if(is_page('contact')) {
		$body_class = contact;
	}
?>

<body <?php body_class($body_class); ?>>

<div id="wrapper" class="hfeed shadow">

<header>



    <div class="slider-wrapper">
	    <?php $heroes = new WP_Query( array( 'post_type' => 'hero' ) ); ?>
	    <?php if($heroes->have_posts()) : ?>
		<ul id="slides" class="owl-carousel">
			<?php
				while($heroes->have_posts()) : $heroes->the_post();
				$link_title		= types_render_field("link-title", array("raw"=>true));
				$link_url		= types_render_field("link-url", array("raw"=>true));
				$show_title     = types_render_field("show-title", array("raw"=>true));
			?>

			<li>
				<?php //echo $show_title ? '<h2 class="hero-title">' . $post->post_title . '</h2>' : null ?>
				<?= $link_url ? '<a class="link" href="' . $link_url . '">See What We Did</a>' : null ?>
				<?php the_post_thumbnail(); ?>
			</li>
			<?php endwhile; ?>
        </ul>
	    <?php endif; wp_reset_query(); ?>
    </div>

    <div id="logo"><a href="http://bbgintegrated.com/wordpress/"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" /></a></div>

    <nav>

    <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>

    </nav>

</header>

<div id="container">