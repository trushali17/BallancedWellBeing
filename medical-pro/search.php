<?php get_header(); 
get_template_part( 'partial/breadcrumb' );
?>

    <section class="row content_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 blog_list">
                    <!--Loop Start-->
                    <?php

                    if(have_posts()) :
                        while(have_posts())
                        {
                            the_post();
                            $archive_year  = get_the_time('Y');
                            $archive_month = get_the_time('m');
                            $archive_day   = get_the_time('d');
    ?>
                            <div id="post-<?php the_ID(); ?>" <?php post_class("row m0 blog blog2"); ?>>
                                <div class="media-body">
                                    <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                   <?php get_template_part( 'partial/post-meta'); ?>
                                    <p><?php the_excerpt(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="view_all"><?php echo $medicalpro_options['blog_read_more_button_text']; ?></a>
                                </div>
                            </div>
                            <?php
                        }
                    else :
                        get_template_part( 'content', 'none' );
                    endif;
                    global $wp_query;
                    medical_pro_pagination($wp_query);
                    ?>
                    <!--single blog-->
                    <!--Loop End-->
                </div>
                <div class="col-sm-12 col-md-4 sidebar">
                    <?php
                    if ( is_active_sidebar( 'blog-post' ) ){
                        dynamic_sidebar( 'blog-post' );
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>


<?php get_footer(); ?>