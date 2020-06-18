<?php
global $medicalpro_options;
$blog_style = $medicalpro_options['blog_style'];

$archive_year  = get_the_time('Y');
$archive_month = get_the_time('m');
$archive_day   = get_the_time('d');
if ($blog_style == '2' || is_page_template('template-blog-2.php'))
{?>               
	<div id="post-<?php the_ID(); ?>" <?php post_class("media blog"); ?>>
		<div class="media-left gallery gallery-slider clearfix">
			<?php  medical_pro_list_gallery_images('medical-pro-post-thumb-medium') ?>
		</div>
		<div class="media-body">
			<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
			<?php get_template_part( 'partial/post-meta'); ?>
			<p><?php echo medical_pro_excerpt(150); ?>  </p>
			<a href="<?php the_permalink(); ?>" class="view_all"><?php esc_html_e('read more', 'medical-pro'); ?></a>
		</div>
	</div> 
 <?php } else { ?>
 <div id="post-<?php the_ID(); ?>" <?php post_class("row m0 blog blog2"); ?>>
	<div class="gallery gallery-slider clearfix">
		<?php  medical_pro_list_gallery_images() ?>
	</div>
	<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
	<?php get_template_part( 'partial/post-meta'); ?>
	<p><?php the_excerpt(); ?></p>                            
	<a href="<?php the_permalink(); ?>" class="view_all"><?php esc_html_e('read more', 'medical-pro'); ?></a>
</div> 
 <?php } ?>