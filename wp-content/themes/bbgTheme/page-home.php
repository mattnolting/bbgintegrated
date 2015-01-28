<?php
/**
 * Template Name: Homepage
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
	<div id="content" class="home">
		<div class="mainarea">
			<?php get_template_part( 'nav', 'above' ); ?>
			<?php while ( have_posts() ) : the_post() ?>
				<?php

				$cell     = types_render_field("phone", array("raw"=>true));
				$email    = types_render_field("email", array("raw"=>true));
				$i_email = types_render_field("email-icon", array("html"=>true));
				$i_cell  = types_render_field("phone-icon", array("html"=>true));
				$col2_content = types_render_field("column-2-content", array("html"=>true));
				$col3_content = types_render_field("column-3-content", array("html"=>true));
				?>
			<div class="col3">
				<?php the_content(); ?>
				<br />
				<a class="email link" href="mailto:<?php echo $email; ?>"><figure class="icon"><?php echo $i_email; ?></figure><span><?php echo $email; ?></span></a>
				<a class="phone link"><figure class="icon"><?php echo $i_cell; ?></figure><span><?php echo $cell; ?></span></a>
				<div class="social">
					<a class="facebook" href="https://www.facebook.com/bbgintegrated" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/i_facebook.jpg" /></a>
					<a class="linkedin" href="http://www.linkedin.com/company/burkhead-brand-group" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/i_linkedin.jpg" /></a>
				</div>
			</div>

			<div class="col3">
				<?php echo $col2_content; ?>
			</div>

			<div class="col3">
				<?php echo $col3_content; ?>
			</div>

			<?php endwhile; ?>
			<?php get_template_part( 'nav', 'below' ); ?>
		</div>
	</div>
<?php get_footer(); ?>