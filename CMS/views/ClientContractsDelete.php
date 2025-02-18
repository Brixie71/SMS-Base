<?php

namespace PHPMaker2024\CMS;

// Page object
$ClientContractsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { client_contracts: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fclient_contractsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fclient_contractsdelete")
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
<form name="fclient_contractsdelete" id="fclient_contractsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="client_contracts">
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
<?php if ($Page->contract_id->Visible) { // contract_id ?>
        <th class="<?= $Page->contract_id->headerCellClass() ?>"><span id="elh_client_contracts_contract_id" class="client_contracts_contract_id"><?= $Page->contract_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
        <th class="<?= $Page->client_id->headerCellClass() ?>"><span id="elh_client_contracts_client_id" class="client_contracts_client_id"><?= $Page->client_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contract_code->Visible) { // contract_code ?>
        <th class="<?= $Page->contract_code->headerCellClass() ?>"><span id="elh_client_contracts_contract_code" class="client_contracts_contract_code"><?= $Page->contract_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->start_date->Visible) { // start_date ?>
        <th class="<?= $Page->start_date->headerCellClass() ?>"><span id="elh_client_contracts_start_date" class="client_contracts_start_date"><?= $Page->start_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->end_date->Visible) { // end_date ?>
        <th class="<?= $Page->end_date->headerCellClass() ?>"><span id="elh_client_contracts_end_date" class="client_contracts_end_date"><?= $Page->end_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_client_contracts_status" class="client_contracts_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contract_type->Visible) { // contract_type ?>
        <th class="<?= $Page->contract_type->headerCellClass() ?>"><span id="elh_client_contracts_contract_type" class="client_contracts_contract_type"><?= $Page->contract_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->service_level->Visible) { // service_level ?>
        <th class="<?= $Page->service_level->headerCellClass() ?>"><span id="elh_client_contracts_service_level" class="client_contracts_service_level"><?= $Page->service_level->caption() ?></span></th>
<?php } ?>
<?php if ($Page->auto_renewal->Visible) { // auto_renewal ?>
        <th class="<?= $Page->auto_renewal->headerCellClass() ?>"><span id="elh_client_contracts_auto_renewal" class="client_contracts_auto_renewal"><?= $Page->auto_renewal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->renewal_notice_days->Visible) { // renewal_notice_days ?>
        <th class="<?= $Page->renewal_notice_days->headerCellClass() ?>"><span id="elh_client_contracts_renewal_notice_days" class="client_contracts_renewal_notice_days"><?= $Page->renewal_notice_days->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_client_contracts_created_by" class="client_contracts_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_client_contracts_created_at" class="client_contracts_created_at"><?= $Page->created_at->caption() ?></span></th>
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
<?php if ($Page->contract_id->Visible) { // contract_id ?>
        <td<?= $Page->contract_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->contract_id->viewAttributes() ?>>
<?= $Page->contract_id->getViewValue() ?></span>
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
<?php if ($Page->contract_code->Visible) { // contract_code ?>
        <td<?= $Page->contract_code->cellAttributes() ?>>
<span id="">
<span<?= $Page->contract_code->viewAttributes() ?>>
<?= $Page->contract_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->start_date->Visible) { // start_date ?>
        <td<?= $Page->start_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->start_date->viewAttributes() ?>>
<?= $Page->start_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->end_date->Visible) { // end_date ?>
        <td<?= $Page->end_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->end_date->viewAttributes() ?>>
<?= $Page->end_date->getViewValue() ?></span>
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
<?php if ($Page->contract_type->Visible) { // contract_type ?>
        <td<?= $Page->contract_type->cellAttributes() ?>>
<span id="">
<span<?= $Page->contract_type->viewAttributes() ?>>
<?= $Page->contract_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->service_level->Visible) { // service_level ?>
        <td<?= $Page->service_level->cellAttributes() ?>>
<span id="">
<span<?= $Page->service_level->viewAttributes() ?>>
<?= $Page->service_level->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->auto_renewal->Visible) { // auto_renewal ?>
        <td<?= $Page->auto_renewal->cellAttributes() ?>>
<span id="">
<span<?= $Page->auto_renewal->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->auto_renewal->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->renewal_notice_days->Visible) { // renewal_notice_days ?>
        <td<?= $Page->renewal_notice_days->cellAttributes() ?>>
<span id="">
<span<?= $Page->renewal_notice_days->viewAttributes() ?>>
<?= $Page->renewal_notice_days->getViewValue() ?></span>
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
