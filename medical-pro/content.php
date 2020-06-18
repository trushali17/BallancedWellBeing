<?php
global $medicalpro_options;
$blog_style = $medicalpro_options['blog_style'];

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
		<?php if(has_post_thumbnail()) { ?>
		<div class="image_row row m0">
			<?php 
				the_post_thumbnail();
			?>
		</div>
		<?php } ?>
		<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
		<?php get_template_part( 'partial/post-meta'); ?>
		<p><?php the_excerpt(); ?></p>                            
		<a href="<?php the_permalink(); ?>" class="view_all"><?php echo $medicalpro_options['blog_read_more_button_text']; ?></a>
	</div>
 <?php } ?>