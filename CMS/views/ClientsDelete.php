<?php

namespace PHPMaker2024\CMS;

// Page object
$ClientsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { clients: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fclientsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fclientsdelete")
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
<form name="fclientsdelete" id="fclientsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="clients">
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
<?php if ($Page->client_id->Visible) { // client_id ?>
        <th class="<?= $Page->client_id->headerCellClass() ?>"><span id="elh_clients_client_id" class="clients_client_id"><?= $Page->client_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->client_code->Visible) { // client_code ?>
        <th class="<?= $Page->client_code->headerCellClass() ?>"><span id="elh_clients_client_code" class="clients_client_code"><?= $Page->client_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->company_name->Visible) { // company_name ?>
        <th class="<?= $Page->company_name->headerCellClass() ?>"><span id="elh_clients_company_name" class="clients_company_name"><?= $Page->company_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type_id->Visible) { // type_id ?>
        <th class="<?= $Page->type_id->headerCellClass() ?>"><span id="elh_clients_type_id" class="clients_type_id"><?= $Page->type_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_clients_status" class="clients_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->account_manager_id->Visible) { // account_manager_id ?>
        <th class="<?= $Page->account_manager_id->headerCellClass() ?>"><span id="elh_clients_account_manager_id" class="clients_account_manager_id"><?= $Page->account_manager_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->registration_date->Visible) { // registration_date ?>
        <th class="<?= $Page->registration_date->headerCellClass() ?>"><span id="elh_clients_registration_date" class="clients_registration_date"><?= $Page->registration_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->website->Visible) { // website ?>
        <th class="<?= $Page->website->headerCellClass() ?>"><span id="elh_clients_website" class="clients_website"><?= $Page->website->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_clients_created_by" class="clients_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_clients_created_at" class="clients_created_at"><?= $Page->created_at->caption() ?></span></th>
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
<?php if ($Page->client_id->Visible) { // client_id ?>
        <td<?= $Page->client_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->client_id->viewAttributes() ?>>
<?= $Page->client_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->client_code->Visible) { // client_code ?>
        <td<?= $Page->client_code->cellAttributes() ?>>
<span id="">
<span<?= $Page->client_code->viewAttributes() ?>>
<?= $Page->client_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->company_name->Visible) { // company_name ?>
        <td<?= $Page->company_name->cellAttributes() ?>>
<span id="">
<span<?= $Page->company_name->viewAttributes() ?>>
<?= $Page->company_name->getViewValue() ?></span>
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
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->account_manager_id->Visible) { // account_manager_id ?>
        <td<?= $Page->account_manager_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->account_manager_id->viewAttributes() ?>>
<?= $Page->account_manager_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->registration_date->Visible) { // registration_date ?>
        <td<?= $Page->registration_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->registration_date->viewAttributes() ?>>
<?= $Page->registration_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->website->Visible) { // website ?>
        <td<?= $Page->website->cellAttributes() ?>>
<span id="">
<span<?= $Page->website->viewAttributes() ?>>
<?= $Page->website->getViewValue() ?></span>
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
