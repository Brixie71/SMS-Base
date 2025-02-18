<?php

namespace PHPMaker2024\AMS;

// Page object
$MaintenanceFindingsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_findings: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fmaintenance_findingsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmaintenance_findingsdelete")
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
<form name="fmaintenance_findingsdelete" id="fmaintenance_findingsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="maintenance_findings">
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
<?php if ($Page->finding_id->Visible) { // finding_id ?>
        <th class="<?= $Page->finding_id->headerCellClass() ?>"><span id="elh_maintenance_findings_finding_id" class="maintenance_findings_finding_id"><?= $Page->finding_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->log_id->Visible) { // log_id ?>
        <th class="<?= $Page->log_id->headerCellClass() ?>"><span id="elh_maintenance_findings_log_id" class="maintenance_findings_log_id"><?= $Page->log_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->finding_type->Visible) { // finding_type ?>
        <th class="<?= $Page->finding_type->headerCellClass() ?>"><span id="elh_maintenance_findings_finding_type" class="maintenance_findings_finding_type"><?= $Page->finding_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->severity->Visible) { // severity ?>
        <th class="<?= $Page->severity->headerCellClass() ?>"><span id="elh_maintenance_findings_severity" class="maintenance_findings_severity"><?= $Page->severity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_maintenance_findings_created_by" class="maintenance_findings_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_maintenance_findings_created_at" class="maintenance_findings_created_at"><?= $Page->created_at->caption() ?></span></th>
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
<?php if ($Page->finding_id->Visible) { // finding_id ?>
        <td<?= $Page->finding_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->finding_id->viewAttributes() ?>>
<?= $Page->finding_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->log_id->Visible) { // log_id ?>
        <td<?= $Page->log_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->log_id->viewAttributes() ?>>
<?= $Page->log_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->finding_type->Visible) { // finding_type ?>
        <td<?= $Page->finding_type->cellAttributes() ?>>
<span id="">
<span<?= $Page->finding_type->viewAttributes() ?>>
<?= $Page->finding_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->severity->Visible) { // severity ?>
        <td<?= $Page->severity->cellAttributes() ?>>
<span id="">
<span<?= $Page->severity->viewAttributes() ?>>
<?= $Page->severity->getViewValue() ?></span>
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
