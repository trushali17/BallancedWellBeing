<?php
/*
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */


//Register the required plugins for this theme.
if(!function_exists('medical_pro_register_required_plugins'))
{
    function medical_pro_register_required_plugins() {
        /*
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(
            array(
                'name' => 'Redux Framework',
                'slug' => 'redux-framework',
                'required' => true,
                'force_activation' => false,
                'force_deactivation' => false
            ),
            array(
                'name' => 'cmb2 Metabox',
                'slug' => 'cmb2',
				'source'    => get_template_directory() . '/include/plugins/cmb2.zip', // The plugin source.
                'required' => true,
                'force_activation' => false,
                'force_deactivation' => false
            ),
            array(
                'name'      => 'Medical Pro',
                'slug'      => 'medical-pro',
                'source'    => get_template_directory() . '/include/plugins/medical-pro.zip', // The plugin source.
                'required'  => true,
                'force_activation' => false,
                'force_deactivation' => false
            ),
			array(
                'name'      => 'Medical Pro Importer',
                'slug'      => 'medical-pro-importer',
                'source'    => get_template_directory() . '/include/plugins/medical-pro-importer.zip', // The plugin source.
                'required'  => true,
                'force_activation' => false,
                'force_deactivation' => false
            ),
            array(
                'name'      => 'Revolution Slider',
                'slug'      => 'revslider',
                'source'    => get_template_directory() . '/include/plugins/revslider.zip', // The plugin source.
                'required'  => true,
                'force_activation' => false,
                'force_deactivation' => false
            ),
            array(
                'name'      => 'Timetable Responsive Schedule For WordPress',
                'slug'      => 'timetable',
                'source'    => get_template_directory() . '/include/plugins/timetable.zip', // The plugin source.
                'required'  => true,
                'force_activation' => false,
                'force_deactivation' => false
            ),
            array(
                'name'      => 'WPBakery Visual Composer',
                'slug'      => 'js_composer',
                'source'    => get_template_directory() . '/include/plugins/js_composer.zip', // The plugin source.
                'required'  => true,
                'force_activation' => false,
                'force_deactivation' => false
            ),
			array(
                'name'      => 'Online Appointment Booking',
                'slug'      => 'booked',
                'source'    => get_template_directory() . '/include/plugins/booked.zip', // The plugin source.
                'required'  => true,
                'force_activation' => false,
                'force_deactivation' => false
            ),
            array(
                'name' => 'WooCommerce',
                'slug' => 'woocommerce',
                'required' => false,
                'force_activation' => false,
                'force_deactivation' => false
            ),
            array(
                'name'      => 'WordPress Importer',
                'slug'      => 'wordpress-importer',
                'required'  => false,
            )
        );

        //Array of configuration settings. Amend each line as needed.
        $config = array(
            'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'themes.php',            // Parent menu slug.
            'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            //'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
        );

        tgmpa( $plugins, $config );
    }
}


add_action( 'tgmpa_register', 'medical_pro_register_required_plugins' );