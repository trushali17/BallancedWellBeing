<?php get_header(); 
get_template_part( 'partial/breadcrumb' );
?>

    <section class="row contents404">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 logo404"><img src="<?php echo get_template_directory_uri() ?>/images/pages/404.png" alt=""></div>
                <div class="col-sm-6 col-sm-offset-1">
                    <h2>404</h2>
                    <h3>Error</h3>
                    <p><?php esc_html_e('Are you trying break our site or something?','medical-pro');?> <br> <?php esc_html_e('i mean ?  Move along. There is nothing to see here.','medical-pro');?></p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="view_all"><?php esc_html_e('go home page','medical-pro'); ?></a>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>