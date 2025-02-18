<?php

namespace PHPMaker2024\AMS;

// Page object
$MeasurementUnitsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fmeasurement_unitsedit" id="fmeasurement_unitsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { measurement_units: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fmeasurement_unitsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmeasurement_unitsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["unit_id", [fields.unit_id.visible && fields.unit_id.required ? ew.Validators.required(fields.unit_id.caption) : null], fields.unit_id.isInvalid],
            ["category_id", [fields.category_id.visible && fields.category_id.required ? ew.Validators.required(fields.category_id.caption) : null, ew.Validators.integer], fields.category_id.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["symbol", [fields.symbol.visible && fields.symbol.required ? ew.Validators.required(fields.symbol.caption) : null], fields.symbol.isInvalid],
            ["conversion_factor", [fields.conversion_factor.visible && fields.conversion_factor.required ? ew.Validators.required(fields.conversion_factor.caption) : null, ew.Validators.float], fields.conversion_factor.isInvalid],
            ["base_unit_id", [fields.base_unit_id.visible && fields.base_unit_id.required ? ew.Validators.required(fields.base_unit_id.caption) : null, ew.Validators.integer], fields.base_unit_id.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid]
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
<input type="hidden" name="t" value="measurement_units">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->unit_id->Visible) { // unit_id ?>
    <div id="r_unit_id"<?= $Page->unit_id->rowAttributes() ?>>
        <label id="elh_measurement_units_unit_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unit_id->caption() ?><?= $Page->unit_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->unit_id->cellAttributes() ?>>
<span id="el_measurement_units_unit_id">
<span<?= $Page->unit_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->unit_id->getDisplayValue($Page->unit_id->EditValue))) ?>"></span>
<input type="hidden" data-table="measurement_units" data-field="x_unit_id" data-hidden="1" name="x_unit_id" id="x_unit_id" value="<?= HtmlEncode($Page->unit_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
    <div id="r_category_id"<?= $Page->category_id->rowAttributes() ?>>
        <label id="elh_measurement_units_category_id" for="x_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category_id->caption() ?><?= $Page->category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category_id->cellAttributes() ?>>
<span id="el_measurement_units_category_id">
<input type="<?= $Page->category_id->getInputTextType() ?>" name="x_category_id" id="x_category_id" data-table="measurement_units" data-field="x_category_id" value="<?= $Page->category_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->category_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->category_id->formatPattern()) ?>"<?= $Page->category_id->editAttributes() ?> aria-describedby="x_category_id_help">
<?= $Page->category_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->category_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_measurement_units_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_measurement_units_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="measurement_units" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->symbol->Visible) { // symbol ?>
    <div id="r_symbol"<?= $Page->symbol->rowAttributes() ?>>
        <label id="elh_measurement_units_symbol" for="x_symbol" class="<?= $Page->LeftColumnClass ?>"><?= $Page->symbol->caption() ?><?= $Page->symbol->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->symbol->cellAttributes() ?>>
<span id="el_measurement_units_symbol">
<input type="<?= $Page->symbol->getInputTextType() ?>" name="x_symbol" id="x_symbol" data-table="measurement_units" data-field="x_symbol" value="<?= $Page->symbol->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->symbol->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->symbol->formatPattern()) ?>"<?= $Page->symbol->editAttributes() ?> aria-describedby="x_symbol_help">
<?= $Page->symbol->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->symbol->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->conversion_factor->Visible) { // conversion_factor ?>
    <div id="r_conversion_factor"<?= $Page->conversion_factor->rowAttributes() ?>>
        <label id="elh_measurement_units_conversion_factor" for="x_conversion_factor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->conversion_factor->caption() ?><?= $Page->conversion_factor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->conversion_factor->cellAttributes() ?>>
<span id="el_measurement_units_conversion_factor">
<input type="<?= $Page->conversion_factor->getInputTextType() ?>" name="x_conversion_factor" id="x_conversion_factor" data-table="measurement_units" data-field="x_conversion_factor" value="<?= $Page->conversion_factor->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->conversion_factor->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->conversion_factor->formatPattern()) ?>"<?= $Page->conversion_factor->editAttributes() ?> aria-describedby="x_conversion_factor_help">
<?= $Page->conversion_factor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->conversion_factor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->base_unit_id->Visible) { // base_unit_id ?>
    <div id="r_base_unit_id"<?= $Page->base_unit_id->rowAttributes() ?>>
        <label id="elh_measurement_units_base_unit_id" for="x_base_unit_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->base_unit_id->caption() ?><?= $Page->base_unit_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->base_unit_id->cellAttributes() ?>>
<span id="el_measurement_units_base_unit_id">
<input type="<?= $Page->base_unit_id->getInputTextType() ?>" name="x_base_unit_id" id="x_base_unit_id" data-table="measurement_units" data-field="x_base_unit_id" value="<?= $Page->base_unit_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->base_unit_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->base_unit_id->formatPattern()) ?>"<?= $Page->base_unit_id->editAttributes() ?> aria-describedby="x_base_unit_id_help">
<?= $Page->base_unit_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->base_unit_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_measurement_units_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_measurement_units_description">
<textarea data-table="measurement_units" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmeasurement_unitsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmeasurement_unitsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("measurement_units");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
