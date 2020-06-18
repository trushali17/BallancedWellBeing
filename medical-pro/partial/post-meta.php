

<div class="row m0 meta">

<?php global $medicalpro_options;

if ($medicalpro_options['display_blog_author_name'] == '1') { 
esc_html_e('By', 'medical-pro'); ?> : <?php the_author_posts_link(); }?>
<?php if ($medicalpro_options['display_blog_created_date'] == '1') { 
esc_html_e('on', 'medical-pro'); ?> : <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php the_time(get_option('date_format')); ?></a> <?php } ?>
<?php if ($medicalpro_options['display_blog_comments_count'] == '1') { 
 esc_html_e('comments', 'medical-pro'); ?> : (<?php comments_popup_link(0,1,'%'); ?>)
<?php } ?>
</div>