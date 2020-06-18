<?php


class Custom_WC_Widget_Recent_Reviews extends WC_Widget_Recent_Reviews
{

    public function widget( $args, $instance ) {
        global $comments, $comment;

        if ( $this->get_cached_widget( $args ) ) {
            return;
        }

        ob_start();

        $number   = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];
        $comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'post_type' => 'product' ) );

        if ( $comments ) {
            $this->widget_start( $args, $instance );

            echo '<ul class="product_list_widget">';

            foreach ( (array) $comments as $comment ) {

                $product = wc_get_product( $comment->comment_post_ID );
                $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
                ?>
                <li>
                    <div class="image-col">
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>"><?php echo $product->get_image(); ?></a>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name"><?php echo $product->get_title(); ?></h3>
                        <div class="rating-box"><span title="<?php echo $rating; ?> out of 5" class="rating" style="width:<?php echo (($rating * 100) / 5) ?>%"></span></div>
                        <?php printf( '<div class="reviewer">' . _x( 'by %1$s', 'by comment author', 'medical-pro' ) . '</div>', get_comment_author() ); ?>
                    </div>
                </li>
<?php

            }

            echo '</ul>';

            $this->widget_end( $args );
        }

        $content = ob_get_clean();

        echo $content;

        $this->cache_widget( $args, $content );
    }

}