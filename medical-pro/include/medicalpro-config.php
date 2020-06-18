<?php

if ( ! class_exists( 'Redux' ) ) {
    return;
}


// This is your option name where all the Redux data is stored.
$opt_name = "medicalpro_options";

// If Redux is running as a plugin, this will remove the demo notice and links
add_action( 'redux/loaded', 'redux_framework_remove_demo' );


/*-----------------------------------------------------------------------------------*/
/*	SET ARGUMENTS
/*  All the possible arguments for Redux.
/*  For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
/*-----------------------------------------------------------------------------------*/


$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.

    'display_name'         => $theme->get( 'Name' ),
    // Name that appears at the top of your panel

    'display_version'      => $theme->get( 'Version' ),
    // Version that appears at the top of your panel

    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)

    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not

    'menu_title'           => esc_html__( 'MedicalPro Options', 'medical-pro' ),

    'page_title'           => esc_html__( 'MedicalPro Options', 'medical-pro' ),

    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',

    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module

    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string

    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader

    'admin_bar'            => true,
    // Show the panel pages on the admin bar

    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu

    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu

    'global_variable'      => 'medicalpro_options',
    // Set a different name for your global variable other than the opt_name

    'dev_mode'             => false,
    // Show the time the page took to load, etc

    'update_notice'        => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo

    'customizer'           => true,
    // Enable basic customizer support

    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.

    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.

    'page_parent'          => 'themes.php',

    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.

    'menu_icon'            => '',
    // Specify a custom URL to an icon

    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)

    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title

    'page_slug'            => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided

    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not

    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.

    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *

    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,

    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output

    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',

    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'system_info'          => false,

   // 'compiler'             => true,

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);

Redux::setArgs( $opt_name, $args );



/*-----------------------------------------------------------------------------------*/
/*	Home page options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Home', 'medical-pro' ),
    'id'         => 'home',
    'subsection' => false,
    'fields'     => array(
        array(
            'id'=>'favicon',
            'type' => 'media',
            'title' => esc_html__('Favicon', 'medical-pro'),
            'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'default'=>array('url' => get_template_directory_uri() .'/images/theme-options/favicon.ico'),
            'subtitle' => esc_html__('Add/Upload Your Website Favicon here', 'medical-pro'),
        ),
        array(
            'id'        => 'default_header_on_page',
            'type'      => 'image_select',
            'title'     => esc_html__('Default Header', 'medical-pro'),
            'subtitle'  => esc_html__('Select Header you want to display on page if header is not select while page creation.', 'medical-pro'),
            'options'   => array(
                '1' => array('title' => esc_html__('1st Variation', 'medical-pro'), 'img' => get_template_directory_uri().'/images/theme-options/header_style1.jpg'),
                '2' => array('title' => esc_html__('2nd Variation', 'medical-pro'), 'img' => get_template_directory_uri().'/images/theme-options/header_style2.jpg'),
				'3' => array('title' => esc_html__('3nd Variation', 'medical-pro'), 'img' => get_template_directory_uri().'/images/theme-options/header_style3.jpg'),
            ),
            'default'   => '2',
        ),
		array(
			'id'       => 'display_scheduletext_or_social_icon_on_top',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Schedule Text or Social Icon Top Bar', 'medical-pro' ),
			'subtitle' => '',
			'default'  => 1,
			'on'       => 'Schedule Text',
			'off'      => 'Social Icon',
		),
        array(
            'id' => 'schedule_text_for_header',
            'type' => 'text',
            'title' => esc_html__('Schedule Text', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Schedule text to display in header top bar', 'medical-pro'),
            'default'   => 'Monday - Saturday - 8:00 - 18:00, Sunday - 8:00 - 14:00',
			'required'  => array('display_scheduletext_or_social_icon_on_top', '=', '1'),
        ),
		array(
            'id' => 'schedule_text_label',
            'type' => 'text',
            'title' => esc_html__('Schedule Text Label', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Schedule text label to display in header top bar', 'medical-pro'),
            'default'   => '<strong><i class="fa fa-clock-o"></i>Schedule</strong>:',
			'required'  => array('display_scheduletext_or_social_icon_on_top', '=', '1'),
        ),
		array(
			'id' 		=> 'display_header_social_icons',
			'type' 		=> 'switch',
			'title' 	=> esc_html__('Social Icons on header', 'medical-pro'),
			'subtitle' 	=> esc_html__('Do you want to display social icons in header ?', 'medical-pro'),
			'default' 	=> '1',
			'on' 		=> esc_html__('Display','medical-pro'),
			'off' 		=> esc_html__('Hide','medical-pro'),
			'required'  => array('display_scheduletext_or_social_icon_on_top', '=', '0'),
		),
        array(
            'id' => 'email_for_header',
            'type' => 'text',
            'title' => esc_html__('Email Address', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Email Address to display in header top bar', 'medical-pro'),
            'default'   => 'info@medicalprotheme.com'
        ),
        array(
            'id' => 'phoneno_for_header',
            'type' => 'text',
            'title' => esc_html__('Phone No.', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Phone No. to display in header top bar', 'medical-pro'),
            'default'   => '123 7890 456'
        ),
		array(
			'id'       => 'display_breadcrumb',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Breadcrumb on header', 'medical-pro' ),
			'subtitle' 	=> esc_html__('Do you want to display Breadcrumb on header?', 'medical-pro'),
			'default'  => 1,
			'on'       => 'Display',
			'off'      => 'Hide',
		),
		array(
            'id' => 'breadcrumb_separator',
            'type' => 'text',
            'title' => esc_html__('Breadcrumb Separator', 'hostingpress'),
            'subtitle' => esc_html__('Provide the Breadcrumb Separator', 'hostingpress'),
            'default'   => '>',
             'required'  => array('display_breadcrumb', '=', '1'),
        ),
		array(
			'id'       => 'display_payintro_header',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Page introduction header or Hide', 'medical-pro' ),
			'subtitle' 	=> esc_html__('Do you want to display page header', 'medical-pro'),
			'default'  => 1,
			'on'       => 'Display',
			'off'      => 'Hide',
		),
    )
) );



Redux::setSection( $opt_name, array(
    'title' => __( 'Styling Option', 'medical-pro'),
    'id'    => 'style-options',
    'desc'  => __('This section contains header styles options.', 'medical-pro' ),
    'subsection' => false,
    'fields'=> array (

       

		    
		
) ) );


Redux::setSection( $opt_name, array(
    'title' => __( 'Header Style', 'medical-pro'),
    'id'    => 'header-style-options',
    'desc'  => __('This section contains Header theme styles options.', 'medical-pro' ),
    'subsection' => true,
    'fields'=> array (

         /*
         * Main menu
         */
        array(
            'id'        => 'medicalpro_header_menu_color',
            'type'      => 'color',
            'output'    => array( '.book_banner,.default .navbar #main_nav .nav li.book a' ),
            'title'     => __( 'Menu Color', 'medical-pro' ),
            'desc'      => 'default: #475267',
            'default'   => '#475267',
            'transparent' => false,
			'output'    => array('background-color' => '',
								'color' => '.default .navbar.navbar2 #main_nav .nav li a')
        ),
		array(
            'id'        => 'medicalpro_header_menu_hover_color',
            'type'      => 'color',
            'title'     => __( 'Menu hover Color', 'medical-pro' ),
            'desc'      => 'default: #404d5f',
            'default'   => '#404d5f',
            'transparent' => false,
			'output'    => array('background-color' => '',
								'color' => '.default .navbar.navbar2 #main_nav .nav li a:hover,.default .navbar.navbar2 #main_nav .nav li.dropdown:hover a')
        ),
		array(
            'id'        => 'medicalpro_header_submenu_color',
            'type'      => 'color_rgba',
            'output'    => array( '.book_banner,.default .navbar #main_nav .nav li.book a' ),
            'title'     => __( 'Sub-Menu Color', 'medical-pro' ),
            'desc'      => 'default: #475267',
            'default'   => array(
						'color'     => '#fdfdfd',
						'alpha'     => 1
					),
            'transparent' => false,
			'output'    => array('background-color' => '',
								'color' => '.default .navbar.navbar2 #main_nav .nav li.dropdown .dropdown-menu li a')
        ),
		array(
            'id'        => 'medicalpro_header_submenu_hover_color',
            'type'      => 'color',
            'title'     => __( 'Sub-Menu hover Color', 'medical-pro' ),
            'desc'      => 'default: #fff',
            'default'   => '#fff',
            'transparent' => false,
			'output'    => array('background-color' => '',
								'color' => '.default .navbar.navbar2 #main_nav .nav li.dropdown .dropdown-menu li a:hover')
        ),
		array(
            'id'        => 'medicalpro_menu_font',
            'type'      => 'typography',
            'title'     => __( 'Menu Font', 'medical-pro' ),
            'subtitle'  => __( 'Select the font for headings.', 'medical-pro' ),
            'desc'      => __( 'Karla is default font.', 'medical-pro' ),
            'google'    => true,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'color'         => false,
            'text-align'    => false,
            'output'        => array( '.default .navbar' ),
            'default'       => array(
                'font-family' => 'Karla',
                'google'      => true
            )
        ),
		array(
            'id'        => 'medicalpro_topbar_font_color',
            'type'      => 'color',
            'title'     => __( 'Header Top bar font Color', 'medical-pro' ),
            'desc'      => 'default: #7184a5',
            'default'   => '#7184a5',
            'transparent' => false,
			'output'    => array('background-color' => '',
								'color' => '.top_bar')
        ),
		array(
            'id'        => 'medicalpro_topbar_background_color',
            'type'      => 'color',
            'title'     => __( 'Header Top bar Background Color', 'medical-pro' ),
            'desc'      => 'default: #fff',
            'default'   => '#fff',
            'transparent' => false,
			'output'    => array('background-color' => '.top_bar',
								'color' => '')
        ),
		array(
            'id'        => 'medicalpro_topbar_font',
            'type'      => 'typography',
            'title'     => __( 'Topbar Font', 'medical-pro' ),
            'subtitle'  => __( 'Select the font for headings.', 'medical-pro' ),
            'desc'      => __( 'Lato is default font.', 'medical-pro' ),
            'google'    => true,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'color'         => false,
            'text-align'    => false,
            'output'        => array( '.top_bar' ),
            'default'       => array(
                'font-family' => 'Lato',
                'google'      => true
            )
        ),
		array(
            'id'        => 'medicalpro_header_link_color',
            'type'      => 'link_color',
            'title'     => __( 'Top Bar Link Color', 'medical-pro' ),
            'active'    => true,
            'output'    => array( '.top_bar a' ),
            'default'   => array(
                'regular' => '#7184a5',
                'hover'   => '#404d5f',
                'active'  => '#404d5f',
            )
        ),
			    
		
) ) );

Redux::setSection( $opt_name, array(
    'title' => __( 'Basic Style', 'medical-pro'),
    'id'    => 'basic-style-options',
    'desc'  => __('This section contains Basic theme styles options.', 'medical-pro' ),
    'subsection' => true,
    'fields'=> array (

         /*
         * Main menu
         */
        array(
            'id'        => 'medicalpro_primary_color',
            'type'      => 'color',
            'output'    => array( '.book_banner,.default .navbar #main_nav .nav li.book a' ),
            'title'     => __( 'Primary Color', 'medical-pro' ),
            'desc'      => 'default: #0186d5',
            'default'   => '#0186d5',
            'transparent' => false,
			'output'    => array('background-color' => '.default .navbar #main_nav .nav li.dropdown .dropdown-menu,
								.service_tab #service_tab li.active a span,footer .newsletterForm input[type="submit"],.entry-content table thead,.entry-content kbd,.entry-content pre,.comment_body  blockquote,.comment_body table thead,.comment_body kbd,.comment_body pre,.page-links a:hover,.default .navbar #main_nav .nav li.dropdown:hover a,.default .navbar #main_nav .nav li.book a:hover,.default .navbar.navbar3,.form_row .col-sm-3 input[type="submit"]:hover,.form_bottom_part,.titleRow h2:after,.accordion .panel .panel-heading h4 a[aria-expanded="true"],.accordion.white_bg .panel .panel-heading h4 a,.view_all:hover,.search_form .input-group span button,.widget_tag_cloud.widget .tagcloud a:hover,.pagination span:hover,.pagination span.current,.author_description .media-body .titleRow h5:after,.tabs.tabs-blue .nav-tabs li a,.tabs.tabs-orrange .nav-tabs li a:hover,.serviceDetailsSection .book_btn,.appointment_home_form2 .form_inputs input[type="submit"]:hover,.team_section .tab-content .titleRow h5:after,footer .newsletterForm input[type="submit"],.testimonial_section .testimonial_slider .testi_content .inner .postText,.testimonial_section .testimonial_slider .flex-control-nav li a.flex-active,.page_intro.row,.comments .comment .comment_body .heading:after,.comments .comment .comment_body .comment-reply-link, .comments .comment .comment_body .comment-edit-link,.reply_form .submit_btn,.contactForm .contact_form .submit_btn,.doctor_cv .cv_widget .heading:after,.service_tab #service_tab li.active a span,.service_tab .tab-content .tab-pane h3:after,#searchform input:focus,#searchform  #searchsubmit,.doctor_tab li a:hover,.doctor_tab li.active a,.wpb_accordion_section.group .wpb_accordion_header.ui-state-default a,.wpb_content_element .wpb_tabs_nav li a,.pagination a:hover, .pagination span:hover,.default.home .navbar .navbar-header button .icon-bar, .default.home2 .navbar .navbar-header button .icon-bar,.product-slide .owl-dots .owl-dot:hover span,.loadmore_btn,.product-shop .action .add-to-cart button.button,.cart-block-content button.button,.sidebar-block  button.button,.woocommerce-product-search input:focus,.woocommerce-product-search  #searchsubmit,.widget_product_tag_cloud .tagcloud a:hover,.widget_shopping_cart .buttons a,.cart-table button.button',
			
								'color' => '.team_section .tab-content .titleRow h2,.team_section .nav-tabs .media.active a,.team_section .nav-tabs .media.active a .media-body h5,.form_top_part h4,.widget ul li a:hover,.recent_posts .recent_post .media-body h5:hover,.recent_posts .recent_post .media-body p a:hover,.widget_tag_cloud a:hover,.related a,.pager .inner a:hover,.author_description .media-body .titleRow h2,.service_block h4:hover,.recent_post_home .media .media-body h4:hover,.recent_post_home .media .media-body .meta a:hover,.department_tab li a:hover,.department_tab li.active a,.our_depts_list .depts_list li a,.team_section .nav-tabs .media.active a .media-body h5,.team_section .tab-content .titleRow h2,.team_section_type2 .team_member .title_row .pos,.book_bannerType2 .view_all,.blog h3 i,.blog h3:hover,.blog .meta a:hover,.comments .comment .comment_body .heading h5,.contact_intro.row .inner .col-sm-7 .phone_fax,
								.contact_intro.row .inner .col-sm-7 .email_address,.doctor_details .doctor_about .heading h5,.team_section .nav-tabs .media:hover a .media-body h5,.product_list ul li .product-info .price-box .price,.product-shop .price-info .price-box .special-price, .product-shop .price-info .price-box ins,ul.product_list_widget .product-info .price-box .amount,.widget_shopping_cart .total .amount',
								
								'border-color' => '.checkout h3:before')
        ),
		array(
            'id'        => 'medicalpro_secondary_color',
            'type'      => 'color',
            'title'     => __( 'Secondary Color', 'medical-pro' ),
            'desc'      => 'default: #fe824c',
            'default'   => '#fe824c',
            'transparent' => false,
			'output'    => array('background-color' => '.default .navbar #main_nav .nav li.book a,.form_row .col-sm-3 input[type="submit"],.view_all,.search_form .input-group input:focus + span > button,.search_form .input-group span button:hover,.tabs.tabs-blue .nav-tabs li a:hover,.tabs.tabs-orrange .nav-tabs li a,.serviceDetailsSection .book_btn:hover,.appointment_home_form2 .form_inputs input[type="submit"],.book_banner,footer .newsletterForm input[type="submit"]:hover,.comments .comment .comment_body .comment-reply-link:hover,.reply_form .submit_btn:focus,.contactForm .contact_form .submit_btn:hover,.contactForm .contact_form .submit_btn:focus,#searchform input:focus + #searchsubmit,#searchform  #searchsubmit:hover,.loadmore_btn:hover, .loadmore_btn:focus,.product-shop .action .buy-now button.button,.cart-total .cart-block-content button.button,.checkout button.button, .checkout .button, .button.button-orange,.woocommerce-product-search input:focus + #searchsubmit,.woocommerce-product-search  #searchsubmit:hover,.widget_shopping_cart .buttons a.checkout',
			
								'color' => '.entry-content  blockquote a,.comment_body  blockquote a,.related a:hover,.book_banner .view_all,footer .msg.error,.breadcrumbRow .inner ul li,.blog blockquote a,.contactForm .contact_form label.error,.cart-table tbody tr td a,.widget_product_categories ul li a:hover,.widget_shopping_cart ul.product_list_widget .remove')
        ),
		array(
            'id'        => 'medicalpro_third_color',
            'type'      => 'color',
            'title'     => __( 'Third Color', 'medical-pro' ),
            'desc'      => 'default: #e5f0fb',
            'default'   => '#e5f0fb',
            'transparent' => false,
			'output'    => array('background-color' => '.page-links a,.search_form .input-group input,.widget_tag_cloud.widget .tagcloud a,.pagination a,
.pagination span,.pager .inner,.author_description,.recentpost_acc,.team_section.team_section_about,.comments .comment.depth-2.bypostauthor,.reply_form .form-control,.contact_intro.row .inner,.contactForm .contact_form .form-control,.doctor_cv,.service_tab #service_tab li a span,#searchform  input,#doctor_thumbnail,.widget_product_tag_cloud .tagcloud a,.woocommerce-product-search  input',
			
								'color' => '')
        ),
		array(
            'id'        => 'medicalpro_fourth_color',
            'type'      => 'color',
            'title'     => __( 'Fourth Color', 'medical-pro' ),
            'desc'      => 'default: #43b9f6',
            'default'   => '#43b9f6',
            'transparent' => false,
			'output'    => array('background-color' => '.form_top_part,.recent_post .inner .postText,.book_bannerType2,.service_tab .tab-content .tab-pane .ts',
					'color' => '.other_services .services_list i,.other_services .services_list a:hover,.serviceDetailsSection .post_list li i,.blog .meta a:last-child')
        ),
		
		
		
		
		 array(
            'id'        => 'medicalpro_change_font',
            'type'      => 'switch',
            'title'     => __( 'Do you want to change fonts?', 'medical-pro' ),
            'default'   => '1',
            'on'    => __( 'Yes', 'medical-pro' ),
            'off'   => __( 'No', 'medical-pro' )
        ),
        array(
            'id'        => 'medicalpro_headings_font',
            'type'      => 'typography',
            'title'     => __( 'Headings Font', 'medical-pro' ),
            'subtitle'  => __( 'Select the font for headings.', 'medical-pro' ),
            'desc'      => __( 'Lato is default font.', 'medical-pro' ),
            'required'  => array( 'medicalpro_change_font', '=', '1' ),
            'google'    => true,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'color'         => false,
            'text-align'    => false,
            'output'        => array( 'h1','h2','h3','h4','h5','h6', '.h1','.h2','.h3','.h4','.h5','.h6' ),
            'default'       => array(
                'font-family' => 'Lato',
                'google'      => true
            )
        ),
        array(
            'id'        => 'medicalpro_body_font',
            'type'      => 'typography',
            'title'     => __( 'Text Font', 'medical-pro' ),
            'subtitle'  => __( 'Select the font for body text.', 'medical-pro' ),
            'desc'      => __( 'Karla is default font.', 'medical-pro' ),
            'required'  => array( 'medicalpro_change_font', '=', '1' ),
            'google'    => true,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'color'         => false,
            'text-align'    => false,
            'output'        => array( 'body' ),
            'default'       => array(
                'font-family' => 'Karla',
                'google'      => true
            )
        ),
        array(
            'id'        => 'medicalpro_headings_color',
            'type'      => 'color',
            'output'    => array( 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6,.tt_timetable tbody tr td:first-child,.product_list ul li .product-info .product-name,.product-shop .product-name,.cart-table tbody tr td.item-desp' ),
            'title'     => __( 'Headings Color', 'medical-pro' ),
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
            'desc'  => 'default: #4a525d',
        ),
        array(
            'id'        => 'medicalpro_text_color',
            'type'      => 'color',
            'transparent' => false,
            'output'    => array( 'body' ),
            'title'     => __( 'Text Color', 'medical-pro' ),
            'desc'  => 'default: #4a525d',
            'default'   => '#4a525d',
            'validate'  => 'color'
        ),
        /*array(
            'id'        => 'medicalpro_blockquote_color',
            'type'      => 'color',
            'output'    => array( 'blockquote', 'blockquote p' ),
            'title'     => __('Quote Text Color', 'medical-pro'),
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
            'desc'  => 'default: #4a525d',
        ),*/
		array(
            'id'        => 'medicalpro_link_color',
            'type'      => 'link_color',
            'title'     => __( 'Link Color', 'medical-pro' ),
            'active'    => true,
            'output'    => array( 'a' ),
            'default'   => array(
                'regular' => '#404d5f',
                'hover'   => '#0186d5',
                'active'  => '#0186d5',
            )
        ),
        array(
            'id'        => 'medicalpro_content_link_color',
            'type'      => 'link_color',
            'title'     => __( 'Link Color in Page and Post Contents', 'medical-pro' ),
            'active'    => true,
            'output'    => array( '.default-page .entry-content a' ),
            'default'   => array(
                'regular' => '#0186d5',
                'hover'   => '#fe824c',
                'active'  => '#fe824c',
            )
        ),
      
        array(
            'id'        => 'medicalpro_quick_css',
            'type'      => 'ace_editor',
            'title'     => __( 'Quick CSS', 'medical-pro' ),
            'desc'      => __( 'You can use this box for some quick css changes. For big changes, Use the custom.css file in css folder. In case of child theme please use style.css file in child theme.', 'medical-pro' ),
            'mode'      => 'css',
            
        )

		    
		
) ) );

Redux::setSection( $opt_name, array(
    'title' => __( 'Book Appointment Form Style', 'medical-pro'),
    'id'    => 'bookappointment-style-options',
    'desc'  => __('This section contains Book Appointment Form theme styles options.', 'medical-pro' ),
    'subsection' => true,
    'fields'=> array (

		array(
            'id'        => 'medicalpro_bookappointment_color',
            'type'      => 'color',
            'title'     => __( 'Book Appointment Form Color', 'medical-pro' ),
            'desc'      => 'default: #57beee',
            'default'   => '#57beee',
            'transparent' => false,
			'output'    => array('background-color' => '.appointment_home_form2 .form_inputs .input_row')
        ),
		array(
            'id'        => 'medicalpro_bookappointment_field_separator_color',
            'type'      => 'color',
            'title'     => __( 'Book Appointment Form Field Separator Color', 'medical-pro' ),
            'desc'      => 'default: #48a8d4',
            'default'   => '#48a8d4',
            'transparent' => false,
			'output'    => array('border-bottom' => '.appointment_home_form2 .form_inputs .input_row')
        ),
		
		array(
            'id'        => 'medicalpro_bookappointment_label_color',
            'type'      => 'color',
            'title'     => __( 'Book Appointment Form label Color', 'medical-pro' ),
            'desc'      => 'default: #fff',
            'default'   => '#fff',
            'transparent' => false,
			'output'    => array('color' => '.appointment_home_form2 .form_inputs .input_row label')
        ),
			
		array(
            'id'        => 'medicalpro_bookappointment_field_text_color',
            'type'      => 'color',
            'title'     => __( 'Book Appointment Form Field Text Color', 'medical-pro' ),
            'desc'      => 'default: #347fa2',
            'default'   => '#347fa2',
            'transparent' => false,
			'output'    => array('color' => '.appointment_home_form2 .form_inputs .input_row .form-control,.appointment_home_form2 .form_inputs .input_row .form-control::-webkit-input-placeholder')
        ),
) ) );

/*-----------------------------------------------------------------------------------*/
/*	Header Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Header', 'medical-pro' ),
    'id'         => 'header',
    'subsection' => false,
    'fields'     => array(
	
    )
) );



/*-----------------------------------------------------------------------------------*/
/*	Header Style 1 Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Header 1', 'medical-pro' ),
    'id'         => 'header1',
    'subsection' => true,
    'fields'     => array(
		array(
			'id'       => 'display_top_header_bar_on_header1',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Top Header Bar on Header Style 1', 'medical-pro' ),
			'subtitle' => esc_html__( 'Do you want to display Top Header Bar on Header Style 1 ?', 'medical-pro' ),
			'default'  => 1,
			'on'       => 'Display',
			'off'      => 'Hide',
		),
	    array(
			'id'       => 'website_logo_for_header1',
			'type'     => 'media',
			'url'      => false,
			'title'    => esc_html__('Logo', 'medical-pro'),
			'subtitle' => esc_html__('Upload logo image for your Website. Otherwise site title will be displayed in place of logo.', 'medical-pro'),
            'default'  => array(
                'url' => get_template_directory_uri() . '/images/logo/3.png'
            )
		),
		array(
			'id'            => 'main_nav_top_margin_for_header1',
			'type'          => 'spacing',
			'output'        => array('nav.main-menu'), // An array of CSS selectors to apply this font style to
			'mode'          => 'margin',    // absolute, padding, margin, defaults to padding
			'all'           => true,        // Have one field that applies to all
			'right'         => false,     // Disable the right
			'bottom'        => false,     // Disable the bottom
			'left'          => false,     // Disable the left
			'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
			'title'         => esc_html__('Top Margin for Main Menu', 'medical-pro'),
			'desc'      => esc_html__('You can provide the top margin in pixels for main menu, To make it look well in the middle of your uploaded logo.', 'medical-pro'),
			'default'       => array(
				'margin-top'    => '0'
			)
		),
		array(
			'id'       => 'display_book_appointment_button_on_header1',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Book Appointment button on Header Style 1', 'medical-pro' ),
			'subtitle' => esc_html__( 'Do you want to display Book Appointment button on Header Style 1 ?', 'medical-pro' ),
			'default'  => 1,
			'on'       => 'Display',
			'off'      => 'Hide',
		),
		 array(
            'id' => 'book_appointment_button_text_header1',
            'type' => 'text',
            'title' => esc_html__('Book Appointment Button Text', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Book Appointment Button Name', 'medical-pro'),
            'required'  => array('display_book_appointment_button_on_header1', '=', '1'),
			'default'  => 'Book Appointment',
        ),
		array(
			'id'       => 'display_slider_or_image_on_header1',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Slider or Image on Header Style 1', 'medical-pro' ),
			'subtitle' => '',
			'default'  => 0,
			'on'       => 'Revolution Slide',
			'off'      => 'Image',
		),
		array(
			'id'       => 'revolution_slider_for_header1',
			'type'     => 'select',
			'title'    => esc_html__( 'Select Revolution Slider', 'medical-pro' ),
			'options'  => medical_pro_get_rev_slider_dropdown(),
			'default'  => '1',
			'required'  => array('display_slider_or_image_on_header1', '=', '1'),
        ),
		array(
			'id'       => 'banner_image_for_header1',
			'type'     => 'media',
			'title'    => esc_html__( 'Banner Image for Header Style 1', 'medical-pro' ),
		
			'subtitle' => esc_html__( 'Upload your image to display in Header Style 1', 'medical-pro' ),
			'required'  => array('display_slider_or_image_on_header1', '=', '0'),
			'default'  => array(
                'url' => get_template_directory_uri() . '/images/theme-options/page_intro.jpg'
            )
		),
        array(
            'id' => 'sub_title_for_header1',
            'type' => 'text',
            'title' => esc_html__('Sub Title', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Sub Title to display in header', 'medical-pro'),
            'required'  => array('display_slider_or_image_on_header1', '=', '0'),
        ),
        array(
            'id' => 'title_for_header1',
            'type' => 'text',
            'title' => esc_html__('Title', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Title to display in header', 'medical-pro'),
            'required'  => array('display_slider_or_image_on_header1', '=', '0'),
        ),
		array(
			'id'       => 'display_drop_on_header1',
			'type'     => 'switch',
			'title'    => esc_html__( 'Do you want to display drop on banner', 'medical-pro' ),
			'subtitle' => '',
			'default'  => 1,
			'on'       => 'Yes',
			'off'      => 'No',
			 'required'  => array('display_slider_or_image_on_header1', '=', '0'),
		),
		array(
			'id'       => 'banner_drop_image_for_header1',
			'type'     => 'media',
			'title'    => esc_html__('Drop Image for header', 'medical-pro' ),
		
			'subtitle' => esc_html__( 'Upload your image to display as drop on header', 'medical-pro' ),
			'required'  => array('display_drop_on_header1', '=', '1'),
			'default'  => array(
                'url' => get_template_directory_uri() . '/images/pages/page_drop.png'
            )
		),
		array(
            'id'        => 'banner_drop_image_color_for_header1',
            'type'      => 'color',
            'title'     => __( 'Header Drop Background Color', 'medical-pro' ),
            'desc'      => 'default: #2e9bdc',
            'default'   => '#2e9bdc',
            'transparent' => false,
			'required'  => array('display_drop_on_header1', '=', '1'),
        ),
		
    )
) );



/*-----------------------------------------------------------------------------------*/
/*	Header Style 2 Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Header 2', 'medical-pro' ),
    'id'         => 'header2',
    'subsection' => true,
    'fields'     => array(
		array(
			'id'       => 'display_top_header_bar_on_header2',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Top Header Bar on Header Style 2', 'medical-pro' ),
			'subtitle' => esc_html__( 'Do you want to display Top Header Bar on Header Style 2 ?', 'medical-pro' ),
			'default'  => 1,
			'on'       => 'Display',
			'off'      => 'Hide',
		),
	    array(
			'id'       => 'website_logo_for_header2',
			'type'     => 'media',
			'url'      => false,
			'title'    => esc_html__('Logo', 'medical-pro'),
			'subtitle' => esc_html__('Upload logo image for your Website. Otherwise site title will be displayed in place of logo.', 'medical-pro'),
            'default'  => array(
                'url'=> get_template_directory_uri() . '/images/logo/1.png'
            )
		),
		array(
			'id'            => 'main_nav_top_margin_for_header2',
			'type'          => 'spacing',
			'output'        => array('nav.main-menu'), // An array of CSS selectors to apply this font style to
			'mode'          => 'margin',    // absolute, padding, margin, defaults to padding
			'all'           => true,        // Have one field that applies to all
			'right'         => false,     // Disable the right
			'bottom'        => false,     // Disable the bottom
			'left'          => false,     // Disable the left
			'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
			'title'         => esc_html__('Top Margin for Main Menu', 'medical-pro'),
			'desc'      => esc_html__('You can provide the top margin in pixels for main menu, To make it look well in the middle of your uploaded logo.', 'medical-pro'),
			'default'       => array(
				'margin-top'    => '0'
			)
		),
		array(
			'id'       => 'display_book_appointment_button_on_header2',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Book Appointment button on Header Style 2', 'medical-pro' ),
			'subtitle' => esc_html__( 'Do you want to display Book Appointment button on Header Style 2 ?', 'medical-pro' ),
			'default'  => 1,
			'on'       => 'Display',
			'off'      => 'Hide',
		),
		 array(
            'id' => 'book_appointment_button_text_header2',
            'type' => 'text',
            'title' => esc_html__('Book Appointment Button Text', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Book Appointment Button Name', 'medical-pro'),
            'required'  => array('display_book_appointment_button_on_header2', '=', '1'),
			'default'  => 'Book Appointment',
        ),
		array(
			'id'       => 'display_slider_or_image_on_header2',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Slider or Image on Header Style 2', 'medical-pro' ),
			'default'  => 0,
			'on'       => 'Revolution Slide',
			'off'      => 'Image',
		),
		array(
			'id'       => 'revolution_slider_for_header2',
			'type'     => 'select',
			'title'    => esc_html__( 'Select Revolution Slider', 'medical-pro' ),
			'options'  => medical_pro_get_rev_slider_dropdown(),
			'default'  => '1',
			'required'  => array('display_slider_or_image_on_header2', '=', '1'),
        ),
		array(
			'id'       => 'banner_image_for_header2',
			'type'     => 'media',
			'title'    => esc_html__( 'Banner Image for Header Style 2', 'medical-pro' ),
			'subtitle' => esc_html__( 'Upload your image to display in Header Style 2', 'medical-pro' ),
			'required'  => array('display_slider_or_image_on_header2', '=', '0'),
			'default'  => array(
                'url' => get_template_directory_uri() . '/images/theme-options/page_intro.jpg'
            )
		),
        array(
            'id' => 'sub_title_for_header2',
            'type' => 'text',
            'title' => esc_html__('Sub Title', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Sub Title to display in header', 'medical-pro'),
            'required'  => array('display_slider_or_image_on_header2', '=', '0'),
        ),
        array(
            'id' => 'title_for_header2',
            'type' => 'text',
            'title' => esc_html__('Title', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Title to display in header', 'medical-pro'),
            'required'  => array('display_slider_or_image_on_header2', '=', '0'),
        ),
		array(
			'id'       => 'display_drop_on_header2',
			'type'     => 'switch',
			'title'    => esc_html__( 'Do you want to display drop on banner', 'medical-pro' ),
			'subtitle' => '',
			'default'  => 1,
			'on'       => 'Yes',
			'off'      => 'No',
			 'required'  => array('display_slider_or_image_on_header2', '=', '0'),
		),
		array(
			'id'       => 'banner_drop_image_for_header2',
			'type'     => 'media',
			'title'    => esc_html__('Drop Image for header', 'medical-pro' ),
		
			'subtitle' => esc_html__( 'Upload your image to display as drop on header', 'medical-pro' ),
			'required'  => array('display_drop_on_header2', '=', '1'),
			'default'  => array(
                'url' => get_template_directory_uri() . '/images/pages/page_drop.png'
            )
		),
		array(
            'id'        => 'banner_drop_image_color_for_header2',
            'type'      => 'color',
            'title'     => __( 'Header Drop Background Color', 'medical-pro' ),
            'desc'      => 'default: #2e9bdc',
            'default'   => '#2e9bdc',
            'transparent' => false,
			'required'  => array('display_drop_on_header2', '=', '1'),
        ),
		
    )
) );


/*-----------------------------------------------------------------------------------*/
/*	Header Style 3 Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Header 3', 'medical-pro' ),
    'id'         => 'header3',
    'subsection' => true,
    'fields'     => array(
		array(
			'id'       => 'display_top_header_bar_on_header3',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Top Header Bar on Header Style 3', 'medical-pro' ),
			'subtitle' => esc_html__( 'Do you want to display Top Header Bar on Header Style 3 ?', 'medical-pro' ),
			'default'  => 1,
			'on'       => 'Display',
			'off'      => 'Hide',
		),
	    array(
			'id'       => 'website_logo_for_header3',
			'type'     => 'media',
			'url'      => false,
			'title'    => esc_html__('Logo', 'medical-pro'),
			'subtitle' => esc_html__('Upload logo image for your Website. Otherwise site title will be displayed in place of logo.', 'medical-pro'),
            'default'  => array(
                'url'=> get_template_directory_uri() . '/images/logo/1.png'
            )
		),
		array(
			'id'            => 'main_nav_top_margin_for_header3',
			'type'          => 'spacing',
			'output'        => array('nav.main-menu'), // An array of CSS selectors to apply this font style to
			'mode'          => 'margin',    // absolute, padding, margin, defaults to padding
			'all'           => true,        // Have one field that applies to all
			'right'         => false,     // Disable the right
			'bottom'        => false,     // Disable the bottom
			'left'          => false,     // Disable the left
			'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
			'title'         => esc_html__('Top Margin for Main Menu', 'medical-pro'),
			'desc'      => esc_html__('You can provide the top margin in pixels for main menu, To make it look well in the middle of your uploaded logo.', 'medical-pro'),
			'default'       => array(
				'margin-top'    => '0'
			)
		),
		array(
			'id'       => 'display_book_appointment_button_on_header3',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Book Appointment button on Header Style 3', 'medical-pro' ),
			'subtitle' => esc_html__( 'Do you want to display Book Appointment button on Header Style 3 ?', 'medical-pro' ),
			'default'  => 1,
			'on'       => 'Display',
			'off'      => 'Hide',
		),
		 array(
            'id' => 'book_appointment_button_text_header3',
            'type' => 'text',
            'title' => esc_html__('Book Appointment Button Text', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Book Appointment Button Name', 'medical-pro'),
            'required'  => array('display_book_appointment_button_on_header3', '=', '1'),
			'default'  => 'Book Appointment',
        ),
		array(
			'id'       => 'display_slider_or_image_on_header3',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Slider or Image on Header Style 3', 'medical-pro' ),
			'default'  => 0,
			'on'       => 'Revolution Slide',
			'off'      => 'Image',
		),
		array(
			'id'       => 'revolution_slider_for_header3',
			'type'     => 'select',
			'title'    => esc_html__( 'Select Revolution Slider', 'medical-pro' ),
			'options'  => medical_pro_get_rev_slider_dropdown(),
			'default'  => '1',
			'required'  => array('display_slider_or_image_on_header3', '=', '1'),
        ),
		array(
			'id'       => 'banner_image_for_header3',
			'type'     => 'media',
			'title'    => esc_html__( 'Banner Image for Header Style 3', 'medical-pro' ),
			'subtitle' => esc_html__( 'Upload your image to display in Header Style 3', 'medical-pro' ),
			'required'  => array('display_slider_or_image_on_header3', '=', '0'),
			'default'  => array(
                'url' => get_template_directory_uri() . '/images/theme-options/page_intro.jpg'
            )
		),
        array(
            'id' => 'sub_title_for_header3',
            'type' => 'text',
            'title' => esc_html__('Sub Title', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Sub Title to display in header', 'medical-pro'),
            'required'  => array('display_slider_or_image_on_header3', '=', '0'),
        ),
        array(
            'id' => 'title_for_header3',
            'type' => 'text',
            'title' => esc_html__('Title', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Title to display in header', 'medical-pro'),
            'required'  => array('display_slider_or_image_on_header3', '=', '0'),
        ),
		array(
			'id'       => 'display_drop_on_header3',
			'type'     => 'switch',
			'title'    => esc_html__( 'Do you want to display drop on banner', 'medical-pro' ),
			'subtitle' => '',
			'default'  => 1,
			'on'       => 'Yes',
			'off'      => 'No',
			 'required'  => array('display_slider_or_image_on_header3', '=', '0'),
		),
		array(
			'id'       => 'banner_drop_image_for_header3',
			'type'     => 'media',
			'title'    => esc_html__('Drop Image for header', 'medical-pro' ),
		
			'subtitle' => esc_html__( 'Upload your image to display as drop on header', 'medical-pro' ),
			'required'  => array('display_drop_on_header3', '=', '1'),
			'default'  => array(
                'url' => get_template_directory_uri() . '/images/pages/page_drop.png'
            )
		),
		array(
            'id'        => 'banner_drop_image_color_for_header3',
            'type'      => 'color',
            'title'     => __( 'Header Drop Background Color', 'medical-pro' ),
            'desc'      => 'default: #2e9bdc',
            'default'   => '#2e9bdc',
            'transparent' => false,
			'required'  => array('display_drop_on_header3', '=', '1'),
        ),
		
    )
) );


/*-----------------------------------------------------------------------------------*/
/*	Default Blog Header
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Default Blog Header', 'medical-pro' ),
    'id'         => 'blog_header_default',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'display_top_header_bar_on_blog_header_default',
            'type'     => 'switch',
            'title'    => esc_html__( 'Display Top Header Bar on Default Blog Header', 'medical-pro' ),
            'subtitle' => esc_html__( 'Do you want to display Top Header Bar on Header Style 1 ?', 'medical-pro' ),
            'default'  => 1,
            'on'       => 'Display',
            'off'      => 'Hide',
        ),
        array(
            'id'       => 'website_logo_for_blog_header_default',
            'type'     => 'media',
            'url'      => false,
            'title'    => esc_html__('Logo', 'medical-pro'),
            'subtitle' => esc_html__('Upload logo image for your Website. Otherwise site title will be displayed in place of logo.', 'medical-pro'),
            'default'  => array(
                'url' => get_template_directory_uri() . '/images/logo/3.png'
            )
        ),
        array(
            'id'        => 'header_style_on_blog_header_default',
            'type'      => 'image_select',
            'title'     => esc_html__('Header Style', 'medical-pro'),
            'subtitle'  => esc_html__('Select Blog Header you want to display on blog if header is not select while page creation.', 'medical-pro'),
            'options'   => array(
                '1' => array('title' => esc_html__('1st Variation', 'medical-pro'), 'img' => get_template_directory_uri().'/images/theme-options/header_style1.jpg'),
                '2' => array('title' => esc_html__('2nd Variation', 'medical-pro'), 'img' => get_template_directory_uri().'/images/theme-options/header_style2.jpg'),
            ),
            'default'   => '1',
        ),
        array(
            'id'            => 'main_nav_top_margin_for_blog_header_default',
            'type'          => 'spacing',
            'output'        => array('nav.main-menu'), // An array of CSS selectors to apply this font style to
            'mode'          => 'margin',    // absolute, padding, margin, defaults to padding
            'all'           => true,        // Have one field that applies to all
            'right'         => false,     // Disable the right
            'bottom'        => false,     // Disable the bottom
            'left'          => false,     // Disable the left
            'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
            'title'         => esc_html__('Top Margin for Main Menu', 'medical-pro'),
            'desc'      => esc_html__('You can provide the top margin in pixels for main menu, To make it look well in the middle of your uploaded logo.', 'medical-pro'),
            'default'       => array(
                'margin-top'    => '0'
            )
        ),
        array(
            'id'       => 'display_book_appointment_button_on_blog_header_default',
            'type'     => 'switch',
            'title'    => esc_html__( 'Display Book Appointment button on Default Blog Header', 'medical-pro' ),
            'subtitle' => esc_html__( 'Do you want to display Book Appointment button on Default Blog Header ?', 'medical-pro' ),
            'default'  => 1,
            'on'       => 'Display',
            'off'      => 'Hide',
        ),
        array(
            'id'       => 'display_slider_or_image_on_blog_header_default',
            'type'     => 'switch',
            'title'    => esc_html__( 'Display Slider or Image on Default Blog Header', 'medical-pro' ),
            'subtitle' => '',
            'default'  => 0,
            'on'       => 'Revolution Slide',
            'off'      => 'Image',
        ),
        array(
            'id'       => 'revolution_slider_for_blog_header_default',
            'type'     => 'select',
            'title'    => esc_html__( 'Select Revolution Slider', 'medical-pro' ),
            'options'  => medical_pro_get_rev_slider_dropdown(),
            'default'  => '1',
            'required'  => array('display_slider_or_image_on_blog_header_default', '=', '1'),
        ),
        array(
            'id'       => 'banner_image_for_blog_header_default',
            'type'     => 'media',
            'title'    => esc_html__( 'Banner Image for Default Blog Header', 'medical-pro' ),
            'subtitle' => esc_html__( 'Upload your image to display in Default Blog Header', 'medical-pro' ),
            'required'  => array('display_slider_or_image_on_blog_header_default', '=', '0'),
            'default'  => array(
                'url' => get_template_directory_uri() . '/images/theme-options/page_intro.jpg'
            )
        ),
        array(
            'id' => 'sub_title_for_blog_header_default',
            'type' => 'text',
            'title' => esc_html__('Sub Title', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Sub Title to display in Default Blog Header', 'medical-pro'),
            'required'  => array('display_slider_or_image_on_blog_header_default', '=', '0'),
            'default' => esc_html__('BLOG NEW', 'medical-pro')
        ),
        array(
            'id' => 'title_for_blog_header_default',
            'type' => 'text',
            'title' => esc_html__('Title', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Title to display in Default Blog Header', 'medical-pro'),
            'required'  => array('display_slider_or_image_on_blog_header_default', '=', '0'),
            'default' => esc_html__("WHAT'S NEW IN MEDICALPRO", 'medical-pro')
        ),
		array(
			'id'       => 'display_drop_on_blog_header_default',
			'type'     => 'switch',
			'title'    => esc_html__( 'Do you want to display drop on banner', 'medical-pro' ),
			'subtitle' => '',
			'default'  => 1,
			'on'       => 'Yes',
			'off'      => 'No',
			 'required'  => array('display_slider_or_image_on_blog_header_default', '=', '0'),
		),
		array(
			'id'       => 'banner_drop_image_for_blog_header_default',
			'type'     => 'media',
			'title'    => esc_html__('Drop Image for header', 'medical-pro' ),
		
			'subtitle' => esc_html__( 'Upload your image to display as drop on header', 'medical-pro' ),
			'required'  => array('display_drop_on_blog_header_default', '=', '1'),
			'default'  => array(
                'url' => get_template_directory_uri() . '/images/pages/page_drop.png'
            )
		),
		array(
            'id'        => 'banner_drop_image_color_for_blog_header_default',
            'type'      => 'color',
            'title'     => __( 'Header Drop Background Color', 'medical-pro' ),
            'desc'      => 'default: #2e9bdc',
            'default'   => '#2e9bdc',
            'transparent' => false,
			'required'  => array('display_drop_on_blog_header_default', '=', '1'),
        ),

    )
) );



/*-----------------------------------------------------------------------------------*/
/*	Contact Us Page Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__('Contact Us', 'medical-pro'),
    'id'         => 'conactus',
    'subsection' => false,
    'fields'     => array(
        array(
            'id' => 'contactus_address',
            'type' => 'textarea',
            'title' => esc_html__('Address', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Address to display under address section', 'medical-pro'),
            'default' => 'Area 51 , Some near unknown,
USA 000000'
        ),
        array(
            'id' => 'contactus_email_address',
            'type' => 'text',
            'title' => esc_html__('Email Address', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Email Address to display under address section', 'medical-pro'),
            'default' => 'info@medicalprotheme.com'
        ),
        array(
            'id' => 'contactus_phone_number',
            'type' => 'text',
            'title' => esc_html__('Phone No.', 'medical-pro'),
            'subtitle' => esc_html__('Provide the Phone No. to display under address section', 'medical-pro'),
            'default' => '123 7890 456'
        ),
        array(
            'id' => 'contactus_display_map',
            'type' => 'switch',
            'title' => esc_html__('Display Map?', 'medical-pro'),
            'subtitle' => esc_html__('Do you want to display map?', 'medical-pro'),
            'default'  => 1,
            'on'       => 'Display',
            'off'      => 'Hide',
        ),
        array(
            'id' => 'contactus_latitude',
            'type' => 'text',
            'title' => esc_html__('Latitude', 'medical-pro'),
            'required'  => array('contactus_display_map', '=', '1'),
            'default' => '23.0300'
        ),
        array(
            'id' => 'contactus_longitude',
            'type' => 'text',
            'title' => esc_html__('Longitude', 'medical-pro'),
            'required'  => array('contactus_display_map', '=', '1'),
            'default' => '72.5800'
        ),
		 array(
            'id' => 'google_api_key',
            'type' => 'text',
            'title' => esc_html__('Google API Key', 'medical-pro'),
            'required'  => array('contactus_display_map', '=', '1'),
            'default' => ''
        )
    )
) );
/*-----------------------------------------------------------------------------------*/
/*	Service Page Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__('Services', 'medical-pro'),
    'id'         => 'services',
    'subsection' => false,
    'fields'     => array(
         array(
            'id' => 'display_service_read_more_button',
            'type' => 'switch',
            'title' => esc_html__('Display Read More button?', 'medical-pro'),
            'subtitle' => esc_html__('Do you want to display Read More button on home page service Style 2?', 'medical-pro'),
            'default'  => 1,
            'on'       => 'Display',
            'off'      => 'Hide',
        ),
		array(
            'id' => 'service_read_more_button_text',
            'type' => 'text',
            'title' => esc_html__('Read More Button Text', 'medical-pro'),
            'default' => 'Read More',
			'required'  => array('display_service_read_more_button', '=', '1'),
        ),
        array(
            'id' => 'trusted_service_label_text_on_image',
            'type' => 'text',
            'title' => esc_html__('Trusted Service Text', 'medical-pro'),
			'subtitle' => esc_html__('Provide text for Trusted Service label on image on Style 2?', 'medical-pro'),
            'default' => 'Trusted Services',
        ),
    )
) );

/*-----------------------------------------------------------------------------------*/
/*	Service Page Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__('Blogs', 'medical-pro'),
    'id'         => 'blogs',
    'subsection' => false,
    'fields'     => array(
        
		array(
            'id' => 'blog_read_more_button_text',
            'type' => 'text',
            'title' => esc_html__('Read More Button Text', 'medical-pro'),
            'default' => 'Read More',
        ),
        array(
            'id' => 'display_blog_author_name',
            'type' => 'switch',
            'title' => esc_html__('Display Blog Author name?', 'medical-pro'),
            'subtitle' => esc_html__('Do you want to display Author Name?', 'medical-pro'),
            'default'  => 1,
            'on'       => 'Display',
            'off'      => 'Hide',
        ),
		array(
            'id' => 'display_blog_created_date',
            'type' => 'switch',
            'title' => esc_html__('Display Blog Created Date?', 'medical-pro'),
            'subtitle' => esc_html__('Do you want to display Blog Created Date?', 'medical-pro'),
            'default'  => 1,
            'on'       => 'Display',
            'off'      => 'Hide',
        ),
		array(
            'id' => 'display_blog_comments_count',
            'type' => 'switch',
            'title' => esc_html__('Display Blog Comments Counts?', 'medical-pro'),
            'subtitle' => esc_html__('Do you want to display Blog Comments Count?', 'medical-pro'),
            'default'  => 1,
            'on'       => 'Display',
            'off'      => 'Hide',
        ),
    )
) );

/*-----------------------------------------------------------------------------------*/
/*	Gallery Page Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__('Gallery', 'medical-pro'),
    'id'         => 'gallery',
    'subsection' => false,
    'fields'     => array(
         array(
            'id' => 'display_related_gallery',
            'type' => 'switch',
            'title' => esc_html__('Display Related Gallery?', 'medical-pro'),
            'subtitle' => esc_html__('Do you want to display Related Gallery?', 'medical-pro'),
            'default'  => 1,
            'on'       => 'Display',
            'off'      => 'Hide',
        ),
		array(
            'id' => 'related_gallery_items_title',
            'type' => 'text',
            'title' => esc_html__('Related Gallery Items Title', 'medical-pro'),
            'default' => 'Related <Strong>Gallery Items</strong>',
			'required'  => array('display_related_gallery', '=', '1'),
        ),
        array(
            'id' => 'related_gallery_items_description',
            'type' => 'text',
            'title' => esc_html__('Related Gallery Items Description', 'medical-pro'),
            'default' => 'This text is about related gallery items and it is coming from theme options.',
			'required'  => array('display_related_gallery', '=', '1'),
        ),
    )
) );

/*-----------------------------------------------------------------------------------*/
/*	Form Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__('Forms', 'medical-pro' ),
    'id'         => 'form_email_template',
    'subsection' => false,
    'fields'     => array()
) );



/*-----------------------------------------------------------------------------------*/
/*	Book Appointment Form Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__('Book Appointment', 'medical-pro' ),
    'id'         => 'book_appointment_form_template',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'book_appointment_form_is_offline',
            'type'     => 'switch',
            'title'    => esc_html__('Book Appointment Type', 'medical-pro'),
            'default'  => 1,
            'on'       => esc_html__('Offline Booking', 'medical-pro'),
            'off'      => esc_html__('Online Booking', 'medical-pro'),
        ),
        array(
            'id'       => 'book_appointment_form_page_id',
            'type' => 'select',
            'placeholder' => 'Select Book Appointment Page',
            'data' => 'page',
            'title'    => esc_html__('Select Book Appointment Page', 'medical-pro'),
            'required'  => array('book_appointment_form_is_offline', '=', '0')
        ),
        array(
            'id'       => 'book_appointment_admin_body_tag',
            'type'     => 'info',
            'style'     => 'warning',
            'title'    => esc_html__('You can use bellow tags in message box, it will replace with user entered data.', 'medical-pro'),
            'desc'    => esc_html__('{#FIRST_NAME#}, {#LAST_NAME#}, {#EMAIL#}, {#PHONE#}, {#BOOKING_DATE#}, {#MESSAGE#}', 'medical-pro'),
            'required'  => array('book_appointment_form_is_offline', '=', '1')
        ),
        array(
            'id'       => 'book_appointment_admin_to_email',
            'type'     => 'text',
            'title'    => esc_html__('To Email', 'medical-pro' ),
            'default'   => 'info@medicalprotheme.com',
            'validate' => 'email',
            'required'  => array('book_appointment_form_is_offline', '=', '1')
        ),
        array(
            'id'       => 'book_appointment_admin_subject',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'medical-pro'),
            'default'   => esc_html__('{#FIRST_NAME#} {#LAST_NAME#} has booked appointment', 'medical-pro'),
            'required'  => array('book_appointment_form_is_offline', '=', '1')
        ),
        array(
            'id'       => 'book_appointment_admin_body',
            'type'     => 'editor',
            'title'    => esc_html__('Message', 'medical-pro'),
            'default'   => 'Dear admin,
{#FIRST_NAME#} {#LAST_NAME#} has booked appointment

<strong>Please find bellow details</strong>
Name: {#FIRST_NAME#} {#LAST_NAME#}
Email: {#EMAIL#}
Phone: {#PHONE#}
Date: {#BOOKING_DATE#}
Message:
{#MESSAGE#}',
            'required'  => array('book_appointment_form_is_offline', '=', '1')
        ),
        array(
            'id'       => 'book_appointment_send_to_client',
            'type'     => 'switch',
            'title'    => esc_html__('Send email to client?', 'medical-pro'),
            'default'  => 1,
            'on'       => 'Yes',
            'off'      => 'No',
            'required'  => array('book_appointment_form_is_offline', '=', '1')
        ),
        array(
            'id'       => 'book_appointment_client_from_email',
            'type'     => 'text',
            'title'    => esc_html__('From Email', 'medical-pro' ),
            'default'   => 'info@medicalprotheme.com',
            'validate' => 'email',
            'required'  => array('book_appointment_send_to_client', '=', '1')
        ),
        array(
            'id'       => 'book_appointment_client_subject',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'medical-pro' ),
            'default'   => esc_html__('Thank you for book appointment', 'medical-pro' ),
            'required'  => array('book_appointment_send_to_client', '=', '1')
        ),
        array(
            'id'       => 'book_appointment_client_body',
            'type'     => 'editor',
            'title'    => esc_html__('Message', 'medical-pro'),
            'default'    => 'Dear {#FIRST_NAME#} {#LAST_NAME#}

Thanks for your enquiry regarding book appointment with '.get_option('blogname').'

We are currently reviewing your enquiry and will contact you in the next two days.',
            'required'  => array('book_appointment_send_to_client', '=', '1')
        )
    )
) );



/*-----------------------------------------------------------------------------------*/
/*	Get in Touch Form Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__('Get in Touch', 'medical-pro' ),
    'id'         => 'get_in_touch_form_template',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'get_in_touch_admin_body_tag',
            'type'     => 'info',
            'style'     => 'warning',
            'title'    => esc_html__('You can use bellow tags in message box, it will replace with user entered data.', 'medical-pro'),
            'desc'    => esc_html__('{#FIRST_NAME#}, {#LAST_NAME#}, {#EMAIL#}, {#PHONE#}, {#MESSAGE#}', 'medical-pro'),
        ),
        array(
            'id'       => 'get_in_touch_admin_to_email',
            'type'     => 'text',
            'title'    => esc_html__('To Email', 'medical-pro' ),
            'default'   => 'info@medicalprotheme.com',
            'validate' => 'email'
        ),
        array(
            'id'       => 'get_in_touch_admin_subject',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'medical-pro'),
            'default'   => esc_html__('{#FIRST_NAME#} {#LAST_NAME#} has submitted contact form', 'medical-pro')
        ),
        array(
            'id'       => 'get_in_touch_admin_body',
            'type'     => 'editor',
            'title'    => esc_html__('Message', 'medical-pro'),
            'default'   => 'Dear admin,
{#FIRST_NAME#} {#LAST_NAME#} has submitted contact form

<strong>Please find bellow details</strong>
Name: {#FIRST_NAME#} {#LAST_NAME#}
Email: {#EMAIL#}
Phone: {#PHONE#}
Message:
{#MESSAGE#}'
        ),
        array(
            'id'       => 'get_in_touch_send_to_client',
            'type'     => 'switch',
            'title'    => esc_html__('Send email to client?', 'medical-pro'),
            'default'  => 1,
            'on'       => 'Yes',
            'off'      => 'No',
        ),
        array(
            'id'       => 'get_in_touch_client_from_email',
            'type'     => 'text',
            'title'    => esc_html__('From Email', 'medical-pro' ),
            'default'   => 'info@medicalprotheme.com',
            'validate' => 'email',
            'required'  => array('get_in_touch_send_to_client', '=', '1')
        ),
        array(
            'id'       => 'get_in_touch_client_subject',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'medical-pro' ),
            'default'   => esc_html__('Thank you for get in touch with us', 'medical-pro' ),
            'required'  => array('get_in_touch_send_to_client', '=', '1')
        ),
        array(
            'id'       => 'get_in_touch_client_body',
            'type'     => 'editor',
            'title'    => esc_html__('Message', 'medical-pro'),
            'default'    => 'Dear {#FIRST_NAME#} {#LAST_NAME#}

Thanks for your enquiry with '.get_option('blogname'),
            'required'  => array('get_in_touch_send_to_client', '=', '1')
        )
    )
) );



/*-----------------------------------------------------------------------------------*/
/*	Signup Newsletter Form Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__('Signup Newsletter', 'medical-pro' ),
    'id'         => 'newsletter_form_template',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'newsletter_admin_body_tag',
            'type'     => 'info',
            'style'     => 'warning',
            'title'    => esc_html__('You can use bellow tags in message box, it will replace with user entered data.', 'medical-pro'),
            'desc'    => esc_html__('{#NAME#}, {#EMAIL#}', 'medical-pro'),
        ),
        array(
            'id'       => 'newsletter_admin_to_email',
            'type'     => 'text',
            'title'    => esc_html__('To Email', 'medical-pro' ),
            'default'   => 'info@medicalprotheme.com',
            'validate' => 'email'
        ),
        array(
            'id'       => 'newsletter_admin_subject',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'medical-pro'),
            'default'   => esc_html__('{#NAME#} has signup newsletter', 'medical-pro')
        ),
        array(
            'id'       => 'newsletter_admin_body',
            'type'     => 'editor',
            'title'    => esc_html__('Message', 'medical-pro'),
            'default'   => 'Dear admin,
{#NAME#} has submitted signup newsletter form

<strong>Please find bellow details</strong>
Name: {#NAME#}
Email: {#EMAIL#}'
        ),
        array(
            'id'       => 'newsletter_send_to_client',
            'type'     => 'switch',
            'title'    => esc_html__('Send email to client?', 'medical-pro'),
            'default'  => 1,
            'on'       => 'Yes',
            'off'      => 'No',
        ),
        array(
            'id'       => 'newsletter_client_from_email',
            'type'     => 'text',
            'title'    => esc_html__('From Email', 'medical-pro' ),
            'default'   => 'info@medicalprotheme.com',
            'validate' => 'email',
            'required'  => array('newsletter_send_to_client', '=', '1')
        ),
        array(
            'id'       => 'newsletter_client_subject',
            'type'     => 'text',
            'title'    => esc_html__('Subject', 'medical-pro' ),
            'default'   => esc_html__('Thank you for signup newsletter', 'medical-pro' ),
            'required'  => array('newsletter_send_to_client', '=', '1')
        ),
        array(
            'id'       => 'newsletter_client_body',
            'type'     => 'editor',
            'title'    => esc_html__('Message', 'medical-pro'),
            'default'    => 'Dear {#NAME#}

Thanks for signup newsletter with '.get_option('blogname'),
            'required'  => array('newsletter_send_to_client', '=', '1')
        )
    )
) );



/*-----------------------------------------------------------------------------------*/
/*	Call to Action Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title'      => esc_html__('Call To Action', 'medical-pro'),
    'heading' 	 => esc_html__('Call to Action details', 'medical-pro'),
    'subsection' => false,
    'fields'     => array(
        array(
            'id'       => 'display_call_to_action',
            'type'     => 'switch',
            'title'    => esc_html__( 'Call to Action bar', 'medical-pro' ),
            'subtitle' => esc_html__( 'Do you want to display Call To Action bar ?', 'medical-pro' ),
            'default'  => 1,
            'on'       => 'Display',
            'off'      => 'Hide'
        ),
        array(
            'id'        => 'call_to_action_variation',
            'type'      => 'image_select',
            'title'     => esc_html__('Call To Action Bar Design', 'medical-pro'),
            'subtitle'  => esc_html__('Select the Call to action bar design variation that you want to use.', 'medical-pro'),
            'options'   => array(
                '1' => array('title' => esc_html__('1st Variation', 'medical-pro'), 'img' => get_template_directory_uri().'/images/theme-options/call_to_action_1.jpg'),
                '2' => array('title' => esc_html__('2nd Variation', 'medical-pro'), 'img' => get_template_directory_uri().'/images/theme-options/call_to_action_2.jpg'),
            ),
            'required'  => array('display_call_to_action', '=', '1'),
            'default'   => '1',
        ),
        array(
            'id'		=>'call_to_action_subtitle',
            'type' 		=> 'text',
            'title' 	=> esc_html__('Call To Action Sub Title', 'medical-pro'),
            'subtitle' 	=> esc_html__('Provide your sub-title text to display on Call TO Action Bar.', 'medical-pro'),
            'default' 	=> esc_html__('BOOKING IS EASY','medical-pro'),
            'required'  => array('call_to_action_variation', '=', '2'),
        ),
        array(
            'id'		=>'call_to_action_title',
            'type' 		=> 'text',
            'title' 	=> esc_html__('Call To Action Title', 'medical-pro'),
            'subtitle' 	=> esc_html__('Provide your title text to display on Call TO Action Bar.', 'medical-pro'),
            'default' 	=> esc_html__('ONLINE HASSLE FREE APPOINTMENT BOOKING', 'medical-pro'),
        ),
        array(
            'id'		=>'call_to_action_description',
            'type' 		=> 'textarea',
            'title' 	=> esc_html__('Call To Action Description', 'medical-pro'),
            'subtitle' 	=> esc_html__('Provide your description to display on Call TO Action Bar.', 'medical-pro'),
            'default' 	=> esc_html__('online hassle free appointment booking online hassle free appointment booking online hassle free appointment booking online hassle free appointment booking', 'medical-pro'),

        ),
        array(
            'id'		=>'call_to_action_button_text',
            'type' 		=> 'text',
            'title' 	=> esc_html__('Call To Action Button Text', 'medical-pro'),
            'subtitle' 	=> esc_html__('Provide your Button text to display on Call TO Action Bar', 'medical-pro'),
            'default' 	=> esc_html__('BOOK YOUR APPOINTMENT', 'medical-pro'),

        ),
    )
) );



/*-----------------------------------------------------------------------------------*/
/*	Footer Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
	'title' => esc_html__('Footer', 'medical-pro'),
	'id'    => 'footer',
	'desc' => esc_html__('This section contains footer related options.', 'medical-pro'),
	'fields' => array(
		array(
			'id'		=>'footer_page_id',
			'type' 		=> 'select',
			'data' 		=> 'page',
			'title' 	=> esc_html__('Select Footer', 'medical-pro'),
			'placeholder' 	=> esc_html__('Select Footer', 'medical-pro')
		),
        array(
            'id'		=>'footer_copyright',
            'type' 		=> 'text',
            'title' 	=> esc_html__('Copyright Text', 'medical-pro'),
            'default'   => esc_html__('&copy; MEDICALPRO 2015. Made with love for great people.', 'medical-pro'),
        ),
        array(
			'id' 		=> 'display_footer_social_icons',
			'type' 		=> 'switch',
			'title' 	=> esc_html__('Social Icons', 'medical-pro'),
			'subtitle' 	=> esc_html__('Do you want to display social icons in footer ?', 'medical-pro'),
			'default' 	=> '1',
			'on' 		=> esc_html__('Display','medical-pro'),
			'off' 		=> esc_html__('Hide','medical-pro')
		),
		array(
			'id'		=>'skype_username',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Skype Username', 'medical-pro'),
			'subtitle' 	=> esc_html__('Provide skype username to display its icon.', 'medical-pro'),
			'required'  => array('display_footer_social_icons', '=', '1'),
            'default'   => 'medical-pro'
		),
		array(
			'id'		=>'twitter_url',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Twitter', 'medical-pro'),
			'subtitle' 	=> esc_html__('Provide twitter url to display its icon.', 'medical-pro'),
			'required'  => array('display_footer_social_icons', '=', '1'),
            'default'   => 'https://www.twitter.com/'
		),
		array(
			'id'		=>'facebook_url',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Facebook', 'medical-pro'),
			'subtitle' 	=> esc_html__('Provide facebook url to display its icon.', 'medical-pro'),
			'required'  => array('display_footer_social_icons', '=', '1'),
            'default'   => 'https://www.facebook.com/'
		),
		array(
			'id'		=>'google_url',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Google+', 'medical-pro'),
			'subtitle' 	=> esc_html__('Provide google+ url to display its icon.', 'medical-pro'),
			'required'  => array('display_footer_social_icons', '=', '1'),
            'default'   => 'https://plus.google.com/'
		),
		array(
			'id'		=>'linkedin_url',
			'type' 		=> 'text',
			'title' 	=> esc_html__('LinkedIn', 'medical-pro'),
			'subtitle' 	=> esc_html__('Provide LinkedIn url to display its icon.', 'medical-pro'),
			'required'  => array('display_footer_social_icons', '=', '1'),
            'default'   => 'https://www.linkedin.com/'
		),
		array(
			'id'		=>'pinterest_url',
			'type' 		=> 'text',
			'title' 	=> esc_html__('Pinterest', 'medical-pro'),
			'subtitle' 	=> esc_html__('Provide Pinterest url to display its icon.', 'medical-pro'),
			'required'  => array('display_footer_social_icons', '=', '1'),
            'default'   => 'https://www.pinterest.com/'
		),
        array(
            'id'		=>'instagram_url',
            'type' 		=> 'text',
            'title' 	=> esc_html__('Instagram', 'medical-pro'),
            'subtitle' 	=> esc_html__('Provide Instagram url to display its icon.', 'medical-pro'),
            'required'  => array('display_footer_social_icons', '=', '1'),
            'default'   => 'https://instagram.com/'
        ),
		array(
			'id'		=>'youtube_url',
			'type' 		=> 'text',
			'title' 	=> esc_html__('YouTube', 'medical-pro'),
			'subtitle' 	=> esc_html__('Provide YouTube url to display its icon.', 'medical-pro'),
			'required'  => array('display_footer_social_icons', '=', '1'),
            'default'   => 'https://www.youtube.com/'
		),
		array(
			'id'		=>'rss_url',
			'type' 		=> 'text',
			'title' 	=> esc_html__('RSS', 'medical-pro'),
			'subtitle' 	=> esc_html__('Provide RSS feed url to display its icon.', 'medical-pro'),
			'required'  => array('display_footer_social_icons', '=', '1'),
            'default'   => esc_url(site_url())
		)
	)
));



/*-----------------------------------------------------------------------------------*/
/*	General Options
/*-----------------------------------------------------------------------------------*/
Redux::setSection( $opt_name, array(
    'title' => esc_html__('General', 'medical-pro'),
    'id'    => 'general',
    'desc' => esc_html__('This section contains general options.', 'medical-pro'),
    'fields' => array(
        array(
            'id'		=>'blog_style',
            'type' 		=> 'select',
            'title' 	=> esc_html__('Select Blog Style', 'medical-pro'),
            'placeholder' 	=> esc_html__('Select Blog Style', 'medical-pro'),
            'desc' 	    => esc_html__('Select Blog style for display post', 'medical-pro'),
            'options'   => array('1' => 'Style 1', '2' => 'Style 2'),
            'default'  => '1',
        ),
        array(
            'id'		=>'blog_page_id',
            'type' 		=> 'select',
            'data' 		=> 'page',
            'title' 	=> esc_html__('Select Blog Page', 'medical-pro'),
            'placeholder' 	=> esc_html__('Select Blog Page', 'medical-pro'),
            'desc' 	    => esc_html__('Select Blog page for View all post url', 'medical-pro')
        ),
        array(
            'id'		=>'doctor_page_id',
            'type' 		=> 'select',
            'data' 		=> 'page',
            'title' 	=> esc_html__('Select Doctor Page', 'medical-pro'),
            'placeholder' 	=> esc_html__('Select Doctor Page', 'medical-pro'),
            'desc' 	    => esc_html__('Select Doctor page for View all doctors', 'medical-pro'),
        ),
        array(
            'id'		=>'about_page_id',
            'type' 		=> 'select',
            'data' 		=> 'page',
            'title' 	=> esc_html__('Select About MedicalPro Page', 'medical-pro'),
            'placeholder' 	=> esc_html__('Select About MedicalPro Page', 'medical-pro'),
            'desc' 	    => esc_html__('Select About MedicalPro page', 'medical-pro'),
        )
    )
));



/*-----------------------------------------------------------------------------------*/
/*	Remove the demo link and the notice of integrated demo from the redux-framework plugin
/*-----------------------------------------------------------------------------------*/
if(!function_exists('redux_framework_remove_demo'))
{
    function redux_framework_remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
}
