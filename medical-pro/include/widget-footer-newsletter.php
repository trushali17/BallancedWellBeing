<?php

if(!class_exists('Medical_Pro_Footer_Newsletter_Widget'))
{
    class Medical_Pro_Footer_Newsletter_Widget extends WP_Widget
    {

        function __construct()
        {
            parent::__construct('footer-newsletter', esc_html__('Medical Pro Footer Newsletter', 'medical-pro'), array('description' => esc_html__('Display Recent Post', 'medical-pro')));
        }

        function widget($args, $instance)
        {
            $ajax_url = esc_url(admin_url('admin-ajax.php'));
            $style = (isset($instance['style']) && intval($instance['style'])) ? $instance['style'] : 1;

            echo $args['before_widget'];
            ?>
            <?php if($style == 1) { ?>
            <form name="newsletterForm" action="<?php echo $ajax_url; ?>" class="row m0 newsletterForm" novalidate autocomplete="off">
                <div class="loading"></div>
                <?php wp_nonce_field('newsletter-form'); ?>
                <input type="hidden" name="action" value="newsletter_form_handler">
                <input name="name" type="text" class="form-control" placeholder="<?php esc_attr_e('Your Name', 'medical-pro'); ?>">
                <input name="email" type="text" class="form-control" placeholder="<?php esc_attr_e('Enter your Email Address', 'medical-pro'); ?>">
                <input type="submit" class="form-control" value="submit">
                <div class="msg"></div>
            </form>
        <?php } else { ?>
            <form name="newsletterForm" action="<?php echo $ajax_url; ?>" class="row m0 appointment_home_form2" novalidate autocomplete="off">
                <div class="loading"></div>
                <?php wp_nonce_field('newsletter-form'); ?>
                <input type="hidden" name="action" value="newsletter_form_handler">
                <div class="form_inputs row m0">
                    <div class="row m0 input_row">
                        <label for="name"><?php esc_html_e('Enter your Name', 'medical-pro'); ?></label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="<?php esc_attr_e('Your Name', 'medical-pro'); ?>">
                    </div>
                    <div class="row m0 input_row">
                        <label for="email"><?php esc_html_e('Email Address', 'medical-pro'); ?></label>
                        <input name="email" type="text" class="form-control" id="email" placeholder="<?php esc_attr_e('Enter your Email Address', 'medical-pro'); ?>">
                    </div>
                    <input type="submit" class="form-control" value="submit">
                    <div class="msg"></div>
                </div>
            </form>
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
            $style = (isset($instance['style']) && intval($instance['style'])) ? $instance['style'] : 1;
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('style_1'); ?>">
                    <input class="widefat" id="<?php echo $this->get_field_id('style_1'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="radio" value="1"<?php echo $style == 1 ? ' checked="checked"' : ''; ?>>
                    <?php esc_html_e('Style 1', 'medical-pro'); ?>
                    <img src="<?php echo get_template_directory_uri() ?>/images/theme-options/newsletter-1.jpg" style="margin-top: 5px;" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('style_2'); ?>">
                    <input class="widefat" id="<?php echo $this->get_field_id('style_2'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="radio" value="2"<?php echo $style == 2 ? ' checked="checked"' : ''; ?>>
                    <?php esc_html_e('Style 2', 'medical-pro'); ?>
                    <img src="<?php echo get_template_directory_uri() ?>/images/theme-options/newsletter-2.jpg" style="margin-top: 5px;" />
                </label>
            </p>
            <?php
        }
    }
}



if (!function_exists('medical_pro_footer_newsletter_register_widget')) {

    function medical_pro_footer_newsletter_register_widget()
    {
        register_widget('Medical_Pro_Footer_Newsletter_Widget');
    }

}

add_action('widgets_init', 'medical_pro_footer_newsletter_register_widget');