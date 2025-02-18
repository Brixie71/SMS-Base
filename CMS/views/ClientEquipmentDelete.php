<?php

namespace PHPMaker2024\CMS;

// Page object
$ClientEquipmentDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { client_equipment: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fclient_equipmentdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fclient_equipmentdelete")
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
<form name="fclient_equipmentdelete" id="fclient_equipmentdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="client_equipment">
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
        <th class="<?= $Page->equipment_id->headerCellClass() ?>"><span id="elh_client_equipment_equipment_id" class="client_equipment_equipment_id"><?= $Page->equipment_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
        <th class="<?= $Page->client_id->headerCellClass() ?>"><span id="elh_client_equipment_client_id" class="client_equipment_client_id"><?= $Page->client_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contract_id->Visible) { // contract_id ?>
        <th class="<?= $Page->contract_id->headerCellClass() ?>"><span id="elh_client_equipment_contract_id" class="client_equipment_contract_id"><?= $Page->contract_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tower_equipment_id->Visible) { // tower_equipment_id ?>
        <th class="<?= $Page->tower_equipment_id->headerCellClass() ?>"><span id="elh_client_equipment_tower_equipment_id" class="client_equipment_tower_equipment_id"><?= $Page->tower_equipment_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->installation_date->Visible) { // installation_date ?>
        <th class="<?= $Page->installation_date->headerCellClass() ?>"><span id="elh_client_equipment_installation_date" class="client_equipment_installation_date"><?= $Page->installation_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->removal_date->Visible) { // removal_date ?>
        <th class="<?= $Page->removal_date->headerCellClass() ?>"><span id="elh_client_equipment_removal_date" class="client_equipment_removal_date"><?= $Page->removal_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_client_equipment_status" class="client_equipment_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maintenance_schedule->Visible) { // maintenance_schedule ?>
        <th class="<?= $Page->maintenance_schedule->headerCellClass() ?>"><span id="elh_client_equipment_maintenance_schedule" class="client_equipment_maintenance_schedule"><?= $Page->maintenance_schedule->caption() ?></span></th>
<?php } ?>
<?php if ($Page->last_maintenance_date->Visible) { // last_maintenance_date ?>
        <th class="<?= $Page->last_maintenance_date->headerCellClass() ?>"><span id="elh_client_equipment_last_maintenance_date" class="client_equipment_last_maintenance_date"><?= $Page->last_maintenance_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->next_maintenance_date->Visible) { // next_maintenance_date ?>
        <th class="<?= $Page->next_maintenance_date->headerCellClass() ?>"><span id="elh_client_equipment_next_maintenance_date" class="client_equipment_next_maintenance_date"><?= $Page->next_maintenance_date->caption() ?></span></th>
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
<?php if ($Page->client_id->Visible) { // client_id ?>
        <td<?= $Page->client_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->client_id->viewAttributes() ?>>
<?= $Page->client_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contract_id->Visible) { // contract_id ?>
        <td<?= $Page->contract_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->contract_id->viewAttributes() ?>>
<?= $Page->contract_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tower_equipment_id->Visible) { // tower_equipment_id ?>
        <td<?= $Page->tower_equipment_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->tower_equipment_id->viewAttributes() ?>>
<?= $Page->tower_equipment_id->getViewValue() ?></span>
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
<?php if ($Page->removal_date->Visible) { // removal_date ?>
        <td<?= $Page->removal_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->removal_date->viewAttributes() ?>>
<?= $Page->removal_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maintenance_schedule->Visible) { // maintenance_schedule ?>
        <td<?= $Page->maintenance_schedule->cellAttributes() ?>>
<span id="">
<span<?= $Page->maintenance_schedule->viewAttributes() ?>>
<?= $Page->maintenance_schedule->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->last_maintenance_date->Visible) { // last_maintenance_date ?>
        <td<?= $Page->last_maintenance_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->last_maintenance_date->viewAttributes() ?>>
<?= $Page->last_maintenance_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->next_maintenance_date->Visible) { // next_maintenance_date ?>
        <td<?= $Page->next_maintenance_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->next_maintenance_date->viewAttributes() ?>>
<?= $Page->next_maintenance_date->getViewValue() ?></span>
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
