<?php
global $medicalpro_options;
$blog_style = $medicalpro_options['blog_style'];

$post_meta = get_post_meta(get_the_ID());
$audio_embed_code = isset($post_meta['audio_embed_code'][0]) ? $post_meta['audio_embed_code'][0] : '';
$mp3_audio_file = isset($post_meta['mp3_audio_file'][0]) ? $post_meta['mp3_audio_file'][0] : '';
if ($mp3_audio_file) {
$mp3_audio_url = wp_get_attachment_url($mp3_audio_file);
}
 $archive_year  = get_the_time('Y');
$archive_month = get_the_time('m');
$archive_day   = get_the_time('d');
if ($blog_style == '2' || is_page_template('template-blog-2.php'))
{?>  

	<div id="post-<?php the_ID(); ?>" <?php post_class("media blog"); ?>>
		<?php if(has_post_thumbnail()) { ?>
		<div class="media-left">
			<a href="<?php the_permalink(); ?>">
			
					<?php the_post_thumbnail('medical-pro-post-thumb-medium', array('class' => 'img-responsive')); ?>
			</a>
		</div>
		<?php } ?>
		<div class="media-body">
			<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
			<?php get_template_part( 'partial/post-meta'); ?>
			<p><?php echo medical_pro_excerpt(150); ?>  </p>
			<a href="<?php the_permalink(); ?>" class="view_all"><?php echo $medicalpro_options['blog_read_more_button_text']; ?></a>
		</div>
	</div> 

 <?php } else { ?>
 <div id="post-<?php the_ID(); ?>" <?php post_class("row m0 blog blog2"); ?>>
	<?php
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
} else if(!empty($audio_embed_code)) {
    ?>
		<div class="embed-responsive embed-responsive-16by9 image_row">
			<iframe class="embed-responsive-item" src="<?php echo esc_url($audio_embed_code); ?>"></iframe>
		</div>
	<?php } else { ?>
	<div class="image_row row m0">
		<?php the_post_thumbnail(); ?>
	</div>
	<?php } ?>
	<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
	<?php get_template_part( 'partial/post-meta'); ?>
	<p><?php the_excerpt(); ?></p>                            
	<a href="<?php the_permalink(); ?>" class="view_all"><?php echo $medicalpro_options['blog_read_more_button_text']; ?></a>
</div>

 <?php } ?>