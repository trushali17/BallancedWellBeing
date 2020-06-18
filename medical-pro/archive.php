<?php get_header(); ?>

    <section class="row breadcrumbRow">
        <div class="container">
            <div class="row inner m0">
                <ul class="breadcrumb">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li><?php the_archive_title(); ?></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="row content_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 blog_list">
                    <!--Loop Start-->
					<?php
						
						while(have_posts())
						{		
							the_post();
							get_template_part('content', get_post_format());
						}
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