<?php get_header(); ?>

    <section class="row product_list_wrap">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-9 product_list">
                    <?php
                    if (have_posts()) :
                        woocommerce_content();
                    else :
                        get_template_part('content', 'none');
                    endif;
                    ?>
                </div>
                <div class="col-sm-12 col-md-3 sidebar">
                    <?php get_sidebar('shop') ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>