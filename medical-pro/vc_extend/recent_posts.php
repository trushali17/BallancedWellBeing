<?php

if(!function_exists('medical_pro_vc_recent_posts'))
{
    function medical_pro_vc_recent_posts() {
        vc_map( array(
            "name"  => esc_html__("Recent Post", "medical-pro" ),
            "base"  => "medicalpro_recent_posts",
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
                    "value"         => esc_html__("Recent Post", "medical-pro"),
                    "param_name"    => "sub_title",
                ),
				array(
                    "type"          => "textfield",
                    "class"         => "",
                    "heading"       => esc_html__("Title", "medical-pro"),
                    "value"         => esc_html__("From Our Blog", "medical-pro"),
                    "param_name"    => "title",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("No. of Post", "medical-pro"),
                    "param_name"    => "limit",
                    "description"   => esc_html__("Limit to maximum display Post", "medical-pro"),
                    'value'         => 2
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Column", "medical-pro"),
                    "param_name"    => "column",
                    'value'         => array('1', '2'),
                    "std"           => '1',
                )
            )
        ) );
    }
}
add_action('vc_before_init', 'medical_pro_vc_recent_posts');


if(!function_exists('medical_pro_vc_recent_posts_shortcode'))
{

    function medical_pro_vc_recent_posts_shortcode($atts)
    {
        $atts = shortcode_atts(array(
			'sub_title' => esc_html__('From Our Blog', "medical-pro"),
            'title' => esc_html__('Recent Post', "medical-pro"),
            'limit' => '2',
            'column' => '1'
        ), $atts);

        $query_arg = array(
            'post_type' => 'post'
        );

        if($atts['limit'] > 0 && is_numeric($atts['limit']))
        {
            $query_arg['posts_per_page'] = $atts['limit'];
        }
        $query_arg['order'] = 'DESC';
       

        $blog_url = false;
        global $medicalpro_options;
        if(isset($medicalpro_options['blog_page_id']) && $medicalpro_options['blog_page_id'])
        {
            if($url = get_the_permalink($medicalpro_options['blog_page_id']))
            {
                $blog_url = '<a href="'.esc_url($url).'" class="view_all">'.esc_html__('view all posts', 'medical-pro').'</a>';
            }
        }
		

        $recent_post = new WP_Query();
        $recent_post->query($query_arg);
ob_start();
		
        if($atts['column'] == '1')
        {?>
			<div class="recent_post_home">
			
            <div class="m0 titleRow text-left">
                    <h5><?php echo esc_html($atts['sub_title']) ?></h5>
                    <h2><?php echo esc_html($atts['title']) ?></h2>
            </div>
            <div class="m0">
            <?php while($recent_post->have_posts()) : $recent_post->the_post(); ?>

                   <div class="media">
						 <?php if(has_post_thumbnail()) { ?>
                        <div class="media-left">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medical-pro-post-thumb'); ?></a>
                        </div>
						<?php } ?>
                        <div class="media-body">
                            <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                            <div class="row m0 meta"><?php esc_html_e('By', 'medical-pro') ?> : <a href="javascript:;"><?php the_author(); ?></a> &nbsp; <?php esc_html_e('on', 'medical-pro') ?> : <a href="#"><?php the_time(get_option('date_format')); ?></a></div>
                            <p><?php echo medical_pro_excerpt(80); ?> </p>
                        </div>
                    </div>

            <?php
            endwhile;

          
			echo wp_kses($blog_url , array('a' => array(
											'href' => array(),
											'title' => array(),
											'class' => array())));
            ?>
				
            </div>
			</div>
        <?php
        }else {
            ?>
				<div class="row contentRowPad">
				
                <div class="m0 titleRow">
                    <h5><?php echo esc_html($atts['sub_title']) ?></h5>
                    <h2><?php echo esc_html($atts['title']) ?></h2>
                </div>
                <div class="recent_post_home recent_post_home3">
                        <?php
							$count =0;
							while($recent_post->have_posts()) : $recent_post->the_post();
								$post_meta = get_post_meta(get_the_ID());
								$embed_code = isset($post_meta['video_embed_code'][0]) ? esc_url($post_meta['video_embed_code'][0]) : '';
								$format = get_post_format($recent_post->ID);
								//echo $format;
								if (false === $format) {
									$format = 'standard';
								}
							//echo $format;
                        ?>
						
                                <div class="col-sm-12 col-md-6">
						
                                    <div class="media border_bottom">
										<?php if ($format == 'image' || $format == 'standard' || $format == 'audio' || $format == 'link' || $format == 'quote' || $format == 'video' ){  ?>
											
											<?php if(has_post_thumbnail()) { ?>
											<div class="media-left">
													<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medical-pro-post-thumb'); ?></a>
											</div>
											<?php } ?>
										<?php } else if ($format == 'video') { ?>
											<div class="media-left">
												<iframe class="embed-responsive-item" src="<?php echo esc_url($embed_code); ?>"></iframe>
											</div>
										<?php } else if ($format == 'gallery') { ?>
											<div class="media-left">
												
												 <?php if(has_post_thumbnail()) { ?>
													<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medical-pro-post-thumb'); ?></a>
												<?php } else { ?>
													<a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/blog_home_avatar.jpg" alt=""></a>
												<?php } ?>
											</div>
                                           <?php }  ?>
                                        
                                        <div class="media-body">
										<?php if ($format == 'link'){ ?>
											 <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
										<?php } else { ?>
                                            <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
										<?php } ?>
                                            <div class="row m0 meta"><?php esc_html_e('By', 'medical-pro') ?> : <?php the_author_posts_link(); ?> &nbsp; <?php esc_html_e('on', 'medical-pro') ?> : <a href="#"><?php the_time( get_option('date_format') ); ?></a></div>
                                            <p><?php echo medical_pro_excerpt(70); ?> </p>
                                        </div>
                                    </div>
							
                                  </div>
							
                             
                            <?php

                            $count = $count + 1;
                        endwhile;

						echo wp_kses($blog_url , array('a' => array(
											'href' => array(),
											'title' => array(),
											'class' => array())));
                        ?>
                </div>
		
				</div>
        <?php
        }
        wp_reset_query();
		return ob_get_clean();	
    }
}
add_shortcode('medicalpro_recent_posts', 'medical_pro_vc_recent_posts_shortcode');