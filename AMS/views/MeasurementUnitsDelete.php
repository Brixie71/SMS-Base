<?php

namespace PHPMaker2024\AMS;

// Page object
$MeasurementUnitsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { measurement_units: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fmeasurement_unitsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmeasurement_unitsdelete")
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
<form name="fmeasurement_unitsdelete" id="fmeasurement_unitsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="measurement_units">
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
<?php if ($Page->unit_id->Visible) { // unit_id ?>
        <th class="<?= $Page->unit_id->headerCellClass() ?>"><span id="elh_measurement_units_unit_id" class="measurement_units_unit_id"><?= $Page->unit_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
        <th class="<?= $Page->category_id->headerCellClass() ?>"><span id="elh_measurement_units_category_id" class="measurement_units_category_id"><?= $Page->category_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_measurement_units_name" class="measurement_units_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->symbol->Visible) { // symbol ?>
        <th class="<?= $Page->symbol->headerCellClass() ?>"><span id="elh_measurement_units_symbol" class="measurement_units_symbol"><?= $Page->symbol->caption() ?></span></th>
<?php } ?>
<?php if ($Page->conversion_factor->Visible) { // conversion_factor ?>
        <th class="<?= $Page->conversion_factor->headerCellClass() ?>"><span id="elh_measurement_units_conversion_factor" class="measurement_units_conversion_factor"><?= $Page->conversion_factor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->base_unit_id->Visible) { // base_unit_id ?>
        <th class="<?= $Page->base_unit_id->headerCellClass() ?>"><span id="elh_measurement_units_base_unit_id" class="measurement_units_base_unit_id"><?= $Page->base_unit_id->caption() ?></span></th>
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
<?php if ($Page->unit_id->Visible) { // unit_id ?>
        <td<?= $Page->unit_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->unit_id->viewAttributes() ?>>
<?= $Page->unit_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
        <td<?= $Page->category_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->category_id->viewAttributes() ?>>
<?= $Page->category_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <td<?= $Page->name->cellAttributes() ?>>
<span id="">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->symbol->Visible) { // symbol ?>
        <td<?= $Page->symbol->cellAttributes() ?>>
<span id="">
<span<?= $Page->symbol->viewAttributes() ?>>
<?= $Page->symbol->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->conversion_factor->Visible) { // conversion_factor ?>
        <td<?= $Page->conversion_factor->cellAttributes() ?>>
<span id="">
<span<?= $Page->conversion_factor->viewAttributes() ?>>
<?= $Page->conversion_factor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->base_unit_id->Visible) { // base_unit_id ?>
        <td<?= $Page->base_unit_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->base_unit_id->viewAttributes() ?>>
<?= $Page->base_unit_id->getViewValue() ?></span>
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
