<?php get_header(); 
get_template_part( 'partial/breadcrumb' );
?>

<div class="bgf sd-full-width clearfix">

            <?php
            if (have_posts()) :

                // Start the loop.
                while (have_posts()) : the_post();

                    ?>
                   
                   
                         <div><?php the_content(); ?></div>
                    
                <?php
				/*	if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif; */
                    // End the loop.
                endwhile;
            else :
                get_template_part('content', 'none');
            endif;
            ?>
</div>

<?php get_footer(); ?>