<?php
add_action('after_setup_theme', 'blankslate_setup');
function blankslate_setup(){
load_theme_textdomain('blankslate', get_template_directory() . '/languages');
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );

	global $content_width;

	if ( ! isset( $content_width ) ) $content_width = 640;
		register_nav_menus(
			array( 'main-menu' => __( 'Main Menu', 'bbgTheme' ),
			'footer-menu' => __( 'Footer Menu', 'bbgTheme' ),
			'agency-menu' => __( 'agency nav', 'bbgTheme'),
			'work-menu' => __( 'work nav', 'bbgTheme' ) )
		);
	}

	add_action('comment_form_before', 'blankslate_enqueue_comment_reply_script');
	function blankslate_enqueue_comment_reply_script()
	{
		if(get_option('thread_comments')) { wp_enqueue_script('comment-reply'); }
	}
	add_filter('the_title', 'blankslate_title');



function blankslate_title($title) {
if ($title == '') {
return 'Untitled';
} else {
return $title;
}
}
add_filter('wp_title', 'blankslate_filter_wp_title');
function blankslate_filter_wp_title($title)
{
return $title . esc_attr(get_bloginfo('name'));
}
add_filter('comment_form_defaults', 'blankslate_comment_form_defaults');
function blankslate_comment_form_defaults( $args )
{
$req = get_option( 'require_name_email' );
$required_text = sprintf( ' ' . __('Required fields are marked %s', 'blankslate'), '<span class="required">*</span>' );
$args['comment_notes_before'] = '<p class="comment-notes">' . __('Your email is kept private.', 'blankslate') . ( $req ? $required_text : '' ) . '</p>';
$args['title_reply'] = __('Post a Comment', 'blankslate');
$args['title_reply_to'] = __('Post a Reply to %s', 'blankslate');
return $args;
}
add_action( 'init', 'blankslate_add_shortcodes' );
function blankslate_add_shortcodes() {
add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');
add_filter('img_caption_shortcode', 'my_img_caption_shortcode_filter',10,3);
add_filter('widget_text', 'do_shortcode');
}
function my_img_caption_shortcode_filter($val, $attr, $content = null)
{
extract(shortcode_atts(array(
'id'	=> '',
'align'	=> '',
'width'	=> '',
'caption' => ''
), $attr));
if ( 1 > (int) $width || empty($caption) )
return $val;
$capid = '';
if ( $id ) {
$id = esc_attr($id);
$capid = 'id="figcaption_'. $id . '" ';
$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
}
return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: '
. (10 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption ' . $capid 
. 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init() {
register_sidebar( array (
'name' => __('Sidebar Widget Area', 'blankslate'),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
$preset_widgets = array (
'primary-aside'  => array( 'search', 'pages', 'categories', 'archives' ),
);
function blankslate_get_page_number() {
if (get_query_var('paged')) {
print ' | ' . __( 'Page ' , 'blankslate') . get_query_var('paged');
}
}

	function theme_name_scripts() {
		$theme_dir = get_stylesheet_directory_uri();
		$has_https = isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == "on" ;
		// Only for Theme Area
		if( ! is_admin() ) {

			// Child Theme Stylesheets
			wp_enqueue_style('owl_style', $theme_dir . '/css/owl.carousel.css', null, null, 'screen');
			wp_enqueue_style('owl_transitions', $theme_dir . '/css/owl.transitions.css', null, null, 'screen');

			// Child Theme Scripts
			wp_enqueue_script( 'owl-carousel', $theme_dir . '/js/owl.carousel.js', array('jquery'), null, false );
			wp_enqueue_script( 'site_scripts', $theme_dir . '/js/scripts.js', array('jquery'), null, true );
		}
	}

	add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );


	function pbug($print){
		echo '<pre>';
		echo print_r($print);
		echo '</pre>';
	}



function amitavroy_site_block_linkify_twitter_status($status_text) {
  // linkify URLs
  $status_text = preg_replace(
    '/(https?:\/\/\S+)/',
    '<a href="\1" class="preg-links">\1</a>',
    $status_text
  );
 
  // linkify twitter users
  $status_text = preg_replace(
    '/(^|\s)@(\w+)/',
    '\1@<a href="http://twitter.com/\2" class="preg-links">\2</a>',
    $status_text
  );
 
  // linkify tags
  $status_text = preg_replace(
    '/(^|\s)#(\w+)/',
    '\1#<a href="http://search.twitter.com/search?q=%23\2" class="preg-links">\2</a>',
    $status_text
  );
 
  return $status_text;
}

/**
 * Format the time when displaying our latest Tweets
 */
function ago($time){
   $periods = array("second", "minute", "hour", "day", "week", "month", "year");
   $lengths = array("60","60","24","7","4.35","12","10");
 
   $now = time();
   $difference = $now - $time;
   $tense = "ago";
 
   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }
 
   $difference = round($difference);
 
   if($difference != 1) {
       $periods[$j].= "s";
   }
 
   return "$difference $periods[$j] ago ";
}
 
/**
 * Display out latest Tweets using the Twitter 1.1 API
 */
function display_latest_tweets($no_tweets){
 
    @require_once 'twitteroauth/twitteroauth.php';
 
     $twitterConnection = new TwitterOAuth(
        'iHVGVWXqzOgxwn9HzIof2Q',    // Consumer Key
        'j3FBfnHUQLzZbIJKrPwVWRdZaQ0Z9OPjSnryoeqaD4', // Consumer secret
        '43369361-QCWiiBqN94yl0yORx7xqryYmCNBIKVx74tyEWf39z',    // Access token
        'j4NtOHxVaI1pJdD6QkpbQeXUlyvPCHN9k4namVDG4Yo'    // Access token secret
        );
 
    $twitterData = $twitterConnection->get(
        'statuses/user_timeline',
          array(
            'screen_name'     => 'bbgintegrated',   // Your Twitter Username
            'count'           => $no_tweets,        // Number of Tweets to display
            'exclude_replies' => true
          )
        );  
 
        if($twitterData && is_array($twitterData)) {
        ?>
        	<?php foreach($twitterData as $tweet): ?>
        	<?php $text = $tweet->text; ?>
			<div id="twitter-data-container">
				<p><?php echo amitavroy_site_block_linkify_twitter_status($text); ?></p>
				<div class="hr"><hr /></div>
			</div>
			<?php endforeach; ?>

			<?php /* ?>
            <div id="tweets_list">
                <ul>
                    <?php foreach($twitterData as $tweet): ?>
                    <li>
                        <span>
                        <?php
                        $latestTweet = $tweet->text;
                        $latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $latestTweet);
            echo $latestTweet;
                        ?>
                        </span>
                        <?php
                        $twitterTime = strtotime($tweet->created_at);
                        $timeAgo = ago($twitterTime);
                        ?>
                        <div class="meta"><a href="http://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" class="jtwt_date"><?php echo $timeAgo; ?></a></div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php */ ?>

    <?php
    }
}

function is_child( $parent = '' ) {
	global $post;
 
	$parent_obj = get_page( $post->post_parent, ARRAY_A );
	$parent = (string) $parent;
	$parent_array = (array) $parent;
 
	if ( in_array( (string) $parent_obj['ID'], $parent_array ) ) {
		return true;
	} elseif ( in_array( (string) $parent_obj['post_title'], $parent_array ) ) {
		return true;	
	} elseif ( in_array( (string) $parent_obj['post_name'], $parent_array ) ) {
		return true;
	} else {
		return false;
	}
}
function blankslate_catz($glue) {
$current_cat = single_cat_title( '', false );
$separator = "\n";
$cats = explode( $separator, get_the_category_list($separator) );
foreach ( $cats as $i => $str ) {
if ( strstr( $str, ">$current_cat<" ) ) {
unset($cats[$i]);
break;
}
}
if ( empty($cats) )
return false;
return trim(join( $glue, $cats ));
}
function blankslate_tag_it($glue) {
$current_tag = single_tag_title( '', '',  false );
$separator = "\n";
$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
foreach ( $tags as $i => $str ) {
if ( strstr( $str, ">$current_tag<" ) ) {
unset($tags[$i]);
break;
}
}
if ( empty($tags) )
return false;
return trim(join( $glue, $tags ));
}
function blankslate_commenter_link() {
$commenter = get_comment_author_link();
if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
$commenter = preg_replace( '/(<a[^>]* class=[\'"]?)/', '\\1url ' , $commenter );
} else {
$commenter = preg_replace( '/(<a )/', '\\1class="url "' , $commenter );
}
$avatar_email = get_comment_author_email();
$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
}
function blankslate_custom_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
$GLOBALS['comment_depth'] = $depth;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author vcard"><?php blankslate_commenter_link() ?></div>
<div class="comment-meta"><?php printf(__('Posted %1$s at %2$s', 'blankslate' ), get_comment_date(), get_comment_time() ); ?><span class="meta-sep"> | </span> <a href="#comment-<?php echo get_comment_ID(); ?>" title="<?php _e('Permalink to this comment', 'blankslate' ); ?>"><?php _e('Permalink', 'blankslate' ); ?></a>
<?php edit_comment_link(__('Edit', 'blankslate'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>
<?php if ($comment->comment_approved == '0') { echo '\t\t\t\t\t<span class="unapproved">'; _e('Your comment is awaiting moderation.', 'blankslate'); echo '</span>\n'; } ?>
<div class="comment-content">
<?php comment_text() ?>
</div>
<?php
if($args['type'] == 'all' || get_comment_type() == 'comment') :
comment_reply_link(array_merge($args, array(
'reply_text' => __('Reply','blankslate'),
'login_text' => __('Login to reply.', 'blankslate'),
'depth' => $depth,
'before' => '<div class="comment-reply-link">',
'after' => '</div>'
)));
endif;
?>
<?php }
function blankslate_custom_pings($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'blankslate'),
get_comment_author_link(),
get_comment_date(),
get_comment_time() );
edit_comment_link(__('Edit', 'blankslate'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>
<?php if ($comment->comment_approved == '0') { echo '\t\t\t\t\t<span class="unapproved">'; _e('Your trackback is awaiting moderation.', 'blankslate'); echo '</span>\n'; } ?>
<div class="comment-content">
<?php comment_text() ?>
</div>
<?php }