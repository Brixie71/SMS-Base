<?php

namespace PHPMaker2024\AMS;

// Page object
$SpecificationTypesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { specification_types: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fspecification_typesdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fspecification_typesdelete")
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
<form name="fspecification_typesdelete" id="fspecification_typesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="specification_types">
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
<?php if ($Page->spec_type_id->Visible) { // spec_type_id ?>
        <th class="<?= $Page->spec_type_id->headerCellClass() ?>"><span id="elh_specification_types_spec_type_id" class="specification_types_spec_type_id"><?= $Page->spec_type_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_specification_types_name" class="specification_types_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->data_type->Visible) { // data_type ?>
        <th class="<?= $Page->data_type->headerCellClass() ?>"><span id="elh_specification_types_data_type" class="specification_types_data_type"><?= $Page->data_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->unit_category_id->Visible) { // unit_category_id ?>
        <th class="<?= $Page->unit_category_id->headerCellClass() ?>"><span id="elh_specification_types_unit_category_id" class="specification_types_unit_category_id"><?= $Page->unit_category_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->is_required->Visible) { // is_required ?>
        <th class="<?= $Page->is_required->headerCellClass() ?>"><span id="elh_specification_types_is_required" class="specification_types_is_required"><?= $Page->is_required->caption() ?></span></th>
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
<?php if ($Page->spec_type_id->Visible) { // spec_type_id ?>
        <td<?= $Page->spec_type_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->spec_type_id->viewAttributes() ?>>
<?= $Page->spec_type_id->getViewValue() ?></span>
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
<?php if ($Page->data_type->Visible) { // data_type ?>
        <td<?= $Page->data_type->cellAttributes() ?>>
<span id="">
<span<?= $Page->data_type->viewAttributes() ?>>
<?= $Page->data_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->unit_category_id->Visible) { // unit_category_id ?>
        <td<?= $Page->unit_category_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->unit_category_id->viewAttributes() ?>>
<?= $Page->unit_category_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->is_required->Visible) { // is_required ?>
        <td<?= $Page->is_required->cellAttributes() ?>>
<span id="">
<span<?= $Page->is_required->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->is_required->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
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
