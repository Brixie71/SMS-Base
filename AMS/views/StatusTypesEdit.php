<?php

namespace PHPMaker2024\AMS;

// Page object
$StatusTypesEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fstatus_typesedit" id="fstatus_typesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { status_types: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fstatus_typesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fstatus_typesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["status_id", [fields.status_id.visible && fields.status_id.required ? ew.Validators.required(fields.status_id.caption) : null], fields.status_id.isInvalid],
            ["category", [fields.category.visible && fields.category.required ? ew.Validators.required(fields.category.caption) : null], fields.category.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["is_operational", [fields.is_operational.visible && fields.is_operational.required ? ew.Validators.required(fields.is_operational.caption) : null], fields.is_operational.isInvalid],
            ["color_code", [fields.color_code.visible && fields.color_code.required ? ew.Validators.required(fields.color_code.caption) : null], fields.color_code.isInvalid],
            ["icon_class", [fields.icon_class.visible && fields.icon_class.required ? ew.Validators.required(fields.icon_class.caption) : null], fields.icon_class.isInvalid],
            ["sequence_no", [fields.sequence_no.visible && fields.sequence_no.required ? ew.Validators.required(fields.sequence_no.caption) : null, ew.Validators.integer], fields.sequence_no.isInvalid]
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
            "is_operational": <?= $Page->is_operational->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="status_types">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->status_id->Visible) { // status_id ?>
    <div id="r_status_id"<?= $Page->status_id->rowAttributes() ?>>
        <label id="elh_status_types_status_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_id->caption() ?><?= $Page->status_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status_id->cellAttributes() ?>>
<span id="el_status_types_status_id">
<span<?= $Page->status_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->status_id->getDisplayValue($Page->status_id->EditValue))) ?>"></span>
<input type="hidden" data-table="status_types" data-field="x_status_id" data-hidden="1" name="x_status_id" id="x_status_id" value="<?= HtmlEncode($Page->status_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category->Visible) { // category ?>
    <div id="r_category"<?= $Page->category->rowAttributes() ?>>
        <label id="elh_status_types_category" for="x_category" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category->caption() ?><?= $Page->category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category->cellAttributes() ?>>
<span id="el_status_types_category">
<input type="<?= $Page->category->getInputTextType() ?>" name="x_category" id="x_category" data-table="status_types" data-field="x_category" value="<?= $Page->category->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->category->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->category->formatPattern()) ?>"<?= $Page->category->editAttributes() ?> aria-describedby="x_category_help">
<?= $Page->category->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->category->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_status_types_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_status_types_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="status_types" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_status_types_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_status_types_description">
<textarea data-table="status_types" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->is_operational->Visible) { // is_operational ?>
    <div id="r_is_operational"<?= $Page->is_operational->rowAttributes() ?>>
        <label id="elh_status_types_is_operational" class="<?= $Page->LeftColumnClass ?>"><?= $Page->is_operational->caption() ?><?= $Page->is_operational->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->is_operational->cellAttributes() ?>>
<span id="el_status_types_is_operational">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->is_operational->isInvalidClass() ?>" data-table="status_types" data-field="x_is_operational" data-boolean name="x_is_operational" id="x_is_operational" value="1"<?= ConvertToBool($Page->is_operational->CurrentValue) ? " checked" : "" ?><?= $Page->is_operational->editAttributes() ?> aria-describedby="x_is_operational_help">
    <div class="invalid-feedback"><?= $Page->is_operational->getErrorMessage() ?></div>
</div>
<?= $Page->is_operational->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
    <div id="r_color_code"<?= $Page->color_code->rowAttributes() ?>>
        <label id="elh_status_types_color_code" for="x_color_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->color_code->caption() ?><?= $Page->color_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->color_code->cellAttributes() ?>>
<span id="el_status_types_color_code">
<input type="<?= $Page->color_code->getInputTextType() ?>" name="x_color_code" id="x_color_code" data-table="status_types" data-field="x_color_code" value="<?= $Page->color_code->EditValue ?>" size="30" maxlength="7" placeholder="<?= HtmlEncode($Page->color_code->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->color_code->formatPattern()) ?>"<?= $Page->color_code->editAttributes() ?> aria-describedby="x_color_code_help">
<?= $Page->color_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->color_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->icon_class->Visible) { // icon_class ?>
    <div id="r_icon_class"<?= $Page->icon_class->rowAttributes() ?>>
        <label id="elh_status_types_icon_class" for="x_icon_class" class="<?= $Page->LeftColumnClass ?>"><?= $Page->icon_class->caption() ?><?= $Page->icon_class->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->icon_class->cellAttributes() ?>>
<span id="el_status_types_icon_class">
<input type="<?= $Page->icon_class->getInputTextType() ?>" name="x_icon_class" id="x_icon_class" data-table="status_types" data-field="x_icon_class" value="<?= $Page->icon_class->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->icon_class->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->icon_class->formatPattern()) ?>"<?= $Page->icon_class->editAttributes() ?> aria-describedby="x_icon_class_help">
<?= $Page->icon_class->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->icon_class->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sequence_no->Visible) { // sequence_no ?>
    <div id="r_sequence_no"<?= $Page->sequence_no->rowAttributes() ?>>
        <label id="elh_status_types_sequence_no" for="x_sequence_no" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sequence_no->caption() ?><?= $Page->sequence_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sequence_no->cellAttributes() ?>>
<span id="el_status_types_sequence_no">
<input type="<?= $Page->sequence_no->getInputTextType() ?>" name="x_sequence_no" id="x_sequence_no" data-table="status_types" data-field="x_sequence_no" value="<?= $Page->sequence_no->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sequence_no->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->sequence_no->formatPattern()) ?>"<?= $Page->sequence_no->editAttributes() ?> aria-describedby="x_sequence_no_help">
<?= $Page->sequence_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sequence_no->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fstatus_typesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fstatus_typesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("status_types");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
