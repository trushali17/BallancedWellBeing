<?php

if(!function_exists('medical_pro_vc_appointment_form'))
{
    function medical_pro_vc_appointment_form() {
        vc_map( array(
            "name"  => esc_html__("Appointment Form", "medical-pro" ),
            "base"  => "medicalpro_appointment_form",
            "class" => "",
            "category" => esc_html__("Medical Pro", "medical-pro"),
            'admin_enqueue_js' => '',
            'admin_enqueue_css' => '',
            "show_settings_on_create" => false,
            "params" => array(
				array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Display Top Part", "medical-pro"),
                    "param_name"    => "display_top_part",
                    'value'         => array('Yes', 'No'),
                    "std"           => 'Yes',
                ),
				array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Display Bottom Part", "medical-pro"),
                    "param_name"    => "display_buttom_part",
                    'value'         => array('Yes', 'No'),
                    "std"           => 'Yes',
                ),
				array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Show Close Button", "medical-pro"),
                    "param_name"    => "display_close_part",
                    'value'         => array('','Yes', 'No'),
                    "std"           => '',
                ),
			
				)
        ) );
    }
}
add_action('vc_before_init', 'medical_pro_vc_appointment_form');


if(!function_exists('medical_pro_vc_appointment_shortcode'))
{
    function medical_pro_vc_appointment_shortcode($atts)
    {
        
		$atts = shortcode_atts(array(
			
            
			'display_top_part' => 'Yes',
			'display_buttom_part' => 'Yes',
			'show_close_btn' => '',
        ), $atts);
		
		global $medicalpro_options;

		
		
        $close_btn = '';
        if(isset($atts['show_close_btn']) && $atts['show_close_btn'])
        {
            $close_btn = '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<i class="fa fa-times-circle-o"></i>
							</button>';
        }

        $phone_no_block = '';
        if($phone = $medicalpro_options["phoneno_for_header"]) {
			$col_now_img = $close_btn ? '/images/call-now3.png' : '/images/call-now2.png';
			
			 if(isset($atts['display_buttom_part']) && $atts['display_buttom_part'] == 'Yes')
			 {
					$phone_no_block = '<div class="row m0 form_footer"><a href="javascript:void(0)"><img src="'.esc_attr(get_stylesheet_directory_uri().$col_now_img).'" alt="">'.esc_html($phone).'</a></div>';
			 }
        }
		$top_bar = '';
		if(isset($atts['display_top_part']) && $atts['display_top_part'] == 'Yes')
		{
			$top_bar = '<h2 class="title">'.esc_html__('BOOK', 'medical-pro').'<br>'.esc_html__('NOW', 'medical-pro').'</h2>';
		}
		else
		{
			$top_bar = '';
		}

        return '<form action="" class="row m0 appointment_home_form2 appointment_form" novalidate autocomplete="off">
'.$close_btn.''.$top_bar.'

    <div class="form_inputs row m0">
        '.wp_nonce_field('book-appointment-form').'
        <div class="loading"></div>
		<input type="hidden" class="form-control" name="lastNameNotAvailable" value="0">
        <div class="row m0 input_row">
            <div class="col-sm-12 col-md-12 col-lg-6 p0">
                <label for="f_name">'.esc_html__('First Name', 'medical-pro').'</label>
                <input name="f_name" type="text" class="form-control" id="f_name" placeholder="'.esc_attr__('Your First Name', 'medical-pro').'">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 p0">
                <label for="l_name">'.esc_html__('Last Name', 'medical-pro').'</label>
                <input name="l_name" type="text" class="form-control" id="l_name" placeholder="'.esc_attr__('Your Last Name', 'medical-pro').'">
            </div>
        </div>
        <div class="row m0 input_row">
            <label for="email">'.esc_html__('Email Address', 'medical-pro').'</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="'.esc_attr__('Enter your Email Address', 'medical-pro').'">
        </div>
        <div class="row m0 input_row">
            <label for="phone">'.esc_html__('Phone Number', 'medical-pro').'</label>
            <input name="phone" type="tel" class="form-control" id="phone" placeholder="'.esc_attr__('Enter your Phone Number', 'medical-pro').'">
        </div>
        <div class="row m0 input_row">
            <label for="date">'.esc_html__('Booking Date', 'medical-pro').'</label>
            <div class="input-append date">
                <input type="text" class="form-control" name="date" id="date" placeholder="'.esc_attr__('Select the Appointment Date', 'medical-pro').'">
                <span class="add-on"><i class="icon-th"></i></span>
            </div>
        </div>
        <div class="row m0 input_row" id="message_row">
            <label for="message">'.esc_html__('Message', 'medical-pro').'</label>
            <textarea name="message" id="message" class="form-control" placeholder="'.esc_attr__('Write down the Message', 'medical-pro').'"></textarea>
        </div>
        <div class="alert" style="display:none;"></div>
        <input type="submit" class="form-control" value="'.esc_attr__('book your appointment now', 'medical-pro').'">
    </div>
    '.$phone_no_block.'
</form>';
    }
}
add_shortcode('medicalpro_appointment_form', 'medical_pro_vc_appointment_shortcode');