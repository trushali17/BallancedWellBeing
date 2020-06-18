<?php
//Display on single service page
?>

<div class="col-sm-4 sidebar">
    <?php
    if ( is_active_sidebar( 'service-detail-page' ) ){
        dynamic_sidebar( 'service-detail-page' );
    }
    ?>
</div>