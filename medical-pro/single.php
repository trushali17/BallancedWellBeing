<?php get_header(); 
get_template_part( 'partial/breadcrumb' );
?>

<?php while (have_posts()) : the_post(); ?>
    <section class="row content_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="row m0 blog single_post">
                        <?php
                        switch (get_post_format()) {
                        case 'gallery' :
                            ?>
                            <div class="gallery gallery-slider clearfix">
                                <?php medical_pro_list_gallery_images(); ?>
                            </div>
                            <h3><?php the_title(); ?></h3>
                            <?php
                            $archive_year  = get_the_time('Y');
                            $archive_month = get_the_time('m');
                            $archive_day   = get_the_time('d');
                            ?>
                            <?php get_template_part( 'partial/post-meta'); ?>
							<div class="entry-content"><?php the_content(); ?>
							<?php wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'medical-pro' ),
								'after'  => '</div>',
							) );
							?>
						</div>
                        <?php
                        break;

                        case 'link' :
                        $post_meta = get_post_meta(get_the_ID());
                        ?>
                            <h3><i class="fa fa-link"></i><?php the_title(); ?></h3>
                            <?php
                            $archive_year  = get_the_time('Y');
                            $archive_month = get_the_time('m');
                            $archive_day   = get_the_time('d');
                            ?>
                            <?php get_template_part( 'partial/post-meta'); ?>
                            <p><a href="<?php echo esc_url($post_meta['link_url'][0]); ?>" target="_blank"><?php echo esc_url($post_meta['link_url'][0]); ?></a></p>
                            <p><?php the_excerpt(); ?></p>
                        <?php
                        break;

                        case 'quote' :
                        $post_meta = get_post_meta(get_the_ID());
                        ?>
                            <blockquote class="m0">
                                <h2>&#8220;<?php echo esc_html($post_meta['quote_text'][0]); ?>&#8221;</h2>
                                <a href="javascript:;"
                                   target="_blank">- <?php echo esc_html($post_meta['quote_author'][0]); ?></a>
                            </blockquote>
                        <?php
                        break;

                        case 'audio' :
                        $post_meta = get_post_meta(get_the_ID());
                        $audio_embed_code = isset($post_meta['audio_embed_code'][0]) ? $post_meta['audio_embed_code'][0] : '';
                        $mp3_audio_file = isset($post_meta['mp3_audio_file'][0]) ? $post_meta['mp3_audio_file'][0] : '';
                        if ($mp3_audio_file) {
                            $mp3_audio_url = wp_get_attachment_url($mp3_audio_file);
                        }

                        if (!empty($mp3_audio_file)) {
                        ?>
                            <div id="jplayer_<?php the_ID(); ?>" class="jp-jplayer jp-jplayer-audio"></div>

                            <div class="jp-audio-container">
                                <div class="jp-audio">
                                    <div id="jp_interface_<?php the_ID(); ?>" class="jp-interface">
                                        <ul class="jp-controls">
                                            <li><a href="#" class="jp-play" tabindex="1"><?php esc_html_e('play', 'medical-pro'); ?></a></li>
                                            <li><a href="#" class="jp-pause" tabindex="1"><?php esc_html_e('pause', 'medical-pro'); ?></a></li>
                                            <li><a href="#" class="jp-mute" tabindex="1"><?php esc_html_e('mute', 'medical-pro'); ?></a></li>
                                            <li><a href="#" class="jp-unmute" tabindex="1"><?php esc_html_e('unmute', 'medical-pro'); ?></a></li>
                                        </ul>
                                        <div class="jp-progress">
                                            <div class="jp-seek-bar">
                                                <div class="jp-play-bar"></div>
                                            </div>
                                        </div>
                                        <div class="jp-volume-bar-container">
                                            <div class="jp-volume-bar">
                                                <div class="jp-volume-bar-value"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script type="text/javascript">
                                jQuery(document).ready(function ($) {
                                    if (jQuery().jPlayer) {
                                        jQuery("#jplayer_<?php the_ID(); ?>").jPlayer({
                                            ready: function () {
                                                $(this).jPlayer("setMedia", {
                                                    <?php
                                                    if( !empty($mp3_audio_url) ) {
                                                        ?>mp3: "<?php echo esc_url($mp3_audio_url); ?>" <?php
                            }
                            ?>
                                                });
                                            },
                                            swfPath: "<?php echo get_template_directory_uri(); ?>/js",
                                            cssSelectorAncestor: "#jp_interface_<?php the_ID(); ?>",
                                            supplied: "<?php if( !empty($mp3_audio_url) ) : ?>mp3,<?php endif; ?>all"
                                        });
                                    }
                                });
                            </script>
                        <?php
                        } else if (!empty($audio_embed_code)) {
                        ?>
                            <div class="embed-responsive embed-responsive-16by9 image_row">
                                <iframe class="embed-responsive-item" src="<?php echo esc_url($audio_embed_code); ?>"></iframe>
                            </div>
                        <?php } else { ?>
                            <div class="image_row row m0">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        <?php } ?>
                            <h3><?php the_title(); ?></h3>
                        <?php
                        $archive_year  = get_the_time('Y');
                        $archive_month = get_the_time('m');
                        $archive_day   = get_the_time('d');
                        ?>
                           <?php get_template_part( 'partial/post-meta'); ?>
							 <div class="entry-content"><?php the_content(); ?></div>
                        <?php
                        //the_content();
                        break;

                        case 'video' :
                        $post_meta = get_post_meta(get_the_ID());
                        $embed_code = $post_meta['video_embed_code'][0];
                        ?>

                        <?php if (!empty($embed_code)) { ?>
                            <div class="embed-responsive embed-responsive-16by9 image_row">
                                <iframe class="embed-responsive-item" src="<?php echo esc_url($embed_code); ?>"></iframe>
                            </div>
                        <?php } else { ?>
                            <div class="image_row row m0">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        <?php } ?>
                            <h3><?php the_title(); ?></h3>
                            <?php
                            $archive_year  = get_the_time('Y');
                            $archive_month = get_the_time('m');
                            $archive_day   = get_the_time('d');
                            ?>
                           <?php get_template_part( 'partial/post-meta'); ?>
                        <div class="entry-content"><?php the_content(); ?></div>
                        <?php
                        break;

                        default :
                        ?>
							 <?php if(has_post_thumbnail()) { ?>
                            <div class="image_row row m0">
                                <?php the_post_thumbnail(); ?>
                            </div>
							<?php } ?>
                            <h3><?php the_title(); ?></h3>
                            <?php
                            $archive_year  = get_the_time('Y');
                            $archive_month = get_the_time('m');
                            $archive_day   = get_the_time('d');
                            ?>
                            <?php get_template_part( 'partial/post-meta'); ?>
                            <div class="entry-content"><?php the_content(); ?>
							<?php wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'medical-pro' ),
								'after'  => '</div>',
							) );
							?>
							</div>
                            <?php
                            break;
                        }
                        ?>
                    </div>


                    <!--Tags-->
                    <?php the_tags('<div class="row m0 tags">Tags: ', ', ', '</div>'); ?>

                    <!--Related Post-->
                    <?php
                    $orig_post = $post;
                    global $post;
                    $tags = wp_get_post_tags($post->ID);

                    if ($tags) :
                        $tag_ids = array();
                        foreach ($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                        $args = array(
                            'tag__in' => $tag_ids,
                            'post__not_in' => array($post->ID),
                            'posts_per_page' => 2, // Number of related posts to display.
                            'ignore_sticky_posts' => 1,
                            'orderby' => 'rand',
                        );

                        $my_query = new wp_query($args);

                        if ($my_query->post_count > 0) :
                            ?>

                            <div class="widget related row m0">
                                <h5 class="widget_heading">Related</h5>

                                <div class="row m0">
                                    <?php
                                    while ($my_query->have_posts()) {
                                        $my_query->the_post();
                                        ?>
                                        <div class="col-sm-6">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            <?php
                                            $categories = get_the_category();
                                            $output = '';
                                            if (!empty($categories)) {
                                                echo 'In "';
                                                foreach ($categories as $category) {
                                                    $output .= esc_html($category->name) . ', ';
                                                }
                                                echo trim($output, ', ');
                                                echo '"';
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        <?php
                        endif;
                    endif;
                    $post = $orig_post;
                    wp_reset_query();
                    ?>



                    <!--Next previous post Link-->
                    <div class="row pager">
                        <?php
                        $previous = get_previous_post_link('%link', '<span><i class="fa fa-arrow-left"></i> ' . esc_html__('Previous post', 'medical-pro') . '</span>');
                        $next = get_next_post_link('%link', '<span>' . esc_html__('Next post', 'medical-pro') . ' <i class="fa fa-arrow-right"></i></span>');
                        ?>
                        <div class="col-sm-6 prev">
                            <?php if ($previous) : ?>
                                <div class="inner row m0">
                                    <?php echo $previous; ?><br/>
                                    <?php previous_post_link('%link', '<span>%title</span>'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6 next">
                            <?php if ($next) : ?>
                                <div class="inner row m0">
                                    <?php echo $next; ?><br/>
                                    <?php next_post_link('%link', '<span>%title</span>'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!--Author Info-->
                    <div class="media author_description">
                        <div class="media-left media-bottom">
                            <?php echo get_avatar(get_the_author_meta('ID'), 195); ?>
                        </div>
                        <div class="media-body">
                            <div class="titleRow text-left">
                                <h2><?php the_author_meta('display_name'); ?></h2>
                                <h5><?php esc_html_e('Author', 'medical-pro'); ?></h5>
                            </div>
                            <p><?php the_author_meta('description'); ?></p>
                            <a class="view_all"
                               href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php esc_html_e('view all posts', 'medical-pro'); ?></a>
                        </div>
                    </div>

                    <!--Comment Section-->
                    <?php
                   if ( comments_open() || '0' != get_comments_number() ) :
                        comments_template();
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
        </div>
    </section>
<?php endwhile; ?>

<?php get_footer(); ?>