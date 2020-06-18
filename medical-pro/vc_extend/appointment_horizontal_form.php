<?php

if(!function_exists('medical_pro_vc_appointment_horizontal_form'))
{
    function medical_pro_vc_appointment_horizontal_form() {
        vc_map( array(
            "name"  => esc_html__("Appointment Horizontal Form ", "medical-pro" ),
            "base"  => "medicalpro_appointment_horizontal_form",
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
                    "type"          => "textfield",
                    "class"         => "",
                    "heading"       => esc_html__("Title", "medical-pro"),
                    "value"         => esc_html__("YOUR ONESTOP SOLUTION MEDICAL SERVICES", "medical-pro"),
                    "param_name"    => "title",
                ),
				array(
                    "type"          => "textfield",
                    "class"         => "",
                    "heading"       => esc_html__("Description", "medical-pro"),
                    "value"         => esc_html__("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed augue vitae ex vulputate venenatis.", "medical-pro"),
                    "param_name"    => "description",
                ),
				array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Display Bottom Part", "medical-pro"),
                    "param_name"    => "display_bottom_part",
                    'value'         => array('Yes', 'No'),
                    "std"           => 'Yes',
                ),
				)
        ) );
    }
}
add_action('vc_before_init', 'medical_pro_vc_appointment_horizontal_form');


if(!function_exists('medical_pro_vc_appointment_horizontal_shortcode'))
{
    function medical_pro_vc_appointment_horizontal_shortcode($atts)
    {
		$atts = shortcode_atts(array(
			'display_top_part' => 'Yes',
			'title' => 'YOUR ONESTOP SOLUTION MEDICAL SERVICES',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sed augue vitae ex vulputate venenatis.',
			'display_bottom_part' => 'Yes',
			
        ), $atts);
		
		global $medicalpro_options;

        $phone = $medicalpro_options["phoneno_for_header"];
				
		if(isset($atts['display_top_part']) && $atts['display_top_part'] == 'Yes')
		{
			 $top_part = '<div class="form_top_part_row row m0">
				<div class="container">
					<div class="row m0 form_top_part">
						<h2>'.$atts['title'].'</h2>
						<p>'.$atts['description'].'</p>
						<h4>'.esc_html__('BOOK APPOINTMENT', 'medical-pro').'</h4>
					</div>
				</div>
			</div>';
		}
		if(isset($atts['display_bottom_part']) && $atts['display_bottom_part'] == 'Yes')
		{
			$bottom_part = '<div class="row m0 form_bottom_part_row">
				<div class="container">
					<div class="row m0 form_bottom_part">
						<a href="#"><img src="'.esc_attr(get_stylesheet_directory_uri()).'/images/call-now.png" alt="">'.esc_html($phone).'</a>
					</div>
				</div>
			</div>';
		}
		
		return '<section class="row">'.$top_part.'<form class="row m0 form_row appointment_home_form appointment_form" action="" novalidate autocomplete="off">
            <div class="container">
				 '.wp_nonce_field('book-appointment-form').'
				<div class="loading"></div>
				<input type="hidden" class="form-control" name="l_name" value="x">
				<input type="hidden" class="form-control" name="lastNameNotAvailable" value="1">
                <div class="row m0 inner">
                    <div class="col-sm-4">                        
                        <input type="text" class="form-control" name="f_name">
                        <div class="placeholder" for="f_name">'.esc_html__('your full name', 'medical-pro').'</div>
                    </div>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" name="email">
                        <div class="placeholder" for="email">'.esc_html__('your email address', 'medical-pro').'</div>
                    </div>
                    <div class="col-sm-4">
                        <input type="tel" class="form-control" name="phone">
                        <div class="placeholder" for="phone">'.esc_html__('your phone number', 'medical-pro').'</div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-append date">
                            <input type="text" class="form-control" name="date">
                            <div class="placeholder" for="date">'.esc_html__('appointment date', 'medical-pro').'</div>
                            <span class="add-on"><i class="icon-th"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-5 col-md-6">
                        <input type="text" class="form-control" name="message">
                        <div class="placeholder" for="message">'.esc_html__('your message', 'medical-pro').'</div>
                    </div>
					
                    <div class="col-sm-3 col-md-2">
                        <input type="submit" value="'.esc_attr__('Book Now', 'medical-pro').'">
                    </div>
                </div>
            </div>
        </form><div class="alert" style="display:none;"></div>'.$bottom_part.'</section>';
		
    }
}
add_shortcode('medicalpro_appointment_horizontal_form', 'medical_pro_vc_appointment_horizontal_shortcode');