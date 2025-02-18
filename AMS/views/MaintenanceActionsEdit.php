<?php

namespace PHPMaker2024\AMS;

// Page object
$MaintenanceActionsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fmaintenance_actionsedit" id="fmaintenance_actionsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_actions: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fmaintenance_actionsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmaintenance_actionsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["action_id", [fields.action_id.visible && fields.action_id.required ? ew.Validators.required(fields.action_id.caption) : null], fields.action_id.isInvalid],
            ["log_id", [fields.log_id.visible && fields.log_id.required ? ew.Validators.required(fields.log_id.caption) : null, ew.Validators.integer], fields.log_id.isInvalid],
            ["action_type", [fields.action_type.visible && fields.action_type.required ? ew.Validators.required(fields.action_type.caption) : null], fields.action_type.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["result", [fields.result.visible && fields.result.required ? ew.Validators.required(fields.result.caption) : null], fields.result.isInvalid],
            ["created_by", [fields.created_by.visible && fields.created_by.required ? ew.Validators.required(fields.created_by.caption) : null, ew.Validators.integer], fields.created_by.isInvalid],
            ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid]
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
<input type="hidden" name="t" value="maintenance_actions">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->action_id->Visible) { // action_id ?>
    <div id="r_action_id"<?= $Page->action_id->rowAttributes() ?>>
        <label id="elh_maintenance_actions_action_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->action_id->caption() ?><?= $Page->action_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->action_id->cellAttributes() ?>>
<span id="el_maintenance_actions_action_id">
<span<?= $Page->action_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->action_id->getDisplayValue($Page->action_id->EditValue))) ?>"></span>
<input type="hidden" data-table="maintenance_actions" data-field="x_action_id" data-hidden="1" name="x_action_id" id="x_action_id" value="<?= HtmlEncode($Page->action_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->log_id->Visible) { // log_id ?>
    <div id="r_log_id"<?= $Page->log_id->rowAttributes() ?>>
        <label id="elh_maintenance_actions_log_id" for="x_log_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->log_id->caption() ?><?= $Page->log_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->log_id->cellAttributes() ?>>
<span id="el_maintenance_actions_log_id">
<input type="<?= $Page->log_id->getInputTextType() ?>" name="x_log_id" id="x_log_id" data-table="maintenance_actions" data-field="x_log_id" value="<?= $Page->log_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->log_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->log_id->formatPattern()) ?>"<?= $Page->log_id->editAttributes() ?> aria-describedby="x_log_id_help">
<?= $Page->log_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->log_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->action_type->Visible) { // action_type ?>
    <div id="r_action_type"<?= $Page->action_type->rowAttributes() ?>>
        <label id="elh_maintenance_actions_action_type" for="x_action_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->action_type->caption() ?><?= $Page->action_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->action_type->cellAttributes() ?>>
<span id="el_maintenance_actions_action_type">
<input type="<?= $Page->action_type->getInputTextType() ?>" name="x_action_type" id="x_action_type" data-table="maintenance_actions" data-field="x_action_type" value="<?= $Page->action_type->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->action_type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->action_type->formatPattern()) ?>"<?= $Page->action_type->editAttributes() ?> aria-describedby="x_action_type_help">
<?= $Page->action_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->action_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_maintenance_actions_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_maintenance_actions_description">
<textarea data-table="maintenance_actions" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->result->Visible) { // result ?>
    <div id="r_result"<?= $Page->result->rowAttributes() ?>>
        <label id="elh_maintenance_actions_result" for="x_result" class="<?= $Page->LeftColumnClass ?>"><?= $Page->result->caption() ?><?= $Page->result->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->result->cellAttributes() ?>>
<span id="el_maintenance_actions_result">
<textarea data-table="maintenance_actions" data-field="x_result" name="x_result" id="x_result" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->result->getPlaceHolder()) ?>"<?= $Page->result->editAttributes() ?> aria-describedby="x_result_help"><?= $Page->result->EditValue ?></textarea>
<?= $Page->result->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->result->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_maintenance_actions_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_maintenance_actions_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="maintenance_actions" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_maintenance_actions_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_maintenance_actions_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="maintenance_actions" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_at->formatPattern()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmaintenance_actionsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmaintenance_actionsedit", "x_created_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmaintenance_actionsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmaintenance_actionsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("maintenance_actions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
