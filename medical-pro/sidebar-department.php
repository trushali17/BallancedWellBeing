<?php
//Display on single department page
?>

<div class="col-sm-4 sidebar">
    <?php
    if ( is_active_sidebar( 'department-detail-page' ) ){
        dynamic_sidebar( 'department-detail-page' );
    }
    ?>
</div>