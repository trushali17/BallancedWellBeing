
<?php get_header(); 
get_template_part( 'partial/breadcrumb' );
?>

    <div class="gallery-single-wrapper clearfix">
        <article class="gallery-single clearfix hentry">
            <div class="container">

                <div class="row">
                    <div class="<?php bc_all('12') ?>">
                        <div class="next-prev-posts pull-right clearfix">
                            <?php previous_post_link('%link', ''); ?>
                            <?php next_post_link('%link', ''); ?>
                        </div>
                    </div>
                </div>

                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        ?>
                        <div class="row">
                            <div class="<?php bc('7', '7', '7', ''); ?>">
                                <div class="gallery-single-post clearfix">
                                    <div class="clearfix" id="slider">
                                        <?php medical_pro_list_custom_gallery_images('gallery-post-single'); ?>
                                    </div>
                                    <?php
                                    $size_thumb = 'gallery-post-single-thumb';
									$gallery_images = get_post_meta($post->ID,'custom_gallery',true);
                      
                                    if (!empty($gallery_images)) {
                                        ?>
                                        <div id="carousel" class="flexslider">
                                            <ul class="slides">
                                                <?php
                                                foreach ($gallery_images as $gallery_image) {
                                                    echo '<li>';
                                                    echo '<img width="111" height="69" src="' . esc_url($gallery_image) . '" />';
                                                    echo '</li>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="<?php bc('5', '5', '5', ''); ?>">
                                <div class="side-content clearfix">
                                    <h1 class="entry-title"><?php the_title(); ?></h1>
                                    <div class="gallery-item-types">
                                        <i class="fa fa-tags"></i>
                                        <?php the_terms($post->ID, 'gallery-type', ' ', ', ', ' '); ?>
                                    </div>
                                    <div class="entry-content">
                                        <?php
                                        /* output contents */
                                        the_content();
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                endif;
                ?>
            </div>
        </article>
		<?php if ($medicalpro_options['display_related_gallery'] == '1') { ?>
       
            <div class="container">
                <div class="row">
                    <div class=" <?php bc_all('12') ?> ">
                        <div class="clearfix">
                            <div id="related-gallery-items-title" class="slogan-section text-left clearfix">
                                <?php
                                if (!empty($medicalpro_options['related_gallery_items_title'])) {
                                    echo '<h2>' . $medicalpro_options['related_gallery_items_title'] . '</h2>';
                                }
                                if (!empty($medicalpro_options['related_gallery_items_description'])) {
                                    echo '<p>' . $medicalpro_options['related_gallery_items_description'] . '</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <div class="related-gallery-items container">
            <div class="row">
                <?php get_template_part('partial/related-gallery-items'); ?>
            </div>
        </div>
		<?php }
        ?>

    </div>
<?php get_footer(); ?>