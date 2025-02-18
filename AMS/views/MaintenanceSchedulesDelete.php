<?php

namespace PHPMaker2024\AMS;

// Page object
$MaintenanceSchedulesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_schedules: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fmaintenance_schedulesdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmaintenance_schedulesdelete")
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
<form name="fmaintenance_schedulesdelete" id="fmaintenance_schedulesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="maintenance_schedules">
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
<?php if ($Page->schedule_id->Visible) { // schedule_id ?>
        <th class="<?= $Page->schedule_id->headerCellClass() ?>"><span id="elh_maintenance_schedules_schedule_id" class="maintenance_schedules_schedule_id"><?= $Page->schedule_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
        <th class="<?= $Page->equipment_id->headerCellClass() ?>"><span id="elh_maintenance_schedules_equipment_id" class="maintenance_schedules_equipment_id"><?= $Page->equipment_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maintenance_type_id->Visible) { // maintenance_type_id ?>
        <th class="<?= $Page->maintenance_type_id->headerCellClass() ?>"><span id="elh_maintenance_schedules_maintenance_type_id" class="maintenance_schedules_maintenance_type_id"><?= $Page->maintenance_type_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->team_id->Visible) { // team_id ?>
        <th class="<?= $Page->team_id->headerCellClass() ?>"><span id="elh_maintenance_schedules_team_id" class="maintenance_schedules_team_id"><?= $Page->team_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->scheduled_date->Visible) { // scheduled_date ?>
        <th class="<?= $Page->scheduled_date->headerCellClass() ?>"><span id="elh_maintenance_schedules_scheduled_date" class="maintenance_schedules_scheduled_date"><?= $Page->scheduled_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
        <th class="<?= $Page->status_id->headerCellClass() ?>"><span id="elh_maintenance_schedules_status_id" class="maintenance_schedules_status_id"><?= $Page->status_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
        <th class="<?= $Page->priority->headerCellClass() ?>"><span id="elh_maintenance_schedules_priority" class="maintenance_schedules_priority"><?= $Page->priority->caption() ?></span></th>
<?php } ?>
<?php if ($Page->estimated_duration->Visible) { // estimated_duration ?>
        <th class="<?= $Page->estimated_duration->headerCellClass() ?>"><span id="elh_maintenance_schedules_estimated_duration" class="maintenance_schedules_estimated_duration"><?= $Page->estimated_duration->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_maintenance_schedules_created_by" class="maintenance_schedules_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_maintenance_schedules_created_at" class="maintenance_schedules_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
        <th class="<?= $Page->updated_by->headerCellClass() ?>"><span id="elh_maintenance_schedules_updated_by" class="maintenance_schedules_updated_by"><?= $Page->updated_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_maintenance_schedules_updated_at" class="maintenance_schedules_updated_at"><?= $Page->updated_at->caption() ?></span></th>
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
<?php if ($Page->schedule_id->Visible) { // schedule_id ?>
        <td<?= $Page->schedule_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->schedule_id->viewAttributes() ?>>
<?= $Page->schedule_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
        <td<?= $Page->equipment_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->equipment_id->viewAttributes() ?>>
<?= $Page->equipment_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maintenance_type_id->Visible) { // maintenance_type_id ?>
        <td<?= $Page->maintenance_type_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->maintenance_type_id->viewAttributes() ?>>
<?= $Page->maintenance_type_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->team_id->Visible) { // team_id ?>
        <td<?= $Page->team_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->team_id->viewAttributes() ?>>
<?= $Page->team_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->scheduled_date->Visible) { // scheduled_date ?>
        <td<?= $Page->scheduled_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->scheduled_date->viewAttributes() ?>>
<?= $Page->scheduled_date->getViewValue() ?></span>
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
<?php if ($Page->priority->Visible) { // priority ?>
        <td<?= $Page->priority->cellAttributes() ?>>
<span id="">
<span<?= $Page->priority->viewAttributes() ?>>
<?= $Page->priority->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->estimated_duration->Visible) { // estimated_duration ?>
        <td<?= $Page->estimated_duration->cellAttributes() ?>>
<span id="">
<span<?= $Page->estimated_duration->viewAttributes() ?>>
<?= $Page->estimated_duration->getViewValue() ?></span>
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
