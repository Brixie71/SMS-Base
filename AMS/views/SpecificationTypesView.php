<?php

namespace PHPMaker2024\AMS;

// Page object
$SpecificationTypesView = &$Page;
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
<form name="fspecification_typesview" id="fspecification_typesview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { specification_types: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fspecification_typesview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fspecification_typesview")
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
<input type="hidden" name="t" value="specification_types">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->spec_type_id->Visible) { // spec_type_id ?>
    <tr id="r_spec_type_id"<?= $Page->spec_type_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_specification_types_spec_type_id"><?= $Page->spec_type_id->caption() ?></span></td>
        <td data-name="spec_type_id"<?= $Page->spec_type_id->cellAttributes() ?>>
<span id="el_specification_types_spec_type_id">
<span<?= $Page->spec_type_id->viewAttributes() ?>>
<?= $Page->spec_type_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <tr id="r_name"<?= $Page->name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_specification_types_name"><?= $Page->name->caption() ?></span></td>
        <td data-name="name"<?= $Page->name->cellAttributes() ?>>
<span id="el_specification_types_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_specification_types_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_specification_types_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->data_type->Visible) { // data_type ?>
    <tr id="r_data_type"<?= $Page->data_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_specification_types_data_type"><?= $Page->data_type->caption() ?></span></td>
        <td data-name="data_type"<?= $Page->data_type->cellAttributes() ?>>
<span id="el_specification_types_data_type">
<span<?= $Page->data_type->viewAttributes() ?>>
<?= $Page->data_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->unit_category_id->Visible) { // unit_category_id ?>
    <tr id="r_unit_category_id"<?= $Page->unit_category_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_specification_types_unit_category_id"><?= $Page->unit_category_id->caption() ?></span></td>
        <td data-name="unit_category_id"<?= $Page->unit_category_id->cellAttributes() ?>>
<span id="el_specification_types_unit_category_id">
<span<?= $Page->unit_category_id->viewAttributes() ?>>
<?= $Page->unit_category_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->validation_rules->Visible) { // validation_rules ?>
    <tr id="r_validation_rules"<?= $Page->validation_rules->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_specification_types_validation_rules"><?= $Page->validation_rules->caption() ?></span></td>
        <td data-name="validation_rules"<?= $Page->validation_rules->cellAttributes() ?>>
<span id="el_specification_types_validation_rules">
<span<?= $Page->validation_rules->viewAttributes() ?>>
<?= $Page->validation_rules->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->is_required->Visible) { // is_required ?>
    <tr id="r_is_required"<?= $Page->is_required->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_specification_types_is_required"><?= $Page->is_required->caption() ?></span></td>
        <td data-name="is_required"<?= $Page->is_required->cellAttributes() ?>>
<span id="el_specification_types_is_required">
<span<?= $Page->is_required->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->is_required->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
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
