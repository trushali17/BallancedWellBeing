<?php

if(!class_exists('Medical_Pro_Other_Department_Widget'))
{
    class Medical_Pro_Other_Department_Widget extends WP_Widget
    {

        function __construct()
        {
            parent::__construct('other-department', esc_html__('Medical Pro Department', 'medical-pro'), array('description' => esc_html__('Display Department List', 'medical-pro')));
        }

        function widget($args, $instance)
        {
            echo $args['before_widget'];
            if ( isset($instance['title']) && !empty($instance['title']) ) {
                echo $args['before_title'] . apply_filters('widget_title', esc_html($instance['title'])) . $args['after_title'];
            }
            ?>
            <div class="other_services">
                <ul class="list-unstyled services_list">
                    <?php
                    $department = new WP_Query();
                    $department->query(array('post_type' => 'department','posts_per_page'=>-1));

                    while ($department->have_posts()) : $department->the_post();
                        ?>
                        <li><i class="fa fa-arrow-right"></i> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                        <?php
                    endwhile;
                    wp_reset_query();
                    ?>
                </ul>
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
            $title = (isset($instance['title']) && !empty($instance['title'])) ? $instance['title'] : __('Other Department', 'medical-pro');
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'medical-pro'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            </p>
            <?php
        }
    }
}



if (!function_exists('other_department_register_widget')) {
    function other_department_register_widget()
    {
        register_widget('Medical_Pro_Other_Department_Widget');
    }
}

add_action('widgets_init', 'other_department_register_widget');