<div class="row" id="national-plan-form">
    <div class="span6">
    <?php
        echo drupal_render($form['title']);
    ?>
    </div>

    <div class="span4">
    <?php
        echo drupal_render($form['field_nat_plan_receipt']);
    ?>
    </div>

    <div class="clearfix"></div>

    <div class="span3">
    <?php
        echo drupal_render($form['field_nat_plan_instrument']);
    ?>
    </div>

    <div class="span3">
    <?php
        echo drupal_render($form['field_nat_plan_country']);
    ?>
    </div>

    <div class="span4">
    <?php
        echo drupal_render($form['field_nat_plan_type']);
    ?>
    </div>

    <div class="span12">
    <?php
        echo drupal_render($form['field_nat_plan_remarks']);
    ?>
    </div>

    <div class="span12">
    <?php
        echo drupal_render($form['field_nat_plan_documents']);
    ?>
    </div>

    <div class="clearfix">&nbsp;</div>

    <div class="span12">
    <?php
        echo drupal_render_children($form);
    ?>
    </div>
</div>

<?php
    $path = drupal_get_path('theme', 'cms_theme');
    drupal_add_js("$path/js/theme.js");
?>
