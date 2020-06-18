<?php
//Display on blog page
?>

<div class="col-sm-12 col-md-4 sidebar">
    <?php
    if ( is_active_sidebar( 'blog-post' ) ){
        dynamic_sidebar( 'blog-post' );
    }
    ?>
</div>