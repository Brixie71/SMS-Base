<?php

namespace PHPMaker2024\CMS;

// Page object
$ClientEquipmentView = &$Page;
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
<form name="fclient_equipmentview" id="fclient_equipmentview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { client_equipment: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fclient_equipmentview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fclient_equipmentview")
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
<input type="hidden" name="t" value="client_equipment">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
    <tr id="r_equipment_id"<?= $Page->equipment_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_equipment_equipment_id"><?= $Page->equipment_id->caption() ?></span></td>
        <td data-name="equipment_id"<?= $Page->equipment_id->cellAttributes() ?>>
<span id="el_client_equipment_equipment_id">
<span<?= $Page->equipment_id->viewAttributes() ?>>
<?= $Page->equipment_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
    <tr id="r_client_id"<?= $Page->client_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_equipment_client_id"><?= $Page->client_id->caption() ?></span></td>
        <td data-name="client_id"<?= $Page->client_id->cellAttributes() ?>>
<span id="el_client_equipment_client_id">
<span<?= $Page->client_id->viewAttributes() ?>>
<?= $Page->client_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contract_id->Visible) { // contract_id ?>
    <tr id="r_contract_id"<?= $Page->contract_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_equipment_contract_id"><?= $Page->contract_id->caption() ?></span></td>
        <td data-name="contract_id"<?= $Page->contract_id->cellAttributes() ?>>
<span id="el_client_equipment_contract_id">
<span<?= $Page->contract_id->viewAttributes() ?>>
<?= $Page->contract_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tower_equipment_id->Visible) { // tower_equipment_id ?>
    <tr id="r_tower_equipment_id"<?= $Page->tower_equipment_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_equipment_tower_equipment_id"><?= $Page->tower_equipment_id->caption() ?></span></td>
        <td data-name="tower_equipment_id"<?= $Page->tower_equipment_id->cellAttributes() ?>>
<span id="el_client_equipment_tower_equipment_id">
<span<?= $Page->tower_equipment_id->viewAttributes() ?>>
<?= $Page->tower_equipment_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->installation_date->Visible) { // installation_date ?>
    <tr id="r_installation_date"<?= $Page->installation_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_equipment_installation_date"><?= $Page->installation_date->caption() ?></span></td>
        <td data-name="installation_date"<?= $Page->installation_date->cellAttributes() ?>>
<span id="el_client_equipment_installation_date">
<span<?= $Page->installation_date->viewAttributes() ?>>
<?= $Page->installation_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->removal_date->Visible) { // removal_date ?>
    <tr id="r_removal_date"<?= $Page->removal_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_equipment_removal_date"><?= $Page->removal_date->caption() ?></span></td>
        <td data-name="removal_date"<?= $Page->removal_date->cellAttributes() ?>>
<span id="el_client_equipment_removal_date">
<span<?= $Page->removal_date->viewAttributes() ?>>
<?= $Page->removal_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_equipment_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_client_equipment_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maintenance_schedule->Visible) { // maintenance_schedule ?>
    <tr id="r_maintenance_schedule"<?= $Page->maintenance_schedule->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_equipment_maintenance_schedule"><?= $Page->maintenance_schedule->caption() ?></span></td>
        <td data-name="maintenance_schedule"<?= $Page->maintenance_schedule->cellAttributes() ?>>
<span id="el_client_equipment_maintenance_schedule">
<span<?= $Page->maintenance_schedule->viewAttributes() ?>>
<?= $Page->maintenance_schedule->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->last_maintenance_date->Visible) { // last_maintenance_date ?>
    <tr id="r_last_maintenance_date"<?= $Page->last_maintenance_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_equipment_last_maintenance_date"><?= $Page->last_maintenance_date->caption() ?></span></td>
        <td data-name="last_maintenance_date"<?= $Page->last_maintenance_date->cellAttributes() ?>>
<span id="el_client_equipment_last_maintenance_date">
<span<?= $Page->last_maintenance_date->viewAttributes() ?>>
<?= $Page->last_maintenance_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->next_maintenance_date->Visible) { // next_maintenance_date ?>
    <tr id="r_next_maintenance_date"<?= $Page->next_maintenance_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_equipment_next_maintenance_date"><?= $Page->next_maintenance_date->caption() ?></span></td>
        <td data-name="next_maintenance_date"<?= $Page->next_maintenance_date->cellAttributes() ?>>
<span id="el_client_equipment_next_maintenance_date">
<span<?= $Page->next_maintenance_date->viewAttributes() ?>>
<?= $Page->next_maintenance_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <tr id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_equipment_notes"><?= $Page->notes->caption() ?></span></td>
        <td data-name="notes"<?= $Page->notes->cellAttributes() ?>>
<span id="el_client_equipment_notes">
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
