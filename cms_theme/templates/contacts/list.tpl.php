<?php
/**
 * drupal_add_js and drupal_add_css not working here
*/
    $js_path = drupal_get_path('module', 'datatables') . '/dataTables/media/js/jquery.dataTables.min.js';
    $DT_js_path = drupal_get_path('module', 'datatables') . '/js/DT_bootstrap.js';
    $css_path = drupal_get_path('module', 'datatables') . '/dataTables/media/css/demo_table.css';
?>
<script type="text/javascript" src="/<?php echo $js_path; ?>"></script>
<script type="text/javascript" src="/<?php echo $DT_js_path; ?>"></script>
<link type="text/css" rel="stylesheet" href="/<?php echo $css_path; ?>" />
<?php
    drupal_add_js(drupal_get_path('theme', 'cms_theme') . '/js/contacts.js');
?>

<div class="row">
    <div class="span12">
        <p class="lead">
            <?php echo t('Contacts from'); ?> <strong class="text-info"><?php echo $instruments[$instrument]; ?></strong> <?php echo t('instrument'); ?>.
        </p>
    </div>
</div>

<div class="clearfix">&nbsp;</div>

<?php
    echo render_simple_slot('filters', 'contacts',
                            array('page' => $page,
                                  'per_page' => $per_page,
                                  'per_page_options' => $per_page_options,
                                  'current_group' => $instrument,
                                  'country' => $country,
                                  'instruments' => $instruments)
    );
?>

<div class="row">
    <div class="span12">
        <table cellpadding="0" cellspacing="0" border="0" id="contacts-listing" class="cols-6 table table-striped table-hover table-bordered dataTable">
            <thead>
                <tr>
                    <th class="span2">
                        <?php
                            echo t('User ID');
                        ?>
                    </th>
                    <th class="span2">
                        <?php
                            echo t('Full name');
                        ?>
                    </th>
                    <th class="span2">
                        <?php
                            echo t('Organization');
                        ?>
                    </th>
                    <th class="span2">
                        <?php
                            echo t('Department');
                        ?>
                    </th>
                    <th class="span3">
                        <?php
                            echo t('Email');
                        ?>
                    </th>
                    <th class="span2">
                        <?php
                            echo t('Country');
                        ?>
                    </th>
                    <th class="span1">
                        <?php
                            echo t('City');
                        ?>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<a href="/contacts/add" class="btn btn-primary" title="<?php echo t('Add'); ?>">
    <?php echo t('Add new contact'); ?>
</a>