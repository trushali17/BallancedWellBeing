<?php get_header(); 
get_template_part( 'partial/breadcrumb' );
?>

<?php
// Start the loop.
$noOfColumn = "col-sm-12";
if ( is_active_sidebar( 'service-detail-page' ) ){
        $noOfColumn = "col-sm-8";
    }

while ( have_posts() ) : the_post();
 $serivce_icon = get_post_meta(get_the_ID(), 'serivce_icon_style2', true);
    ?>
    <section class="row service_details">
        <div class="container">
            <div class="row">
                <div class="<?php echo $noOfColumn; ?> serviceDetailsSection">
                    <h2 class="post_title"><span class="post_icon"><img src="<?php echo esc_url($serivce_icon); ?>"/></span><?php the_title(); ?></h2>
                    <div class="entry-content"><?php the_content(); ?></div>
                </div>
				<?php
				if ( is_active_sidebar( 'service-detail-page' ) ){ ?>
               <div class="col-sm-4 sidebar">
					<?php
						dynamic_sidebar( 'service-detail-page' );
					?>
				</div>
				<?php } ?>
            </div>
        </div>
    </section>
<?php endwhile; ?>
<?php get_footer(); ?>