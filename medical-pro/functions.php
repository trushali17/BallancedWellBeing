<?php

if ( ! isset( $content_width ) ) $content_width = 900;

function medical_pro_setup()
{

    // Make theme available for translation, translations can be filed in the /languages/ directory
    load_theme_textdomain('medical-pro', get_template_directory() . '/languages');

    // This theme uses post format support.
    add_theme_support('post-formats', array('gallery', 'link', 'image', 'quote', 'video', 'audio'));

    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
    add_theme_support('title-tag');

    // This theme uses post thumbnails
    add_theme_support('post-thumbnails');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // This theme uses menus
    add_theme_support('menus');

    // This theme uses woocommerce
    add_theme_support('woocommerce');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array(
        'top' => esc_html__('Top Navigation', 'medical-pro'),
        'footer' => esc_html__('Footer Navigation', 'medical-pro'),
    ));

    /* Add Post Thumbnails Support and Related Image Sizes */	
    add_theme_support('post-thumbnails');
	
	add_image_size('medical-pro-thumb-small', 42, 42, true);
	add_image_size('medical-pro-doctor-thumb', 262, 262, true);
    add_image_size('medical-pro-thumb-large', 495, 601, true);
	add_image_size('medical-pro-post-thumb', 185, 137, true);
	add_image_size('medical-pro-department-thumb', 569, 459, true);
	add_image_size('medical-pro-service-thumb-large', 555, 363, true);
	add_image_size('medical-pro-post-thumb-medium', 262, 202, true);
	add_image_size('medical-pro-post-thumb-widget', 143, 122, true);
	add_image_size('gallery-post-single', 670, 500, true);          // For Gallery Single Post Slider and Various Other Parts of theme like doctors pages
    add_image_size('gallery-post-single-thumb', 111, 69, true);     // For Gallery Single Post Thumbnail

}
add_action('after_setup_theme', 'medical_pro_setup');


if(!function_exists('medical_pro_add_editor_styles'))
{
    function medical_pro_add_editor_styles() {
        add_editor_style(get_stylesheet_uri());
        add_editor_style(get_template_directory_uri() . '/css/bootstrap.min.css');
        add_editor_style(get_template_directory_uri() . '/css/bootstrap-theme.min.css');
        add_editor_style(get_template_directory_uri() . '/css/font-awesome.min.css');
        add_editor_style(get_template_directory_uri() . '/css/default/style.css');
    }
}
add_action('admin_init', 'medical_pro_add_editor_styles');


/*-----------------------------------------------------------------------------------*/
/*	Theme required plugin list
/*-----------------------------------------------------------------------------------*/
require_once ( get_template_directory() .'/include/plugins/class-tgm-plugin-activation.php');
require_once ( get_template_directory() .'/include/plugins/plugin_list.php');


/*-----------------------------------------------------------------------------------*/
/*	Theme custom function
/*-----------------------------------------------------------------------------------*/
require_once ( get_template_directory() .'/include/theme-functions.php');


/*-----------------------------------------------------------------------------------*/
/*	Theme option configuration
/*-----------------------------------------------------------------------------------*/
require_once ( get_template_directory() .'/include/medicalpro-config.php');


/*-----------------------------------------------------------------------------------*/
/*	Bootstrap WP Menu Walker
/*-----------------------------------------------------------------------------------*/
require_once ( get_template_directory() .'/include/wp_bootstrap_navwalker.php');


/*-----------------------------------------------------------------------------------*/
/*	AJAX Handler
/*-----------------------------------------------------------------------------------*/
require_once ( get_template_directory() .'/include/ajax.php');

if (class_exists('WPBakeryVisualComposerAbstract')) {
		$dir = get_template_directory() . '/include/';
		vc_set_shortcodes_templates_dir( $dir );
	  require_once(get_template_directory() . '/include/vc-update.php');
}
/*-----------------------------------------------------------------------------------*/
/*	Register Widgets
/*-----------------------------------------------------------------------------------*/
require_once ( get_template_directory() .'/include/widget-services.php');
require_once ( get_template_directory() .'/include/widget-departments.php');
require_once ( get_template_directory() .'/include/widget-recent-post.php');
require_once ( get_template_directory() .'/include/widget-footer-contact.php');
require_once ( get_template_directory() .'/include/widget-footer-newsletter.php');
require_once ( get_template_directory() .'/include/widget-future-box.php');

require_once ( get_template_directory() . '/vc_extend/services.php');
require_once ( get_template_directory() . '/vc_extend/testimonials.php');
require_once ( get_template_directory() . '/vc_extend/recent_posts.php');
require_once ( get_template_directory() . '/vc_extend/doctors.php');
require_once ( get_template_directory() . '/vc_extend/department.php');
require_once ( get_template_directory() . '/vc_extend/appointment_form.php');
require_once ( get_template_directory() . '/vc_extend/appointment_horizontal_form.php');
require_once ( get_template_directory() . '/vc_extend/future_boxes.php');

/*-----------------------------------------------------------------------------------*/
/*	WooCommerce functions and hook
/*-----------------------------------------------------------------------------------*/
require_once ( get_template_directory() .'/include/woocommerce.php');
/*-----------------------------------------------------------------------------------*/
/*	Add Widget Areas
/*-----------------------------------------------------------------------------------*/
if (function_exists('register_sidebar')) {

        // Default Sidebar
        register_sidebar(array(
            'id' => 'blog-post',
            'name' => esc_html__('Blog Post',  'medical-pro'),
            'description' => esc_html__('This sidebar is for blog posts.',  'medical-pro'),
            'before_widget' => '<div id="%1$s" class="row m0 widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="widget_heading">',
            'after_title' => '</h5>'
        ));

        // Service Detail Page Sidebar
        register_sidebar(array(
            'id' => 'service-detail-page',
            'name' => esc_html__('Service Detail Page', 'medical-pro'),
            'description' => esc_html__('This sidebar is for service detail page.', 'medical-pro'),
            'before_widget' => '<div id="%1$s" class="row m0 widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="widget_heading">',
            'after_title' => '</h5>'
        ));
		
		// Department Detail Page Sidebar
        register_sidebar(array(
            'id' => 'department-detail-page',
            'name' => esc_html__('Department Detail Page', 'medical-pro'),
            'description' => esc_html__('This sidebar is for department detail page.', 'medical-pro'),
            'before_widget' => '<div id="%1$s" class="row m0 widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="widget_heading">',
            'after_title' => '</h5>'
        ));

        // Footer Widget 1
        register_sidebar(array(
            'id' => 'footer-widget-1',
            'name' => esc_html__('Footer Widget 1', 'medical-pro'),
            'description' => esc_html__('This widget is for footer.', 'medical-pro'),
            'before_widget' => '<div id="%1$s" class="row m0 widget  %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="heading row m0"><h3>',
            'after_title' => '</h3></div>'
        ));

        // Footer Widget 2
        register_sidebar(array(
            'id' => 'footer-widget-2',
            'name' => esc_html__('Footer Widget 2', 'medical-pro'),
            'description' => esc_html__('This widget is for footer.', 'medical-pro'),
            'before_widget' => '<div id="%1$s" class="row m0 widget  %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="heading row m0"><h3>',
            'after_title' => '</h3></div>'
        ));

        // Footer Widget 3
        register_sidebar(array(
            'id' => 'footer-widget-3',
            'name' => esc_html__('Footer Widget 3', 'medical-pro'),
            'description' => esc_html__('This widget is for footer.', 'medical-pro'),
            'before_widget' => '<div id="%1$s" class="row m0 widget  %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="heading row m0"><h3>',
            'after_title' => '</h3></div>'
        ));

        // WooCommerce
        register_sidebar(array(
            'id' => 'shop',
            'name' => esc_html__('Shop', 'medical-pro'),
            'description' => esc_html__('This widget is for Shop.', 'medical-pro'),
            'before_widget' => '<div id="%1$s" class="sidebar-block clearfix %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="sidebar-block-title"><h3>',
            'after_title' => '</h3></div>'
        ));

}


/*-----------------------------------------------------------------------------------*/
//	Generate Quick CSS
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'medicalpro_generate_quick_css' ) ){
    function medicalpro_generate_quick_css(){
        global $medicalpro_options;

        if($medicalpro_options['medicalpro_quick_css']){
            // Quick CSS from Theme Options
            $quick_css = stripslashes($medicalpro_options['medicalpro_quick_css']);

            if(!empty($quick_css)){
                echo "\n<style type='text/css' id='quick-css'>\n";
                echo $quick_css . "\n";
                echo "</style>". "\n\n";
            }
        }
    }
}
add_action('wp_head', 'medicalpro_generate_quick_css',151);

/*-----------------------------------------------------------------------------------*/
/*	Function to output different bootstrap classes
/*-----------------------------------------------------------------------------------*/
if (!function_exists('get_bc')) {
    function get_bc($col_lg = null, $col_md = null, $col_sm = null, $col_xs = null)
    {
        $bootstrap_classes = "";
        if (!empty($col_lg)) {
            $bootstrap_classes .= "col-lg-$col_lg ";
        }
        if (!empty($col_md)) {
            $bootstrap_classes .= "col-md-$col_md ";
        }
        if (!empty($col_sm)) {
            $bootstrap_classes .= "col-sm-$col_sm ";
        }
        if (!empty($col_xs)) {
            $bootstrap_classes .= "col-xs-$col_xs ";
        }
        return $bootstrap_classes;
    }
}

if (!function_exists('bc')) {
    function bc($col_lg = null, $col_md = null, $col_sm = null, $col_xs = null)
    {
        echo get_bc($col_lg, $col_md, $col_sm, $col_xs);
    }
}

if (!function_exists('get_bc_all')) {
    function get_bc_all($column)
    {
        return "col-lg-$column col-md-$column col-sm-$column";
    }
}

if (!function_exists('bc_all')) {
    function bc_all($column)
    {
        echo get_bc_all($column);
    }
}