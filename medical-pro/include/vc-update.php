<?php
/**
 * Update Visual Composer Parameters
 *
 */
 
// Row
$row_atts = array (
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Center content?', 'hostingpress' ),
		'param_name' => 'centered',
		'value'      => array(
							__( 'No', 'hostingpress' )  => 'no',
							__( 'Yes', 'hostingpress' ) => 'yes',
							),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Margin Top', 'hostingpress' ),
		'param_name'  => 'sd_margin_top',
		'description' => __( 'eg. 20px', 'hostingpress' ),
		'group'       => __( 'Margin', 'hostingpress' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Margin Bottom', 'hostingpress' ),
		'param_name'  => 'sd_margin_bottom',
		'description' => __( 'eg. 20px', 'hostingpress' ),
		'group'       => __( 'Margin', 'hostingpress' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Padding Top', 'hostingpress' ),
		'param_name'  => 'padding_top',
		'description' => __( 'eg. 20px', 'hostingpress' ),
		'group'       => __( 'Padding', 'hostingpress' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Padding Right', 'hostingpress' ),
		'param_name'  => 'padding_right',
		'description' => __( 'eg. 20px', 'hostingpress' ),
		'group'       => __( 'Padding', 'hostingpress' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Padding Bottom', 'hostingpress' ),
		'param_name'  => 'padding_bottom',
		'description' => __( 'eg. 20px', 'hostingpress' ),
		'group'       => __( 'Padding', 'hostingpress' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Padding Left', 'hostingpress' ),
		'param_name'  => 'padding_left',
		'description' => __( 'eg. 20px', 'hostingpress' ),
		'group'       => __( 'Padding', 'hostingpress' ),
	),
	array(
		'type'       => "colorpicker",
		'heading'    => __( 'Border Color', 'hostingpress' ),
		'param_name' => 'border_color',
		'value'      => '',
		'group'      => __( 'Border', 'hostingpress' ),
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Border Style', 'hostingpress' ),
		'param_name' => 'border_style',
		'value'      => array( 
							__( 'None', 'hostingpress' )   => 'none', 
							__( 'Solid', 'hostingpress' )  => 'solid',
							__( 'Dotted', 'hostingpress' ) => 'dotted',
							__( 'Dashed', 'hostingpress' ) => 'dashed',
						),
		'group'      => __( 'Border', 'hostingpress' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Border Width', 'hostingpress' ),
		'param_name'  => 'border_width',
		'description' => __( 'The width of your border. (eg. 1px 1px 1px 1px) Note: the widths are in this order: top right bottom left', 'hostingpress' ),
		'group'       => __( 'Border', 'hostingpress' )
	),
);

vc_add_params( 'vc_row', $row_atts );

// Separator
