<?php

namespace PHPMaker2024\AMS;

// Page object
$MeasurementUnitsView = &$Page;
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
<form name="fmeasurement_unitsview" id="fmeasurement_unitsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { measurement_units: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fmeasurement_unitsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmeasurement_unitsview")
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
<input type="hidden" name="t" value="measurement_units">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->unit_id->Visible) { // unit_id ?>
    <tr id="r_unit_id"<?= $Page->unit_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_measurement_units_unit_id"><?= $Page->unit_id->caption() ?></span></td>
        <td data-name="unit_id"<?= $Page->unit_id->cellAttributes() ?>>
<span id="el_measurement_units_unit_id">
<span<?= $Page->unit_id->viewAttributes() ?>>
<?= $Page->unit_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
    <tr id="r_category_id"<?= $Page->category_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_measurement_units_category_id"><?= $Page->category_id->caption() ?></span></td>
        <td data-name="category_id"<?= $Page->category_id->cellAttributes() ?>>
<span id="el_measurement_units_category_id">
<span<?= $Page->category_id->viewAttributes() ?>>
<?= $Page->category_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <tr id="r_name"<?= $Page->name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_measurement_units_name"><?= $Page->name->caption() ?></span></td>
        <td data-name="name"<?= $Page->name->cellAttributes() ?>>
<span id="el_measurement_units_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->symbol->Visible) { // symbol ?>
    <tr id="r_symbol"<?= $Page->symbol->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_measurement_units_symbol"><?= $Page->symbol->caption() ?></span></td>
        <td data-name="symbol"<?= $Page->symbol->cellAttributes() ?>>
<span id="el_measurement_units_symbol">
<span<?= $Page->symbol->viewAttributes() ?>>
<?= $Page->symbol->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->conversion_factor->Visible) { // conversion_factor ?>
    <tr id="r_conversion_factor"<?= $Page->conversion_factor->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_measurement_units_conversion_factor"><?= $Page->conversion_factor->caption() ?></span></td>
        <td data-name="conversion_factor"<?= $Page->conversion_factor->cellAttributes() ?>>
<span id="el_measurement_units_conversion_factor">
<span<?= $Page->conversion_factor->viewAttributes() ?>>
<?= $Page->conversion_factor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->base_unit_id->Visible) { // base_unit_id ?>
    <tr id="r_base_unit_id"<?= $Page->base_unit_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_measurement_units_base_unit_id"><?= $Page->base_unit_id->caption() ?></span></td>
        <td data-name="base_unit_id"<?= $Page->base_unit_id->cellAttributes() ?>>
<span id="el_measurement_units_base_unit_id">
<span<?= $Page->base_unit_id->viewAttributes() ?>>
<?= $Page->base_unit_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_measurement_units_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_measurement_units_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
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
