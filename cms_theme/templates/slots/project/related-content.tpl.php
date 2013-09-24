<h3 class="muted">
    <?php
        echo t('Related content');
    ?>
</h3>

<ul class="nav nav-tabs" id="related-content-tabs">
    <?php
        render_tab(t('Species'), 'related-content-species', 'active', 'field_project_species', TRUE, $content);
        render_tab(t('Documents'), 'related-content-documents', '', 'field_project_document', TRUE, $content);
        render_tab(t('National Plans'), 'related-content-national-plans', '', 'field_project_nat_plan', TRUE, $content);
        render_tab(t('National Reports'), 'related-content-national-reports', '', 'field_project_national_reports', TRUE, $content);
        render_tab(t('Publications'), 'related-content-publications', '', 'field_project_publication', TRUE, $content);
        render_tab(t('Meetings'), 'related-content-meetings', '', 'field_project_meeting', TRUE, $content);
        render_tab(t('Threats'), 'related-content-threats', '', 'field_project_threat', TRUE, $content);
    ?>
</ul>

<div class="tab-content">
    <div class="tab-pane active loaded" id="related-content-species">
        <?php
            if (check_display_field($content, 'field_project_species')) {
                echo render($content['field_project_species']);
            }else {
        ?>
        <p class="text-warning">
        <?php
                echo t('No related species');
        ?>
        </p>
        <?php
            }
        ?>
    </div>

    <div class="tab-pane" id="related-content-documents">
        <?php
            if (check_display_field($content, 'field_project_document')) {
                echo render($content['field_project_document']);
            }else {
        ?>
        <p class="text-warning">
        <?php
                echo t('No related documents');
        ?>
        </p>
        <?php
            }
        ?>
    </div>

    <div class="tab-pane" id="related-content-national-plans">
        <?php
            if (check_display_field($content, 'field_project_nat_plan')) {
                echo render($content['field_project_nat_plan']);
            }else {
        ?>
        <p class="text-warning">
        <?php
                echo t('No related national plans');
        ?>
        </p>
        <?php
            }
        ?>
    </div>

    <div class="tab-pane" id="related-content-national-reports">
        <?php
            if (check_display_field($content, 'field_project_national_reports')) {
                echo render($content['field_project_national_reports']);
            }else {
        ?>
        <p class="text-warning">
        <?php
                echo t('No related national_reports');
        ?>
        </p>
        <?php
            }
        ?>
    </div>

    <div class="tab-pane" id="related-content-publications">
        <?php
            if (check_display_field($content, 'field_project_publication')) {
                echo render($content['field_project_publication']);
            }else {
        ?>
        <p class="text-warning">
        <?php
                echo t('No related publications');
        ?>
        </p>
        <?php
            }
        ?>
    </div>

    <div class="tab-pane" id="related-content-meetings">
        <?php
            if (check_display_field($content, 'field_project_meeting')) {
                echo render($content['field_project_meeting']);
            }else {
        ?>
        <p class="text-warning">
        <?php
                echo t('No related meetings');
        ?>
        </p>
        <?php
            }
        ?>
    </div>
        <div class="tab-pane" id="related-content-threats">
        <?php
            if (check_display_field($content, 'field_project_threat')) {
                echo render($content['field_project_threat']);
            }else {
        ?>
        <p class="text-warning">
        <?php
                echo t('No related threats');
        ?>
        </p>
        <?php
            }
        ?>
    </div>

</div>
