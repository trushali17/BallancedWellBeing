<?php

if(!class_exists('Medical_Pro_Future_Box_Widget'))
{
    class Medical_Pro_Future_Box_Widget extends WP_Widget
    {

        function __construct()
        {
            parent::__construct('future-box', esc_html__('Medical Pro Future Box', 'medical-pro'), array('description' => esc_html__('Display Future Box with details', 'medical-pro')));
        }

        function widget($args, $instance)
        {
            echo $args['before_widget'];
            if (isset($instance['title']) && !empty($instance['title'])) {
                echo $args['before_title'] . apply_filters('widget_title', esc_html($instance['title'])) . $args['after_title'];
            }
            ?>
			<div class="quick_block mb30">
				<div class="row m0 inner" style="background:<?php echo $instance['background_color']; ?>">
					<div class="row heading m0">
						 <h5 style='color: #FFF;'><?php echo $instance['subtitle']; ?></h5>
						 <h3><?php echo $instance['title']; ?></h3>
					</div>
					<p><?php echo $instance['content']; ?></p>
					<a href="<?php echo $instance['pageurl']; ?>"><?php echo $instance['pageurltext']; ?></a> 
				</div>
			</div>
            <?php
            echo $args['after_widget'];
        }

        function update($new_instance, $old_instance)
        {
            return $new_instance;
        }

        function form($instance)
        {
            $subtitle = (isset($instance['subtitle']) && !empty($instance['subtitle'])) ? $instance['subtitle'] : esc_html__('', 'medical-pro');
			$title = (isset($instance['title']) && !empty($instance['title'])) ? $instance['title'] : esc_html__('', 'medical-pro');
			$content = (isset($instance['content']) && !empty($instance['content'])) ? $instance['content'] : esc_html__('', 'medical-pro');
			$pageurl = (isset($instance['pageurl']) && !empty($instance['pageurl'])) ? $instance['pageurl'] : esc_html__('#', 'medical-pro');
			$pageurltext = (isset($instance['pageurltext']) && !empty($instance['pageurltext'])) ? $instance['pageurltext'] : esc_html__('', 'medical-pro');
			$background_color = (isset($instance['background_color']) && !empty($instance['background_color'])) ? $instance['background_color'] : esc_html__('#0186d5', 'medical-pro');
          
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Sub Title:', 'medical-pro'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>">
            </p>
			 <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'medical-pro'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            </p>
			 <p>
                <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:', 'medical-pro'); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo esc_html__($content); ?></textarea>
				
            </p>
			<p>
                <label for="<?php echo $this->get_field_id('pageurltext'); ?>"><?php _e('URL Text:', 'medical-pro'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('pageurltext'); ?>" name="<?php echo $this->get_field_name('pageurltext'); ?>" type="text" value="<?php echo esc_attr($pageurltext); ?>">
            </p>
			 <p>
                <label for="<?php echo $this->get_field_id('pageurl'); ?>"><?php _e('URL:', 'medical-pro'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('pageurl'); ?>" name="<?php echo $this->get_field_name('pageurl'); ?>" type="text" value="<?php echo esc_attr($pageurl); ?>">
            </p>
			 <p>
                <label for="<?php echo $this->get_field_id('background_color'); ?>"><?php _e('Background Color Code:', 'medical-pro'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('background_color'); ?>" name="<?php echo $this->get_field_name('background_color'); ?>" type="text" value="<?php echo esc_attr($background_color); ?>">
            </p>
          
            <?php
        }
    }
}


if (!function_exists('medical_pro_future_box_register_widget')) {
    function medical_pro_future_box_register_widget()
    {
        register_widget('Medical_Pro_Future_Box_Widget');
    }
}

add_action('widgets_init', 'medical_pro_future_box_register_widget');