<?php get_header(); 
get_template_part( 'partial/breadcrumb' );
?>
<?php
// Start the loop.
while ( have_posts() ) : the_post();
 $department_meta = get_post_meta(get_the_ID());
    ?>
    <section class="row service_details">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 serviceDetailsSection">
					<div class="entry-content">
						 <h3 class="post_title"><?php the_title(); ?></h3>
						 <div class="image_row row m0">
							<?php the_post_thumbnail('large', array('class' => 'img-responsive','style' => 'width:100%')); ?>
						 </div>
						<h3><?php echo esc_html($department_meta['department_subtitle'][0]) ?></h3>
						<?php the_content(); ?>
					</div>
                </div>
                <?php get_sidebar('department') ?>
            </div>
        </div>
    </section>
	
<?php endwhile; ?>

<?php get_footer(); ?>