<?php

namespace PHPMaker2024\CMS;

// Page object
$ContractTermsView = &$Page;
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
<form name="fcontract_termsview" id="fcontract_termsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { contract_terms: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fcontract_termsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fcontract_termsview")
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
<input type="hidden" name="t" value="contract_terms">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->term_id->Visible) { // term_id ?>
    <tr id="r_term_id"<?= $Page->term_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contract_terms_term_id"><?= $Page->term_id->caption() ?></span></td>
        <td data-name="term_id"<?= $Page->term_id->cellAttributes() ?>>
<span id="el_contract_terms_term_id">
<span<?= $Page->term_id->viewAttributes() ?>>
<?= $Page->term_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contract_id->Visible) { // contract_id ?>
    <tr id="r_contract_id"<?= $Page->contract_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contract_terms_contract_id"><?= $Page->contract_id->caption() ?></span></td>
        <td data-name="contract_id"<?= $Page->contract_id->cellAttributes() ?>>
<span id="el_contract_terms_contract_id">
<span<?= $Page->contract_id->viewAttributes() ?>>
<?= $Page->contract_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->term_type->Visible) { // term_type ?>
    <tr id="r_term_type"<?= $Page->term_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contract_terms_term_type"><?= $Page->term_type->caption() ?></span></td>
        <td data-name="term_type"<?= $Page->term_type->cellAttributes() ?>>
<span id="el_contract_terms_term_type">
<span<?= $Page->term_type->viewAttributes() ?>>
<?= $Page->term_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contract_terms_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_contract_terms_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->value->Visible) { // value ?>
    <tr id="r_value"<?= $Page->value->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contract_terms_value"><?= $Page->value->caption() ?></span></td>
        <td data-name="value"<?= $Page->value->cellAttributes() ?>>
<span id="el_contract_terms_value">
<span<?= $Page->value->viewAttributes() ?>>
<?= $Page->value->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
    <tr id="r_priority"<?= $Page->priority->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contract_terms_priority"><?= $Page->priority->caption() ?></span></td>
        <td data-name="priority"<?= $Page->priority->cellAttributes() ?>>
<span id="el_contract_terms_priority">
<span<?= $Page->priority->viewAttributes() ?>>
<?= $Page->priority->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->is_mandatory->Visible) { // is_mandatory ?>
    <tr id="r_is_mandatory"<?= $Page->is_mandatory->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contract_terms_is_mandatory"><?= $Page->is_mandatory->caption() ?></span></td>
        <td data-name="is_mandatory"<?= $Page->is_mandatory->cellAttributes() ?>>
<span id="el_contract_terms_is_mandatory">
<span<?= $Page->is_mandatory->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->is_mandatory->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
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
