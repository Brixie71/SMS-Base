<?php

namespace PHPMaker2024\AMS;

// Page object
$MaintenancePartsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_parts: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fmaintenance_partsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmaintenance_partsdelete")
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
<form name="fmaintenance_partsdelete" id="fmaintenance_partsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="maintenance_parts">
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
<?php if ($Page->part_id->Visible) { // part_id ?>
        <th class="<?= $Page->part_id->headerCellClass() ?>"><span id="elh_maintenance_parts_part_id" class="maintenance_parts_part_id"><?= $Page->part_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->log_id->Visible) { // log_id ?>
        <th class="<?= $Page->log_id->headerCellClass() ?>"><span id="elh_maintenance_parts_log_id" class="maintenance_parts_log_id"><?= $Page->log_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->part_name->Visible) { // part_name ?>
        <th class="<?= $Page->part_name->headerCellClass() ?>"><span id="elh_maintenance_parts_part_name" class="maintenance_parts_part_name"><?= $Page->part_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th class="<?= $Page->quantity->headerCellClass() ?>"><span id="elh_maintenance_parts_quantity" class="maintenance_parts_quantity"><?= $Page->quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->unit_cost->Visible) { // unit_cost ?>
        <th class="<?= $Page->unit_cost->headerCellClass() ?>"><span id="elh_maintenance_parts_unit_cost" class="maintenance_parts_unit_cost"><?= $Page->unit_cost->caption() ?></span></th>
<?php } ?>
<?php if ($Page->total_cost->Visible) { // total_cost ?>
        <th class="<?= $Page->total_cost->headerCellClass() ?>"><span id="elh_maintenance_parts_total_cost" class="maintenance_parts_total_cost"><?= $Page->total_cost->caption() ?></span></th>
<?php } ?>
<?php if ($Page->supplier->Visible) { // supplier ?>
        <th class="<?= $Page->supplier->headerCellClass() ?>"><span id="elh_maintenance_parts_supplier" class="maintenance_parts_supplier"><?= $Page->supplier->caption() ?></span></th>
<?php } ?>
<?php if ($Page->warranty_period->Visible) { // warranty_period ?>
        <th class="<?= $Page->warranty_period->headerCellClass() ?>"><span id="elh_maintenance_parts_warranty_period" class="maintenance_parts_warranty_period"><?= $Page->warranty_period->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_maintenance_parts_created_by" class="maintenance_parts_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_maintenance_parts_created_at" class="maintenance_parts_created_at"><?= $Page->created_at->caption() ?></span></th>
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
<?php if ($Page->part_id->Visible) { // part_id ?>
        <td<?= $Page->part_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->part_id->viewAttributes() ?>>
<?= $Page->part_id->getViewValue() ?></span>
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
<?php if ($Page->part_name->Visible) { // part_name ?>
        <td<?= $Page->part_name->cellAttributes() ?>>
<span id="">
<span<?= $Page->part_name->viewAttributes() ?>>
<?= $Page->part_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <td<?= $Page->quantity->cellAttributes() ?>>
<span id="">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->unit_cost->Visible) { // unit_cost ?>
        <td<?= $Page->unit_cost->cellAttributes() ?>>
<span id="">
<span<?= $Page->unit_cost->viewAttributes() ?>>
<?= $Page->unit_cost->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->total_cost->Visible) { // total_cost ?>
        <td<?= $Page->total_cost->cellAttributes() ?>>
<span id="">
<span<?= $Page->total_cost->viewAttributes() ?>>
<?= $Page->total_cost->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->supplier->Visible) { // supplier ?>
        <td<?= $Page->supplier->cellAttributes() ?>>
<span id="">
<span<?= $Page->supplier->viewAttributes() ?>>
<?= $Page->supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->warranty_period->Visible) { // warranty_period ?>
        <td<?= $Page->warranty_period->cellAttributes() ?>>
<span id="">
<span<?= $Page->warranty_period->viewAttributes() ?>>
<?= $Page->warranty_period->getViewValue() ?></span>
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
