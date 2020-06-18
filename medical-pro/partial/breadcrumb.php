<?php
global $medicalpro_options;

if ($medicalpro_options['display_breadcrumb'] == '1')
{
?>
<section class="row breadcrumbRow">
    <div class="container">
        <div class="row inner m0">
            <?php echo medical_pro_breadcrumb($medicalpro_options['breadcrumb_separator']); ?>
        </div>
    </div>
</section>
<?php } ?>