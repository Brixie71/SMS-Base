<?php

namespace PHPMaker2024\CMS;

// Page object
$ClientContactsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { client_contacts: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fclient_contactsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fclient_contactsdelete")
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
<form name="fclient_contactsdelete" id="fclient_contactsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="client_contacts">
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
<?php if ($Page->contact_id->Visible) { // contact_id ?>
        <th class="<?= $Page->contact_id->headerCellClass() ?>"><span id="elh_client_contacts_contact_id" class="client_contacts_contact_id"><?= $Page->contact_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
        <th class="<?= $Page->client_id->headerCellClass() ?>"><span id="elh_client_contacts_client_id" class="client_contacts_client_id"><?= $Page->client_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_client_contacts_name" class="client_contacts_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->position->Visible) { // position ?>
        <th class="<?= $Page->position->headerCellClass() ?>"><span id="elh_client_contacts_position" class="client_contacts_position"><?= $Page->position->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_client_contacts__email" class="client_contacts__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <th class="<?= $Page->phone->headerCellClass() ?>"><span id="elh_client_contacts_phone" class="client_contacts_phone"><?= $Page->phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->mobile->Visible) { // mobile ?>
        <th class="<?= $Page->mobile->headerCellClass() ?>"><span id="elh_client_contacts_mobile" class="client_contacts_mobile"><?= $Page->mobile->caption() ?></span></th>
<?php } ?>
<?php if ($Page->is_primary->Visible) { // is_primary ?>
        <th class="<?= $Page->is_primary->headerCellClass() ?>"><span id="elh_client_contacts_is_primary" class="client_contacts_is_primary"><?= $Page->is_primary->caption() ?></span></th>
<?php } ?>
<?php if ($Page->is_technical->Visible) { // is_technical ?>
        <th class="<?= $Page->is_technical->headerCellClass() ?>"><span id="elh_client_contacts_is_technical" class="client_contacts_is_technical"><?= $Page->is_technical->caption() ?></span></th>
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
<?php if ($Page->contact_id->Visible) { // contact_id ?>
        <td<?= $Page->contact_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->contact_id->viewAttributes() ?>>
<?= $Page->contact_id->getViewValue() ?></span>
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
<?php if ($Page->name->Visible) { // name ?>
        <td<?= $Page->name->cellAttributes() ?>>
<span id="">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->position->Visible) { // position ?>
        <td<?= $Page->position->cellAttributes() ?>>
<span id="">
<span<?= $Page->position->viewAttributes() ?>>
<?= $Page->position->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <td<?= $Page->_email->cellAttributes() ?>>
<span id="">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <td<?= $Page->phone->cellAttributes() ?>>
<span id="">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->mobile->Visible) { // mobile ?>
        <td<?= $Page->mobile->cellAttributes() ?>>
<span id="">
<span<?= $Page->mobile->viewAttributes() ?>>
<?= $Page->mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->is_primary->Visible) { // is_primary ?>
        <td<?= $Page->is_primary->cellAttributes() ?>>
<span id="">
<span<?= $Page->is_primary->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->is_primary->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->is_technical->Visible) { // is_technical ?>
        <td<?= $Page->is_technical->cellAttributes() ?>>
<span id="">
<span<?= $Page->is_technical->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->is_technical->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
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
