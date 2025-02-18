<?php

namespace PHPMaker2024\AMS;

// Page object
$MaintenanceLogsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<form name="fmaintenance_logsview" id="fmaintenance_logsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_logs: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fmaintenance_logsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmaintenance_logsview")
        .setPageId("view")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="maintenance_logs">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->log_id->Visible) { // log_id ?>
    <tr id="r_log_id"<?= $Page->log_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_logs_log_id"><?= $Page->log_id->caption() ?></span></td>
        <td data-name="log_id"<?= $Page->log_id->cellAttributes() ?>>
<span id="el_maintenance_logs_log_id">
<span<?= $Page->log_id->viewAttributes() ?>>
<?= $Page->log_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->schedule_id->Visible) { // schedule_id ?>
    <tr id="r_schedule_id"<?= $Page->schedule_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_logs_schedule_id"><?= $Page->schedule_id->caption() ?></span></td>
        <td data-name="schedule_id"<?= $Page->schedule_id->cellAttributes() ?>>
<span id="el_maintenance_logs_schedule_id">
<span<?= $Page->schedule_id->viewAttributes() ?>>
<?= $Page->schedule_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->start_time->Visible) { // start_time ?>
    <tr id="r_start_time"<?= $Page->start_time->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_logs_start_time"><?= $Page->start_time->caption() ?></span></td>
        <td data-name="start_time"<?= $Page->start_time->cellAttributes() ?>>
<span id="el_maintenance_logs_start_time">
<span<?= $Page->start_time->viewAttributes() ?>>
<?= $Page->start_time->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->end_time->Visible) { // end_time ?>
    <tr id="r_end_time"<?= $Page->end_time->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_logs_end_time"><?= $Page->end_time->caption() ?></span></td>
        <td data-name="end_time"<?= $Page->end_time->cellAttributes() ?>>
<span id="el_maintenance_logs_end_time">
<span<?= $Page->end_time->viewAttributes() ?>>
<?= $Page->end_time->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->performed_by->Visible) { // performed_by ?>
    <tr id="r_performed_by"<?= $Page->performed_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_logs_performed_by"><?= $Page->performed_by->caption() ?></span></td>
        <td data-name="performed_by"<?= $Page->performed_by->cellAttributes() ?>>
<span id="el_maintenance_logs_performed_by">
<span<?= $Page->performed_by->viewAttributes() ?>>
<?= $Page->performed_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->verified_by->Visible) { // verified_by ?>
    <tr id="r_verified_by"<?= $Page->verified_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_logs_verified_by"><?= $Page->verified_by->caption() ?></span></td>
        <td data-name="verified_by"<?= $Page->verified_by->cellAttributes() ?>>
<span id="el_maintenance_logs_verified_by">
<span<?= $Page->verified_by->viewAttributes() ?>>
<?= $Page->verified_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
    <tr id="r_status_id"<?= $Page->status_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_logs_status_id"><?= $Page->status_id->caption() ?></span></td>
        <td data-name="status_id"<?= $Page->status_id->cellAttributes() ?>>
<span id="el_maintenance_logs_status_id">
<span<?= $Page->status_id->viewAttributes() ?>>
<?= $Page->status_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->next_maintenance_date->Visible) { // next_maintenance_date ?>
    <tr id="r_next_maintenance_date"<?= $Page->next_maintenance_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_logs_next_maintenance_date"><?= $Page->next_maintenance_date->caption() ?></span></td>
        <td data-name="next_maintenance_date"<?= $Page->next_maintenance_date->cellAttributes() ?>>
<span id="el_maintenance_logs_next_maintenance_date">
<span<?= $Page->next_maintenance_date->viewAttributes() ?>>
<?= $Page->next_maintenance_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <tr id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_logs_created_by"><?= $Page->created_by->caption() ?></span></td>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el_maintenance_logs_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_logs_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_maintenance_logs_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
    <tr id="r_updated_by"<?= $Page->updated_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_logs_updated_by"><?= $Page->updated_by->caption() ?></span></td>
        <td data-name="updated_by"<?= $Page->updated_by->cellAttributes() ?>>
<span id="el_maintenance_logs_updated_by">
<span<?= $Page->updated_by->viewAttributes() ?>>
<?= $Page->updated_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_logs_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_maintenance_logs_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <tr id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_logs_notes"><?= $Page->notes->caption() ?></span></td>
        <td data-name="notes"<?= $Page->notes->cellAttributes() ?>>
<span id="el_maintenance_logs_notes">
<span<?= $Page->notes->viewAttributes() ?>>
<?= $Page->notes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
