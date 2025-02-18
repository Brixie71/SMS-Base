<?php

namespace PHPMaker2024\AMS;

// Page object
$MaintenancePartsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fmaintenance_partsedit" id="fmaintenance_partsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_parts: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fmaintenance_partsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmaintenance_partsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["part_id", [fields.part_id.visible && fields.part_id.required ? ew.Validators.required(fields.part_id.caption) : null], fields.part_id.isInvalid],
            ["log_id", [fields.log_id.visible && fields.log_id.required ? ew.Validators.required(fields.log_id.caption) : null, ew.Validators.integer], fields.log_id.isInvalid],
            ["part_name", [fields.part_name.visible && fields.part_name.required ? ew.Validators.required(fields.part_name.caption) : null], fields.part_name.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
            ["unit_cost", [fields.unit_cost.visible && fields.unit_cost.required ? ew.Validators.required(fields.unit_cost.caption) : null, ew.Validators.float], fields.unit_cost.isInvalid],
            ["total_cost", [fields.total_cost.visible && fields.total_cost.required ? ew.Validators.required(fields.total_cost.caption) : null, ew.Validators.float], fields.total_cost.isInvalid],
            ["supplier", [fields.supplier.visible && fields.supplier.required ? ew.Validators.required(fields.supplier.caption) : null], fields.supplier.isInvalid],
            ["warranty_period", [fields.warranty_period.visible && fields.warranty_period.required ? ew.Validators.required(fields.warranty_period.caption) : null, ew.Validators.integer], fields.warranty_period.isInvalid],
            ["created_by", [fields.created_by.visible && fields.created_by.required ? ew.Validators.required(fields.created_by.caption) : null, ew.Validators.integer], fields.created_by.isInvalid],
            ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid],
            ["notes", [fields.notes.visible && fields.notes.required ? ew.Validators.required(fields.notes.caption) : null], fields.notes.isInvalid]
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
<input type="hidden" name="t" value="maintenance_parts">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->part_id->Visible) { // part_id ?>
    <div id="r_part_id"<?= $Page->part_id->rowAttributes() ?>>
        <label id="elh_maintenance_parts_part_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->part_id->caption() ?><?= $Page->part_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->part_id->cellAttributes() ?>>
<span id="el_maintenance_parts_part_id">
<span<?= $Page->part_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->part_id->getDisplayValue($Page->part_id->EditValue))) ?>"></span>
<input type="hidden" data-table="maintenance_parts" data-field="x_part_id" data-hidden="1" name="x_part_id" id="x_part_id" value="<?= HtmlEncode($Page->part_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->log_id->Visible) { // log_id ?>
    <div id="r_log_id"<?= $Page->log_id->rowAttributes() ?>>
        <label id="elh_maintenance_parts_log_id" for="x_log_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->log_id->caption() ?><?= $Page->log_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->log_id->cellAttributes() ?>>
<span id="el_maintenance_parts_log_id">
<input type="<?= $Page->log_id->getInputTextType() ?>" name="x_log_id" id="x_log_id" data-table="maintenance_parts" data-field="x_log_id" value="<?= $Page->log_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->log_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->log_id->formatPattern()) ?>"<?= $Page->log_id->editAttributes() ?> aria-describedby="x_log_id_help">
<?= $Page->log_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->log_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->part_name->Visible) { // part_name ?>
    <div id="r_part_name"<?= $Page->part_name->rowAttributes() ?>>
        <label id="elh_maintenance_parts_part_name" for="x_part_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->part_name->caption() ?><?= $Page->part_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->part_name->cellAttributes() ?>>
<span id="el_maintenance_parts_part_name">
<input type="<?= $Page->part_name->getInputTextType() ?>" name="x_part_name" id="x_part_name" data-table="maintenance_parts" data-field="x_part_name" value="<?= $Page->part_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->part_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->part_name->formatPattern()) ?>"<?= $Page->part_name->editAttributes() ?> aria-describedby="x_part_name_help">
<?= $Page->part_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->part_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <div id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <label id="elh_maintenance_parts_quantity" for="x_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quantity->caption() ?><?= $Page->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->quantity->cellAttributes() ?>>
<span id="el_maintenance_parts_quantity">
<input type="<?= $Page->quantity->getInputTextType() ?>" name="x_quantity" id="x_quantity" data-table="maintenance_parts" data-field="x_quantity" value="<?= $Page->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->quantity->formatPattern()) ?>"<?= $Page->quantity->editAttributes() ?> aria-describedby="x_quantity_help">
<?= $Page->quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->unit_cost->Visible) { // unit_cost ?>
    <div id="r_unit_cost"<?= $Page->unit_cost->rowAttributes() ?>>
        <label id="elh_maintenance_parts_unit_cost" for="x_unit_cost" class="<?= $Page->LeftColumnClass ?>"><?= $Page->unit_cost->caption() ?><?= $Page->unit_cost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->unit_cost->cellAttributes() ?>>
<span id="el_maintenance_parts_unit_cost">
<input type="<?= $Page->unit_cost->getInputTextType() ?>" name="x_unit_cost" id="x_unit_cost" data-table="maintenance_parts" data-field="x_unit_cost" value="<?= $Page->unit_cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->unit_cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->unit_cost->formatPattern()) ?>"<?= $Page->unit_cost->editAttributes() ?> aria-describedby="x_unit_cost_help">
<?= $Page->unit_cost->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->unit_cost->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total_cost->Visible) { // total_cost ?>
    <div id="r_total_cost"<?= $Page->total_cost->rowAttributes() ?>>
        <label id="elh_maintenance_parts_total_cost" for="x_total_cost" class="<?= $Page->LeftColumnClass ?>"><?= $Page->total_cost->caption() ?><?= $Page->total_cost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->total_cost->cellAttributes() ?>>
<span id="el_maintenance_parts_total_cost">
<input type="<?= $Page->total_cost->getInputTextType() ?>" name="x_total_cost" id="x_total_cost" data-table="maintenance_parts" data-field="x_total_cost" value="<?= $Page->total_cost->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->total_cost->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->total_cost->formatPattern()) ?>"<?= $Page->total_cost->editAttributes() ?> aria-describedby="x_total_cost_help">
<?= $Page->total_cost->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total_cost->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->supplier->Visible) { // supplier ?>
    <div id="r_supplier"<?= $Page->supplier->rowAttributes() ?>>
        <label id="elh_maintenance_parts_supplier" for="x_supplier" class="<?= $Page->LeftColumnClass ?>"><?= $Page->supplier->caption() ?><?= $Page->supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->supplier->cellAttributes() ?>>
<span id="el_maintenance_parts_supplier">
<input type="<?= $Page->supplier->getInputTextType() ?>" name="x_supplier" id="x_supplier" data-table="maintenance_parts" data-field="x_supplier" value="<?= $Page->supplier->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->supplier->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->supplier->formatPattern()) ?>"<?= $Page->supplier->editAttributes() ?> aria-describedby="x_supplier_help">
<?= $Page->supplier->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->supplier->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->warranty_period->Visible) { // warranty_period ?>
    <div id="r_warranty_period"<?= $Page->warranty_period->rowAttributes() ?>>
        <label id="elh_maintenance_parts_warranty_period" for="x_warranty_period" class="<?= $Page->LeftColumnClass ?>"><?= $Page->warranty_period->caption() ?><?= $Page->warranty_period->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->warranty_period->cellAttributes() ?>>
<span id="el_maintenance_parts_warranty_period">
<input type="<?= $Page->warranty_period->getInputTextType() ?>" name="x_warranty_period" id="x_warranty_period" data-table="maintenance_parts" data-field="x_warranty_period" value="<?= $Page->warranty_period->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->warranty_period->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->warranty_period->formatPattern()) ?>"<?= $Page->warranty_period->editAttributes() ?> aria-describedby="x_warranty_period_help">
<?= $Page->warranty_period->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->warranty_period->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_maintenance_parts_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_maintenance_parts_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="maintenance_parts" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_maintenance_parts_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_maintenance_parts_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="maintenance_parts" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_at->formatPattern()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmaintenance_partsedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    clock: !!format.match(/h/i) || !!format.match(/m/) || !!format.match(/s/i),
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.getPreferredTheme()
            }
        };
    ew.createDateTimePicker("fmaintenance_partsedit", "x_created_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <div id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <label id="elh_maintenance_parts_notes" for="x_notes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notes->caption() ?><?= $Page->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notes->cellAttributes() ?>>
<span id="el_maintenance_parts_notes">
<textarea data-table="maintenance_parts" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notes->getPlaceHolder()) ?>"<?= $Page->notes->editAttributes() ?> aria-describedby="x_notes_help"><?= $Page->notes->EditValue ?></textarea>
<?= $Page->notes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmaintenance_partsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmaintenance_partsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("maintenance_parts");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
