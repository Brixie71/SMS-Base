<?php

namespace PHPMaker2024\CMS;

// Page object
$ClientDocumentsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { client_documents: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fclient_documentsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fclient_documentsdelete")
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
<form name="fclient_documentsdelete" id="fclient_documentsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="client_documents">
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
<?php if ($Page->document_id->Visible) { // document_id ?>
        <th class="<?= $Page->document_id->headerCellClass() ?>"><span id="elh_client_documents_document_id" class="client_documents_document_id"><?= $Page->document_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
        <th class="<?= $Page->client_id->headerCellClass() ?>"><span id="elh_client_documents_client_id" class="client_documents_client_id"><?= $Page->client_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->document_type->Visible) { // document_type ?>
        <th class="<?= $Page->document_type->headerCellClass() ?>"><span id="elh_client_documents_document_type" class="client_documents_document_type"><?= $Page->document_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
        <th class="<?= $Page->_title->headerCellClass() ?>"><span id="elh_client_documents__title" class="client_documents__title"><?= $Page->_title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->upload_date->Visible) { // upload_date ?>
        <th class="<?= $Page->upload_date->headerCellClass() ?>"><span id="elh_client_documents_upload_date" class="client_documents_upload_date"><?= $Page->upload_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->expiry_date->Visible) { // expiry_date ?>
        <th class="<?= $Page->expiry_date->headerCellClass() ?>"><span id="elh_client_documents_expiry_date" class="client_documents_expiry_date"><?= $Page->expiry_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_client_documents_status" class="client_documents_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->uploaded_by->Visible) { // uploaded_by ?>
        <th class="<?= $Page->uploaded_by->headerCellClass() ?>"><span id="elh_client_documents_uploaded_by" class="client_documents_uploaded_by"><?= $Page->uploaded_by->caption() ?></span></th>
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
<?php if ($Page->document_id->Visible) { // document_id ?>
        <td<?= $Page->document_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->document_id->viewAttributes() ?>>
<?= $Page->document_id->getViewValue() ?></span>
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
<?php if ($Page->document_type->Visible) { // document_type ?>
        <td<?= $Page->document_type->cellAttributes() ?>>
<span id="">
<span<?= $Page->document_type->viewAttributes() ?>>
<?= $Page->document_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
        <td<?= $Page->_title->cellAttributes() ?>>
<span id="">
<span<?= $Page->_title->viewAttributes() ?>>
<?= $Page->_title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->upload_date->Visible) { // upload_date ?>
        <td<?= $Page->upload_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->upload_date->viewAttributes() ?>>
<?= $Page->upload_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->expiry_date->Visible) { // expiry_date ?>
        <td<?= $Page->expiry_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->expiry_date->viewAttributes() ?>>
<?= $Page->expiry_date->getViewValue() ?></span>
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
<?php if ($Page->uploaded_by->Visible) { // uploaded_by ?>
        <td<?= $Page->uploaded_by->cellAttributes() ?>>
<span id="">
<span<?= $Page->uploaded_by->viewAttributes() ?>>
<?= $Page->uploaded_by->getViewValue() ?></span>
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
