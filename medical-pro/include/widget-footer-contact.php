<?php

if(!class_exists('Medical_Pro_Footer_Contact_Widget'))
{
    class Medical_Pro_Footer_Contact_Widget extends WP_Widget
    {

        function __construct()
        {
            parent::__construct('footer-contact', esc_html__('Medical Pro Footer Contact', 'medical-pro'), array('description' => esc_html__('Display Recent Post', 'medical-pro')));
        }

        function widget($args, $instance)
        {
            echo $args['before_widget'];
            ?>
            <?php if(isset($instance['address']) && $instance['address']) { ?>
            <div class="media address_line">
                <div class="media-left icon"><i class="fa fa-map-marker"></i></div>
                <div class="media-body address_text"><?php echo nl2br(esc_html($instance['address'])); ?></div>
            </div>
        <?php } ?>

            <?php if(isset($instance['email']) && $instance['email']) { ?>
            <div class="media address_line">
                <div class="media-left icon"><i class="fa fa-envelope"></i></div>
                <div class="media-body address_text"><a href="mailto:<?php echo esc_attr($instance['email']); ?>"><?php echo esc_html($instance['email']); ?></a></div>
            </div>
        <?php } ?>


            <?php if(isset($instance['phone']) && $instance['phone']) { ?>
            <div class="media address_line">
                <div class="media-left icon"><i class="fa fa-phone"></i></div>
                <div class="media-body address_text"><?php echo esc_html($instance['phone']); ?></div>
            </div>
        <?php } ?>

            <?php
            echo $args['after_widget'];
        }

        function update($new_instance, $old_instance)
        {
            return $new_instance;
        }

        function form($instance)
        {
            $address = isset($instance['address']) ? $instance['address'] : esc_html__("Area 51 , Some near unknown,\nUSA 000000", 'medical-pro');
            $email = isset($instance['email']) ? $instance['email'] : esc_html__('info@medicalprotheme.com', 'medical-pro');
            $phone = isset($instance['phone']) ? $instance['phone'] : esc_html__('123 7890 456', 'medical-pro');
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('address'); ?>"><?php esc_html_e('Address:', 'medical-pro'); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo esc_textarea($address); ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('email'); ?>"><?php esc_html_e('Email:', 'medical-pro'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('phone'); ?>"><?php esc_html_e('Phone:', 'medical-pro'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>">
            </p>
            <?php
        }
    }
}


if (!function_exists('medical_pro_footer_contact_register_widget')) {
    function medical_pro_footer_contact_register_widget()
    {
        register_widget('Medical_Pro_Footer_Contact_Widget');
    }
}

add_action('widgets_init', 'medical_pro_footer_contact_register_widget');