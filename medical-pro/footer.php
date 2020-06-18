<?php global $medicalpro_options; ?>
<?php if ($medicalpro_options['display_call_to_action']) : ?>

    <?php if ($medicalpro_options['call_to_action_variation'] == "1") : ?>
        <section class="row book_banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        <div class="row m0">
                            <?php if($title = $medicalpro_options['call_to_action_title']) : ?><h3 class="bannerTitle"><?php echo esc_html($title); ?></h3><?php endif; ?>
                            <?php if($description = $medicalpro_options['call_to_action_description']) : ?><h5><?php echo esc_html($description); ?></h5><?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="row m0">
                            <?php if($medicalpro_options["book_appointment_form_is_offline"]) { ?>
                                <a href="#" data-toggle="modal" data-target="#appointmefnt_form_pop" class="view_all"><?php echo $medicalpro_options['call_to_action_button_text'] ? esc_html($medicalpro_options['call_to_action_button_text']) : esc_html_e('BOOK YOUR APPOINTMENT', 'medical-pro');?></a>
                            <?php } elseif($medicalpro_options["book_appointment_form_page_id"]) { ?>
                                <a href="<?php echo esc_url(get_the_permalink($medicalpro_options["book_appointment_form_page_id"])); ?>" class="view_all"><?php echo $medicalpro_options['call_to_action_button_text'] ? esc_html($medicalpro_options['call_to_action_button_text']) : esc_html_e('BOOK YOUR APPOINTMENT', 'medical-pro');?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php elseif ($medicalpro_options['call_to_action_variation'] == "2") : ?>

        <section class="row book_bannerType2">
            <div class="container">
                <div class="row m0">
                    <?php if($sub_title = $medicalpro_options['call_to_action_subtitle']) : ?><h4><?php echo esc_html($sub_title); ?></h4><?php endif; ?>
                    <?php if($title = $medicalpro_options['call_to_action_title']) : ?><h2 class="bannerTitle"><?php echo esc_html($title); ?></h2><?php endif; ?>

                    <?php if($description = $medicalpro_options['call_to_action_description']) : ?><p><?php echo esc_html($description); ?></p><?php endif; ?>
                    <?php if($medicalpro_options["book_appointment_form_is_offline"]) { ?>
                        <a href="#" data-toggle="modal" data-target="#appointmefnt_form_pop" class="view_all"><?php echo $medicalpro_options['call_to_action_button_text'] ? esc_html($medicalpro_options['call_to_action_button_text']) :  esc_html_e('BOOK YOUR APPOINTMENT', 'medical-pro'); ?></a>
                    <?php } elseif($medicalpro_options["book_appointment_form_page_id"]) { ?>
                        <a href="<?php echo esc_url(get_the_permalink($medicalpro_options["book_appointment_form_page_id"])); ?>" class="view_all"><?php echo $medicalpro_options['call_to_action_button_text'] ? esc_html($medicalpro_options['call_to_action_button_text']) :  esc_html_e('BOOK YOUR APPOINTMENT', 'medical-pro'); ?></a>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

<?php endif; ?>
<?php
$have_no_footer = (!isset($medicalpro_options['footer_page_id']) || !$medicalpro_options['footer_page_id']) ? ' style="padding:0px; background:#FFF;"' : '';
?>
<footer class="row bgf"<?php echo $have_no_footer; ?>>
    <div class="container">
        <?php
		if(isset($medicalpro_options['footer_page_id']) && $medicalpro_options['footer_page_id'])
		{
			$footer_post = get_post($medicalpro_options['footer_page_id']);
			if(!empty($footer_post))
			{
				echo do_shortcode($footer_post->post_content);
			}
		}

        ?>

        <?php if($medicalpro_options['display_footer_social_icons'] || $medicalpro_options['footer_copyright']) : ?>
        <div class="row m0 footer_bottom">
            <?php if($medicalpro_options['display_footer_social_icons']) : ?>
            <ul class="list-inline social_menu m0 fleft">
                <?php
                $social_urls = array(
                    'fa-skype' => $medicalpro_options['skype_username'],
                    'fa-twitter' => $medicalpro_options['twitter_url'],
                    'fa-facebook' => $medicalpro_options['facebook_url'],
                    'fa-google' => $medicalpro_options['google_url'],
                    'fa-linkedin' => $medicalpro_options['linkedin_url'],
                    'fa-pinterest' => $medicalpro_options['pinterest_url'],
                    'fa-instagram' => $medicalpro_options['instagram_url'],
                    'fa-youtube' => $medicalpro_options['youtube_url'],
                    'fa-rss' => $medicalpro_options['rss_url'],
                );

			
                foreach($social_urls as $icon => $url)
                {
                    if($url)
                    {
						if($icon == 'fa-skype')
						{
							echo '<li><a href="skype:'.$url.'?chat" target="_blank"><i class="fa '.$icon.'"></i></a></li>';
						}
						else
						{
							echo '<li><a href="'.esc_url($url).'" target="_blank"><i class="fa '.$icon.'"></i></a></li>';
						}
                    }
                }
                ?>
            </ul>
            <?php endif; ?>

            <?php if($copyright_txt = $medicalpro_options['footer_copyright']) : ?>
            <div class="fright copyright"><?php echo esc_html($copyright_txt); ?></div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</footer>

<div class="modal fade" id="appointmefnt_form_pop" tabindex="-1" role="dialog" aria-labelledby="appointmefnt_form_pop">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <?php echo do_shortcode('[medicalpro_appointment_form show_close_btn=1]'); ?>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>