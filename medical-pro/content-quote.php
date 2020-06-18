<?php $post_meta = get_post_meta(get_the_ID()); ?>
<?php if (isset($post_meta['quote_text'][0]) && $post_meta['quote_text'][0]) { ?>
  <div id="post-<?php the_ID(); ?>" <?php post_class("row m0 blog blog2"); ?>>
	<blockquote class="m0">
		<h2>&#8220;<?php echo esc_html($post_meta['quote_text'][0]); ?>&#8221;</h2>
		<a href="javascript:;" target="_blank">- <?php echo esc_html($post_meta['quote_author'][0]); ?></a>
	</blockquote>
  </div>
<?php } ?>