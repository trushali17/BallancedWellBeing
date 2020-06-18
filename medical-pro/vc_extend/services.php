<?php

if(!function_exists('medical_pro_vc_services'))
{
    function medical_pro_vc_services() {
        vc_map( array(
            "name"  => esc_html__("Services", "medical-pro" ),
            "base"  => "medicalpro_services",
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
                    "value"         => esc_html__("Get Well Soon", "medical-pro"),
                    "param_name"    => "sub_title",
                ),
				array(
                    "type"          => "textfield",
                    "class"         => "",
                    "heading"       => esc_html__("Title", "medical-pro"),
                    "value"         => esc_html__("MedicalPro Services", "medical-pro"),
                    "param_name"    => "title",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("No. of Services", "medical-pro"),
                    "param_name"    => "limit",
                    "description"   => esc_html__("Limit to maximum display Services, 0 to unlimited", "medical-pro"),
                    'value'         => 6
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Order By", "medical-pro"),
                    "param_name"    => "sort_by",
                    'value'         => array(
                        "name"      => esc_html__("Name", "medical-pro"),
                        "newest"    => esc_html__("Newest", "medical-pro"),
                        "oldest"    => esc_html__("Oldest", "medical-pro")
                    ),
                    "std"           => 'newest',
                ),
				array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Display Style", "medical-pro"),
                    "param_name"    => "template",
                    'value'         => array('Style 1', 'Style 2'),
                    "std"           => 'Style 1',
                ),
            )
        ) );
    }
}
add_action('vc_before_init', 'medical_pro_vc_services');


if(!function_exists('medical_pro_services_shortcode'))
{
    function medical_pro_services_shortcode($atts)
    {
        $atts = shortcode_atts(array(
			'title' => esc_html__('Get Well Soon', 'medical-pro'),
            'sub_title' => esc_html__('MedicalPro Services', 'medical-pro'),
            'limit' => '6',
            'sort_by' => 'Newest',
			'template' => 'Style 1',
        ), $atts);

        $query_arg = array(
            'post_type' => 'service'
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

		global $medicalpro_options;
        $services = new WP_Query();
        $services->query($query_arg);
		ob_start();
		if($atts['template'] == 'Style 1')
        {
			?>
			<div class="row service_block_row bgf">
			<div class="titleRow">
					<h5><?php echo esc_html($atts['sub_title']) ?></h5>
					 <h2><?php echo esc_html($atts['title']) ?></h2>
			</div>
			<div class="">
			<?php
			while($services->have_posts()) : $services->the_post();
				$service_meta = get_post_meta(get_the_ID());
				$icon_url = stripslashes($service_meta['serivce_icon_style2'][0]);
				
			?>
				<div class="col-sm-6 col-md-4 service_block">
					<div class="row m0 inner">
						<div class="row icon">
							<img src="<?php echo esc_attr($icon_url) ?>"/>
						</div>
						<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
						<p><?php echo medical_pro_excerpt(100); ?></p>
					</div>
				</div>

			<?php
			endwhile;?>
			 </div>
			 </div>
		<?php
		} else {
		?>
			  <div class="row service_tab">
			  <div class="titleRow">
					<h5><?php echo esc_html($atts['sub_title']) ?></h5>
					<h2><?php echo esc_html($atts['title']) ?></h2>
			  </div>  
				<div class="">
                        <!-- Nav tabs -->
						<ul class="nav nav-tabs nav-justified" role="tablist" id="service_tab">
							<?php
							$count =0;
							while($services->have_posts()) : $services->the_post();
							$service_meta = get_post_meta(get_the_ID());
							$activeVal = $count == 0 ? "active" : "";
							$icon_url = stripslashes($service_meta['serivce_icon'][0]);
							$icon_url_active = stripslashes($service_meta['serivce_icon_hover'][0]);
							
							?>
							<style>
							.service_tab #service_tab li a span.services<?php echo get_the_ID() ?> {
								background-image: url(<?php echo esc_url($icon_url) ?>);
							}
							
							.service_tab #service_tab li a span.services<?php echo get_the_ID() ?>.active{
								background-image: url(<?php echo esc_url($icon_url_active) ?>);
							}
							</style>
							<li id="serviceid<?php echo get_the_ID() ?>" role="presentation" class="<?php echo esc_attr($activeVal); ?>">
								<a href="#<?php echo get_the_ID() ?>" aria-controls="<?php echo get_the_ID() ?>" role="tab" data-toggle="tab">
								<span class="services<?php echo get_the_ID() ?> <?php echo esc_attr($activeVal); ?>"></span><?php the_title(); ?></a>
							</li>
							<?php
							$count = $count + 1;
							endwhile;
							?>
                        </ul>
                       
					<div class="tab-content">
                   
							<?php
							$count =0;
							while($services->have_posts()) : $services->the_post();
							$service_meta = get_post_meta(get_the_ID());
							$activeVal = $count == 0 ? "active" : "";
							?>
							<div role="tabpanel" class="tab-pane <?php echo esc_attr($activeVal); ?>" id="<?php echo get_the_ID() ?>">
								<div class="col-sm-6">
									<div class="row m0">
										<?php the_post_thumbnail('medical-pro-service-thumb-large', array('class' => 'img-responsive')); ?>
										<?php if (!empty($medicalpro_options['trusted_service_label_text_on_image'])) { ?>
										<div class="ts"><?php echo $medicalpro_options['trusted_service_label_text_on_image']; ?></div>
										<?php } ?>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="row m0">
										<h3><?php the_title(); ?></h3>
										<h4><?php echo esc_html($service_meta['serivce_subtitle'][0]) ?></h4>
										<p><?php echo medical_pro_excerpt(200); ?></p>
										<?php if ($medicalpro_options['display_service_read_more_button'] == '1') { ?>
										<a href="<?php the_permalink(); ?>" class="view_all"><?php echo $medicalpro_options['service_read_more_button_text'] ?></a>
										<?php } ?>
									</div>
								</div>
							</div>
							<?php
							$count = $count + 1;
							endwhile;
							?>
                        </div>
                </div>
				</div>
			 <?php
        }
        wp_reset_query();
		return ob_get_clean();	
    }
}
add_shortcode('medicalpro_services', 'medical_pro_services_shortcode');