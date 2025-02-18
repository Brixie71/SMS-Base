<?php

namespace PHPMaker2024\AMS;

// Page object
$MaintenanceSchedulesView = &$Page;
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
<form name="fmaintenance_schedulesview" id="fmaintenance_schedulesview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_schedules: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fmaintenance_schedulesview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmaintenance_schedulesview")
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
<input type="hidden" name="t" value="maintenance_schedules">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->schedule_id->Visible) { // schedule_id ?>
    <tr id="r_schedule_id"<?= $Page->schedule_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_schedules_schedule_id"><?= $Page->schedule_id->caption() ?></span></td>
        <td data-name="schedule_id"<?= $Page->schedule_id->cellAttributes() ?>>
<span id="el_maintenance_schedules_schedule_id">
<span<?= $Page->schedule_id->viewAttributes() ?>>
<?= $Page->schedule_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
    <tr id="r_equipment_id"<?= $Page->equipment_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_schedules_equipment_id"><?= $Page->equipment_id->caption() ?></span></td>
        <td data-name="equipment_id"<?= $Page->equipment_id->cellAttributes() ?>>
<span id="el_maintenance_schedules_equipment_id">
<span<?= $Page->equipment_id->viewAttributes() ?>>
<?= $Page->equipment_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maintenance_type_id->Visible) { // maintenance_type_id ?>
    <tr id="r_maintenance_type_id"<?= $Page->maintenance_type_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_schedules_maintenance_type_id"><?= $Page->maintenance_type_id->caption() ?></span></td>
        <td data-name="maintenance_type_id"<?= $Page->maintenance_type_id->cellAttributes() ?>>
<span id="el_maintenance_schedules_maintenance_type_id">
<span<?= $Page->maintenance_type_id->viewAttributes() ?>>
<?= $Page->maintenance_type_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->team_id->Visible) { // team_id ?>
    <tr id="r_team_id"<?= $Page->team_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_schedules_team_id"><?= $Page->team_id->caption() ?></span></td>
        <td data-name="team_id"<?= $Page->team_id->cellAttributes() ?>>
<span id="el_maintenance_schedules_team_id">
<span<?= $Page->team_id->viewAttributes() ?>>
<?= $Page->team_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->scheduled_date->Visible) { // scheduled_date ?>
    <tr id="r_scheduled_date"<?= $Page->scheduled_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_schedules_scheduled_date"><?= $Page->scheduled_date->caption() ?></span></td>
        <td data-name="scheduled_date"<?= $Page->scheduled_date->cellAttributes() ?>>
<span id="el_maintenance_schedules_scheduled_date">
<span<?= $Page->scheduled_date->viewAttributes() ?>>
<?= $Page->scheduled_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
    <tr id="r_status_id"<?= $Page->status_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_schedules_status_id"><?= $Page->status_id->caption() ?></span></td>
        <td data-name="status_id"<?= $Page->status_id->cellAttributes() ?>>
<span id="el_maintenance_schedules_status_id">
<span<?= $Page->status_id->viewAttributes() ?>>
<?= $Page->status_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
    <tr id="r_priority"<?= $Page->priority->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_schedules_priority"><?= $Page->priority->caption() ?></span></td>
        <td data-name="priority"<?= $Page->priority->cellAttributes() ?>>
<span id="el_maintenance_schedules_priority">
<span<?= $Page->priority->viewAttributes() ?>>
<?= $Page->priority->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->estimated_duration->Visible) { // estimated_duration ?>
    <tr id="r_estimated_duration"<?= $Page->estimated_duration->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_schedules_estimated_duration"><?= $Page->estimated_duration->caption() ?></span></td>
        <td data-name="estimated_duration"<?= $Page->estimated_duration->cellAttributes() ?>>
<span id="el_maintenance_schedules_estimated_duration">
<span<?= $Page->estimated_duration->viewAttributes() ?>>
<?= $Page->estimated_duration->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <tr id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_schedules_created_by"><?= $Page->created_by->caption() ?></span></td>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el_maintenance_schedules_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_schedules_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_maintenance_schedules_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
    <tr id="r_updated_by"<?= $Page->updated_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_schedules_updated_by"><?= $Page->updated_by->caption() ?></span></td>
        <td data-name="updated_by"<?= $Page->updated_by->cellAttributes() ?>>
<span id="el_maintenance_schedules_updated_by">
<span<?= $Page->updated_by->viewAttributes() ?>>
<?= $Page->updated_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_schedules_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_maintenance_schedules_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <tr id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_schedules_notes"><?= $Page->notes->caption() ?></span></td>
        <td data-name="notes"<?= $Page->notes->cellAttributes() ?>>
<span id="el_maintenance_schedules_notes">
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
