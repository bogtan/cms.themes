<h3 class="muted">
    <?php
        echo t('Related content');
    ?>
</h3>

<ul class="nav nav-tabs" id="related-content-tabs">
    <?php
        render_tab(t('Meetings'), 'related-content-meetings', 'active', 'meetings', TRUE, $content);
        render_tab(t('Projects'), 'related-content-projects', '', 'projects', TRUE, $content);
        render_tab(t('Publications'), 'related-content-publications', '', 'publications', TRUE, $content);
        render_tab(t('Documents'), 'related-content-documents', '', 'documents', TRUE, $content);
        render_tab(t('Contacts'), 'related-content-contacts', '', 'contacts', TRUE, $content);

    ?>
</ul>

<div class="tab-content">
    <div class="tab-pane active loaded" id="related-content-meetings">
        <?php echo render($content['meetings']); ?>
    </div>

    <div class="tab-pane" id="related-content-projects">
        <?php echo render($content['projects']); ?>
    </div>

    <div class="tab-pane" id="related-content-publications">
        <?php echo render($content['publications']); ?>
    </div>

    <div class="tab-pane" id="related-content-documents">
        <?php #echo render($content['documents']); ?>
    </div>

    <div class="tab-pane" id="related-content-species">
        <?php echo render($content['species']); ?>
    </div>


    <div class="tab-pane" id="related-content-contacts">
        <table class="table table-striped table-bordered dataTable">
            <thead>
                <tr>
                    <th>
                    <?php echo t('Full name'); ?>
                    </th>
                </tr>
            </thead>

            <tbody>
                <?php
                    if (isset($node->contacts) && (!empty($node->contacts))) {
                        foreach ($node->contacts as $contact) {
                ?>
                <tr>
                    <td>
                        <a href='/contacts/item/<?php echo $contact['uid'][0]; ?>/<?php echo $contact['conventions'][0]; ?>/view'>
                            <?php echo $contact['cn'][0]; ?>
                        </a>
                    </td>
                </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
