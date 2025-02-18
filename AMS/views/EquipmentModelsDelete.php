<?php

namespace PHPMaker2024\AMS;

// Page object
$EquipmentModelsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { equipment_models: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fequipment_modelsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fequipment_modelsdelete")
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
<form name="fequipment_modelsdelete" id="fequipment_modelsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="equipment_models">
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
<?php if ($Page->model_id->Visible) { // model_id ?>
        <th class="<?= $Page->model_id->headerCellClass() ?>"><span id="elh_equipment_models_model_id" class="equipment_models_model_id"><?= $Page->model_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->manufacturer_id->Visible) { // manufacturer_id ?>
        <th class="<?= $Page->manufacturer_id->headerCellClass() ?>"><span id="elh_equipment_models_manufacturer_id" class="equipment_models_manufacturer_id"><?= $Page->manufacturer_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type_id->Visible) { // type_id ?>
        <th class="<?= $Page->type_id->headerCellClass() ?>"><span id="elh_equipment_models_type_id" class="equipment_models_type_id"><?= $Page->type_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->model_number->Visible) { // model_number ?>
        <th class="<?= $Page->model_number->headerCellClass() ?>"><span id="elh_equipment_models_model_number" class="equipment_models_model_number"><?= $Page->model_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_equipment_models_name" class="equipment_models_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->support_end_date->Visible) { // support_end_date ?>
        <th class="<?= $Page->support_end_date->headerCellClass() ?>"><span id="elh_equipment_models_support_end_date" class="equipment_models_support_end_date"><?= $Page->support_end_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_equipment_models_created_by" class="equipment_models_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_equipment_models_created_at" class="equipment_models_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
        <th class="<?= $Page->updated_by->headerCellClass() ?>"><span id="elh_equipment_models_updated_by" class="equipment_models_updated_by"><?= $Page->updated_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_equipment_models_updated_at" class="equipment_models_updated_at"><?= $Page->updated_at->caption() ?></span></th>
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
<?php if ($Page->model_id->Visible) { // model_id ?>
        <td<?= $Page->model_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->model_id->viewAttributes() ?>>
<?= $Page->model_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->manufacturer_id->Visible) { // manufacturer_id ?>
        <td<?= $Page->manufacturer_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->manufacturer_id->viewAttributes() ?>>
<?= $Page->manufacturer_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->type_id->Visible) { // type_id ?>
        <td<?= $Page->type_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->type_id->viewAttributes() ?>>
<?= $Page->type_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->model_number->Visible) { // model_number ?>
        <td<?= $Page->model_number->cellAttributes() ?>>
<span id="">
<span<?= $Page->model_number->viewAttributes() ?>>
<?= $Page->model_number->getViewValue() ?></span>
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
<?php if ($Page->support_end_date->Visible) { // support_end_date ?>
        <td<?= $Page->support_end_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->support_end_date->viewAttributes() ?>>
<?= $Page->support_end_date->getViewValue() ?></span>
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
