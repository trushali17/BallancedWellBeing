<?php
if(!function_exists('medical_pro_replace_email_tag'))
{
    function medical_pro_replace_email_tag($data, $text)
    {
        return str_replace(array_keys($data), array_values($data), $text);
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Book Appointment AJAX form Handler
/*-----------------------------------------------------------------------------------*/
if(!function_exists('medical_pro_book_appointment_form_ajax'))
{

    function medical_pro_book_appointment_form_ajax(){
        $f_name = sanitize_text_field($_POST['f_name']);
        $l_name = sanitize_text_field($_POST['l_name']);
        $email = sanitize_email($_POST['email']);
        $phone = sanitize_text_field($_POST['phone']);
        $date = sanitize_text_field($_POST['date']);
        $message = nl2br(esc_html($_POST['message']));
		$lastNameNotAvailable = sanitize_text_field($_POST['lastNameNotAvailable']);

        $errors = array();
        try {

            if(!isset($_POST['_wpnonce']) || !$_POST['_wpnonce'] || !wp_verify_nonce($_POST['_wpnonce'], 'book-appointment-form'))
            {
                throw new Exception(esc_html__('Error while submitting form.', 'medical-pro'));
            }

            if(!$f_name)
            {
                $errors['f_name'] = esc_html__('First Name must be required.', 'medical-pro');
            }

            if(!$l_name)
            {
                $errors['l_name'] = esc_html__('Last Name must be required.', 'medical-pro');
            }

            if(!$email)
            {
                $errors['email'] = esc_html__('Email must be required.', 'medical-pro');
            }

            if(!$date)
            {
                $errors['date'] = esc_html__('Booking Date must be required.', 'medical-pro');
            }

            if(!$message)
            {
                $errors['message'] = esc_html__('Message must be required.', 'medical-pro');
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $errors['email'] = esc_html__('Please enter valid email.', 'medical-pro');
            }

            $format = 'm/d/Y';
            $d = DateTime::createFromFormat($format, $date);
            if(!$d || $d->format($format) != $date)
            {
                $errors['date'] = esc_html__('Please select valid booking date.', 'medical-pro');
            }

            if(!empty($errors))
            {
                throw new Exception(esc_html__('Error while submitting form.', 'medical-pro'));
            }

            global $medicalpro_options;

			if(isset($_POST['lastNameNotAvailable']) && $_POST['lastNameNotAvailable'] == '1')
			{
				$l_name = "";
			}
			
            $tags = array(
                '{#FIRST_NAME#}' => $f_name,
                '{#LAST_NAME#}' => $l_name,
                '{#EMAIL#}' => $email,
                '{#PHONE#}' => $phone,
                '{#BOOKING_DATE#}' => date('d M Y', strtotime($date)),
                '{#MESSAGE#}' => $message,
            );
            $subject = medical_pro_replace_email_tag($tags, $medicalpro_options['book_appointment_admin_subject']);
            $message_body = medical_pro_replace_email_tag($tags, $medicalpro_options['book_appointment_admin_body']);

            $headers = array();
            $headers[] = "From: {$f_name} {$l_name} <{$email}>";
            $headers[] = 'Content-Type: text/html; charset=UTF-8';

            if(wp_mail($medicalpro_options['book_appointment_admin_to_email'], $subject, $message_body, $headers))
            {
                if($medicalpro_options['book_appointment_send_to_client'])
                {
                    $subject = medical_pro_replace_email_tag($tags, $medicalpro_options['book_appointment_client_subject']);
                    $message_body = medical_pro_replace_email_tag($tags, $medicalpro_options['book_appointment_client_body']);

                    $headers = array();
                    $headers[] = "From: {$medicalpro_options['book_appointment_client_from_email']}";
                    $headers[] = 'Content-Type: text/html; charset=UTF-8';
                    wp_mail($email, $subject, $message_body, $headers);
                }
            }

            echo json_encode(array('success' => esc_html__('Form has been submitted successfully.', 'medical-pro')));

        } catch(Exception $e)
        {
            echo json_encode(array('error' => $e->getMessage(), 'errors' => $errors));
        }

        wp_die();
    }
}

//hooks for ajax handler function
add_action('wp_ajax_book_appointment', 'medical_pro_book_appointment_form_ajax');

// for users who are not logged in
add_action('wp_ajax_nopriv_book_appointment', 'medical_pro_book_appointment_form_ajax');




/*-----------------------------------------------------------------------------------*/
/*	Contact Us AJAX form Handler
/*-----------------------------------------------------------------------------------*/
if(!function_exists('medical_pro_contact_us_form_ajax'))
{
    function medical_pro_contact_us_form_ajax()
    {
        $f_name = sanitize_text_field($_POST['contact_fname']);
        $l_name = sanitize_text_field($_POST['contact_lname']);
        $email = sanitize_email($_POST['contact_femail']);
        $phone = sanitize_text_field($_POST['contact_fphone']);
        $message = nl2br(esc_html($_POST['contact_fmsg']));

        try {

            if(!isset($_POST['_wpnonce']) || !$_POST['_wpnonce'] || !wp_verify_nonce($_POST['_wpnonce'], 'contact-us-form'))
            {
                throw new Exception(esc_html__('Error while submitting form.', 'medical-pro'));
            }

            if(!$f_name || !$l_name || !$email || !$message)
            {
                throw new Exception(esc_html__('All field are required.', 'medical-pro'));
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                throw new Exception(esc_html__('Please enter valid email address.', 'medical-pro'));
            }

            global $medicalpro_options;

            $tags = array(
                '{#FIRST_NAME#}' => $f_name,
                '{#LAST_NAME#}' => $l_name,
                '{#EMAIL#}' => $email,
                '{#PHONE#}' => $phone,
                '{#MESSAGE#}' => $message,
            );
            $subject = medical_pro_replace_email_tag($tags, $medicalpro_options['get_in_touch_admin_subject']);
            $message_body = medical_pro_replace_email_tag($tags, $medicalpro_options['get_in_touch_admin_body']);

            $headers = array();
            $headers[] = "From: {$f_name} {$l_name} <{$email}>";
            $headers[] = 'Content-Type: text/html; charset=UTF-8';

            if(wp_mail($medicalpro_options['get_in_touch_admin_to_email'], $subject, $message_body, $headers))
            {
                if($medicalpro_options['get_in_touch_send_to_client'])
                {
                    $subject = medical_pro_replace_email_tag($tags, $medicalpro_options['get_in_touch_client_subject']);
                    $message_body = medical_pro_replace_email_tag($tags, $medicalpro_options['get_in_touch_client_body']);

                    $headers = array();
                    $headers[] = "From: {$medicalpro_options['get_in_touch_client_from_email']}";
                    $headers[] = 'Content-Type: text/html; charset=UTF-8';
                    wp_mail($email, $subject, $message_body, $headers);
                }
            }

            echo json_encode(array('success' => esc_html__('Form has been submitted successfully.', 'medical-pro')));

        } catch(Exception $e)
        {
            echo json_encode(array('error' => $e->getMessage()));
        }

        wp_die();
    }
}

//hooks for ajax handler function
add_action('wp_ajax_contact_us', 'medical_pro_contact_us_form_ajax');

// for users who are not logged in
add_action('wp_ajax_nopriv_contact_us', 'medical_pro_contact_us_form_ajax');




/*-----------------------------------------------------------------------------------*/
/*	Newsletter AJAX form Handler
/*-----------------------------------------------------------------------------------*/
if(!function_exists('medical_pro_newsletter_form_ajax'))
{
    function medical_pro_newsletter_form_ajax()
    {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);

        $errors = array();

        try {

            if(!isset($_POST['_wpnonce']) || !$_POST['_wpnonce'] || !wp_verify_nonce($_POST['_wpnonce'], 'newsletter-form'))
            {
                throw new Exception(esc_html__('Error while submitting form.', 'medical-pro'));
            }

            if(!$name)
            {
                $errors['name'] = esc_html__('Please enter your name.', 'medical-pro');
            }

            if(!$email)
            {
                $errors['email'] = esc_html__('Please enter your email address.', 'medical-pro');
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $errors['email'] = esc_html__('Please enter valid email address.', 'medical-pro');
            }

            if(!empty($errors))
            {
                throw new Exception(esc_html__('Error while submitting form.', 'medical-pro'));
            }

            global $medicalpro_options;

            $tags = array(
                '{#NAME#}' => $name,
                '{#EMAIL#}' => $email,
            );
            $subject = medical_pro_replace_email_tag($tags, $medicalpro_options['newsletter_admin_subject']);
            $message_body = medical_pro_replace_email_tag($tags, $medicalpro_options['newsletter_admin_body']);

            $headers = array();
            $headers[] = "From: {$name} <{$email}>";
            $headers[] = 'Content-Type: text/html; charset=UTF-8';

            if(wp_mail($medicalpro_options['newsletter_admin_to_email'], $subject, $message_body, $headers))
            {
                if($medicalpro_options['newsletter_send_to_client'])
                {
                    $subject = medical_pro_replace_email_tag($tags, $medicalpro_options['newsletter_client_subject']);
                    $message_body = medical_pro_replace_email_tag($tags, $medicalpro_options['newsletter_client_body']);

                    $headers = array();
                    $headers[] = "From: {$medicalpro_options['newsletter_client_from_email']}";
                    $headers[] = 'Content-Type: text/html; charset=UTF-8';
                    wp_mail($email, $subject, $message_body, $headers);
                }
            }

            echo json_encode(array('success' => esc_html__('Form has been submitted successfully.', 'medical-pro')));

        } catch(Exception $e)
        {
            echo json_encode(array('error' => $e->getMessage(), 'errors' => $errors));
        }

        wp_die();
    }
}
//hooks for ajax handler function
add_action('wp_ajax_newsletter_form_handler', 'medical_pro_newsletter_form_ajax');

// for users who are not logged in
add_action('wp_ajax_nopriv_newsletter_form_handler', 'medical_pro_newsletter_form_ajax');