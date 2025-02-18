<?php

namespace PHPMaker2024\AMS;

// Page object
$TowerEquipmentView = &$Page;
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
<form name="ftower_equipmentview" id="ftower_equipmentview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tower_equipment: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var ftower_equipmentview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ftower_equipmentview")
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
<input type="hidden" name="t" value="tower_equipment">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
    <tr id="r_equipment_id"<?= $Page->equipment_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_equipment_id"><?= $Page->equipment_id->caption() ?></span></td>
        <td data-name="equipment_id"<?= $Page->equipment_id->cellAttributes() ?>>
<span id="el_tower_equipment_equipment_id">
<span<?= $Page->equipment_id->viewAttributes() ?>>
<?= $Page->equipment_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tower_id->Visible) { // tower_id ?>
    <tr id="r_tower_id"<?= $Page->tower_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_tower_id"><?= $Page->tower_id->caption() ?></span></td>
        <td data-name="tower_id"<?= $Page->tower_id->cellAttributes() ?>>
<span id="el_tower_equipment_tower_id">
<span<?= $Page->tower_id->viewAttributes() ?>>
<?= $Page->tower_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->model_id->Visible) { // model_id ?>
    <tr id="r_model_id"<?= $Page->model_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_model_id"><?= $Page->model_id->caption() ?></span></td>
        <td data-name="model_id"<?= $Page->model_id->cellAttributes() ?>>
<span id="el_tower_equipment_model_id">
<span<?= $Page->model_id->viewAttributes() ?>>
<?= $Page->model_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->serial_number->Visible) { // serial_number ?>
    <tr id="r_serial_number"<?= $Page->serial_number->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_serial_number"><?= $Page->serial_number->caption() ?></span></td>
        <td data-name="serial_number"<?= $Page->serial_number->cellAttributes() ?>>
<span id="el_tower_equipment_serial_number">
<span<?= $Page->serial_number->viewAttributes() ?>>
<?= $Page->serial_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->installation_date->Visible) { // installation_date ?>
    <tr id="r_installation_date"<?= $Page->installation_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_installation_date"><?= $Page->installation_date->caption() ?></span></td>
        <td data-name="installation_date"<?= $Page->installation_date->cellAttributes() ?>>
<span id="el_tower_equipment_installation_date">
<span<?= $Page->installation_date->viewAttributes() ?>>
<?= $Page->installation_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->warranty_expiry->Visible) { // warranty_expiry ?>
    <tr id="r_warranty_expiry"<?= $Page->warranty_expiry->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_warranty_expiry"><?= $Page->warranty_expiry->caption() ?></span></td>
        <td data-name="warranty_expiry"<?= $Page->warranty_expiry->cellAttributes() ?>>
<span id="el_tower_equipment_warranty_expiry">
<span<?= $Page->warranty_expiry->viewAttributes() ?>>
<?= $Page->warranty_expiry->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
    <tr id="r_status_id"<?= $Page->status_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_status_id"><?= $Page->status_id->caption() ?></span></td>
        <td data-name="status_id"<?= $Page->status_id->cellAttributes() ?>>
<span id="el_tower_equipment_status_id">
<span<?= $Page->status_id->viewAttributes() ?>>
<?= $Page->status_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->last_maintenance->Visible) { // last_maintenance ?>
    <tr id="r_last_maintenance"<?= $Page->last_maintenance->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_last_maintenance"><?= $Page->last_maintenance->caption() ?></span></td>
        <td data-name="last_maintenance"<?= $Page->last_maintenance->cellAttributes() ?>>
<span id="el_tower_equipment_last_maintenance">
<span<?= $Page->last_maintenance->viewAttributes() ?>>
<?= $Page->last_maintenance->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->next_maintenance->Visible) { // next_maintenance ?>
    <tr id="r_next_maintenance"<?= $Page->next_maintenance->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_next_maintenance"><?= $Page->next_maintenance->caption() ?></span></td>
        <td data-name="next_maintenance"<?= $Page->next_maintenance->cellAttributes() ?>>
<span id="el_tower_equipment_next_maintenance">
<span<?= $Page->next_maintenance->viewAttributes() ?>>
<?= $Page->next_maintenance->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
    <tr id="r_client_id"<?= $Page->client_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_client_id"><?= $Page->client_id->caption() ?></span></td>
        <td data-name="client_id"<?= $Page->client_id->cellAttributes() ?>>
<span id="el_tower_equipment_client_id">
<span<?= $Page->client_id->viewAttributes() ?>>
<?= $Page->client_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->installed_by->Visible) { // installed_by ?>
    <tr id="r_installed_by"<?= $Page->installed_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_installed_by"><?= $Page->installed_by->caption() ?></span></td>
        <td data-name="installed_by"<?= $Page->installed_by->cellAttributes() ?>>
<span id="el_tower_equipment_installed_by">
<span<?= $Page->installed_by->viewAttributes() ?>>
<?= $Page->installed_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <tr id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_created_by"><?= $Page->created_by->caption() ?></span></td>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el_tower_equipment_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_tower_equipment_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
    <tr id="r_updated_by"<?= $Page->updated_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_updated_by"><?= $Page->updated_by->caption() ?></span></td>
        <td data-name="updated_by"<?= $Page->updated_by->cellAttributes() ?>>
<span id="el_tower_equipment_updated_by">
<span<?= $Page->updated_by->viewAttributes() ?>>
<?= $Page->updated_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_tower_equipment_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->is_active->Visible) { // is_active ?>
    <tr id="r_is_active"<?= $Page->is_active->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_is_active"><?= $Page->is_active->caption() ?></span></td>
        <td data-name="is_active"<?= $Page->is_active->cellAttributes() ?>>
<span id="el_tower_equipment_is_active">
<span<?= $Page->is_active->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->is_active->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <tr id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tower_equipment_notes"><?= $Page->notes->caption() ?></span></td>
        <td data-name="notes"<?= $Page->notes->cellAttributes() ?>>
<span id="el_tower_equipment_notes">
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
