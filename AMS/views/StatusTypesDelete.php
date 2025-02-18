<?php

namespace PHPMaker2024\AMS;

// Page object
$StatusTypesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { status_types: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fstatus_typesdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fstatus_typesdelete")
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
<form name="fstatus_typesdelete" id="fstatus_typesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="status_types">
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
<?php if ($Page->status_id->Visible) { // status_id ?>
        <th class="<?= $Page->status_id->headerCellClass() ?>"><span id="elh_status_types_status_id" class="status_types_status_id"><?= $Page->status_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->category->Visible) { // category ?>
        <th class="<?= $Page->category->headerCellClass() ?>"><span id="elh_status_types_category" class="status_types_category"><?= $Page->category->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_status_types_name" class="status_types_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->is_operational->Visible) { // is_operational ?>
        <th class="<?= $Page->is_operational->headerCellClass() ?>"><span id="elh_status_types_is_operational" class="status_types_is_operational"><?= $Page->is_operational->caption() ?></span></th>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
        <th class="<?= $Page->color_code->headerCellClass() ?>"><span id="elh_status_types_color_code" class="status_types_color_code"><?= $Page->color_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->icon_class->Visible) { // icon_class ?>
        <th class="<?= $Page->icon_class->headerCellClass() ?>"><span id="elh_status_types_icon_class" class="status_types_icon_class"><?= $Page->icon_class->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sequence_no->Visible) { // sequence_no ?>
        <th class="<?= $Page->sequence_no->headerCellClass() ?>"><span id="elh_status_types_sequence_no" class="status_types_sequence_no"><?= $Page->sequence_no->caption() ?></span></th>
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
<?php if ($Page->status_id->Visible) { // status_id ?>
        <td<?= $Page->status_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->status_id->viewAttributes() ?>>
<?= $Page->status_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->category->Visible) { // category ?>
        <td<?= $Page->category->cellAttributes() ?>>
<span id="">
<span<?= $Page->category->viewAttributes() ?>>
<?= $Page->category->getViewValue() ?></span>
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
<?php if ($Page->is_operational->Visible) { // is_operational ?>
        <td<?= $Page->is_operational->cellAttributes() ?>>
<span id="">
<span<?= $Page->is_operational->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->is_operational->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
        <td<?= $Page->color_code->cellAttributes() ?>>
<span id="">
<span<?= $Page->color_code->viewAttributes() ?>>
<?= $Page->color_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->icon_class->Visible) { // icon_class ?>
        <td<?= $Page->icon_class->cellAttributes() ?>>
<span id="">
<span<?= $Page->icon_class->viewAttributes() ?>>
<?= $Page->icon_class->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sequence_no->Visible) { // sequence_no ?>
        <td<?= $Page->sequence_no->cellAttributes() ?>>
<span id="">
<span<?= $Page->sequence_no->viewAttributes() ?>>
<?= $Page->sequence_no->getViewValue() ?></span>
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
