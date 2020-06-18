<?php

if(!function_exists('medical_pro_vc_department'))
{
    function medical_pro_vc_department() {
        vc_map( array(
            "name"  => esc_html__("Department", "medical-pro" ),
            "base"  => "medicalpro_department",
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
                    "value"         => esc_html__("GENERAL INFORMATION", "medical-pro"),
                    "param_name"    => "sub_title",
                ),
				array(
                    "type"          => "textfield",
                    "class"         => "",
                    "heading"       => esc_html__("Title", "medical-pro"),
                    "value"         => esc_html__("OUR DEPARTMENTS", "medical-pro"),
                    "param_name"    => "title",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("No. of Department", "medical-pro"),
                    "param_name"    => "limit",
                    "description"   => esc_html__("Limit to maximum display Department", "medical-pro"),
                    'value'         => 5
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
add_action('vc_before_init', 'medical_pro_vc_department');


if(!function_exists('medical_pro_vc_department_shortcode'))
{
    function medical_pro_vc_department_shortcode($atts)
    {
        $atts = shortcode_atts(array(
			'sub_title' => esc_html__("GENERAL INFORMATION", "medical-pro"),
			'title' => esc_html__("OUR DEPARTMENTS", "medical-pro"),
            'limit' => 5,
            'template' => 'Style 1'
        ), $atts);

        $query_arg = array(
            'post_type' => 'department'
        );

        if($atts['limit'] > 0 && is_numeric($atts['limit']))
        {
            $query_arg['posts_per_page'] = $atts['limit'];
        }
       
		$query_arg['order'] = 'DESC';
	
        
        $departments = new WP_Query();
        $departments->query($query_arg);
		ob_start();

		if($atts['template'] == 'Style 1')
        { ?>
			 <div class="row m0 titleRow text-left">
                <h5><?php echo esc_html($atts['sub_title']) ?></h5>
                <h2><?php echo esc_html($atts['title']) ?></h2>
			 </div>
			 <div class="row m0">                         
				 <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
			<?php 
				$count = 0;
				while($departments->have_posts()) : $departments->the_post();
				if($count == 0)
				{
					$expandedFlag = "true";
					$collapseFlag = "in";
				}
				else
				{
					$expandedFlag = "";
					$collapseFlag = "";
				}
				?>
				 
				 
				<div class="panel panel-default">
					 <div class="panel-heading" role="tab" id="headingOne<?php echo get_the_ID() ?>">
						 <h4 class="panel-title">
							 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo get_the_ID() ?>" aria-expanded="<?php echo esc_attr($expandedFlag); ?>" aria-controls="collapseOne<?php echo get_the_ID() ?>">
								<?php the_title(); ?>
								 <span class="sign"></span>
							 </a>
						 </h4>
					 </div>
					 <div id="collapseOne<?php echo get_the_ID() ?>" class="panel-collapse collapse <?php echo esc_attr($collapseFlag); ?>" role="tabpanel" aria-labelledby="headingOne<?php echo get_the_ID() ?>">
						 <div class="panel-body">                                
							<?php the_excerpt(); ?>
						 </div>
					 </div>
				</div>
				
			<?php
			$count = $count + 1;
			?>
			
			<?php
			endwhile; 
			 wp_reset_query();?>
				</div>
            </div>
			<?php
			} else {
			?>
			 <div class="about_medicalpro_row">
			 <div class="">
			 <div class="row titleRow title-white">
                <h5><?php echo esc_html($atts['sub_title']) ?></h5>
                <h2><?php echo esc_html($atts['title']) ?></h2>
            </div>
			<div class="">
                <ul class="nav nav-tabs department_tab" role="tablist">
				<?php 
				$count = 0;
				$start = 0;
				while($departments->have_posts()) : $departments->the_post();
				if( $count == $start )
					$activeVal = "active";
				else
					$activeVal = "";

				?>
                    <li role="presentation" class="<?php echo esc_attr($activeVal) ?>"><a href="#<?php echo get_the_ID() ?>" aria-controls="<?php echo get_the_ID() ?>" role="tab" data-toggle="tab"><?php the_title(); ?></a></li>
                   
				<?php
				$count = $count + 1;
				?>
				
				<?php
				endwhile; 
				 wp_reset_query();?>
                </ul>
                <div class="tab-content">
				<?php 
				$count = 0;
				$start = 0;
				while($departments->have_posts()) : $departments->the_post();
				$department_meta = get_post_meta(get_the_ID());
				if( $count == $start )
					$activeVal = "active";
				else
					$activeVal = "";
			
				?>
					
					<div role="tabpanel" class="tab-pane <?php echo esc_attr($activeVal); ?>" id="<?php echo get_the_ID() ?>">
                        <div class="row m0 about_medicalpro">
                            <div class="row m0 inner">
                                <div class="col-sm-12 col-md-6 img">
                                    <div class="row">
                                        <?php the_post_thumbnail('medical-pro-department-thumb', array('class' => 'img-responsive')); ?>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 content">
                                    <div class="row">
										<h3><?php echo esc_html($department_meta['department_subtitle'][0]) ?></h3>
                                    <p><?php echo medical_pro_excerpt(344); ?></p>
										
										<a href="<?php the_permalink(); ?>" class="view_all"><?php esc_html_e('read more', 'medical-pro'); ?></a>
										
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				
				
				<?php
				$count = $count + 1;
				?>
				
				<?php
				endwhile; 
				wp_reset_query(); ?>
				</div>
            </div>
			</div>
			</div>
			 <?php
        }
        wp_reset_query();
		return ob_get_clean();	
    }
}
add_shortcode('medicalpro_department', 'medical_pro_vc_department_shortcode');