<?php
/*
 * Template Name: Doctors
 */
?>

<?php get_header(); 
get_template_part( 'partial/breadcrumb' );
?>

<?php
$departments = new WP_Query();
$departments->query(array('post_type' => 'department','posts_per_page' => -1));
?>
<section class="row">
    <div class="container">
        <div class="row inner m0">
            <ul id="doctor_departments" class="nav nav-tabs doctor_tab">
                <li class="active"><a href="javascript:;" rel="sh_department_all"><?php esc_html_e('All', 'medical-pro'); ?></a></li>
                <?php while($departments->have_posts()) : $departments->the_post(); ?>
                    <li><a href="javascript:void(0)" rel="sh_department_<?php the_ID(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</section>
<?php
$doctors = new WP_Query();
$doctors->query(array('post_type' => 'doctor','posts_per_page' => -1,'order'=>'ASC','orderby'=>'title'));
?>
<section class="row team_section_type2 bgf">
    <div class="container">
        <div class="row dorctors_row">
            <?php while($doctors->have_posts()) : $doctors->the_post(); ?>
            <?php
                $departments = array();
                $post_meta = get_post_meta(get_the_ID());
                $department_ids = get_post_meta(get_the_ID(), 'department_id', true);
                $department_rel = array('sh_department_all');
                if(!empty($department_ids))
                {
                    foreach($department_ids as $department_id)
                    {
                        $curent_department = get_post($department_id);
                        if(!empty($curent_department))
                        {
                            $departments[] = $curent_department->post_title;
                        }

                        $department_rel[] = 'sh_department_'.$department_id;
                    }
                }
            ?>

            <div class="col-sm-6 col-md-3 team_member <?php echo implode(' ', $department_rel) ?>">
                <div class="row m0 inner">
                    <a href="<?php the_permalink(); ?>">
                        <div class="row m0 image" id="doctor_thumbnail"><?php the_post_thumbnail('medical-pro-doctor-thumb', array('class' => 'img-responsive')); ?></div>
                        <div class="row m0 title_row">
                            <h5><?php the_title(); ?></h5>
                            <div class="row m0 pos"><?php echo implode(', ', $departments); ?></div>
                        </div>
                    </a>
                    <p><?php echo esc_html($post_meta['doctor_introduction_text'][0]); ?></p>
                    <ul class="social_list">
                        <?php if(!empty($post_meta['doctor_facebook_url'][0])) : ?><li><a href="<?php echo esc_url($post_meta['doctor_facebook_url'][0]); ?>"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
                        <?php if(!empty($post_meta['doctor_twitter_url'][0])) : ?><li><a href="<?php echo esc_url($post_meta['doctor_twitter_url'][0]); ?>"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
                        <?php if(!empty($post_meta['doctor_google_plus_url'][0])) : ?><li><a href="<?php echo esc_url($post_meta['doctor_google_plus_url'][0]); ?>"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
                    </ul>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>

<script>
    jQuery('ul#doctor_departments li a').click(function(e){
        e.preventDefault();
        jQuery('ul#doctor_departments li').removeClass('active');
        jQuery(this).closest('li').addClass('active');
        var current_sh_department = jQuery(this).attr('rel');
        jQuery('.team_member').hide();
        jQuery('.'+current_sh_department).show();
    });
</script>