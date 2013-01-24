<?php
    render_slot($node, 'node-buttons', 'general');
?>

<div class="row">
    <div class="span6">
        <table class="table table-condensed table-hover two-columns">
            <tbody>
            <?php
                echo render($content['field_decision_publish_date']);
                echo render($content['field_decision_type']);
                echo render($content['field_decision_status']);
                echo render($content['field_decision_number']);
                echo render($content['field_decision_meeting']);
            ?>
            </tbody>
        </table>
        <hr />

        <?php echo render($content['field_decision_document']); ?>
    </div>

    <div class="span6">
    <?php
        echo render($content['field_decision_summary']);
    ?>
    </div>
</div>

<?php
    hide($content['links']);
    hide($content['comments']);
?>
