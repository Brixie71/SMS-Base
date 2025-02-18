<?php

namespace PHPMaker2024\AMS;

// Page object
$TowerEquipmentDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tower_equipment: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var ftower_equipmentdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ftower_equipmentdelete")
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
<form name="ftower_equipmentdelete" id="ftower_equipmentdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tower_equipment">
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
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
        <th class="<?= $Page->equipment_id->headerCellClass() ?>"><span id="elh_tower_equipment_equipment_id" class="tower_equipment_equipment_id"><?= $Page->equipment_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tower_id->Visible) { // tower_id ?>
        <th class="<?= $Page->tower_id->headerCellClass() ?>"><span id="elh_tower_equipment_tower_id" class="tower_equipment_tower_id"><?= $Page->tower_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->model_id->Visible) { // model_id ?>
        <th class="<?= $Page->model_id->headerCellClass() ?>"><span id="elh_tower_equipment_model_id" class="tower_equipment_model_id"><?= $Page->model_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->serial_number->Visible) { // serial_number ?>
        <th class="<?= $Page->serial_number->headerCellClass() ?>"><span id="elh_tower_equipment_serial_number" class="tower_equipment_serial_number"><?= $Page->serial_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->installation_date->Visible) { // installation_date ?>
        <th class="<?= $Page->installation_date->headerCellClass() ?>"><span id="elh_tower_equipment_installation_date" class="tower_equipment_installation_date"><?= $Page->installation_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->warranty_expiry->Visible) { // warranty_expiry ?>
        <th class="<?= $Page->warranty_expiry->headerCellClass() ?>"><span id="elh_tower_equipment_warranty_expiry" class="tower_equipment_warranty_expiry"><?= $Page->warranty_expiry->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
        <th class="<?= $Page->status_id->headerCellClass() ?>"><span id="elh_tower_equipment_status_id" class="tower_equipment_status_id"><?= $Page->status_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->last_maintenance->Visible) { // last_maintenance ?>
        <th class="<?= $Page->last_maintenance->headerCellClass() ?>"><span id="elh_tower_equipment_last_maintenance" class="tower_equipment_last_maintenance"><?= $Page->last_maintenance->caption() ?></span></th>
<?php } ?>
<?php if ($Page->next_maintenance->Visible) { // next_maintenance ?>
        <th class="<?= $Page->next_maintenance->headerCellClass() ?>"><span id="elh_tower_equipment_next_maintenance" class="tower_equipment_next_maintenance"><?= $Page->next_maintenance->caption() ?></span></th>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
        <th class="<?= $Page->client_id->headerCellClass() ?>"><span id="elh_tower_equipment_client_id" class="tower_equipment_client_id"><?= $Page->client_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->installed_by->Visible) { // installed_by ?>
        <th class="<?= $Page->installed_by->headerCellClass() ?>"><span id="elh_tower_equipment_installed_by" class="tower_equipment_installed_by"><?= $Page->installed_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_tower_equipment_created_by" class="tower_equipment_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_tower_equipment_created_at" class="tower_equipment_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
        <th class="<?= $Page->updated_by->headerCellClass() ?>"><span id="elh_tower_equipment_updated_by" class="tower_equipment_updated_by"><?= $Page->updated_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_tower_equipment_updated_at" class="tower_equipment_updated_at"><?= $Page->updated_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->is_active->Visible) { // is_active ?>
        <th class="<?= $Page->is_active->headerCellClass() ?>"><span id="elh_tower_equipment_is_active" class="tower_equipment_is_active"><?= $Page->is_active->caption() ?></span></th>
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
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
        <td<?= $Page->equipment_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->equipment_id->viewAttributes() ?>>
<?= $Page->equipment_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tower_id->Visible) { // tower_id ?>
        <td<?= $Page->tower_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->tower_id->viewAttributes() ?>>
<?= $Page->tower_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->model_id->Visible) { // model_id ?>
        <td<?= $Page->model_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->model_id->viewAttributes() ?>>
<?= $Page->model_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->serial_number->Visible) { // serial_number ?>
        <td<?= $Page->serial_number->cellAttributes() ?>>
<span id="">
<span<?= $Page->serial_number->viewAttributes() ?>>
<?= $Page->serial_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->installation_date->Visible) { // installation_date ?>
        <td<?= $Page->installation_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->installation_date->viewAttributes() ?>>
<?= $Page->installation_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->warranty_expiry->Visible) { // warranty_expiry ?>
        <td<?= $Page->warranty_expiry->cellAttributes() ?>>
<span id="">
<span<?= $Page->warranty_expiry->viewAttributes() ?>>
<?= $Page->warranty_expiry->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
        <td<?= $Page->status_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->status_id->viewAttributes() ?>>
<?= $Page->status_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->last_maintenance->Visible) { // last_maintenance ?>
        <td<?= $Page->last_maintenance->cellAttributes() ?>>
<span id="">
<span<?= $Page->last_maintenance->viewAttributes() ?>>
<?= $Page->last_maintenance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->next_maintenance->Visible) { // next_maintenance ?>
        <td<?= $Page->next_maintenance->cellAttributes() ?>>
<span id="">
<span<?= $Page->next_maintenance->viewAttributes() ?>>
<?= $Page->next_maintenance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
        <td<?= $Page->client_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->client_id->viewAttributes() ?>>
<?= $Page->client_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->installed_by->Visible) { // installed_by ?>
        <td<?= $Page->installed_by->cellAttributes() ?>>
<span id="">
<span<?= $Page->installed_by->viewAttributes() ?>>
<?= $Page->installed_by->getViewValue() ?></span>
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
