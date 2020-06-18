<?php

if(!function_exists('medical_pro_vc_doctors'))
{
    function medical_pro_vc_doctors() {
        vc_map( array(
            "name"  => esc_html__("Doctors", "medical-pro" ),
            "base"  => "medicalpro_doctors",
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
                    "value"         => esc_html__("our doctors", "medical-pro"),
                    "param_name"    => "sub_title",
                ),
				array(
                    "type"          => "textfield",
                    "class"         => "",
                    "heading"       => esc_html__("Title", "medical-pro"),
                    "value"         => esc_html__("experienced team", "medical-pro"),
                    "param_name"    => "title",
                ),
				array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("No. of Doctor", "medical-pro"),
                    "param_name"    => "limit",
                    "description"   => esc_html__("Limit to maximum display Doctors", "medical-pro"),
                    'value'         => 4
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
				array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Display Column", "medical-pro"),
                    "param_name"    => "column",
                    'value'         => array('1 Column','2 Column','3 Column','4 Column'),
                    "std"           => '4 Column',
                )
            )
        ) );
    }
}
add_action('vc_before_init', 'medical_pro_vc_doctors');


if(!function_exists('medical_pro_vc_doctors_shortcode'))
{
    function medical_pro_vc_doctors_shortcode($atts)
    {
        $atts = shortcode_atts(array(
			'sub_title' => esc_html__('our doctors', "medical-pro"),
			'title' => esc_html__('experienced team', "medical-pro"),
            'limit' => 4,
            'sort_by' => 'newest',
			'template' => 'Style 1',
			'column' => '4 Column',
			
        ), $atts);

        $query_arg = array(
            'post_type' => 'doctor'
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


        $all_doctor_url = false;
        global $medicalpro_options;
        if(isset($medicalpro_options['doctor_page_id']) && $medicalpro_options['doctor_page_id'])
        {
            if($url = get_the_permalink($medicalpro_options['doctor_page_id']))
            {
                $all_doctor_url = '<a href="'.esc_url($url).'" class="view_all">'.esc_html__('view all doctors', 'medical-pro').'</a>';
            }
        }

        $doctors = new WP_Query();
        $doctors->query($query_arg);
		ob_start();

		if($atts['template'] == 'Style 1')
        {
			
			if ($atts['column'] == '4 Column') {
				$bootstrap_grid_class = medical_pro_bc('3', '6');
			} else if ($atts['column'] == '3 Column') {
				$bootstrap_grid_class = medical_pro_bc('4', '6');
			} else if ($atts['column'] == '2 Column') {
				$bootstrap_grid_class = medical_pro_bc('6', '6');
			}else {
				$bootstrap_grid_class = medical_pro_bc('12', '12');
			}
				
			?>
			<div class="team_section_type2 bgf">
			<div class="row titleRow">
                <h5><?php echo esc_html($atts['sub_title']) ?></h5>
				<h2><?php echo esc_html($atts['title']) ?></h2>
            </div>
            <div class="row">
			<?php
			while($doctors->have_posts()) : $doctors->the_post();
			$departments = array();
								
			$department_ids = get_post_meta(get_the_ID(), 'department_id', true);
		
			if(!empty($department_ids))
			{
				foreach($department_ids as $department_id)
				{
					$curent_department = get_post($department_id);
					if(!empty($curent_department))
					{
						$departments[] = esc_html($curent_department->post_title);
					}
				}
			}
				?>

				<div class="<?php echo esc_attr($bootstrap_grid_class); ?> team_member">
					<div class="row m0 inner">
						<a href="<?php the_permalink(); ?>">
							<div class="row m0 image" id="doctor_thumbnail">
								<?php 
								if(has_post_thumbnail())
								{
									the_post_thumbnail('medical-pro-doctor-thumb', array('class' => 'img-responsive'));
								} else { ?>
									<img src="<?php echo get_template_directory_uri() ?> ./images/doctor_home_avatar.jpg" alt="" class="img-responsive">
								<?php } ?>
							</div>
							<div class="row m0 title_row">
								<h5><?php the_title(); ?></h5>
								<div class="row m0 pos"><?php echo implode(', ', $departments); ?></div>
							</div>
						</a>
						<?php
						$post_meta = get_post_meta(get_the_ID());
						?>
						<p><?php echo esc_html($post_meta['doctor_introduction_text'][0]); ?></p>
						<ul class="social_list">
							<?php if(!empty($post_meta['doctor_facebook_url'][0])) : ?><li><a href="<?php echo esc_url($post_meta['doctor_facebook_url'][0]); ?>"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
							<?php if(!empty($post_meta['doctor_twitter_url'][0])) : ?><li><a href="<?php echo esc_url($post_meta['doctor_twitter_url'][0]); ?>"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
							<?php if(!empty($post_meta['doctor_google_plus_url'][0])) : ?><li><a href="<?php echo esc_url($post_meta['doctor_google_plus_url'][0]); ?>"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
						</ul>
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
			 <div class="team_section bgf">
			 <div class="col-sm-4 col-md-3 team_menu">
                  <div class="row titleRow text-left">
                        <h5><?php echo esc_html($atts['sub_title']) ?></h5>
						<h2><?php echo esc_html($atts['title']) ?></h2>
                    </div>  
				<div class="row">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
							<?php
							$count =0;
							$start = 0;
							while($doctors->have_posts()) : $doctors->the_post();
							$post_meta = get_post_meta(get_the_ID());
							if( $count == $start )
								$activeVal = "active";
							else
								$activeVal = "";
							 $departments = array();
								
								$department_ids = get_post_meta(get_the_ID(), 'department_id', true);
							
								if(!empty($department_ids))
								{
									foreach($department_ids as $department_id)
									{
										$curent_department = get_post($department_id);
										if(!empty($curent_department))
										{
											$departments[] = esc_html($curent_department->post_title);
										}
									}
								}
							?>
                            <li role="presentation" class="<?php echo esc_attr($activeVal); ?> media"><a href="#<?php echo get_the_ID() ?>" aria-controls="<?php echo get_the_ID() ?>" role="tab" data-toggle="tab">
                                <div class="media-left" id="radius_thumb"><?php the_post_thumbnail('medical-pro-thumb-small'); ?></div>
                                <div class="media-body media-middle">
                                    <h5><?php the_title(); ?></h5>
                                    <div class="row designation"><?php echo implode(', ', $departments); ?></div>
                                </div>
                            </a></li>
                            
							<?php
							$count = $count + 1;
							endwhile;
							?>
                        </ul>
                    <?php
                    if($all_doctor_url)
                    {
                       	echo wp_kses($all_doctor_url , array('a' => array(
											'href' => array(),
											'title' => array(),
											'class' => array())));
                    }
                    ?>
					</div>
                </div>
				 <div class="col-sm-8 col-md-9 team_descss">
                    <div class="row">
                        <div class="tab-content">
							<?php
							$count =0;
							$start = 0;
							while($doctors->have_posts()) : $doctors->the_post();
							$post_meta = get_post_meta(get_the_ID());
							if( $count == $start )
								$activeVal = "active";
							else
								$activeVal = "";
							 $departments = array();
								
								$department_ids = get_post_meta(get_the_ID(), 'department_id', true);
							
								if(!empty($department_ids))
								{
									foreach($department_ids as $department_id)
									{
										$curent_department = get_post($department_id);
										if(!empty($curent_department))
										{
											$departments[] = esc_html($curent_department->post_title);
										}
									}
								}
							?>
                            <div role="tabpanel" class="tab-pane media <?php echo esc_attr($activeVal); ?>" id="<?php echo get_the_ID() ?>">
                                <div class="media-left media-bottom">
                                    <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('medical-pro-thumb-large', array('class' => 'img-responsive','height'=>'601px')); ?>
									</a>
                                </div>
                                <div class="media-body">
                                    <div class="row titleRow text-left">
                                        <h2><?php the_title(); ?></h2>
                                        <h5><?php echo implode(', ', $departments); ?></h5>
                                    </div>
                                    <p><?php echo esc_html($post_meta['doctor_introduction_text'][0]); ?></p>
                                    <ul class="social_list">
                                        <?php if(!empty($post_meta['doctor_facebook_url'][0])) : ?><li><a href="<?php echo esc_url($post_meta['doctor_facebook_url'][0]); ?>"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
										<?php if(!empty($post_meta['doctor_twitter_url'][0])) : ?><li><a href="<?php echo esc_url($post_meta['doctor_twitter_url'][0]); ?>"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
										<?php if(!empty($post_meta['doctor_google_plus_url'][0])) : ?><li><a href="<?php echo esc_url($post_meta['doctor_google_plus_url'][0]); ?>"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
                                    </ul>
                                </div>
                            </div><!-- Doctor about-->
  
							<?php
							$count = $count + 1;
							endwhile;
							?>
                        </div>
                        <?php
                        if($all_doctor_url)
                        {
                            echo '<div class="visible-xs view_all_btn_4_mobile">' . $all_doctor_url . '</div>';
                        }
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
add_shortcode('medicalpro_doctors', 'medical_pro_vc_doctors_shortcode');