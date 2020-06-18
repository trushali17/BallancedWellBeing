<?php

if(!function_exists('medical_pro_vc_testimonials'))
{
    function medical_pro_vc_testimonials() {
        vc_map( array(
            "name"  => esc_html__("Testimonial", "medical-pro" ),
            "base"  => "medicalpro_testimonials",
            "class" => "",
            "category" => esc_html__("Medical Pro", "medical-pro"),
            'admin_enqueue_js' => '',
            'admin_enqueue_css' => '',
            "show_settings_on_create" => false,
            "params" => array(
                 array(
                    "type"          => "textfield",
                    "class"         => "",
                    "heading"       => esc_html__("Sub Title", "medical-pro"),
                    "value"         => esc_html__("What People Say", "medical-pro"),
                    "param_name"    => "sub_title",
                ),
				array(
                    "type"          => "textfield",
                    "class"         => "",
                    "heading"       => esc_html__("Title", "medical-pro"),
                    "value"         => esc_html__("Testimonials", "medical-pro"),
                    "param_name"    => "title",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("No. of Testimonials", "medical-pro"),
                    "param_name"    => "limit",
                    "description"   => esc_html__("Limit to maximum display Testimonials, 0 to unlimited", "medical-pro"),
                    'value'         => 3
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Order By", "medical-pro"),
                    "param_name"    => "sort_by",
                    'value'         => array('Name', 'Newest', 'Oldest'),
                    "std"           => 'Newest',
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Display Style", "medical-pro"),
                    "param_name"    => "template",
                    'value'         => array('Style 1', 'Style 2'),
                    "std"           => 'Style 1',
                )
            )
        ) );
    }
}
add_action('vc_before_init', 'medical_pro_vc_testimonials');


if(!function_exists('medical_pro_vc_testimonials_shortcode'))
{
    function medical_pro_vc_testimonials_shortcode($atts)
    {
        $atts = shortcode_atts(array(
            'sub_title' => esc_html__('What People Say', 'medical-pro'),
			'title' => esc_html__('Our Testimonials', 'medical-pro'),
            'limit' => 6,
            'sort_by' => 'Newest',
			 'template' => 'Style 1'
        ), $atts);


        $query_arg = array(
            'post_type' => 'testimonial'
        );

        if($atts['limit'] > 0 && is_numeric($atts['limit']))
        {
            $query_arg['posts_per_page'] = $atts['limit'];
        }

        if($atts['sort_by'] == 'Name')
        {
            $query_arg['order'] = 'ASC';
            $query_arg['orderby'] = 'title';

        } else if($atts['sort_by'] == 'Newest')
        {
            $query_arg['order'] = 'ASC';
          
        } else if($atts['sort_by'] == 'Oldest')
        {
            $query_arg['order'] = 'DESC';
           
        }


        $testimonials = new WP_Query();
        $testimonials->query($query_arg);
ob_start();

        if($atts['template'] == 'Style 1')
        {
			?>
			<div class="row recent_post_home2">
	
			<div class="titleRow">
                 <h5><?php echo esc_html($atts['sub_title']) ?></h5>
                <h2><?php echo esc_html($atts['title']) ?></h2>
            </div>
            <div class="">
			<?php
            while($testimonials->have_posts()) : $testimonials->the_post();
            ?>
                <div class="col-sm-4 recent_post">
                    <div class="row m0 inner">
                        <div class="postText row m0">
                            <?php the_content(); ?>
                        </div>
                        <div class="media authorMeta">
                            <div class="media-left" id="radius_thumb"><?php the_post_thumbnail('medical-pro-thumb-small'); ?></div>
                            <div class="media-body media-middle">
                                <h5><?php the_title(); ?></h5>
                                <?php $website_url = esc_url(get_post_meta(get_the_ID(), 'website_url', true)); ?>
                                <div class="row designation"><?php echo esc_html($website_url); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
            endwhile;
			?>
			 </div>
		
			 </div>
			<?php
        } else {
            ?>
			<div class="testimonial_section">
            <div class="inner row m0">
            <div class="row m0 titleRow text-left">
                <h5><?php echo esc_html($atts['sub_title']) ?></h5>
                <h2><?php echo esc_html($atts['title']) ?></h2>
            </div>
            <div class="flexslider testimonial_slider">
                <ul class="slides">
                    <?php
                    while($testimonials->have_posts()) : $testimonials->the_post();
                    ?>
                        <li>
                            <div class="row m0 recent_post testi_content">
                                <div class="row m0 inner">
                                    <div class="postText row m0"><?php the_content(); ?></div>
                                    <div class="media authorMeta">
                                        <div class="media-left"><?php the_post_thumbnail('medical-pro-thumb-small'); ?></div>
                                        <div class="media-body media-middle">
                                            <h5><?php the_title(); ?></h5>
                                            <?php $website_url = esc_url(get_post_meta(get_the_ID(), 'website_url', true)); ?>
                                            <div class="row designation"><?php echo esc_html($website_url); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php
                    endwhile;
                    ?>
                </ul>
            </div>
            </div>
			</div>
                <?php
        }

        wp_reset_query();
		return ob_get_clean();	
    }
}
add_shortcode('medicalpro_testimonials', 'medical_pro_vc_testimonials_shortcode');