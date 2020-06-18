<?php
global $medicalpro_options;
$blog_style = $medicalpro_options['blog_style'];

$template = "";
$post_meta = get_post_meta(get_the_ID());
$embed_code = isset($post_meta['video_embed_code'][0]) ? $post_meta['video_embed_code'][0] : ''; 
$archive_year  = get_the_time('Y');
$archive_month = get_the_time('m');
$archive_day   = get_the_time('d');
if ($blog_style == '2' || is_page_template('template-blog-2.php'))
{?>
	
	<div id="post-<?php the_ID(); ?>" <?php post_class("media blog"); ?>>
		<div class="media-left">
			<iframe class="embed-responsive-item" src="<?php echo esc_url($embed_code); ?>"></iframe>
		</div>
		<div class="media-body">
			<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
			<?php get_template_part( 'partial/post-meta'); ?>
			<p><?php the_excerpt(); ?></p>                            
			<a href="<?php the_permalink(); ?>" class="view_all"><?php echo $medicalpro_options['blog_read_more_button_text']; ?></a>
		</div>
	</div> 

 <?php } else { ?>
 <div id="post-<?php the_ID(); ?>" <?php post_class("row m0 blog blog2"); ?>>
	<?php
	if (!empty($embed_code)) {
    ?>
		<div class="embed-responsive embed-responsive-16by9 image_row">
			<iframe class="embed-responsive-item" src="<?php echo esc_url($embed_code); ?>"></iframe>
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