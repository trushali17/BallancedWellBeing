<?php
/*
 * Template Name: Blog Variation 2
 */
?>

<?php get_header(); 
get_template_part( 'partial/breadcrumb' );
?>

    <section class="row content_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 blog_list">
                    <!--Loop Start-->
                    <?php
						 $query_arg = array(
							'post_type' => 'post'
						);

						$query_arg['order'] = 'DESC';
						$query_arg['orderby'] = 'ID';
						$query_arg['paged'] = max( 1, get_query_var('paged') );
						$query_arg['posts_per_page'] = get_option('posts_per_page');
						
						$blog_posts = new WP_Query();
						$blog_posts->query($query_arg);
						while($blog_posts->have_posts())
						{		
							$blog_posts->the_post();
							
							get_template_part('content', get_post_format());
						}
						wp_reset_query();
                        medical_pro_pagination($blog_posts);
						
						?>
					
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>


<?php get_footer(); ?>