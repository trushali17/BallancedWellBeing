<?php

if(!class_exists('Medical_Pro_Recent_Post_Widget'))
{
    class Medical_Pro_Recent_Post_Widget extends WP_Widget
    {

        function __construct()
        {
            parent::__construct('recent-post', esc_html__('Medical Pro Recent Post', 'medical-pro'), array('description' => esc_html__('Display Recent Post', 'medical-pro')));
        }

        function widget($args, $instance)
        {
            echo $args['before_widget'];
            if (isset($instance['title']) && !empty($instance['title'])) {
                echo $args['before_title'] . apply_filters('widget_title', esc_html($instance['title'])) . $args['after_title'];
            }

            $instance['showposts'] = (isset($instance['showposts']) && intval($instance['showposts']) && $instance['showposts'] > 0) ? $instance['showposts'] : 3;

            $recent_post = new WP_Query();
            $recent_post->query(array('post_type' => 'post', 'showposts' => $instance['showposts'], 'paged' => 1, 'ignore_sticky_posts' => 1));
            ?>
            <div class="recent_posts">
                <?php
                while ($recent_post->have_posts()) : $recent_post->the_post();
                    ?>
                    <div class="media recent_post">
                        <?php if(has_post_thumbnail()) { ?>
                            <div class="media-left">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medical-pro-post-thumb-widget'); ?></a>
                            </div>
                        <?php } ?>
                        <div class="media-body">
                            <a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
                            <p><?php esc_html_e('on', 'medical-pro') ?>: <a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format') ); ?></a></p>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_query();
                ?>
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
            $title = (isset($instance['title']) && !empty($instance['title'])) ? $instance['title'] : esc_html__('Recent Post', 'medical-pro');
            $showposts = (isset($instance['showposts']) && intval($instance['showposts']) && $instance['showposts'] > 0) ? $instance['showposts'] : 3;
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'medical-pro'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('showposts'); ?>"><?php _e('Number of posts to show:', 'medical-pro'); ?></label>
                <input id="<?php echo $this->get_field_id('showposts'); ?>" name="<?php echo $this->get_field_name('showposts'); ?>" type="text" value="<?php echo esc_attr($showposts); ?>" size="3">
            </p>
            <?php
        }
    }
}


if (!function_exists('medical_pro_recent_post_register_widget')) {
    function medical_pro_recent_post_register_widget()
    {
        register_widget('Medical_Pro_Recent_Post_Widget');
    }
}

add_action('widgets_init', 'medical_pro_recent_post_register_widget');