<?php
global $post;

$related_items_args = array(
    'post_type' => 'gallery-item',
    'posts_per_page' => 4,
    'post__not_in' => array($post->ID),
    'orderby' => 'rand'
);

/* Main gallery-item-types terms */
$tax_query = array();
$item_type_terms = get_the_terms($post->ID, "gallery-type");
if (!empty($item_type_terms) && is_array($item_type_terms)) {
    $gallery_item_types_array = array();
    foreach ($item_type_terms as $single_term) {
        $gallery_item_types_array[] = $single_term->term_id;
    }
    $tax_query[] = array(
        'taxonomy' => 'gallery-type',
        'field' => 'id',
        'terms' => $gallery_item_types_array
    );
}

$tax_count = count($tax_query); // count number of taxonomies
if ($tax_count > 0) {
    $related_items_args['tax_query'] = $tax_query; // add taxonomies query
}

// Related items query
$related_items_query = new WP_Query($related_items_args);

if ($related_items_query->have_posts()) {
    $loop_counter = 0;
    while ($related_items_query->have_posts()) {
        $related_items_query->the_post();
        $gallery_terms = get_the_terms($post->ID, 'gallery-type');
        ?>
        <div class="<?php bc('3', '4', '6', ''); ?>">
            <article class="common clearfix hentry">
                <?php
                if (has_post_thumbnail($post->ID)) {
                    $image_id = get_post_thumbnail_id();
                    $full_image_url = wp_get_attachment_url($image_id);
                    ?>
                    <figure class="overlay-effect">
                        <a href="<?php echo $full_image_url; ?>" title="<?php the_title(); ?>">
                            <?php the_post_thumbnail('gallery-post-single'); ?>
                        </a>
                        <a class="overlay" href="<?php echo $full_image_url; ?>"><i class="top"></i> <i class="bottom"></i></a>
                    </figure>
                <?php
                }
                ?>
                <div class="content clearfix">
                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>

                    <div class="gallery-item-types"><?php the_terms($post->ID, 'gallery-type', ' ', ', ', ' '); ?></div>
                </div>
            </article>
        </div>
    <?php
    $loop_counter++;
    if( ($loop_counter % 3) == 0 ){
        ?>
        <div class="visible-md clearfix"></div>
    <?php
    } else if( ($loop_counter % 2) == 0 ){
        ?>
        <div class="visible-sm clearfix"></div>
    <?php
    }
    }
    wp_reset_query();
}
?>