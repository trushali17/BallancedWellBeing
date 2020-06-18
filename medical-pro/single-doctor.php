<?php
// @TODO: Doctor Detail Page
?>
<?php get_header(); 
get_template_part( 'partial/breadcrumb' );
?>
<?php
// Start the loop.
while ( have_posts() ) : the_post();

    $department_id = get_post_meta(get_the_ID(), 'department_id', true);
    $departments = array();
    if(!empty($department_id))
    {
        foreach($department_id as $department_id)
        {
            $curent_department = get_post($department_id);
            if(!empty($curent_department))
            {
                $departments[] = $curent_department->post_title;
            }
        }
    }

    $fb_url = get_post_meta(get_the_ID(), 'doctor_facebook_url', true);
    $twitter_url = get_post_meta(get_the_ID(), 'doctor_twitter_url', true);
    $google_plus_url = get_post_meta(get_the_ID(), 'doctor_google_plus_url', true);
    $speciality = get_post_meta(get_the_ID(), 'doctor_speciality', true);
?>
    <section class="row doctor_details">
        <div class="container">

            <div class="row">
                <div class="col-sm-12 col-md-9 doctor_about">
                    <div class="row">

                        <div class="col-sm-12 col-md-12 texts">

                            <div class="heading row m0">
                                <?php the_post_thumbnail('medical-pro-doctor-thumb', array('class'=>'img-responsive', 'style' => 'float:left; padding-right:30px;')); ?>
                                <ul class="fright social_list">
                                    <?php if($fb_url) { ?><li><a href="<?php echo esc_url($fb_url); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
                                    <?php if($twitter_url) { ?><li><a href="<?php echo esc_url($twitter_url); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
                                    <?php if($google_plus_url) { ?><li><a href="<?php echo esc_url($google_plus_url); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
                                </ul>
                                <div class="name_pos">
                                    <h3><?php the_title(); ?></h3>
                                    <?php if(!empty($departments)) { ?><h5><?php echo implode(', ', $departments); ?></h5><?php } ?>
                                </div>

                                <?php the_content(); ?>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-sm-12 col-md-3 sidebar doctor_details_sidebar">
                    <div class="row m0 widget speciality">
                        <h5 class="widget_heading">Speciality</h5>
                        <ul class="list-unstyled">
                            <?php
                                $department_ids = get_post_meta(get_the_ID(), 'department_id', true);

                                if(!empty($department_ids))
                                {
                                    foreach($department_ids as $department_id)
                                    {
                                        $curent_department = get_post($department_id);
                                        if(!empty($curent_department))
                                        { ?>
                                            <li><i class="fa fa-angle-right"></i><?php echo esc_html($curent_department->post_title); ?></li>
                                        <?php }
                                    }
                                }
                            ?>
                        </ul>
                        <a href="#" data-toggle="modal" data-target="#appointmefnt_form_pop" class="view_all"><?php esc_html_e('book appointment', 'medical-pro'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row doctor_cv">
        <div class="container">
            <div class="row">

                <?php if($address = get_post_meta(get_the_ID(), 'doctor_address', true)) { ?>
                    <div class="col-sm-4 cv_widget address">
                        <h5 class="heading"><?php esc_html_e('Address', 'medical-pro'); ?></h5>
                        <div class="row m0"><?php echo nl2br($address); ?></div>
                    </div>
                <?php } ?>

                <?php if($educations = get_post_meta(get_the_ID(), 'doctor_educations', true)) { ?>
                    <div class="col-sm-4 cv_widget education">
                        <h5 class="heading"><?php esc_html_e('Educations', 'medical-pro'); ?></h5>
                        <div class="row m0"><?php echo nl2br($educations); ?></div>
                    </div>
                <?php } ?>

                <?php if($awards = get_post_meta(get_the_ID(), 'doctor_awards_n_recognition', true)) { ?>
                    <div class="col-sm-4 cv_widget awards">
                        <h5 class="heading"><?php esc_html_e('Awards & Recognition', 'medical-pro'); ?></h5>
                        <div class="row m0"><?php echo nl2br($awards); ?></div>
                    </div>
                <?php } ?>

                <?php
                $office_hours = get_post_meta(get_the_ID(), 'office_hours', true);
                if(!empty($office_hours)) {
                ?>
                    <div class="col-sm-4 cv_widget office_hours">
                        <h5 class="heading"><?php esc_html_e('office hours', 'medical-pro'); ?></h5>
                        <div class="row m0">
                            <?php
                                foreach($office_hours as $office_hours)
                                {
                                    echo "{$office_hours['doctor_office_work_day']}<br><strong>{$office_hours['doctor_office_work_time']}</strong><br>";
                                }
                            ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if($certification = get_post_meta(get_the_ID(), 'doctor_certification', true)) { ?>
                    <div class="col-sm-4 cv_widget certifications">
                        <h5 class="heading"><?php esc_html_e('Certification(S)', 'medical-pro'); ?></h5>
                        <div class="row m0"><?php echo nl2br($certification); ?></div>
                    </div>
                <?php } ?>

                <?php if($contact_info = get_post_meta(get_the_ID(), 'doctor_contact_info', true)) { ?>
                    <div class="col-sm-4 cv_widget contact_info">
                        <h5 class="heading"><?php esc_html_e('Contact info', 'medical-pro'); ?></h5>
                        <div class="row m0"><?php echo nl2br($contact_info); ?></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php endwhile; ?>
<?php get_footer(); ?>