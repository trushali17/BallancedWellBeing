<?php

if(!function_exists('vc_medical_pro_boxes'))
{
    function vc_medical_pro_boxes() {
        vc_map( array(
            "name"  => __("Boxes", "medicalpro" ),
            "base"  => "medicalpro_boxes",
            "category" => __("Medical Pro", "medicalpro"),
            'admin_enqueue_js' => '',
            'admin_enqueue_css' => '',
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    "type"          => "textfield",
                    "heading"       => __("Sub Title", "medicalpro"),
                    "param_name"    => "sub_title",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => __("Title", "medicalpro"),
                    "param_name"    => "title",
                ),
                array(
                    "type"          => "textarea",
                    "heading"       => __("Content", "medicalpro"),
                    "param_name"    => "box_content",
                ),
                array(
                    "type"          => "vc_link",
                    "heading"       => __("URL", "medicalpro"),
                    "param_name"    => "url",
                ),
                array(
                    "type"          => "colorpicker",
                    "heading"       => __("Box Background Color", "medicalpro"),
                    "param_name"    => "background_color",
                    "value"         => "#469FB4"
                ),
                array(
                    "type"          => "attach_image",
                    "heading"       => __("Box Background Icon", "medicalpro"),
                    "param_name"    => "background_icon",
                    "value"         => get_template_directory_uri() . '/images/pages/quick-blocks/4.png'
                ),
            )
        ) );
    }
}
add_action('vc_before_init', 'vc_medical_pro_boxes');


if(!function_exists('medicalpro_boxes_shortcode'))
{
    function medicalpro_boxes_shortcode($atts)
    {
        $atts = shortcode_atts(array(
            'sub_title' => '',
            'title' => '',
            'box_content' => '',
            'url' => '',
            'background_color' => '#469FB4',
            'background_icon' => get_template_directory_uri() . '/images/pages/quick-blocks/4.png',
        ), $atts);


        $sub_title = $atts['sub_title'];
        $title = $atts['title'];
        $box_color = $atts['background_color'];
        $background_icon = is_numeric($atts['background_icon']) ? wp_get_attachment_image_src($atts['background_icon']) : $atts['background_icon'];
        $background_icon = is_array($background_icon) ? $background_icon[0] : $background_icon;
        $content = do_shortcode($atts['box_content']);

        $url_text = "";
        $url = "javascript:;";
        $vc_url = explode("|", $atts['url']);
        if(!empty($vc_url))
        {
            foreach($vc_url as $vc_url)
            {
                $vc_url = explode(":", $vc_url);
                if($vc_url[0] == 'url')
                {
                    $url = urldecode($vc_url[1]);
                } else if($vc_url[0] == 'title')
                {
                    $url_text = urldecode($vc_url[1]);
                }
            }
        }

        $current_box_html = '<div class="quick_block mb30">';

        $current_box_html .= '<div class="row m0 inner" style="background: url('.$background_icon.') no-repeat scroll right bottom '.$box_color.';">';

        $current_box_html .= '<div class="row heading m0">';
        $current_box_html .= $sub_title ? "<h5 style='color: #FFF;'>{$sub_title}</h5>" : '';
        $current_box_html .= $title ? "<h3>{$title}</h3>" : '';
        $current_box_html .= '</div>';


        $current_box_html .= "<p>{$content}</p>";

        $current_box_html .= $url_text ? '<a href="'.$url.'">'.$url_text.'</a>' : '';

        $current_box_html .= '</div>';

        $current_box_html .= '</div>';


        return $current_box_html;

    }
}
add_shortcode('medicalpro_boxes', 'medicalpro_boxes_shortcode');