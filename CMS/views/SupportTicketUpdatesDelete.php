<?php

namespace PHPMaker2024\CMS;

// Page object
$SupportTicketUpdatesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { support_ticket_updates: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fsupport_ticket_updatesdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsupport_ticket_updatesdelete")
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
<form name="fsupport_ticket_updatesdelete" id="fsupport_ticket_updatesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="support_ticket_updates">
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
<?php if ($Page->update_id->Visible) { // update_id ?>
        <th class="<?= $Page->update_id->headerCellClass() ?>"><span id="elh_support_ticket_updates_update_id" class="support_ticket_updates_update_id"><?= $Page->update_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ticket_id->Visible) { // ticket_id ?>
        <th class="<?= $Page->ticket_id->headerCellClass() ?>"><span id="elh_support_ticket_updates_ticket_id" class="support_ticket_updates_ticket_id"><?= $Page->ticket_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->update_type->Visible) { // update_type ?>
        <th class="<?= $Page->update_type->headerCellClass() ?>"><span id="elh_support_ticket_updates_update_type" class="support_ticket_updates_update_type"><?= $Page->update_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
        <th class="<?= $Page->updated_by->headerCellClass() ?>"><span id="elh_support_ticket_updates_updated_by" class="support_ticket_updates_updated_by"><?= $Page->updated_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_support_ticket_updates_updated_at" class="support_ticket_updates_updated_at"><?= $Page->updated_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_support_ticket_updates_status" class="support_ticket_updates_status"><?= $Page->status->caption() ?></span></th>
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
<?php if ($Page->update_id->Visible) { // update_id ?>
        <td<?= $Page->update_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->update_id->viewAttributes() ?>>
<?= $Page->update_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ticket_id->Visible) { // ticket_id ?>
        <td<?= $Page->ticket_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->ticket_id->viewAttributes() ?>>
<?= $Page->ticket_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->update_type->Visible) { // update_type ?>
        <td<?= $Page->update_type->cellAttributes() ?>>
<span id="">
<span<?= $Page->update_type->viewAttributes() ?>>
<?= $Page->update_type->getViewValue() ?></span>
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
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
