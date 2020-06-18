<?php

// Remove Default Style
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );


//Set 3 column layout
if (!function_exists('medicalpro_shop_loop_columns'))
{
    function medicalpro_shop_loop_columns()
    {
        return 3;
    }
}
add_filter('loop_shop_columns', 'medicalpro_shop_loop_columns');


//Set 12 product display per page
if (!function_exists('medicalpro_shop_loop_shop_per_page'))
{
    function medicalpro_shop_loop_shop_per_page()
    {
        return 12;
    }
}
add_filter('loop_shop_per_page', 'medicalpro_shop_loop_shop_per_page');

// Remove Order Review
remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review');

// Remove On Sale
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash');

// Remove Product Meta
//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

if(!function_exists('medicalpro_shop_override_woocommerce_widgets'))
{
    function medicalpro_shop_override_woocommerce_widgets() {
        if ( class_exists( 'WC_Widget_Recent_Reviews' ) ) {
            unregister_widget( 'WC_Widget_Recent_Reviews' );

            require_once ( get_template_directory() .'/woocommerce/widgets/widget-recent-reviews.php');

            register_widget( 'Custom_WC_Widget_Recent_Reviews' );
        }

    }
}
add_action( 'widgets_init', 'medicalpro_shop_override_woocommerce_widgets', 15 );

//Product Detail Page Social Media Sharing button
if(!function_exists('medicalpro_shop_share'))
{
    function medicalpro_shop_share()
    {
        echo '<div class="sharing-links">
                                <ul>
                                    <li>Share :</li>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>';
    }
}
add_action('woocommerce_share', 'medicalpro_shop_share');


function medicalpro_shop_related_products_args( $args ) {
    $args['posts_per_page'] = 3; // 4 related products
    $args['columns'] = 3; // arranged in 2 columns
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'medicalpro_shop_related_products_args' );


// Remove Multiple Price from Loop
function medicalpro_shop_variation_price_format( $price, $product )
{
    if(is_shop())
    {
        // Main Price
        $prices = array($product->get_variation_price('min', true), $product->get_variation_price('max', true));
        $price = wc_price($prices[0]);

        // Sale Price
        $prices = array($product->get_variation_regular_price('min', true), $product->get_variation_regular_price('max', true));
        sort($prices);

        $saleprice = wc_price($prices[0]);
        if ($price !== $saleprice) {
            $price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
        }
    }

    return $price;
}
add_filter('woocommerce_variable_sale_price_html', 'medicalpro_shop_variation_price_format', 10, 2);
add_filter('woocommerce_variable_price_html', 'medicalpro_shop_variation_price_format', 10, 2);