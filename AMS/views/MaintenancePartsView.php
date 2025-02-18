<?php

namespace PHPMaker2024\AMS;

// Page object
$MaintenancePartsView = &$Page;
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
<form name="fmaintenance_partsview" id="fmaintenance_partsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_parts: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fmaintenance_partsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmaintenance_partsview")
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
<input type="hidden" name="t" value="maintenance_parts">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->part_id->Visible) { // part_id ?>
    <tr id="r_part_id"<?= $Page->part_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_parts_part_id"><?= $Page->part_id->caption() ?></span></td>
        <td data-name="part_id"<?= $Page->part_id->cellAttributes() ?>>
<span id="el_maintenance_parts_part_id">
<span<?= $Page->part_id->viewAttributes() ?>>
<?= $Page->part_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->log_id->Visible) { // log_id ?>
    <tr id="r_log_id"<?= $Page->log_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_parts_log_id"><?= $Page->log_id->caption() ?></span></td>
        <td data-name="log_id"<?= $Page->log_id->cellAttributes() ?>>
<span id="el_maintenance_parts_log_id">
<span<?= $Page->log_id->viewAttributes() ?>>
<?= $Page->log_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->part_name->Visible) { // part_name ?>
    <tr id="r_part_name"<?= $Page->part_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_parts_part_name"><?= $Page->part_name->caption() ?></span></td>
        <td data-name="part_name"<?= $Page->part_name->cellAttributes() ?>>
<span id="el_maintenance_parts_part_name">
<span<?= $Page->part_name->viewAttributes() ?>>
<?= $Page->part_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <tr id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_parts_quantity"><?= $Page->quantity->caption() ?></span></td>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el_maintenance_parts_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->unit_cost->Visible) { // unit_cost ?>
    <tr id="r_unit_cost"<?= $Page->unit_cost->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_parts_unit_cost"><?= $Page->unit_cost->caption() ?></span></td>
        <td data-name="unit_cost"<?= $Page->unit_cost->cellAttributes() ?>>
<span id="el_maintenance_parts_unit_cost">
<span<?= $Page->unit_cost->viewAttributes() ?>>
<?= $Page->unit_cost->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->total_cost->Visible) { // total_cost ?>
    <tr id="r_total_cost"<?= $Page->total_cost->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_parts_total_cost"><?= $Page->total_cost->caption() ?></span></td>
        <td data-name="total_cost"<?= $Page->total_cost->cellAttributes() ?>>
<span id="el_maintenance_parts_total_cost">
<span<?= $Page->total_cost->viewAttributes() ?>>
<?= $Page->total_cost->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->supplier->Visible) { // supplier ?>
    <tr id="r_supplier"<?= $Page->supplier->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_parts_supplier"><?= $Page->supplier->caption() ?></span></td>
        <td data-name="supplier"<?= $Page->supplier->cellAttributes() ?>>
<span id="el_maintenance_parts_supplier">
<span<?= $Page->supplier->viewAttributes() ?>>
<?= $Page->supplier->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->warranty_period->Visible) { // warranty_period ?>
    <tr id="r_warranty_period"<?= $Page->warranty_period->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_parts_warranty_period"><?= $Page->warranty_period->caption() ?></span></td>
        <td data-name="warranty_period"<?= $Page->warranty_period->cellAttributes() ?>>
<span id="el_maintenance_parts_warranty_period">
<span<?= $Page->warranty_period->viewAttributes() ?>>
<?= $Page->warranty_period->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <tr id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_parts_created_by"><?= $Page->created_by->caption() ?></span></td>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el_maintenance_parts_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_parts_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_maintenance_parts_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <tr id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_parts_notes"><?= $Page->notes->caption() ?></span></td>
        <td data-name="notes"<?= $Page->notes->cellAttributes() ?>>
<span id="el_maintenance_parts_notes">
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
