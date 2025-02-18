<?php

namespace PHPMaker2024\AMS;

// Page object
$MaintenanceLogsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fmaintenance_logsedit" id="fmaintenance_logsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_logs: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fmaintenance_logsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmaintenance_logsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["log_id", [fields.log_id.visible && fields.log_id.required ? ew.Validators.required(fields.log_id.caption) : null], fields.log_id.isInvalid],
            ["schedule_id", [fields.schedule_id.visible && fields.schedule_id.required ? ew.Validators.required(fields.schedule_id.caption) : null, ew.Validators.integer], fields.schedule_id.isInvalid],
            ["start_time", [fields.start_time.visible && fields.start_time.required ? ew.Validators.required(fields.start_time.caption) : null, ew.Validators.datetime(fields.start_time.clientFormatPattern)], fields.start_time.isInvalid],
            ["end_time", [fields.end_time.visible && fields.end_time.required ? ew.Validators.required(fields.end_time.caption) : null, ew.Validators.datetime(fields.end_time.clientFormatPattern)], fields.end_time.isInvalid],
            ["performed_by", [fields.performed_by.visible && fields.performed_by.required ? ew.Validators.required(fields.performed_by.caption) : null, ew.Validators.integer], fields.performed_by.isInvalid],
            ["verified_by", [fields.verified_by.visible && fields.verified_by.required ? ew.Validators.required(fields.verified_by.caption) : null, ew.Validators.integer], fields.verified_by.isInvalid],
            ["status_id", [fields.status_id.visible && fields.status_id.required ? ew.Validators.required(fields.status_id.caption) : null, ew.Validators.integer], fields.status_id.isInvalid],
            ["next_maintenance_date", [fields.next_maintenance_date.visible && fields.next_maintenance_date.required ? ew.Validators.required(fields.next_maintenance_date.caption) : null, ew.Validators.datetime(fields.next_maintenance_date.clientFormatPattern)], fields.next_maintenance_date.isInvalid],
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="maintenance_logs">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->log_id->Visible) { // log_id ?>
    <div id="r_log_id"<?= $Page->log_id->rowAttributes() ?>>
        <label id="elh_maintenance_logs_log_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->log_id->caption() ?><?= $Page->log_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->log_id->cellAttributes() ?>>
<span id="el_maintenance_logs_log_id">
<span<?= $Page->log_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->log_id->getDisplayValue($Page->log_id->EditValue))) ?>"></span>
<input type="hidden" data-table="maintenance_logs" data-field="x_log_id" data-hidden="1" name="x_log_id" id="x_log_id" value="<?= HtmlEncode($Page->log_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->schedule_id->Visible) { // schedule_id ?>
    <div id="r_schedule_id"<?= $Page->schedule_id->rowAttributes() ?>>
        <label id="elh_maintenance_logs_schedule_id" for="x_schedule_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->schedule_id->caption() ?><?= $Page->schedule_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->schedule_id->cellAttributes() ?>>
<span id="el_maintenance_logs_schedule_id">
<input type="<?= $Page->schedule_id->getInputTextType() ?>" name="x_schedule_id" id="x_schedule_id" data-table="maintenance_logs" data-field="x_schedule_id" value="<?= $Page->schedule_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->schedule_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->schedule_id->formatPattern()) ?>"<?= $Page->schedule_id->editAttributes() ?> aria-describedby="x_schedule_id_help">
<?= $Page->schedule_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->schedule_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->start_time->Visible) { // start_time ?>
    <div id="r_start_time"<?= $Page->start_time->rowAttributes() ?>>
        <label id="elh_maintenance_logs_start_time" for="x_start_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->start_time->caption() ?><?= $Page->start_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->start_time->cellAttributes() ?>>
<span id="el_maintenance_logs_start_time">
<input type="<?= $Page->start_time->getInputTextType() ?>" name="x_start_time" id="x_start_time" data-table="maintenance_logs" data-field="x_start_time" value="<?= $Page->start_time->EditValue ?>" placeholder="<?= HtmlEncode($Page->start_time->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->start_time->formatPattern()) ?>"<?= $Page->start_time->editAttributes() ?> aria-describedby="x_start_time_help">
<?= $Page->start_time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->start_time->getErrorMessage() ?></div>
<?php if (!$Page->start_time->ReadOnly && !$Page->start_time->Disabled && !isset($Page->start_time->EditAttrs["readonly"]) && !isset($Page->start_time->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmaintenance_logsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmaintenance_logsedit", "x_start_time", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->end_time->Visible) { // end_time ?>
    <div id="r_end_time"<?= $Page->end_time->rowAttributes() ?>>
        <label id="elh_maintenance_logs_end_time" for="x_end_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->end_time->caption() ?><?= $Page->end_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->end_time->cellAttributes() ?>>
<span id="el_maintenance_logs_end_time">
<input type="<?= $Page->end_time->getInputTextType() ?>" name="x_end_time" id="x_end_time" data-table="maintenance_logs" data-field="x_end_time" value="<?= $Page->end_time->EditValue ?>" placeholder="<?= HtmlEncode($Page->end_time->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->end_time->formatPattern()) ?>"<?= $Page->end_time->editAttributes() ?> aria-describedby="x_end_time_help">
<?= $Page->end_time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->end_time->getErrorMessage() ?></div>
<?php if (!$Page->end_time->ReadOnly && !$Page->end_time->Disabled && !isset($Page->end_time->EditAttrs["readonly"]) && !isset($Page->end_time->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmaintenance_logsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmaintenance_logsedit", "x_end_time", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->performed_by->Visible) { // performed_by ?>
    <div id="r_performed_by"<?= $Page->performed_by->rowAttributes() ?>>
        <label id="elh_maintenance_logs_performed_by" for="x_performed_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->performed_by->caption() ?><?= $Page->performed_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->performed_by->cellAttributes() ?>>
<span id="el_maintenance_logs_performed_by">
<input type="<?= $Page->performed_by->getInputTextType() ?>" name="x_performed_by" id="x_performed_by" data-table="maintenance_logs" data-field="x_performed_by" value="<?= $Page->performed_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->performed_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->performed_by->formatPattern()) ?>"<?= $Page->performed_by->editAttributes() ?> aria-describedby="x_performed_by_help">
<?= $Page->performed_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->performed_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->verified_by->Visible) { // verified_by ?>
    <div id="r_verified_by"<?= $Page->verified_by->rowAttributes() ?>>
        <label id="elh_maintenance_logs_verified_by" for="x_verified_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->verified_by->caption() ?><?= $Page->verified_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->verified_by->cellAttributes() ?>>
<span id="el_maintenance_logs_verified_by">
<input type="<?= $Page->verified_by->getInputTextType() ?>" name="x_verified_by" id="x_verified_by" data-table="maintenance_logs" data-field="x_verified_by" value="<?= $Page->verified_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->verified_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->verified_by->formatPattern()) ?>"<?= $Page->verified_by->editAttributes() ?> aria-describedby="x_verified_by_help">
<?= $Page->verified_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->verified_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
    <div id="r_status_id"<?= $Page->status_id->rowAttributes() ?>>
        <label id="elh_maintenance_logs_status_id" for="x_status_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_id->caption() ?><?= $Page->status_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status_id->cellAttributes() ?>>
<span id="el_maintenance_logs_status_id">
<input type="<?= $Page->status_id->getInputTextType() ?>" name="x_status_id" id="x_status_id" data-table="maintenance_logs" data-field="x_status_id" value="<?= $Page->status_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->status_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->status_id->formatPattern()) ?>"<?= $Page->status_id->editAttributes() ?> aria-describedby="x_status_id_help">
<?= $Page->status_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->next_maintenance_date->Visible) { // next_maintenance_date ?>
    <div id="r_next_maintenance_date"<?= $Page->next_maintenance_date->rowAttributes() ?>>
        <label id="elh_maintenance_logs_next_maintenance_date" for="x_next_maintenance_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->next_maintenance_date->caption() ?><?= $Page->next_maintenance_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->next_maintenance_date->cellAttributes() ?>>
<span id="el_maintenance_logs_next_maintenance_date">
<input type="<?= $Page->next_maintenance_date->getInputTextType() ?>" name="x_next_maintenance_date" id="x_next_maintenance_date" data-table="maintenance_logs" data-field="x_next_maintenance_date" value="<?= $Page->next_maintenance_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->next_maintenance_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->next_maintenance_date->formatPattern()) ?>"<?= $Page->next_maintenance_date->editAttributes() ?> aria-describedby="x_next_maintenance_date_help">
<?= $Page->next_maintenance_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->next_maintenance_date->getErrorMessage() ?></div>
<?php if (!$Page->next_maintenance_date->ReadOnly && !$Page->next_maintenance_date->Disabled && !isset($Page->next_maintenance_date->EditAttrs["readonly"]) && !isset($Page->next_maintenance_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmaintenance_logsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmaintenance_logsedit", "x_next_maintenance_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_maintenance_logs_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_maintenance_logs_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="maintenance_logs" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_maintenance_logs_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_maintenance_logs_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="maintenance_logs" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_at->formatPattern()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmaintenance_logsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmaintenance_logsedit", "x_created_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
    <div id="r_updated_by"<?= $Page->updated_by->rowAttributes() ?>>
        <label id="elh_maintenance_logs_updated_by" for="x_updated_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_by->caption() ?><?= $Page->updated_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_by->cellAttributes() ?>>
<span id="el_maintenance_logs_updated_by">
<input type="<?= $Page->updated_by->getInputTextType() ?>" name="x_updated_by" id="x_updated_by" data-table="maintenance_logs" data-field="x_updated_by" value="<?= $Page->updated_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->updated_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->updated_by->formatPattern()) ?>"<?= $Page->updated_by->editAttributes() ?> aria-describedby="x_updated_by_help">
<?= $Page->updated_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_maintenance_logs_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_maintenance_logs_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="maintenance_logs" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->updated_at->formatPattern()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmaintenance_logsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmaintenance_logsedit", "x_updated_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <div id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <label id="elh_maintenance_logs_notes" for="x_notes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notes->caption() ?><?= $Page->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notes->cellAttributes() ?>>
<span id="el_maintenance_logs_notes">
<textarea data-table="maintenance_logs" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notes->getPlaceHolder()) ?>"<?= $Page->notes->editAttributes() ?> aria-describedby="x_notes_help"><?= $Page->notes->EditValue ?></textarea>
<?= $Page->notes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmaintenance_logsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmaintenance_logsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("maintenance_logs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
