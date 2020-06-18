<?php
$post_meta = get_post_meta(get_the_ID());
$archive_year  = get_the_time('Y');
$archive_month = get_the_time('m');
$archive_day   = get_the_time('d');
?>
<div id="post-<?php the_ID(); ?>" <?php post_class("row m0 blog blog2"); ?>>
	<a href="<?php echo esc_url($post_meta['link_url'][0]); ?>" target="_blank"><h3><i class="fa fa-link"></i><?php the_title(); ?></h3></a>
	<?php get_template_part( 'partial/post-meta'); ?>
	<p><?php echo medical_pro_excerpt(150); ?>  </p>
	<a href="<?php the_permalink(); ?>" class="view_all"><?php esc_html_e('read more', 'medical-pro'); ?></a>
</div>