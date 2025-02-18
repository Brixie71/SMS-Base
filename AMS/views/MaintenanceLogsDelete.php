<?php

namespace PHPMaker2024\AMS;

// Page object
$MaintenanceLogsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_logs: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fmaintenance_logsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmaintenance_logsdelete")
        .setPageId("delete")
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fmaintenance_logsdelete" id="fmaintenance_logsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="maintenance_logs">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->log_id->Visible) { // log_id ?>
        <th class="<?= $Page->log_id->headerCellClass() ?>"><span id="elh_maintenance_logs_log_id" class="maintenance_logs_log_id"><?= $Page->log_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->schedule_id->Visible) { // schedule_id ?>
        <th class="<?= $Page->schedule_id->headerCellClass() ?>"><span id="elh_maintenance_logs_schedule_id" class="maintenance_logs_schedule_id"><?= $Page->schedule_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->start_time->Visible) { // start_time ?>
        <th class="<?= $Page->start_time->headerCellClass() ?>"><span id="elh_maintenance_logs_start_time" class="maintenance_logs_start_time"><?= $Page->start_time->caption() ?></span></th>
<?php } ?>
<?php if ($Page->end_time->Visible) { // end_time ?>
        <th class="<?= $Page->end_time->headerCellClass() ?>"><span id="elh_maintenance_logs_end_time" class="maintenance_logs_end_time"><?= $Page->end_time->caption() ?></span></th>
<?php } ?>
<?php if ($Page->performed_by->Visible) { // performed_by ?>
        <th class="<?= $Page->performed_by->headerCellClass() ?>"><span id="elh_maintenance_logs_performed_by" class="maintenance_logs_performed_by"><?= $Page->performed_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->verified_by->Visible) { // verified_by ?>
        <th class="<?= $Page->verified_by->headerCellClass() ?>"><span id="elh_maintenance_logs_verified_by" class="maintenance_logs_verified_by"><?= $Page->verified_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
        <th class="<?= $Page->status_id->headerCellClass() ?>"><span id="elh_maintenance_logs_status_id" class="maintenance_logs_status_id"><?= $Page->status_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->next_maintenance_date->Visible) { // next_maintenance_date ?>
        <th class="<?= $Page->next_maintenance_date->headerCellClass() ?>"><span id="elh_maintenance_logs_next_maintenance_date" class="maintenance_logs_next_maintenance_date"><?= $Page->next_maintenance_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_maintenance_logs_created_by" class="maintenance_logs_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_maintenance_logs_created_at" class="maintenance_logs_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
        <th class="<?= $Page->updated_by->headerCellClass() ?>"><span id="elh_maintenance_logs_updated_by" class="maintenance_logs_updated_by"><?= $Page->updated_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_maintenance_logs_updated_at" class="maintenance_logs_updated_at"><?= $Page->updated_at->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while ($Page->fetch()) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = RowType::VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->CurrentRow);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->log_id->Visible) { // log_id ?>
        <td<?= $Page->log_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->log_id->viewAttributes() ?>>
<?= $Page->log_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->schedule_id->Visible) { // schedule_id ?>
        <td<?= $Page->schedule_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->schedule_id->viewAttributes() ?>>
<?= $Page->schedule_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->start_time->Visible) { // start_time ?>
        <td<?= $Page->start_time->cellAttributes() ?>>
<span id="">
<span<?= $Page->start_time->viewAttributes() ?>>
<?= $Page->start_time->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->end_time->Visible) { // end_time ?>
        <td<?= $Page->end_time->cellAttributes() ?>>
<span id="">
<span<?= $Page->end_time->viewAttributes() ?>>
<?= $Page->end_time->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->performed_by->Visible) { // performed_by ?>
        <td<?= $Page->performed_by->cellAttributes() ?>>
<span id="">
<span<?= $Page->performed_by->viewAttributes() ?>>
<?= $Page->performed_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->verified_by->Visible) { // verified_by ?>
        <td<?= $Page->verified_by->cellAttributes() ?>>
<span id="">
<span<?= $Page->verified_by->viewAttributes() ?>>
<?= $Page->verified_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
        <td<?= $Page->status_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->status_id->viewAttributes() ?>>
<?= $Page->status_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->next_maintenance_date->Visible) { // next_maintenance_date ?>
        <td<?= $Page->next_maintenance_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->next_maintenance_date->viewAttributes() ?>>
<?= $Page->next_maintenance_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <td<?= $Page->created_by->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <td<?= $Page->created_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
        <td<?= $Page->updated_by->cellAttributes() ?>>
<span id="">
<span<?= $Page->updated_by->viewAttributes() ?>>
<?= $Page->updated_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td<?= $Page->updated_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
}
$Page->Recordset?->free();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
