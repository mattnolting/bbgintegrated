<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
<div id="nav-below" class="navigation">
<div class="nav-previous"><?php previous_posts_link(sprintf(__( '%s newer articles', 'blankslate' ),'<span class="meta-nav">&larr;</span>')) ?></div>
<div class="nav-next"><?php next_posts_link(sprintf(__( 'older articles %s', 'blankslate' ),'<span class="meta-nav">&rarr;</span>')) ?></div>
</div>
<?php } ?> 