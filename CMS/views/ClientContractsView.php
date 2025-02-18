<?php

namespace PHPMaker2024\CMS;

// Page object
$ClientContractsView = &$Page;
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
<form name="fclient_contractsview" id="fclient_contractsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { client_contracts: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fclient_contractsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fclient_contractsview")
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
<input type="hidden" name="t" value="client_contracts">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->contract_id->Visible) { // contract_id ?>
    <tr id="r_contract_id"<?= $Page->contract_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_contracts_contract_id"><?= $Page->contract_id->caption() ?></span></td>
        <td data-name="contract_id"<?= $Page->contract_id->cellAttributes() ?>>
<span id="el_client_contracts_contract_id">
<span<?= $Page->contract_id->viewAttributes() ?>>
<?= $Page->contract_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
    <tr id="r_client_id"<?= $Page->client_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_contracts_client_id"><?= $Page->client_id->caption() ?></span></td>
        <td data-name="client_id"<?= $Page->client_id->cellAttributes() ?>>
<span id="el_client_contracts_client_id">
<span<?= $Page->client_id->viewAttributes() ?>>
<?= $Page->client_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contract_code->Visible) { // contract_code ?>
    <tr id="r_contract_code"<?= $Page->contract_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_contracts_contract_code"><?= $Page->contract_code->caption() ?></span></td>
        <td data-name="contract_code"<?= $Page->contract_code->cellAttributes() ?>>
<span id="el_client_contracts_contract_code">
<span<?= $Page->contract_code->viewAttributes() ?>>
<?= $Page->contract_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->start_date->Visible) { // start_date ?>
    <tr id="r_start_date"<?= $Page->start_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_contracts_start_date"><?= $Page->start_date->caption() ?></span></td>
        <td data-name="start_date"<?= $Page->start_date->cellAttributes() ?>>
<span id="el_client_contracts_start_date">
<span<?= $Page->start_date->viewAttributes() ?>>
<?= $Page->start_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->end_date->Visible) { // end_date ?>
    <tr id="r_end_date"<?= $Page->end_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_contracts_end_date"><?= $Page->end_date->caption() ?></span></td>
        <td data-name="end_date"<?= $Page->end_date->cellAttributes() ?>>
<span id="el_client_contracts_end_date">
<span<?= $Page->end_date->viewAttributes() ?>>
<?= $Page->end_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_contracts_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_client_contracts_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contract_type->Visible) { // contract_type ?>
    <tr id="r_contract_type"<?= $Page->contract_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_contracts_contract_type"><?= $Page->contract_type->caption() ?></span></td>
        <td data-name="contract_type"<?= $Page->contract_type->cellAttributes() ?>>
<span id="el_client_contracts_contract_type">
<span<?= $Page->contract_type->viewAttributes() ?>>
<?= $Page->contract_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->service_level->Visible) { // service_level ?>
    <tr id="r_service_level"<?= $Page->service_level->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_contracts_service_level"><?= $Page->service_level->caption() ?></span></td>
        <td data-name="service_level"<?= $Page->service_level->cellAttributes() ?>>
<span id="el_client_contracts_service_level">
<span<?= $Page->service_level->viewAttributes() ?>>
<?= $Page->service_level->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->auto_renewal->Visible) { // auto_renewal ?>
    <tr id="r_auto_renewal"<?= $Page->auto_renewal->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_contracts_auto_renewal"><?= $Page->auto_renewal->caption() ?></span></td>
        <td data-name="auto_renewal"<?= $Page->auto_renewal->cellAttributes() ?>>
<span id="el_client_contracts_auto_renewal">
<span<?= $Page->auto_renewal->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->auto_renewal->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->renewal_notice_days->Visible) { // renewal_notice_days ?>
    <tr id="r_renewal_notice_days"<?= $Page->renewal_notice_days->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_contracts_renewal_notice_days"><?= $Page->renewal_notice_days->caption() ?></span></td>
        <td data-name="renewal_notice_days"<?= $Page->renewal_notice_days->cellAttributes() ?>>
<span id="el_client_contracts_renewal_notice_days">
<span<?= $Page->renewal_notice_days->viewAttributes() ?>>
<?= $Page->renewal_notice_days->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <tr id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_contracts_created_by"><?= $Page->created_by->caption() ?></span></td>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el_client_contracts_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_client_contracts_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_client_contracts_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
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
