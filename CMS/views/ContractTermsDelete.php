<?php

namespace PHPMaker2024\CMS;

// Page object
$ContractTermsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { contract_terms: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fcontract_termsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fcontract_termsdelete")
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
<form name="fcontract_termsdelete" id="fcontract_termsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="contract_terms">
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
<?php if ($Page->term_id->Visible) { // term_id ?>
        <th class="<?= $Page->term_id->headerCellClass() ?>"><span id="elh_contract_terms_term_id" class="contract_terms_term_id"><?= $Page->term_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contract_id->Visible) { // contract_id ?>
        <th class="<?= $Page->contract_id->headerCellClass() ?>"><span id="elh_contract_terms_contract_id" class="contract_terms_contract_id"><?= $Page->contract_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->term_type->Visible) { // term_type ?>
        <th class="<?= $Page->term_type->headerCellClass() ?>"><span id="elh_contract_terms_term_type" class="contract_terms_term_type"><?= $Page->term_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
        <th class="<?= $Page->priority->headerCellClass() ?>"><span id="elh_contract_terms_priority" class="contract_terms_priority"><?= $Page->priority->caption() ?></span></th>
<?php } ?>
<?php if ($Page->is_mandatory->Visible) { // is_mandatory ?>
        <th class="<?= $Page->is_mandatory->headerCellClass() ?>"><span id="elh_contract_terms_is_mandatory" class="contract_terms_is_mandatory"><?= $Page->is_mandatory->caption() ?></span></th>
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
<?php if ($Page->term_id->Visible) { // term_id ?>
        <td<?= $Page->term_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->term_id->viewAttributes() ?>>
<?= $Page->term_id->getViewValue() ?></span>
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
<?php if ($Page->term_type->Visible) { // term_type ?>
        <td<?= $Page->term_type->cellAttributes() ?>>
<span id="">
<span<?= $Page->term_type->viewAttributes() ?>>
<?= $Page->term_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
        <td<?= $Page->priority->cellAttributes() ?>>
<span id="">
<span<?= $Page->priority->viewAttributes() ?>>
<?= $Page->priority->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->is_mandatory->Visible) { // is_mandatory ?>
        <td<?= $Page->is_mandatory->cellAttributes() ?>>
<span id="">
<span<?= $Page->is_mandatory->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->is_mandatory->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
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
