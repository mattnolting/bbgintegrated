<div class="clear"></div>
</div>
</div>
<footer>
	<div class="footer_bar">
    	<div class="footer_content">
        	<div style="float:left;">
        	<p>&copy;Burkhead Brand Group 2013</p>
            </div>
            <div style="float:right; width: 80px;">
	            <img style="max-width: 100%; height: auto;" src="<?php echo ot_get_option( 'homepage_slider_logo' ); ?>" alt="<?php echo get_bloginfo('name'); ?>" />
<!--                <img class="footer_logo" src="--><?php //bloginfo('template_directory'); ?><!--/images/footer_logo.png" />-->
            </div>
		    <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>