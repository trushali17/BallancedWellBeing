<?php

/*-----------------------------------------------------------------------------------*/
/*	WP Enqueue CSS and JavaScript
/*-----------------------------------------------------------------------------------*/
if(!function_exists('medical_pro_custom_page_style'))
{

    function medical_pro_custom_page_style()
    {
        global $medicalpro_options;

        wp_enqueue_style('base-style', get_stylesheet_uri(), false, null );
        wp_enqueue_style('google-font-karla', 'http://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic', false, null );
        wp_enqueue_style('google-font-lato', 'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic', false, null );
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false, null);
        wp_enqueue_style('bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array('bootstrap'), null);
		wp_enqueue_style('flexslider', get_template_directory_uri() . '/vendors/flexslider/flexslider.css', false, 'all');
		wp_enqueue_style('swipebox', get_template_directory_uri() . '/vendors/flexslider/swipebox.css', false, 'all');
        wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', false, null);
        wp_enqueue_style('bootstrap-datepicker', get_template_directory_uri() . '/vendors/bootstrap-datepicker/css/datepicker3.css', false, 'screen');
        wp_enqueue_style('medical-pro-style', get_template_directory_uri() . '/css/default/style.css', false, null);
        wp_enqueue_style('medical-pro-responsive-style', get_template_directory_uri() . '/css/responsive/responsive.css', false, null);
        wp_enqueue_style('carousel-theme', get_template_directory_uri().'/vendors/owl.carousel/css/owl.theme.default.min.css', false, null);
        wp_enqueue_style('carousel', get_template_directory_uri().'/vendors/owl.carousel/css/owl.carousel.min.css', false, null);
		wp_enqueue_style('animations', get_template_directory_uri() . '/css/animations.css', false, null);

        wp_enqueue_script('jquery', get_template_directory_uri().'/js/jquery-2.1.3.min.js', null, null, true, true);
        wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), null, true, true);
        wp_enqueue_script('bootstrap-datepicker', get_template_directory_uri().'/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js', array('jquery', 'bootstrap'), null, true, true);
        wp_enqueue_script('flexslider', get_template_directory_uri().'/vendors/flexslider/jquery.flexslider-min.js', array('jquery'), null, true, true);
    	wp_enqueue_script('swipebox', get_template_directory_uri().'/vendors/flexslider/jquery.swipebox.min.js', array('jquery'), null, true, true);
        wp_enqueue_script('carousel', get_template_directory_uri().'/vendors/owl.carousel/js/owl.carousel.min.js', array('jquery'), null, true, true);
	    wp_register_script('jplayer', get_template_directory_uri().'/js/jquery.jplayer.min.js', array('jquery'), null, true, true);
        wp_register_script('jquery-form', get_template_directory_uri().'/js/jquery.form.js', array('jquery'), null, true, true);
        wp_register_script('form-validation', get_template_directory_uri().'/js/jquery.validate.min.js', array('jquery'), null, true, true);
        wp_register_script('medical-pro-contact', get_template_directory_uri().'/js/contact.js', array('jquery', 'jquery-form', 'form-validation'), null, true, true);
		wp_enqueue_script('jquery-isotope', get_template_directory_uri().'/js/jquery.isotope.min.js', array('jquery'), null, true, true);
		wp_enqueue_script('jquery-appear', get_template_directory_uri().'/js/jquery.appear.js', array('jquery'), null, true, true);
		if(!empty($medicalpro_options['google_api_key']))
		{
		wp_register_script('google-map-api','http://maps.google.com/maps/api/js?key='.$medicalpro_options['google_api_key'].'&sensor=true&ver=4.3.1', array('jquery'), null, true, true);
		}
		else
		{
			wp_register_script('google-map-api','http://maps.google.com/maps/api/js?sensor=true&ver=4.3.1', array('jquery'), null, true, true);
		}
        wp_register_script('google-map', get_template_directory_uri().'/js/google-map.js', array('jquery', 'google-map-api'), null, true, true);
        wp_localize_script('google-map', 'MAP', array('lat' => $medicalpro_options['contactus_latitude'], 'lng' => $medicalpro_options['contactus_longitude'], 'marker' => get_template_directory_uri().'/images/map-marker.png'));
        wp_register_script('medical-pro-theme-js', get_template_directory_uri().'/js/theme.js', array('jquery', 'bootstrap'), null, true, true);
        wp_localize_script('medical-pro-theme-js', 'MyAjax', array('ajaxurl' => esc_url(admin_url('admin-ajax.php'))));
        wp_enqueue_script('medical-pro-theme-js');
		
		if(is_singular())
        {
            wp_enqueue_script('comment-reply');
        }
    }

}
add_action( 'wp_enqueue_scripts', 'medical_pro_custom_page_style',155 );

/*-----------------------------------------------------------------------------------*/
/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/
if (!function_exists('medical_pro_admin_script')) {
    function medical_pro_admin_script($hook){
        if ($hook == 'post.php' || $hook == 'post-new.php') {
            $post_id = intval(@$_GET['post']);
            if ("post" == get_post_type($post_id)) {
                wp_enqueue_script('medical-pro-admin-js', get_template_directory_uri() . '/js/admin.js', 'jquery');
               
               
            }
        }
    }
}
add_action('admin_enqueue_scripts', 'medical_pro_admin_script', 10, 1);

//Get revolution slider drop down options
if(!function_exists('medical_pro_get_rev_slider_dropdown'))
{
    function medical_pro_get_rev_slider_dropdown()
    {
        $sliders = array();

        if (class_exists('RevSliderAdmin')) {
            $slider = new RevSlider();
            $arrSliders = $slider->getArrSlidersShort();
            if(!empty($arrSliders))
            {
                foreach($arrSliders as $id => $title)
                {
                    $slider = new RevSlider();
                    $slider->initByID($id);

                    $sliders[$slider->getAlias()] = $title;
                }
            }
        }
        return $sliders;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Medical Pro Header
/*-----------------------------------------------------------------------------------*/

if(!function_exists('medical_pro_get_header'))
{
    /**
     * Get theme header
     */
    function medical_pro_get_header()
    {
        global $medicalpro_options;

        $slider_alias = $slider_img = $title = $sub_title= $header_style = false;

        if(is_page() || is_single() )
        {
            global $post;
            $header_style = get_post_meta($post->ID, 'header_style', true);
			
            $slider_alias = get_post_meta($post->ID, 'slider_alias', true);
            if(!$slider_alias)
            {
                $slider_img = get_post_meta($post->ID, 'header_image', true);
                $title = get_post_meta($post->ID, 'title', true);
                $sub_title = get_post_meta($post->ID, 'sub_title', true);
            }

        }

        $default_header_on_page = (is_singular('post') || is_page_template('template-blog-1.php') || is_page_template('template-blog-2.php')) ? $medicalpro_options['header_style_on_blog_header_default'] : $medicalpro_options['default_header_on_page'];
        $header_style = $header_style ? $header_style : $default_header_on_page;

        ?>

        <?php if($medicalpro_options["display_top_header_bar_on_header{$header_style}"]) : ?>
        <section class="row top_bar">
            <div class="container">
                <div class="row m0">
					
                   
				   <?php 
						
						if($medicalpro_options["display_scheduletext_or_social_icon_on_top"] == '1')
						{
							if($schedule_text = $medicalpro_options["schedule_text_for_header"]) : ?>
								<div class="fleft schedule">
								<?php
								if(!empty($medicalpro_options["schedule_text_label"]))
								{
										echo wp_kses($medicalpro_options["schedule_text_label"] , array('i' => array(
											'class' => array()),
											'strong' => array(),
											'b' => array()));
								} ?>

								<?php echo esc_html($schedule_text); ?></div><?php endif; 
						}
						else 
						{ ?>
							
							<?php if($medicalpro_options['display_header_social_icons'] == '1') : ?>
								<ul class="list-inline social_menu m0 fleft">
									<?php
									$social_urls = array(
										'fa-skype' => $medicalpro_options['skype_username'],
										'fa-twitter' => $medicalpro_options['twitter_url'],
										'fa-facebook' => $medicalpro_options['facebook_url'],
										'fa-google' => $medicalpro_options['google_url'],
										'fa-linkedin' => $medicalpro_options['linkedin_url'],
										'fa-pinterest' => $medicalpro_options['pinterest_url'],
										'fa-instagram' => $medicalpro_options['instagram_url'],
										'fa-youtube' => $medicalpro_options['youtube_url'],
										'fa-rss' => $medicalpro_options['rss_url'],
									);

									foreach($social_urls as $icon => $url)
									{
										if($url)
										{
											if($icon == 'fa-skype')
											{
												echo '<li><a href="skype:'.$url.'?chat" target="_blank"><i class="fa '.$icon.'"></i></a></li>';
											}
											else
											{
												echo '<li><a href="'.esc_url($url).'" target="_blank"><i class="fa '.$icon.'"></i></a></li>';
											}
										}
										
									}
									?>
								</ul>
								<?php endif; ?>
						 <?php  } ?>
				   
                    <div class="fright contact_info">
                        <?php if($email = $medicalpro_options["email_for_header"]) : ?><div class="fleft email"><i class="fa fa-envelope-o"></i> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></div><?php endif; ?>
                        <?php if($phone = $medicalpro_options["phoneno_for_header"]) : ?><div class="fleft phone"><i class="fa fa-phone"></i> <strong><?php echo esc_html($phone); ?></strong></div><?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php $logo_url = $medicalpro_options["website_logo_for_header{$header_style}"]['url'] ? $medicalpro_options["website_logo_for_header{$header_style}"]['url'] : get_stylesheet_directory_uri()."/images/logo/3.png"; ?>

		
		<?php $headerClass = '';
		if($header_style == 1)
			$headerClass = "navbar2";
		else if($header_style == 2)
			$headerClass = "navbar3";
		else
			$headerClass = "";
		
		?>
		
		
		
        <nav class="navbar navbar-default navbar-static-top <?php echo $headerClass; ?>">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url($logo_url); ?>" alt=""></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main_nav" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php if($medicalpro_options["display_book_appointment_button_on_header{$header_style}"]) : ?>
                        <?php if($medicalpro_options["book_appointment_form_is_offline"]) { ?>
                        <a href="javascript:;" class="navbar-toggle visible-xs" data-toggle="modal" data-target="#appointmefnt_form_pop"><?php echo $medicalpro_options["book_appointment_button_text_header{$header_style}"]; ?></a>
                        <?php } elseif($medicalpro_options["book_appointment_form_page_id"]) { ?>
                        <a href="<?php echo esc_url(get_the_permalink($medicalpro_options["book_appointment_form_page_id"])); ?>" class="navbar-toggle visible-xs"><?php echo $medicalpro_options["book_appointment_button_text_header{$header_style}"]; ?></a>
                        <?php } ?>
                    <?php endif; ?>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="main_nav"<?php echo $medicalpro_options["main_nav_top_margin_for_header{$header_style}"]['margin-top'] ? ' style="margin-top:'.esc_attr($medicalpro_options["main_nav_top_margin_for_header{$header_style}"]['margin-top']).'"' : ''; ?>>
                    <?php if($medicalpro_options["display_book_appointment_button_on_header{$header_style}"]) : ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="hidden-xs book">
                                <?php if($medicalpro_options["book_appointment_form_is_offline"]) { ?>
                                    <a href="javascript:;" data-toggle="modal" data-target="#appointmefnt_form_pop"><?php echo $medicalpro_options["book_appointment_button_text_header{$header_style}"]; ?></a>
                                <?php } elseif($medicalpro_options["book_appointment_form_page_id"]) { ?>
                                    <a href="<?php echo esc_url(get_the_permalink($medicalpro_options["book_appointment_form_page_id"])); ?>"><?php echo $medicalpro_options["book_appointment_button_text_header{$header_style}"]; ?></a>
                                <?php } ?>
                                </li>
                        </ul>
                    <?php endif; ?>

                    <?php
                    // Primary navigation menu.
                    wp_nav_menu(array(
                        'container' => '',
                        'fallback_cb' => 'medical_pro_default_top_menu',
                        'menu_class' => 'nav navbar-nav navbar-right',
                        'theme_location' => 'top',
                        'depth' => 3,
                        'walker' => new wp_bootstrap_navwalker()
                    ));
                    ?>

                </div>

            </div><!-- /.container -->
        </nav>

        <?php
        if(!$slider_alias && !$slider_img)
        {
            if(is_singular('post') || is_page_template('template-blog-1.php') || is_page_template('template-blog-2.php'))
            {
                if($medicalpro_options["display_slider_or_image_on_blog_header_default"] == '0')
                {
                    $slider_img = $medicalpro_options["banner_image_for_blog_header_default"]["url"];
                    $title = $medicalpro_options["title_for_blog_header_default"];
                    $sub_title = $medicalpro_options["sub_title_for_blog_header_default"];
                    $options = array('slider_img' => $slider_img, 'title' => $title, 'sub_title' => $sub_title);
					
					 if($medicalpro_options["display_drop_on_blog_header_default"] == '1')
					 {
						 $drop_img = $medicalpro_options["banner_drop_image_for_blog_header_default"]['url'];
						 $drop_color = isset($medicalpro_options["banner_drop_image_color_for_blog_header_default"]) ? $medicalpro_options["banner_drop_image_color_for_blog_header_default"] : '';
						 $options = array('slider_img' => $slider_img, 'title' => $title, 'sub_title' => $sub_title,'drop_img' => $drop_img, 'drop_color' =>$drop_color);
					 }
					 else
					 {
						  $options = array('slider_img' => $slider_img, 'title' => $title, 'sub_title' => $sub_title,'drop_img' => '', 'drop_color' =>'');
					 }
					
                } else if($medicalpro_options["display_slider_or_image_on_blog_header_default"] == '1')
                {
                    $slider_alias = $medicalpro_options["revolution_slider_for_headerblog_header_default"];
                    $options = array('slider_alias' => $slider_alias);
                }
            } else {
                $options = medical_pro_get_default_header($header_style);
            }

            if(!empty($options))
            {
                foreach($options as $key => $val)
                {
                    if(($key == 'title' && $title) || ($key == 'sub_title' && $sub_title))
                    {
                        continue;
                    }

                    $$key = $val;
                }
            }

        } 
		
		
        if($slider_alias)
        {
            if(function_exists('putRevSlider'))
            {
                putRevSlider($slider_alias); 
            }
        } else if($slider_img && $medicalpro_options["display_payintro_header"] == '1')
        { 
			$slider_img = is_array($slider_img) ? $slider_img['url'][0] : $slider_img;
			if($drop_img)
			{
				$drop_img = is_array($drop_img) ? $drop_img['url'][0] : $drop_img;
			}
            ?>
            <section class="row page_intro">
                <div class="row m0 inner">
                    <?php if($title || $sub_title) : ?>
                        <div class="container">
                            <div class="row">
                                <?php if($sub_title) : ?><h5><?php echo esc_html($sub_title); ?></h5><?php endif; ?>
                                <?php if($title) : ?><h2><?php echo esc_html($title); ?></h2><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
            <style>
                .page_intro.row .inner:before {
                    background: url(<?php echo esc_url($slider_img); ?>) no-repeat scroll center 0;
                    -webkit-background-size: cover;
                    background-size: cover;
                    height: 100%;
                    content: '';
                    width: 100%;
                    position: absolute;
                    top: 0;
                    z-index: 0;
                    opacity: 0.2;
                }
				.page_intro.row .inner:after {
					  content: '';
					  width: 60px;
					  height: 60px;
					  background: url(<?php echo esc_url($drop_img); ?>) no-repeat scroll center center <?php echo esc_url($drop_color); ?>;
					  border-radius: 100%;
					  position: absolute;
					  bottom: -30px;
					  left: 50%;
					  left: -webkit-calc(50% - 30px);
					  left: -moz-calc(50% - 30px);
					  left: calc(50% - 30px);
				}
            </style>
			
        <?php
        } else if($medicalpro_options["display_payintro_header"] == '1') {
            ?>
            <section class="row page_intro">
                <div class="row m0 inner">
                        <div class="container">
                            <div class="row">
                            </div>
                        </div>
                </div>
            </section>
            <style>
                .page_intro {
                    background: #2E9BDC !important;
                }
                .page_intro.row .inner:before {
                    background: none;
                }
            </style>
            <?php
        }

        ?>

    <?php
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Medical Pro Default Header
/*-----------------------------------------------------------------------------------*/
if(!function_exists('medical_pro_get_default_header'))
{
    function medical_pro_get_default_header($header_style = 1)
    {
        global $medicalpro_options;

        if($medicalpro_options["display_slider_or_image_on_header{$header_style}"] == '0')
        {
            $slider_img = $medicalpro_options["banner_image_for_header{$header_style}"]['url'];
            $title = isset($medicalpro_options["title_for_header{$header_style}"]) ? $medicalpro_options["title_for_header{$header_style}"] : '';
            $sub_title = isset($medicalpro_options["sub_title_for_header{$header_style}"]) ? $medicalpro_options["sub_title_for_header{$header_style}"] : '';
			
			 if($medicalpro_options["display_drop_on_header{$header_style}"] == '1')
			 {
				 $drop_img = $medicalpro_options["banner_drop_image_for_header{$header_style}"]['url'];
				 $drop_color = isset($medicalpro_options["banner_drop_image_color_for_header{$header_style}"]) ? $medicalpro_options["banner_drop_image_color_for_header{$header_style}"] : '';
				 return array('slider_img' => $slider_img, 'title' => $title, 'sub_title' => $sub_title,'drop_img' => $drop_img, 'drop_color' =>$drop_color);
			 }
			 else
			 {
				  return array('slider_img' => $slider_img, 'title' => $title, 'sub_title' => $sub_title,'drop_img' => '', 'drop_color' =>'');
			 }
        } else if($medicalpro_options["display_slider_or_image_on_header{$header_style}"] == '1')
        {
            $slider_alias = $medicalpro_options["revolution_slider_for_header{$header_style}"];
            return array('slider_alias' => $slider_alias);
        }
    }
}


/*-----------------------------------------------------------------------------------*/
/*	List Post Comments
/*-----------------------------------------------------------------------------------*/
if(!function_exists('medical_pro_list_comments'))
{
    function medical_pro_list_comments()
    {
        if(!have_comments())
        {
            return;
        }
        ?>
        <h5 class="widget_heading"><?php esc_html_e('Comments', 'medical-pro'); ?></h5>
        <?php

        wp_list_comments( array(
            'style'       => 'div',
            'max_depth' => '2',
            'short_ping'  => true,
            'callback'  => 'medical_pro_list_comments_walker',
            'avatar_size' => 138,
        ) );

        echo '<div class="pagination">';
        paginate_comments_links();
        echo '</div>';
    }
}


/*-----------------------------------------------------------------------------------*/
/*	List Post Comments Walker
/*-----------------------------------------------------------------------------------*/
if(!function_exists('medical_pro_list_comments_walker'))
{
    function medical_pro_list_comments_walker($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);

        $comment_class = array('media', 'comment');
        if($comment->comment_approved == '0')
        {
            $comment_class[] = 'comment-awaiting-moderation';
        }

        if($args['has_children'])
        {
            $comment_class[] = 'parent';
        }
        ?>

        <<?php echo esc_attr($args['style']); ?> <?php comment_class($comment_class); ?> id="comment-<?php comment_ID() ?>">

        <div class="media-left commenter_img"><a href="<?php comment_author_link(); ?>"><?php echo get_avatar( $comment, $args['avatar_size'] );?></a></div>

        <div class="media-body comment_body">
            <?php if($depth > 1 && in_array('bypostauthor', get_comment_class())) : ?>
                <span class="author_badge"><?php esc_html_e('author', 'medical-pro'); ?></span>
            <?php endif; ?>

            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'medical-pro'); ?></em>
                <br />
            <?php endif; ?>

            <div class="row m0 heading">
                <h5><?php comment_author(); ?> <span class="time_ago"><?php echo human_time_diff(current_time('timestamp'), strtotime(get_comment_time())) . ' ago'; ?></span></h5>
                <h6><?php comment_date(); ?></h6>
            </div>

            <?php
            comment_text();
            comment_reply_link( array_merge( $args, array( 'add_below' => 'reply_btn', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
            edit_comment_link( esc_html__('Edit', 'medical-pro'), '  ', '' );
            ?>
        </div>
    <?php
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Comments Form
/*-----------------------------------------------------------------------------------*/
if(!function_exists('medical_pro_comment_form'))
{
    function medical_pro_comment_form()
    {
        if (!comments_open())
        {
            return;
        }

        ?>
        <div class="row m0 leave_reply">
            <div class="reply_form">
            <?php
            $fields =  array(
                'author' =>'<input id="author" placeholder="'.esc_html__('Your Name', 'medical-pro').'" name="author" type="text" class="form-control" required="required" />',
                'email' => '<input id="email" placeholder="'.esc_html__('E-Mail', 'medical-pro').'" name="email" type="email" class="form-control" required="required" />',
                'url' => '<input id="url"placeholder="'.esc_html__('Website', 'medical-pro').'" name="url" type="text" class="form-control" />',
            );

            $args = array(
                'class_submit' => 'submit_btn',
                'comment_field' => '<textarea placeholder="'.esc_html__('Comment', 'medical-pro').'" id="comment" name="comment" class="form-control" required="required"></textarea>',
                'fields' => apply_filters('comment_form_default_fields', $fields),
                'comment_notes_before' => '',
                'comment_notes_after' => ''
            );
            comment_form($args);
            ?>
            </div>
        </div>
        <?php
    }
}

/*-----------------------------------------------------------------------------------*/
/*	List Gallery Images
/*-----------------------------------------------------------------------------------*/
if (!function_exists('medical_pro_list_gallery_images'))
{
    function medical_pro_list_gallery_images($size = 'blog-post-thumb') {
        ?>
        <ul class="slides">
            <?php
            global $post;
			
            $gallery_images = get_post_meta($post->ID,'gallery',true);

            if (!empty($gallery_images)) {
                foreach ($gallery_images as $gallery_image) {
					
                    echo '<li><a class="swipebox" href="' . esc_url($gallery_image) . '">';
					if($size == 'medical-pro-post-thumb-medium')
						echo '<img width="262" height="202" src="' . esc_url($gallery_image) . '" alt="' . esc_url($gallery_image) . '" />';
					else
						echo '<img src="' . esc_url($gallery_image) . '" alt="' . esc_url($gallery_image) . '" />';
                    echo '</a></li>';
                }
            } else if (has_post_thumbnail($post->ID)) {
			
                echo '<li><a href="' . get_permalink() . '" title="' . get_the_title() . '" >';
                the_post_thumbnail($size);
                echo '</a></li>';
            }
            ?>
        </ul>
    <?php
    }
}
/*Gallery for custom post*/
if (!function_exists('medical_pro_list_custom_gallery_images'))
{
    function medical_pro_list_custom_gallery_images($size = 'blog-post-thumb') {
        ?>
        <ul class="slides">
            <?php
            global $post;
			
            $gallery_images = get_post_meta($post->ID,'custom_gallery',true);

            if (!empty($gallery_images)) {
                foreach ($gallery_images as $gallery_image) {
					
                    echo '<li><a class="swipebox" href="' . esc_url($gallery_image) . '">';
					if($size == 'medical-pro-post-thumb-medium')
						echo '<img width="262" height="202" src="' . esc_url($gallery_image) . '" alt="' . esc_url($gallery_image) . '" />';
					else if($size == 'gallery-post-single')
						echo '<img width="653" height="487" src="' . esc_url($gallery_image) . '" alt="' . esc_url($gallery_image) . '" />';
					else 
						echo '<img src="' . esc_url($gallery_image) . '" alt="' . esc_url($gallery_image) . '" />';
                    echo '</a></li>';
                }
            } else if (has_post_thumbnail($post->ID)) {
				
                echo '<li><a href="' . get_permalink() . '" title="' . get_the_title() . '" >';
                the_post_thumbnail($size);
                echo '</a></li>';
            }
            ?>
        </ul>
    <?php
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Medical Pro Theme Pagination
/*-----------------------------------------------------------------------------------*/
if (!function_exists('medical_pro_pagination'))
{
    function medical_pro_pagination($query){
        echo "<div class='pagination'>";
        $big = 999999999; // need an unlikely integer
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'prev_text' => esc_html__(' < ', 'medical-pro'),
            'next_text' => esc_html__(' > ', 'medical-pro'),
            'current' => max(1, get_query_var('paged')),
            'total' => $query->max_num_pages
        ));
        echo "</div>";
    }
}

/*-----------------------------------------------------------------------------------*/
/*	MedicalPro the excerpt
/*-----------------------------------------------------------------------------------*/
if (!function_exists('medical_pro_excerpt'))
{
    function medical_pro_excerpt($length = 300){
       return substr(get_the_content(),0,$length)."...";
    }
}

/*-----------------------------------------------------------------------------------*/
/*	MedicalPro page breadcrumb
/*-----------------------------------------------------------------------------------*/
if (!function_exists('medical_pro_breadcrumb'))
{
    function medical_pro_breadcrumb($separator = '>')
    {

        echo '<ul class="breadcrumb">';

        /* For all pages other than front page */
        if (!is_front_page()) {
            echo '<li><a href="' . esc_url(home_url('/')) . '">';
			esc_html_e('Home', 'medical-pro');
			echo '</a></li>';
        }

        /* For index.php OR blog posts page */
        if (is_home()) {
		
            $page_for_posts = get_option('page_for_posts');
            if ($page_for_posts) {
                $blog = get_post($page_for_posts);
                echo '<li>';
                echo esc_html($blog->post_title);
                echo '</li>';
            } else {
                echo '<li>';
                esc_html_e('Blog', 'medical-pro');
                echo '<li>';
            }
        }

        if (is_category() || is_singular('post')) {
            $category = get_the_category();
            $ID = $category[0]->cat_ID;
            echo '<li>';
            echo get_category_parents($ID, TRUE, ' </li>', FALSE);
        }

        if (is_tax('gallery-item-type') || is_tax('department')) {
			
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            if (!empty($current_term->name)) {
                echo '<li class="active">';
                echo esc_html($current_term->name);
                echo '</li>';
            }
        }
		if(is_singular('doctor'))
		{
			 echo '<li><a href="' . esc_url(home_url('/doctor')) . '">';
			 esc_html_e('Doctors', 'medical-pro');
			 echo '</a></li>';
		}
		if(is_singular('gallery-item'))
		{
			 echo '<li><a href="' . esc_url(home_url('/gallery')) . '">';
			 esc_html_e('Gallery', 'medical-pro');
			 echo '</a></li>';
		}
		if(is_singular('service'))
		{
			 echo '<li><a href="' . esc_url(home_url('/service')) . '">';
			 esc_html_e('Services', 'medical-pro');
			 echo '</a></li>';
		}
		if(is_singular('department'))
		{
			 echo '<li><a href="javascript:;">';
			 esc_html_e('Departments', 'medical-pro');
			 echo '</a></li>';
		}
		

        if (is_singular('post') || is_singular('doctor') || is_singular('gallery-item')  || is_singular('service') || is_singular('department') || is_singular('gallery') || is_page()) {
			
            echo '<li class="active">';
            the_title();
            echo '</li>';
        }

        if (is_tag()) {
            echo '<li>';
            esc_html_e('Tag: ', 'medical-pro');
            echo single_tag_title('', FALSE);
            echo '</li>';
        }

        if (is_404()) {
            echo '<li>';
            esc_html_e('404 - Page not Found', 'medical-pro');
            echo '</li>';

        }

        if (is_search()) {
            echo '<li>';
            esc_html_e('Search', 'medical-pro');
            echo '</li>';
        }

        if (is_year()) {
            echo '</li>';
            echo get_the_time('Y');
            echo '</li>';
        }

        if(is_archive())
        {
            //the_archive_title( '<li>', '</li>' );
        }

        echo "</ul>";
		?>
		 <style>
        .breadcrumbRow .inner ul li + li:before
        {
            content: '<?php echo $separator; ?>';
        }
        </style>
<?php
    }
}


if(!function_exists('medical_pro_default_top_menu'))
{
    function medical_pro_default_top_menu()
    {
        $args = array(
            'sort_order' => 'asc',
            'sort_column' => 'post_title',
            'hierarchical' => 1,
            'exclude' => '',
            'include' => '',
            'meta_key' => '',
            'meta_value' => '',
            'authors' => '',
            'child_of' => 0,
            'parent' => -1,
            'exclude_tree' => '',
            'number' => 5,
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'publish'
        );
        $pages = get_pages($args);
        echo '<ul id="menu-primary" class="nav navbar-nav navbar-right">';
        if(!empty($pages))
        {
            foreach($pages as $pages)
            {
                echo '<li>' . '<a title="Home Page" href="'.get_the_permalink($pages->ID).'">'.$pages->post_title.'</a>' . '</li>';
            }
        }

        echo '</ul>';

    }
}


/*-----------------------------------------------------------------------------------*/
/*	Function to output different bootstrap classes
/*-----------------------------------------------------------------------------------*/
if (!function_exists('medical_pro_bc'))
{
    function medical_pro_bc($col_md = null,$col_sm = null)
    {
        $bootstrap_grid_class = "";
        if (!empty($col_md)) {
            $bootstrap_grid_class .= "col-md-$col_md ";
        }
        if (!empty($col_sm)) {
            $bootstrap_grid_class .= "col-sm-$col_sm ";
        }
        return $bootstrap_grid_class;
    }
}
if ( !function_exists( 'medical_pro_render_title' ) )
{
    /**
     * Render Title
     */
    if (!function_exists('_wp_render_title_tag'))
    {
        function medical_pro_render_title()
        {
            ?>
            <title><?php wp_title('|', true, 'right'); ?></title>
            <?php
        }

        add_action('wp_head', 'medical_pro_render_title');
    }
}

if ( !function_exists( 'medical_pro_render_favicon' ) )
{
    /**
     * Render favicon
     */
    if (!function_exists('has_site_icon') || !has_site_icon())
    {
        function medical_pro_render_favicon()
        {
            global $medicalpro_options;
            if(!$favicon_url = $medicalpro_options['favicon']['url'])
            {
                $favicon_url = get_template_directory_uri() .'/images/theme-options/favicon.ico';
            }

            ?>

            <link rel="shortcut icon" href="<?php echo esc_url($favicon_url); ?>" />
            <?php

        }
		add_action('wp_head', 'medical_pro_render_favicon');
    }
    
}
/*-----------------------------------------------------------------------------------*/
/*	Add Class Next Post Link
/*-----------------------------------------------------------------------------------*/
if (!function_exists('add_class_next_post_link')) {
    function add_class_next_post_link($html)
    {
        $html = str_replace('<a', '<a class="next fa fa-chevron-right"', $html);
        return $html;
    }
}
add_filter('next_post_link', 'add_class_next_post_link', 10, 1);


if (!function_exists('add_class_previous_post_link')) {
    function add_class_previous_post_link($html)
    {
        $html = str_replace('<a', '<a class="prev fa fa-chevron-left"', $html);
        return $html;
    }
}
add_filter('previous_post_link', 'add_class_previous_post_link', 10, 1);
