<?php get_header(); ?>

    <section class="row bgf">
        <div class="container">
            <div class="row content_section">
                <div class="col-sm-12 col-md-8 blog_list">
                    <?php
                    if (have_posts()) :

                        // Start the loop.
                        while (have_posts()) : the_post();

                            // Include the page content template.
                            get_template_part('content', get_post_format());

                            // End the loop.
                        endwhile;
                        global $wp_query;
                        medical_pro_pagination($wp_query);
                    else :
                        get_template_part('content', 'none');
                    endif;
                    ?>
                </div>
                <div class="col-sm-12 col-md-4 sidebar">
                    <?php
                    if (is_active_sidebar('blog-post')) {
                        dynamic_sidebar('blog-post');
                    }
                    ?>

                </div>
            </div>
    </section>




<?php get_footer(); ?>