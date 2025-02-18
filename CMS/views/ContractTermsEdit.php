<?php

namespace PHPMaker2024\CMS;

// Page object
$ContractTermsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fcontract_termsedit" id="fcontract_termsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { contract_terms: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fcontract_termsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fcontract_termsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["term_id", [fields.term_id.visible && fields.term_id.required ? ew.Validators.required(fields.term_id.caption) : null], fields.term_id.isInvalid],
            ["contract_id", [fields.contract_id.visible && fields.contract_id.required ? ew.Validators.required(fields.contract_id.caption) : null, ew.Validators.integer], fields.contract_id.isInvalid],
            ["term_type", [fields.term_type.visible && fields.term_type.required ? ew.Validators.required(fields.term_type.caption) : null], fields.term_type.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["value", [fields.value.visible && fields.value.required ? ew.Validators.required(fields.value.caption) : null], fields.value.isInvalid],
            ["priority", [fields.priority.visible && fields.priority.required ? ew.Validators.required(fields.priority.caption) : null, ew.Validators.integer], fields.priority.isInvalid],
            ["is_mandatory", [fields.is_mandatory.visible && fields.is_mandatory.required ? ew.Validators.required(fields.is_mandatory.caption) : null], fields.is_mandatory.isInvalid]
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
            "is_mandatory": <?= $Page->is_mandatory->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="contract_terms">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->term_id->Visible) { // term_id ?>
    <div id="r_term_id"<?= $Page->term_id->rowAttributes() ?>>
        <label id="elh_contract_terms_term_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->term_id->caption() ?><?= $Page->term_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->term_id->cellAttributes() ?>>
<span id="el_contract_terms_term_id">
<span<?= $Page->term_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->term_id->getDisplayValue($Page->term_id->EditValue))) ?>"></span>
<input type="hidden" data-table="contract_terms" data-field="x_term_id" data-hidden="1" name="x_term_id" id="x_term_id" value="<?= HtmlEncode($Page->term_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contract_id->Visible) { // contract_id ?>
    <div id="r_contract_id"<?= $Page->contract_id->rowAttributes() ?>>
        <label id="elh_contract_terms_contract_id" for="x_contract_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contract_id->caption() ?><?= $Page->contract_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contract_id->cellAttributes() ?>>
<span id="el_contract_terms_contract_id">
<input type="<?= $Page->contract_id->getInputTextType() ?>" name="x_contract_id" id="x_contract_id" data-table="contract_terms" data-field="x_contract_id" value="<?= $Page->contract_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->contract_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contract_id->formatPattern()) ?>"<?= $Page->contract_id->editAttributes() ?> aria-describedby="x_contract_id_help">
<?= $Page->contract_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contract_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->term_type->Visible) { // term_type ?>
    <div id="r_term_type"<?= $Page->term_type->rowAttributes() ?>>
        <label id="elh_contract_terms_term_type" for="x_term_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->term_type->caption() ?><?= $Page->term_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->term_type->cellAttributes() ?>>
<span id="el_contract_terms_term_type">
<input type="<?= $Page->term_type->getInputTextType() ?>" name="x_term_type" id="x_term_type" data-table="contract_terms" data-field="x_term_type" value="<?= $Page->term_type->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->term_type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->term_type->formatPattern()) ?>"<?= $Page->term_type->editAttributes() ?> aria-describedby="x_term_type_help">
<?= $Page->term_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->term_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_contract_terms_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_contract_terms_description">
<textarea data-table="contract_terms" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value->Visible) { // value ?>
    <div id="r_value"<?= $Page->value->rowAttributes() ?>>
        <label id="elh_contract_terms_value" for="x_value" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value->caption() ?><?= $Page->value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value->cellAttributes() ?>>
<span id="el_contract_terms_value">
<textarea data-table="contract_terms" data-field="x_value" name="x_value" id="x_value" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->value->getPlaceHolder()) ?>"<?= $Page->value->editAttributes() ?> aria-describedby="x_value_help"><?= $Page->value->EditValue ?></textarea>
<?= $Page->value->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
    <div id="r_priority"<?= $Page->priority->rowAttributes() ?>>
        <label id="elh_contract_terms_priority" for="x_priority" class="<?= $Page->LeftColumnClass ?>"><?= $Page->priority->caption() ?><?= $Page->priority->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->priority->cellAttributes() ?>>
<span id="el_contract_terms_priority">
<input type="<?= $Page->priority->getInputTextType() ?>" name="x_priority" id="x_priority" data-table="contract_terms" data-field="x_priority" value="<?= $Page->priority->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->priority->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->priority->formatPattern()) ?>"<?= $Page->priority->editAttributes() ?> aria-describedby="x_priority_help">
<?= $Page->priority->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->priority->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->is_mandatory->Visible) { // is_mandatory ?>
    <div id="r_is_mandatory"<?= $Page->is_mandatory->rowAttributes() ?>>
        <label id="elh_contract_terms_is_mandatory" class="<?= $Page->LeftColumnClass ?>"><?= $Page->is_mandatory->caption() ?><?= $Page->is_mandatory->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->is_mandatory->cellAttributes() ?>>
<span id="el_contract_terms_is_mandatory">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->is_mandatory->isInvalidClass() ?>" data-table="contract_terms" data-field="x_is_mandatory" data-boolean name="x_is_mandatory" id="x_is_mandatory" value="1"<?= ConvertToBool($Page->is_mandatory->CurrentValue) ? " checked" : "" ?><?= $Page->is_mandatory->editAttributes() ?> aria-describedby="x_is_mandatory_help">
    <div class="invalid-feedback"><?= $Page->is_mandatory->getErrorMessage() ?></div>
</div>
<?= $Page->is_mandatory->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fcontract_termsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fcontract_termsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("contract_terms");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
