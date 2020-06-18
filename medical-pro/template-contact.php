<?php
/*
 * Template Name: Contact Us
 */
?>

<?php get_header(); 
get_template_part( 'partial/breadcrumb' );
?>
<?php
while(have_posts()) : the_post();
    the_content();
endwhile;

global $medicalpro_options;
?>
    <section class="row contact_form_row">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 contact_form_area">
                    <h3 class="contact_section_title"><?php esc_html_e('get in touch', 'medical-pro'); ?></h3>
                    <div class="contactForm row m0">
                        <form action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" class="row contact_form" id="contactForm">
                            <?php wp_nonce_field('contact-us-form'); ?>
                            <input type="hidden" name="action" value="contact_us" />
                            <div class="row m0">
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <label for="contact_fname"><?php esc_html_e('First Name', 'medical-pro'); ?></label>
                                        <input type="text" class="form-control" id="contact_fname" name="contact_fname" tabindex="1">
                                    </div>
                                    <div class="input-group">
                                        <label for="contact_femail"><?php esc_html_e('E-mail Address', 'medical-pro'); ?></label>
                                        <input type="email" class="form-control" id="contact_femail" name="contact_femail" tabindex="3">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <label for="contact_lname"><?php esc_html_e('Last Name', 'medical-pro'); ?></label>
                                        <input type="text" class="form-control" id="contact_lname" name="contact_lname" tabindex="2">
                                    </div>
                                    <div class="input-group">
                                        <label for="contact_fphone"><?php esc_html_e('Phone Number', 'medical-pro'); ?></label>
                                        <input type="tel" class="form-control" id="contact_fphone" name="contact_fphone" tabindex="4">
                                    </div>
                                </div>
                            </div>
                            <div class="row m0">
                                <div class="col-sm-12">
                                    <label for="contact_fmsg"><?php esc_html_e('Details/Comments', 'medical-pro'); ?></label>
                                    <textarea name="contact_fmsg" id="contact_fmsg" class="form-control" tabindex="5"></textarea>
                                </div>
                            </div>
                            <div class="row m0">
                                <div class="col-sm-12">
                                    <div id="error" class="alert alert-danger">
                                        <span><?php esc_html_e('Something went wrong, try refreshing and submitting the form again.', 'medical-pro'); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row m0">
                                <div class="col-sm-12">
                                    <input type="submit" class="submit_btn" value="<?php esc_html_e('Submit', 'medical-pro'); ?>" tabindex="6">
                                </div>
                            </div>
                        </form>
                        <div id="success" class="text-center">
                            <span><?php esc_html_e('Your message was sent successfully! I will be in touch as soon as I can.', 'medical-pro'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 contact_address">
                    <h3 class="contact_section_title"><?php esc_html_e('Address', 'medical-pro'); ?></h3>
                    <div class="row address m0">
                        <div class="media address_line">
                            <div class="media-left icon"><i class="fa fa-map-marker"></i></div>
                            <div class="media-body address_text"><?php echo nl2br($medicalpro_options['contactus_address']); ?></div>
                        </div>
                        <div class="media address_line">
                            <div class="media-left icon"><i class="fa fa-envelope"></i></div>
                            <div class="media-body address_text"><a href="mailto:<?php echo esc_attr($medicalpro_options['contactus_email_address']); ?>"><?php echo esc_html($medicalpro_options['contactus_email_address']); ?></a></div>
                        </div>
                        <div class="media address_line">
                            <div class="media-left icon"><i class="fa fa-phone"></i></div>
                            <div class="media-body address_text"><?php echo esc_html($medicalpro_options['contactus_phone_number']); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if($medicalpro_options['contactus_display_map']) { ?>
    <section class="row map_row">
        <div class="container">
            <h3 class="contact_section_title"><?php esc_html_e('Direction', 'medical-pro'); ?></h3>
            <div id="mapBox" class="row m0"></div>
        </div>
    </section>
    <?php
        wp_enqueue_script('google-map');
    }
    ?>

<?php wp_enqueue_script('medical-pro-contact'); ?>

<?php get_footer(); ?>