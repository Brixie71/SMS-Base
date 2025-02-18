<?php

namespace PHPMaker2024\AMS;

// Page object
$SpecificationTypesEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fspecification_typesedit" id="fspecification_typesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { specification_types: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fspecification_typesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fspecification_typesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["spec_type_id", [fields.spec_type_id.visible && fields.spec_type_id.required ? ew.Validators.required(fields.spec_type_id.caption) : null], fields.spec_type_id.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["data_type", [fields.data_type.visible && fields.data_type.required ? ew.Validators.required(fields.data_type.caption) : null], fields.data_type.isInvalid],
            ["unit_category_id", [fields.unit_category_id.visible && fields.unit_category_id.required ? ew.Validators.required(fields.unit_category_id.caption) : null, ew.Validators.integer], fields.unit_category_id.isInvalid],
            ["validation_rules", [fields.validation_rules.visible && fields.validation_rules.required ? ew.Validators.required(fields.validation_rules.caption) : null], fields.validation_rules.isInvalid],
            ["is_required", [fields.is_required.visible && fields.is_required.required ? ew.Validators.required(fields.is_required.caption) : null], fields.is_required.isInvalid]
        ])

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)!
                    // Your custom validation code in JAVASCRIPT here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
            "is_required": <?= $Page->is_required->toClientList($Page) ?>,
        })
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="specification_types">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->spec_type_id->Visible) { // spec_type_id ?>
    <div id="r_spec_type_id"<?= $Page->spec_type_id->rowAttributes() ?>>
        <label id="elh_specification_types_spec_type_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->spec_type_id->caption() ?><?= $Page->spec_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->spec_type_id->cellAttributes() ?>>
<span id="el_specification_types_spec_type_id">
<span<?= $Page->spec_type_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->spec_type_id->getDisplayValue($Page->spec_type_id->EditValue))) ?>"></span>
<input type="hidden" data-table="specification_types" data-field="x_spec_type_id" data-hidden="1" name="x_spec_type_id" id="x_spec_type_id" value="<?= HtmlEncode($Page->spec_type_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_specification_types_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_specification_types_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="specification_types" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_specification_types_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_specification_types_description">
<textarea data-table="specification_types" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->data_type->Visible) { // data_type ?>
    <div id="r_data_type"<?= $Page->data_type->rowAttributes() ?>>
        <label id="elh_specification_types_data_type" for="x_data_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->data_type->caption() ?><?= $Page->data_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->data_type->cellAttributes() ?>>
<span id="el_specification_types_data_type">
<input type="<?= $Page->data_type->getInputTextType() ?>" name="x_data_type" id="x_data_type" data-table="specification_types" data-field="x_data_type" value="<?= $Page->data_type->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->data_type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->data_type->formatPattern()) ?>"<?= $Page->data_type->editAttributes() ?> aria-describedby="x_data_type_help">
<?= $Page->data_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->data_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->unit_category_id->Visible) { // unit_category_id ?>
    <div id="r_unit_category_id"<?= $Page->unit_category_id->rowAttributes() ?>>
        <label id="elh_specification_types_unit_category_id" for="x_unit_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unit_category_id->caption() ?><?= $Page->unit_category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->unit_category_id->cellAttributes() ?>>
<span id="el_specification_types_unit_category_id">
<input type="<?= $Page->unit_category_id->getInputTextType() ?>" name="x_unit_category_id" id="x_unit_category_id" data-table="specification_types" data-field="x_unit_category_id" value="<?= $Page->unit_category_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->unit_category_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->unit_category_id->formatPattern()) ?>"<?= $Page->unit_category_id->editAttributes() ?> aria-describedby="x_unit_category_id_help">
<?= $Page->unit_category_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->unit_category_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->validation_rules->Visible) { // validation_rules ?>
    <div id="r_validation_rules"<?= $Page->validation_rules->rowAttributes() ?>>
        <label id="elh_specification_types_validation_rules" for="x_validation_rules" class="<?= $Page->LeftColumnClass ?>"><?= $Page->validation_rules->caption() ?><?= $Page->validation_rules->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->validation_rules->cellAttributes() ?>>
<span id="el_specification_types_validation_rules">
<textarea data-table="specification_types" data-field="x_validation_rules" name="x_validation_rules" id="x_validation_rules" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->validation_rules->getPlaceHolder()) ?>"<?= $Page->validation_rules->editAttributes() ?> aria-describedby="x_validation_rules_help"><?= $Page->validation_rules->EditValue ?></textarea>
<?= $Page->validation_rules->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->validation_rules->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->is_required->Visible) { // is_required ?>
    <div id="r_is_required"<?= $Page->is_required->rowAttributes() ?>>
        <label id="elh_specification_types_is_required" class="<?= $Page->LeftColumnClass ?>"><?= $Page->is_required->caption() ?><?= $Page->is_required->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->is_required->cellAttributes() ?>>
<span id="el_specification_types_is_required">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->is_required->isInvalidClass() ?>" data-table="specification_types" data-field="x_is_required" data-boolean name="x_is_required" id="x_is_required" value="1"<?= ConvertToBool($Page->is_required->CurrentValue) ? " checked" : "" ?><?= $Page->is_required->editAttributes() ?> aria-describedby="x_is_required_help">
    <div class="invalid-feedback"><?= $Page->is_required->getErrorMessage() ?></div>
</div>
<?= $Page->is_required->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fspecification_typesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fspecification_typesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("specification_types");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
