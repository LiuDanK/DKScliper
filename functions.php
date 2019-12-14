<?php
/**
 * Akina functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Scilper
 */
 
define( 'SIREN_VERSION', '2.0.4' );

if ( !function_exists( 'akina_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

function akina_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Akina, use a find and replace
	 * to change 'akina' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'akina', get_template_directory() . '/languages' );


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( '导航菜单', 'akina' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'status',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'akina_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	add_filter('pre_option_link_manager_enabled','__return_true');
	
	// 优化代码
	//去除头部冗余代码
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'wp_generator');
	remove_action( 'wp_head', 'wp_generator' ); //隐藏wordpress版本
	remove_filter('the_content', 'wptexturize'); //取消标点符号转义
	
	remove_action('rest_api_init', 'wp_oembed_register_route');
	remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
	remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
	remove_filter('oembed_response_data', 'get_oembed_response_data_rich', 10, 4);
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'wp_oembed_add_host_js');
	// Remove the Link header for the WP REST API
	// [link] => <http://cnzhx.net/wp-json/>; rel="https://api.w.org/"
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
	
	function coolwp_remove_open_sans_from_wp_core() {
		wp_deregister_style( 'open-sans' );
		wp_register_style( 'open-sans', false );
		wp_enqueue_style('open-sans','');
	}
	add_action( 'init', 'coolwp_remove_open_sans_from_wp_core' );
	
	/**
	* Disable the emoji's
	*/
	function disable_emojis() {
	 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	 remove_action( 'wp_print_styles', 'print_emoji_styles' );
	 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	}
	add_action( 'init', 'disable_emojis' );
	 
	/**
	 * Filter function used to remove the tinymce emoji plugin.
	 * 
	 * @param    array  $plugins  
	 * @return   array             Difference betwen the two arrays
	 */
	function disable_emojis_tinymce( $plugins ) {
	 if ( is_array( $plugins ) ) {
	 return array_diff( $plugins, array( 'wpemoji' ) );
	 } else {
	 return array();
	 }
	}

	/*
	 * 评论表情
	 */
	function custom_smilies_src($src, $img){
		return get_bloginfo('template_directory').'/images/smilies/' . $img;
	}
	add_filter('smilies_src', 'custom_smilies_src', 10, 2);

	function init_akinasmilie() {
			global $wpsmiliestrans;
			//默认表情文本与表情图片的对应关系(可自定义修改)
			$wpsmiliestrans = array(
					':mrgreen:' => 'icon_mrgreen.gif',
					':neutral:' => 'icon_neutral.gif',
					':twisted:' => 'icon_twisted.gif',
					':arrow:' => 'icon_arrow.gif',
					':shock:' => 'icon_eek.gif',
					':smile:' => 'icon_smile.gif',
					':???:' => 'icon_confused.gif',
					':cool:' => 'icon_cool.gif',
					':evil:' => 'icon_evil.gif',
					':grin:' => 'icon_biggrin.gif',
					':idea:' => 'icon_idea.gif',
					':oops:' => 'icon_redface.gif',
					':razz:' => 'icon_razz.gif',
					':roll:' => 'icon_rolleyes.gif',
					':wink:' => 'icon_wink.gif',
					':cry:' => 'icon_cry.gif',
					':eek:' => 'icon_surprised.gif',
					':lol:' => 'icon_lol.gif',
					':mad:' => 'icon_mad.gif',
					':sad:' => 'icon_sad.gif',
					'8-)' => 'icon_cool.gif',
					'8-O' => 'icon_eek.gif',
					':-(' => 'icon_sad.gif',
					':-)' => 'icon_smile.gif',
					':-?' => 'icon_confused.gif',
					':-D' => 'icon_biggrin.gif',
					':-P' => 'icon_razz.gif',
					':-o' => 'icon_surprised.gif',
					':-x' => 'icon_mad.gif',
					':-|' => 'icon_neutral.gif',
					';-)' => 'icon_wink.gif',
					'8O' => 'icon_eek.gif',
					':(' => 'icon_sad.gif',
					':)' => 'icon_smile.gif',
					':?' => 'icon_confused.gif',
					':D' => 'icon_biggrin.gif',
					':P' => 'icon_razz.gif',
					':o' => 'icon_surprised.gif',
					':x' => 'icon_mad.gif',
					':|' => 'icon_neutral.gif',
					';)' => 'icon_wink.gif',
					':!:' => 'icon_exclaim.gif',
					':?:' => 'icon_question.gif',
			);
		 
	}
	add_action('init', 'init_akinasmilie', 5); 

	/*
	 * WordPress 后台回复评论插入表情
	 */
	function Bing_ajax_smiley_scripts(){
		echo '<script type="text/javascript">function grin(e){var t;e=" "+e+" ";if(!document.getElementById("replycontent")||document.getElementById("replycontent").type!="textarea")return!1;t=document.getElementById("replycontent");if(document.selection)t.focus(),sel=document.selection.createRange(),sel.text=e,t.focus();else if(t.selectionStart||t.selectionStart=="0"){var n=t.selectionStart,r=t.selectionEnd,i=r;t.value=t.value.substring(0,n)+e+t.value.substring(r,t.value.length),i+=e.length,t.focus(),t.selectionStart=i,t.selectionEnd=i}else t.value+=e,t.focus()}jQuery(document).ready(function(e){var t="";e("#comments-form").length&&e.get(ajaxurl,{action:"ajax_data_smiley"},function(n){t=n,e("#qt_replycontent_toolbar input:last").after("<br>"+t)})})</script>';
	}
	add_action( 'admin_head', 'Bing_ajax_smiley_scripts' );
	
	//Ajax 获取表情
	function Bing_ajax_data_smiley(){
		$site_url = site_url();
		foreach( array_unique( (array) $GLOBALS['wpsmiliestrans'] ) as $key => $value ){
			$src_url = apply_filters( 'smilies_src', includes_url( 'images/smilies/' . $value ), $value, $site_url );
			echo ' <a href="javascript:grin(\'' . $key . '\')"><img src="' . $src_url . '" alt="' . $key . '" /></a> ';
		}
		die;
	}
	add_action( 'wp_ajax_nopriv_ajax_data_smiley', 'Bing_ajax_data_smiley' );
	add_action( 'wp_ajax_ajax_data_smiley', 'Bing_ajax_data_smiley' );
	
	// 移除菜单冗余代码
	add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
	add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
	add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
	function my_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent')) : '';
	}
		
}
endif;
add_action( 'after_setup_theme', 'akina_setup' );

function admin_lettering(){
    echo'<style type="text/css">body{font-family: Microsoft YaHei;}</style>';
}
add_action('admin_head', 'admin_lettering');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function akina_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'akina_content_width', 640 );
}
add_action( 'after_setup_theme', 'akina_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
/*function akina_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'akina' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'akina' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'akina_widgets_init' );
*/

/**
 * Enqueue scripts and styles.
 */
function akina_scripts() {
	wp_enqueue_style( 'siren', get_stylesheet_uri(), array(), SIREN_VERSION );
	wp_enqueue_script( 'jq', get_template_directory_uri() . '/js/jquery.min.js', array(), SIREN_VERSION, true );
	wp_enqueue_script( 'pjax-libs', get_template_directory_uri() . '/js/jquery.pjax.js', array(), SIREN_VERSION, true );
	wp_enqueue_script( 'input', get_template_directory_uri() . '/js/input.min.js', array(), SIREN_VERSION, true );
    wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app.js', array(), SIREN_VERSION, true );
    wp_enqueue_script( 'tocbot', get_template_directory_uri() . '/js/tocbot.min.js' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( akina_option('scilper_hitokoto') != '0' ) {
		wp_enqueue_style( 'animateCSS', 'http://www.liudank.top/wp-content/themes/scilper/animate.min.css', array(), SIREN_VERSION ); 
	}

	// 20161116 @Louie
	$mv_live = akina_option('focus_mvlive') ? 'open' : 'close';
	$movies = akina_option('focus_amv') ? array('url' => akina_option('amv_url'), 'name' => akina_option('amv_title'), 'live' => $mv_live) : 'close';
	$auto_height = akina_option('focus_height') ? 'fixed' : 'auto';
	$code_lamp = akina_option('open_prism_codelamp') ? 'open' : 'close';
	// if(wp_is_mobile()) $auto_height = 'fixed'; //拦截移动端
	wp_localize_script( 'app', 'Poi' , array(
		'pjax' => akina_option('poi_pjax'),
		'movies' => $movies,
		'windowheight' => $auto_height,
		'codelamp' => $code_lamp,
		'ajaxurl' => admin_url('admin-ajax.php'),
		'order' => get_option('comment_order'), // ajax comments
		'formpostion' => 'bottom' // ajax comments 默认为bottom，如果你的表单在顶部则设置为top。
	));
}
add_action( 'wp_enqueue_scripts', 'akina_scripts', 0, 0);

/**
 * load .php.
 */
require get_template_directory() .'/inc/decorate.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * function update
 */
require get_template_directory() . '/inc/siren-update.php';
require get_template_directory() . '/inc/categories-images.php';


/**
 * COMMENT FORMATTING
 */
if(!function_exists('akina_comment_format')){
	function akina_comment_format($comment, $args, $depth){
		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class(); ?> id="comment-<?php echo esc_attr(comment_ID()); ?>">
			<div class="contents">
				<div class="comment-arrow">
					<div class="main shadow">
						<div class="profile">
							<a href="<?php comment_author_url(); ?>" target="_blank"><?php echo get_avatar( $comment->comment_author_email, '80', '', get_comment_author() ); ?></a>
						</div>
						<div class="commentinfo">
							<section class="commeta">
								<div class="left">
									<h4 class="author"><a href="<?php comment_author_url(); ?>" rel="external nofollow" target="_blank"><?php echo get_avatar( $comment->comment_author_email, '24', '', get_comment_author() ); ?><?php comment_author(); ?> <span class="isauthor" title="<?php esc_attr_e('Author', 'akina'); ?>">博主</span></a></h4>
								</div>
								<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
								<div class="right">
									<div class="info"><time datetime="<?php comment_date('Y-m-d'); ?>"><?php echo poi_time_since(strtotime($comment->comment_date_gmt), true );//comment_date(get_option('date_format')); ?></time><?php echo siren_get_useragent($comment->comment_agent); ?></div>
								</div>
							</section>
						</div>
						<div class="body">
							<?php comment_text(); ?>
						</div>
					</div>
					<div class="arrow-left"></div>
				</div>
			</div>
			<hr>
		<?php
	}
}


/**
 * post views.
 * @bigfa
 */
function restyle_text($number) {
    if($number >= 1000) {
        return round($number/1000,2) . 'k';
    }else{
        return $number;
    }
}

function set_post_views() {
    global $post;
    $post_id = intval($post->ID);
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    if(is_single() || is_page()) {
        if(!update_post_meta($post_id, 'views', ($views + 1))) {
            add_post_meta($post_id, 'views', 1, true);
        }
    }
}
add_action('get_header', 'set_post_views');

function get_post_views($post_id) {
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    $post_views = intval(post_custom('views'));
    if($views == '') {
        return 0;
    }else{
        return restyle_text($views);
    }
} 


/*
 * Ajax点赞
 */
add_action('wp_ajax_nopriv_specs_zan', 'specs_zan');
add_action('wp_ajax_specs_zan', 'specs_zan');
function specs_zan(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
        $specs_raters = get_post_meta($id,'specs_zan',true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('specs_zan_'.$id,$id,$expire,'/',$domain,false);
        if (!$specs_raters || !is_numeric($specs_raters)) {
            update_post_meta($id, 'specs_zan', 1);
        } 
        else {
            update_post_meta($id, 'specs_zan', ($specs_raters + 1));
        }
        echo get_post_meta($id,'specs_zan',true);
    } 
    die;
}


/*
 * 友情链接
 */
function get_the_link_items($id = null){
  $bookmarks = get_bookmarks('orderby=date&category=' .$id );
  $default_levek = get_template_directory_uri().'/images/none.png';
  $loading_levek = get_template_directory_uri().'/images/level/loading.ajax-links_levek.svg';
  $output = '';
  if ( !empty($bookmarks) ) {
      $output .= '<ul class="link-items fontSmooth">';
      foreach ($bookmarks as $bookmark) {
      	if (empty($bookmark->link_description)) $bookmark->link_description = '这家伙好懒，什么都没写╮(╯▽╰)╭';
      	if (empty($bookmark->link_image)) $bookmark->link_image = get_template_directory_uri() .'/images/none.png';
        $output .=  '<li class="link-item"><a class="link-item-inner effect-apollo" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank"><img class="linksimage" src="' . $bookmark->link_image . '" onerror="javascript:this.src=\'' . $default_levek . '\'" /><span class="sitename">'. $bookmark->link_name .'</span><div class="linkdes">'. ''. $bookmark->link_description .'</div></a></li>';
      }
      $output .= '</ul>';
  }
  return $output;
}

function get_link_items(){
  $linkcats = get_terms( 'link_category' );
  	if ( !empty($linkcats) ) {
      	foreach( $linkcats as $linkcat){            
        	$result .=  '<h3 class="link-title">'.$linkcat->name.'</h3>';
        	if( $linkcat->description ) $result .= '<div class="link-description">' . $linkcat->description . '</div>';
        	$result .=  get_the_link_items($linkcat->term_id);
      	}
  	} else {
    	$result = get_the_link_items();
  	}
  return $result;
}

/*
 * Ajax实时获取Gravatar头像
 */
add_action( 'init', 'ajax_avatar_url' );
function ajax_avatar_url() {
	if( $_GET['action'] == 'ajax_avatar_get' && 'GET' == $_SERVER['REQUEST_METHOD'] ) {
		$email = $_GET['email'];
		echo get_avatar_url( $email, array( 'size'=>54 ) ); // size 指定头像大小
		die();
	}else{ 
		return; 
	}
}

/*
 * Gravatar头像使用中国服务器
 */
function gravatar_cn( $url ){ 
	$gravatar_url = array('0.gravatar.com','1.gravatar.com','2.gravatar.com');
	return str_replace( $gravatar_url, 'cn.gravatar.com', $url );
}
add_filter( 'get_avatar_url', 'gravatar_cn', 4 );


/*
 * 阻止站内文章互相Pingback 
 */
function theme_noself_ping( &$links ) { 
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
	if ( 0 === strpos( $link, $home ) )
	unset($links[$l]); 
}
add_action('pre_ping','theme_noself_ping');


/*
 * 订制body类
*/
function akina_body_classes( $classes ) {
  // Adds a class of group-blog to blogs with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }
  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }
  return $classes;
}
add_filter( 'body_class', 'akina_body_classes' );


/*
 * 图片七牛云缓存
 */
add_filter( 'upload_dir', 'wpjam_custom_upload_dir' );
function wpjam_custom_upload_dir( $uploads ) {
	$upload_path = '';
	$upload_url_path = akina_option('qiniu_cdn');

	if ( empty( $upload_path ) || 'wp-content/uploads' == $upload_path ) {
		$uploads['basedir']  = WP_CONTENT_DIR . '/uploads';
	} elseif ( 0 !== strpos( $upload_path, ABSPATH ) ) {
		$uploads['basedir'] = path_join( ABSPATH, $upload_path );
	} else {
		$uploads['basedir'] = $upload_path;
	}

	$uploads['path'] = $uploads['basedir'].$uploads['subdir'];

	if ( $upload_url_path ) {
		$uploads['baseurl'] = $upload_url_path;
		$uploads['url'] = $uploads['baseurl'].$uploads['subdir'];
	}
	return $uploads;
}


/*
 * 删除自带小工具
*/
function unregister_default_widgets() {
	unregister_widget("WP_Widget_Pages");
	unregister_widget("WP_Widget_Calendar");
	unregister_widget("WP_Widget_Archives");
	unregister_widget("WP_Widget_Links");
	unregister_widget("WP_Widget_Meta");
	unregister_widget("WP_Widget_Search");
	unregister_widget("WP_Widget_Text");
	unregister_widget("WP_Widget_Categories");
	unregister_widget("WP_Widget_Recent_Posts");
	unregister_widget("WP_Widget_Recent_Comments");
	unregister_widget("WP_Widget_RSS");
	unregister_widget("WP_Widget_Tag_Cloud");
	unregister_widget("WP_Nav_Menu_Widget");
}
add_action("widgets_init", "unregister_default_widgets", 11);


/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function akina_jetpack_setup() {
  // Add theme support for Infinite Scroll.
  add_theme_support( 'infinite-scroll', array(
    'container' => 'main',
    'render'    => 'akina_infinite_scroll_render',
    'footer'    => 'page',
  ) );

  // Add theme support for Responsive Videos.
  add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'akina_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function akina_infinite_scroll_render() {
  while ( have_posts() ) {
    the_post();
    if ( is_search() ) :
        get_template_part( 'tpl/content', 'search' );
    else :
        get_template_part( 'tpl/content', get_post_format() );
    endif;
  }
}

/*
 * 编辑器增强
 */
function enable_more_buttons($buttons) {
	$buttons[] = 'hr'; 
	$buttons[] = 'del'; 
	$buttons[] = 'sub'; 
	$buttons[] = 'sup';
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'cleanup';
	$buttons[] = 'styleselect';
	$buttons[] = 'wp_page';
	$buttons[] = 'anchor'; 
	$buttons[] = 'backcolor'; 
	return $buttons;
} 
add_filter("mce_buttons_3", "enable_more_buttons");

/*
 * 代码高亮文件路径
 */
function add_highlight() {
    wp_register_style(
        'highlightCSS', 
        get_stylesheet_directory_uri() . '/inc/css/highlight.css'
    );
    wp_register_script(
        'highlightJS',
        get_stylesheet_directory_uri() . '/inc/js/highlight.pack.js'
    );
    wp_enqueue_style('highlightCSS');
    wp_enqueue_script('highlightJS');
}
add_action('wp_enqueue_scripts', 'add_highlight');

/*
 * 后台登录页
 * @M.J
 */	
//Login Page style
function custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/inc/login.css" />'."\n";
	echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/jquery.min.js"></script>'."\n";
}
add_action('login_head', 'custom_login');

//Login Page Title
function custom_headertitle ( $title ) {
	return get_bloginfo('name');
}
add_filter('login_headertitle','custom_headertitle');

//Login Page Link
function custom_loginlogo_url($url) {
	return esc_url( home_url('/') );
}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );

//Login Page Footer
function custom_html() {
	if ( akina_option('login_bg') ) {
		$loginbg = akina_option('login_bg'); 
	}else{
		$loginbg = get_bloginfo('template_directory').'/images/hd.jpg';
	}
	echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/login.js"></script>'."\n";
	echo '<script type="text/javascript">'."\n";
	echo 'jQuery("body").prepend("<div class=\"loading\"><img src=\"'.get_bloginfo('template_directory').'/images/login_loading.gif\" width=\"58\" height=\"10\"></div><div id=\"bg\"><img /></div>");'."\n";
	echo 'jQuery(\'#bg\').children(\'img\').attr(\'src\', \''.$loginbg.'\').load(function(){'."\n";
	echo '	resizeImage(\'bg\');'."\n";
	echo '	jQuery(window).bind("resize", function() { resizeImage(\'bg\'); });'."\n";
	echo '	jQuery(\'.loading\').fadeOut();'."\n";
	echo '});';
	echo '</script>'."\n";
}
add_action('login_footer', 'custom_html');

//禁用sw.org
function remove_dns_prefetch( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		return array_diff( wp_dependencies_unique_hosts(), $hints );
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );

//禁用谷歌字体
function scilper_disable_open_sans( $translations, $text, $context, $domain ) {
  if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
    $translations = 'off';
  }
  return $translations;
}
add_filter( 'gettext_with_context', 'scilper_disable_open_sans', 888, 4 );

//使用昵称替换用户名，通过用户ID进行查询
function scilper_author_link( $link, $author_id) {
    global $wp_rewrite;
    $author_id = (int) $author_id;
    $link = $wp_rewrite->get_author_permastruct();
    if ( empty($link) ) {
        $file = home_url( '/' );
        $link = $file . '?author=' . $author_id;
    } else {
        $link = str_replace('%author%', $author_id, $link);
        $link = home_url( user_trailingslashit( $link ) );
    }
    return $link;
}
add_filter( 'author_link', 'scilper_author_link', 10, 2 );

function scilper_author_link_request( $query_vars ) {
    if ( array_key_exists( 'author_name', $query_vars ) ) {
        global $wpdb;
        $author_id=$query_vars['author_name'];
        if ( $author_id ) {
            $query_vars['author'] = $author_id;
            unset( $query_vars['author_name'] );    
        }
    }
    return $query_vars;
}
add_filter( 'request', 'scilper_author_link_request' );

//TOC 支持
function toc_support($content) {
    $content =  str_replace('[toc]', '<div class="has-toc have-toc"></div>', $content); // TOC 支持
    return $content;
}
add_filter('the_content', 'toc_support');

/*
 * 图片自动添加alt属性
 */
function img_alt( $imgalt ){
    global $post;
    $title = $post->post_title;
    $imgUrl = "<img\s[^>]*src=(\"??)([^\" >]*?)\\1[^>]*>";
    if(preg_match_all("/$imgUrl/siU",$imgalt,$matches,PREG_SET_ORDER)){
        if( !empty($matches) ){
            for ($i=0; $i < count($matches); $i++){
                $tag = $url = $matches[$i][0];
                $judge = '/alt=/';
                preg_match($judge,$tag,$match,PREG_OFFSET_CAPTURE);
                if( count($match) < 1 )
                $altURL = ' alt="'.$title.'" ';
                $url = rtrim($url,'>');
                $url .= $altURL.'>';
                $imgalt = str_replace($tag,$url,$imgalt);
            }
        }
    }
    return $imgalt;
}
add_filter( 'the_content','img_alt');

//去掉img无用参数
function fanly_remove_images_attribute( $html ) {
	//$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	$html = preg_replace( '/width="(\d*)"\s+height="(\d*)"\s+class=\"[^\"]*\"/', "", $html );
	$html = preg_replace( '/  /', "", $html );
	return $html;
}
add_filter( 'post_thumbnail_html', 'fanly_remove_images_attribute', 10 );
add_filter( 'image_send_to_editor', 'fanly_remove_images_attribute', 10 );

/*
 * 评论邮件回复
 */
function comment_mail_notify($comment_id){
	$mail_user_name = akina_option('mail_user_name') ? akina_option('mail_user_name') : 'poi';
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if(($parent_id != '') && ($spam_confirmed != 'spam')){
    $wp_email = $mail_user_name . '@' . 'email.' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '你在 [' . get_option("blogname") . '] 的留言有了回应';
    $message = '
	    <table border="1" cellpadding="0" cellspacing="0" width="600" align="center" style="border-collapse: collapse; border-style: solid; border-width: 1;border-color:#ddd;">
			<tbody>
	          <tr>
	            <td>
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" height="48" >
	                    <tbody>
	                    	<tr>
	                        <td width="100" align="center" style="border-right:1px solid #ddd;">'. get_option("blogname") .'</td>
	                        <td width="300" style="padding-left:20px;"><strong>您有一条来自 <a href="'.home_url().'" target="_blank" style="color:#6ec3c8;text-decoration:none;">' . get_option("blogname") . '</a> 的留言回复！</strong></td>
							</tr>
						</tbody>
					</table>
				</td>
	          </tr>
	          <tr>
	            <td  style="padding:15px;"><p><strong>' . trim(get_comment($parent_id)->comment_author) . '</strong> 同学, 您好!</span>
	            	<p>您在《' . get_the_title($comment->comment_post_ID) . '》的留言为:</p><p style="border-left:3px solid #ddd;padding-left:1rem;color:#999;">' . trim(get_comment($parent_id)->comment_content) . '</p>
	            	<p>' . trim($comment->comment_author) . ' 给您的回复:</p><p style="border-left:3px solid #ddd;padding-left:1rem;color:#999;">' . trim($comment->comment_content) . '</p>
			        <center><a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" target="_blank" style="background-color:#6ec3c8; border-radius:10px; display:inline-block; color:#fff; padding:15px 20px 15px 20px; text-decoration:none;margin-top:20px; margin-bottom:10px;">点击查看完整内容</a></center>
					<center><p style="font-size:0.8rem; color:#999;">(此邮件由系统自动发出，请勿直接回复)</p></center>
				</td>
	          </tr>
	          <tr>
	            <td align="center" valign="center" height="38" style="font-size:0.8rem; color:#999;">Copyright © '.get_option("blogname").'</td>
	          </tr>
			  </tbody>
		</table>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
  }
}
add_action('comment_post', 'comment_mail_notify');

/*
 * WordPress无插件使用SMTP发送邮件并修改发件人名称
 */
if ( akina_option('open_smtp') != '0' ) {
	function mail_smtp( $phpmailer ) {
		$phpmailer->IsSMTP();
		$phpmailer->SMTPAuth = true; //启用SMTPAuth服务
		$phpmailer->Port = akina_option('open_smtp_port'); //SMTP邮件发送端口，这个和下面的对应，如果这里填写25，则下面为空白
		$phpmailer->SMTPSecure = akina_option('open_smtp_smtpsecure'); //是否验证 ssl，这个和上面的对应，如果不填写，则上面的端口须为25
		$phpmailer->Host = akina_option('open_smtp_host'); //邮箱的SMTP服务器地址，如果是QQ的则为：smtp.exmail.qq.com
		$phpmailer->Username = akina_option('open_smtp_username'); //你的邮箱地址
		$phpmailer->Password = akina_option('open_smtp_password'); //你的邮箱授权密码（有的是登录密码）
	}
	add_action('phpmailer_init', 'mail_smtp');
	//下面这个很重要，需跟上面smtp邮箱一致才行
	function ashuwp_wp_mail_from( $original_email_address ) {
		return akina_option('open_smtp_username');
	}
	add_filter( 'wp_mail_from', 'ashuwp_wp_mail_from' );
	//修改WordPress发送邮件的发件人
	function new_from_name($email){
		$wp_from_name = get_option('blogname');
		return $wp_from_name;
	}
	add_filter('wp_mail_from_name', 'new_from_name');
}

/*
 * 引用方糖气球评论微信推送
 */
function wpso_wechet_comment_notify($comment_id) {
    $text = get_bloginfo('name'). '上有新的评论';  
    $comment = get_comment($comment_id);
	$wpso_wenotify_key = akina_option('wpso_wenotify_key');
    $desp = $comment->comment_author.' 同学在文章《'.get_the_title($comment->comment_post_ID).'》中给您的留言为：'.$comment->comment_content;
    $key = $wpso_wenotify_key;  
    $postdata = http_build_query(  
        array(  
            'text' => $text,  
            'desp' => $desp  
        )  
    );  

    $opts = array('http' =>  
        array(  
            'method' => 'POST',  
            'header' => 'Content-type: application/x-www-form-urlencoded',  
            'content' => $postdata  
        )  
    );  
    $context = stream_context_create($opts);
    $admin_email = get_bloginfo ('admin_email');
    $comment_author_email = trim($comment->comment_author_email);
    if($admin_email!=$comment_author_email){
				return $result = file_get_contents('http://sc.ftqq.com/'.$key.'.send', false, $context); 
    }
}  
add_action('comment_post', 'wpso_wechet_comment_notify', 19, 2);

/* 替换图片链接为 https */
function https_image_replacer($content){
	
		/*已经验证使用 $_SERVER['SERVER_NAME']也可以获取到数据，但是貌似$_SERVER['HTTP_HOST']更好一点*/
		$host_name = $_SERVER['HTTP_HOST'];
		$http_host_name='http://qiniu.liudank.top/wp-content/uploads';
		$https_host_name='https://qiniu.liudank.top/wp-content/uploads';
		$content = str_replace($https_host_name,$http_host_name, $content);
	
	return $content;
}
add_filter('the_content', 'https_image_replacer');

/* 面包屑 */

function get_breadcrumbs()
{
global $wp_query;

if ( !is_home() ){

// Start the UL
echo '<ul class="breadcrumbs">';
// Add the Home link
echo '<li><a href="'. get_settings('home') .'">首页</a></li>';

if ( is_category() )
{
$catTitle = single_cat_title( "", false );
$cat = get_cat_ID( $catTitle );
echo "<li> &raquo; ". get_category_parents( $cat, TRUE, " &raquo; " ) ."</li>";
}
elseif ( is_archive() && !is_category() )
{
echo "<li> &raquo; Archives</li>";
}
elseif ( is_search() ) {

echo "<li> &raquo; 搜索结果</li>";
}
elseif ( is_404() )
{
echo "<li> &raquo; 404 Not Found</li>";
}
elseif ( is_single() )
{
$category = get_the_category();
$category_id = get_cat_ID( $category[0]->cat_name );

echo '<li> &raquo; '. get_category_parents( $category_id, TRUE, " &raquo; " );
echo the_title('','', FALSE) ."</li>";
}
elseif ( is_page() )
{
$post = $wp_query->get_queried_object();

if ( $post->post_parent == 0 ){

echo "<li> &raquo; ".the_title('','', FALSE)."</li>";

} else {
$title = the_title('','', FALSE);
$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
array_push($ancestors, $post->ID);

foreach ( $ancestors as $ancestor ){
if( $ancestor != end($ancestors) ){
echo '<li> &raquo; <a href="'. get_permalink($ancestor) .'">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></li>';
} else {
echo '<li> &raquo; '. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</li>';
}
}
}
}

// End the UL
echo "</ul>";
}
}



//code end 