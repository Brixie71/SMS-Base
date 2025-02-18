<?php

namespace PHPMaker2024\AMS;

// Page object
$MaintenanceSchedulesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_schedules: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fmaintenance_schedulesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmaintenance_schedulesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["equipment_id", [fields.equipment_id.visible && fields.equipment_id.required ? ew.Validators.required(fields.equipment_id.caption) : null, ew.Validators.integer], fields.equipment_id.isInvalid],
            ["maintenance_type_id", [fields.maintenance_type_id.visible && fields.maintenance_type_id.required ? ew.Validators.required(fields.maintenance_type_id.caption) : null, ew.Validators.integer], fields.maintenance_type_id.isInvalid],
            ["team_id", [fields.team_id.visible && fields.team_id.required ? ew.Validators.required(fields.team_id.caption) : null, ew.Validators.integer], fields.team_id.isInvalid],
            ["scheduled_date", [fields.scheduled_date.visible && fields.scheduled_date.required ? ew.Validators.required(fields.scheduled_date.caption) : null, ew.Validators.datetime(fields.scheduled_date.clientFormatPattern)], fields.scheduled_date.isInvalid],
            ["status_id", [fields.status_id.visible && fields.status_id.required ? ew.Validators.required(fields.status_id.caption) : null, ew.Validators.integer], fields.status_id.isInvalid],
            ["priority", [fields.priority.visible && fields.priority.required ? ew.Validators.required(fields.priority.caption) : null], fields.priority.isInvalid],
            ["estimated_duration", [fields.estimated_duration.visible && fields.estimated_duration.required ? ew.Validators.required(fields.estimated_duration.caption) : null, ew.Validators.integer], fields.estimated_duration.isInvalid],
            ["created_by", [fields.created_by.visible && fields.created_by.required ? ew.Validators.required(fields.created_by.caption) : null, ew.Validators.integer], fields.created_by.isInvalid],
            ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid],
            ["updated_by", [fields.updated_by.visible && fields.updated_by.required ? ew.Validators.required(fields.updated_by.caption) : null, ew.Validators.integer], fields.updated_by.isInvalid],
            ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(fields.updated_at.clientFormatPattern)], fields.updated_at.isInvalid],
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fmaintenance_schedulesadd" id="fmaintenance_schedulesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="maintenance_schedules">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
    <div id="r_equipment_id"<?= $Page->equipment_id->rowAttributes() ?>>
        <label id="elh_maintenance_schedules_equipment_id" for="x_equipment_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->equipment_id->caption() ?><?= $Page->equipment_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->equipment_id->cellAttributes() ?>>
<span id="el_maintenance_schedules_equipment_id">
<input type="<?= $Page->equipment_id->getInputTextType() ?>" name="x_equipment_id" id="x_equipment_id" data-table="maintenance_schedules" data-field="x_equipment_id" value="<?= $Page->equipment_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->equipment_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->equipment_id->formatPattern()) ?>"<?= $Page->equipment_id->editAttributes() ?> aria-describedby="x_equipment_id_help">
<?= $Page->equipment_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->equipment_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maintenance_type_id->Visible) { // maintenance_type_id ?>
    <div id="r_maintenance_type_id"<?= $Page->maintenance_type_id->rowAttributes() ?>>
        <label id="elh_maintenance_schedules_maintenance_type_id" for="x_maintenance_type_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maintenance_type_id->caption() ?><?= $Page->maintenance_type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->maintenance_type_id->cellAttributes() ?>>
<span id="el_maintenance_schedules_maintenance_type_id">
<input type="<?= $Page->maintenance_type_id->getInputTextType() ?>" name="x_maintenance_type_id" id="x_maintenance_type_id" data-table="maintenance_schedules" data-field="x_maintenance_type_id" value="<?= $Page->maintenance_type_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->maintenance_type_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->maintenance_type_id->formatPattern()) ?>"<?= $Page->maintenance_type_id->editAttributes() ?> aria-describedby="x_maintenance_type_id_help">
<?= $Page->maintenance_type_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maintenance_type_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->team_id->Visible) { // team_id ?>
    <div id="r_team_id"<?= $Page->team_id->rowAttributes() ?>>
        <label id="elh_maintenance_schedules_team_id" for="x_team_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->team_id->caption() ?><?= $Page->team_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->team_id->cellAttributes() ?>>
<span id="el_maintenance_schedules_team_id">
<input type="<?= $Page->team_id->getInputTextType() ?>" name="x_team_id" id="x_team_id" data-table="maintenance_schedules" data-field="x_team_id" value="<?= $Page->team_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->team_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->team_id->formatPattern()) ?>"<?= $Page->team_id->editAttributes() ?> aria-describedby="x_team_id_help">
<?= $Page->team_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->team_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->scheduled_date->Visible) { // scheduled_date ?>
    <div id="r_scheduled_date"<?= $Page->scheduled_date->rowAttributes() ?>>
        <label id="elh_maintenance_schedules_scheduled_date" for="x_scheduled_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->scheduled_date->caption() ?><?= $Page->scheduled_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->scheduled_date->cellAttributes() ?>>
<span id="el_maintenance_schedules_scheduled_date">
<input type="<?= $Page->scheduled_date->getInputTextType() ?>" name="x_scheduled_date" id="x_scheduled_date" data-table="maintenance_schedules" data-field="x_scheduled_date" value="<?= $Page->scheduled_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->scheduled_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->scheduled_date->formatPattern()) ?>"<?= $Page->scheduled_date->editAttributes() ?> aria-describedby="x_scheduled_date_help">
<?= $Page->scheduled_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->scheduled_date->getErrorMessage() ?></div>
<?php if (!$Page->scheduled_date->ReadOnly && !$Page->scheduled_date->Disabled && !isset($Page->scheduled_date->EditAttrs["readonly"]) && !isset($Page->scheduled_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmaintenance_schedulesadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmaintenance_schedulesadd", "x_scheduled_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
    <div id="r_status_id"<?= $Page->status_id->rowAttributes() ?>>
        <label id="elh_maintenance_schedules_status_id" for="x_status_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_id->caption() ?><?= $Page->status_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status_id->cellAttributes() ?>>
<span id="el_maintenance_schedules_status_id">
<input type="<?= $Page->status_id->getInputTextType() ?>" name="x_status_id" id="x_status_id" data-table="maintenance_schedules" data-field="x_status_id" value="<?= $Page->status_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->status_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->status_id->formatPattern()) ?>"<?= $Page->status_id->editAttributes() ?> aria-describedby="x_status_id_help">
<?= $Page->status_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
    <div id="r_priority"<?= $Page->priority->rowAttributes() ?>>
        <label id="elh_maintenance_schedules_priority" for="x_priority" class="<?= $Page->LeftColumnClass ?>"><?= $Page->priority->caption() ?><?= $Page->priority->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->priority->cellAttributes() ?>>
<span id="el_maintenance_schedules_priority">
<input type="<?= $Page->priority->getInputTextType() ?>" name="x_priority" id="x_priority" data-table="maintenance_schedules" data-field="x_priority" value="<?= $Page->priority->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->priority->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->priority->formatPattern()) ?>"<?= $Page->priority->editAttributes() ?> aria-describedby="x_priority_help">
<?= $Page->priority->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->priority->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->estimated_duration->Visible) { // estimated_duration ?>
    <div id="r_estimated_duration"<?= $Page->estimated_duration->rowAttributes() ?>>
        <label id="elh_maintenance_schedules_estimated_duration" for="x_estimated_duration" class="<?= $Page->LeftColumnClass ?>"><?= $Page->estimated_duration->caption() ?><?= $Page->estimated_duration->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->estimated_duration->cellAttributes() ?>>
<span id="el_maintenance_schedules_estimated_duration">
<input type="<?= $Page->estimated_duration->getInputTextType() ?>" name="x_estimated_duration" id="x_estimated_duration" data-table="maintenance_schedules" data-field="x_estimated_duration" value="<?= $Page->estimated_duration->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->estimated_duration->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->estimated_duration->formatPattern()) ?>"<?= $Page->estimated_duration->editAttributes() ?> aria-describedby="x_estimated_duration_help">
<?= $Page->estimated_duration->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->estimated_duration->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_maintenance_schedules_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_maintenance_schedules_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="maintenance_schedules" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_maintenance_schedules_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_maintenance_schedules_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="maintenance_schedules" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_at->formatPattern()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmaintenance_schedulesadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmaintenance_schedulesadd", "x_created_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
    <div id="r_updated_by"<?= $Page->updated_by->rowAttributes() ?>>
        <label id="elh_maintenance_schedules_updated_by" for="x_updated_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_by->caption() ?><?= $Page->updated_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_by->cellAttributes() ?>>
<span id="el_maintenance_schedules_updated_by">
<input type="<?= $Page->updated_by->getInputTextType() ?>" name="x_updated_by" id="x_updated_by" data-table="maintenance_schedules" data-field="x_updated_by" value="<?= $Page->updated_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->updated_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->updated_by->formatPattern()) ?>"<?= $Page->updated_by->editAttributes() ?> aria-describedby="x_updated_by_help">
<?= $Page->updated_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_maintenance_schedules_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_maintenance_schedules_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="maintenance_schedules" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->updated_at->formatPattern()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmaintenance_schedulesadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmaintenance_schedulesadd", "x_updated_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <div id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <label id="elh_maintenance_schedules_notes" for="x_notes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notes->caption() ?><?= $Page->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notes->cellAttributes() ?>>
<span id="el_maintenance_schedules_notes">
<textarea data-table="maintenance_schedules" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notes->getPlaceHolder()) ?>"<?= $Page->notes->editAttributes() ?> aria-describedby="x_notes_help"><?= $Page->notes->EditValue ?></textarea>
<?= $Page->notes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmaintenance_schedulesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmaintenance_schedulesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("maintenance_schedules");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
