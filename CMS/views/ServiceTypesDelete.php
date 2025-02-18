<?php

namespace PHPMaker2024\CMS;

// Page object
$ServiceTypesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { service_types: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fservice_typesdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fservice_typesdelete")
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
<form name="fservice_typesdelete" id="fservice_typesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="service_types">
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
<?php if ($Page->service_id->Visible) { // service_id ?>
        <th class="<?= $Page->service_id->headerCellClass() ?>"><span id="elh_service_types_service_id" class="service_types_service_id"><?= $Page->service_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_service_types_name" class="service_types_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sla_hours->Visible) { // sla_hours ?>
        <th class="<?= $Page->sla_hours->headerCellClass() ?>"><span id="elh_service_types_sla_hours" class="service_types_sla_hours"><?= $Page->sla_hours->caption() ?></span></th>
<?php } ?>
<?php if ($Page->severity_level->Visible) { // severity_level ?>
        <th class="<?= $Page->severity_level->headerCellClass() ?>"><span id="elh_service_types_severity_level" class="service_types_severity_level"><?= $Page->severity_level->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maintenance_frequency->Visible) { // maintenance_frequency ?>
        <th class="<?= $Page->maintenance_frequency->headerCellClass() ?>"><span id="elh_service_types_maintenance_frequency" class="service_types_maintenance_frequency"><?= $Page->maintenance_frequency->caption() ?></span></th>
<?php } ?>
<?php if ($Page->is_active->Visible) { // is_active ?>
        <th class="<?= $Page->is_active->headerCellClass() ?>"><span id="elh_service_types_is_active" class="service_types_is_active"><?= $Page->is_active->caption() ?></span></th>
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
<?php if ($Page->service_id->Visible) { // service_id ?>
        <td<?= $Page->service_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->service_id->viewAttributes() ?>>
<?= $Page->service_id->getViewValue() ?></span>
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
<?php if ($Page->sla_hours->Visible) { // sla_hours ?>
        <td<?= $Page->sla_hours->cellAttributes() ?>>
<span id="">
<span<?= $Page->sla_hours->viewAttributes() ?>>
<?= $Page->sla_hours->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->severity_level->Visible) { // severity_level ?>
        <td<?= $Page->severity_level->cellAttributes() ?>>
<span id="">
<span<?= $Page->severity_level->viewAttributes() ?>>
<?= $Page->severity_level->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maintenance_frequency->Visible) { // maintenance_frequency ?>
        <td<?= $Page->maintenance_frequency->cellAttributes() ?>>
<span id="">
<span<?= $Page->maintenance_frequency->viewAttributes() ?>>
<?= $Page->maintenance_frequency->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->is_active->Visible) { // is_active ?>
        <td<?= $Page->is_active->cellAttributes() ?>>
<span id="">
<span<?= $Page->is_active->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->is_active->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
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
