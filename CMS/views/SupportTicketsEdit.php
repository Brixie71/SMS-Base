<?php

namespace PHPMaker2024\CMS;

// Page object
$SupportTicketsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fsupport_ticketsedit" id="fsupport_ticketsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { support_tickets: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fsupport_ticketsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsupport_ticketsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["ticket_id", [fields.ticket_id.visible && fields.ticket_id.required ? ew.Validators.required(fields.ticket_id.caption) : null], fields.ticket_id.isInvalid],
            ["client_id", [fields.client_id.visible && fields.client_id.required ? ew.Validators.required(fields.client_id.caption) : null, ew.Validators.integer], fields.client_id.isInvalid],
            ["equipment_id", [fields.equipment_id.visible && fields.equipment_id.required ? ew.Validators.required(fields.equipment_id.caption) : null, ew.Validators.integer], fields.equipment_id.isInvalid],
            ["subject", [fields.subject.visible && fields.subject.required ? ew.Validators.required(fields.subject.caption) : null], fields.subject.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["priority", [fields.priority.visible && fields.priority.required ? ew.Validators.required(fields.priority.caption) : null], fields.priority.isInvalid],
            ["category", [fields.category.visible && fields.category.required ? ew.Validators.required(fields.category.caption) : null], fields.category.isInvalid],
            ["submitted_by", [fields.submitted_by.visible && fields.submitted_by.required ? ew.Validators.required(fields.submitted_by.caption) : null, ew.Validators.integer], fields.submitted_by.isInvalid],
            ["assigned_to", [fields.assigned_to.visible && fields.assigned_to.required ? ew.Validators.required(fields.assigned_to.caption) : null, ew.Validators.integer], fields.assigned_to.isInvalid],
            ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["resolution", [fields.resolution.visible && fields.resolution.required ? ew.Validators.required(fields.resolution.caption) : null], fields.resolution.isInvalid],
            ["closed_at", [fields.closed_at.visible && fields.closed_at.required ? ew.Validators.required(fields.closed_at.caption) : null, ew.Validators.datetime(fields.closed_at.clientFormatPattern)], fields.closed_at.isInvalid],
            ["response_time_minutes", [fields.response_time_minutes.visible && fields.response_time_minutes.required ? ew.Validators.required(fields.response_time_minutes.caption) : null, ew.Validators.integer], fields.response_time_minutes.isInvalid],
            ["resolution_time_minutes", [fields.resolution_time_minutes.visible && fields.resolution_time_minutes.required ? ew.Validators.required(fields.resolution_time_minutes.caption) : null, ew.Validators.integer], fields.resolution_time_minutes.isInvalid],
            ["sla_compliant", [fields.sla_compliant.visible && fields.sla_compliant.required ? ew.Validators.required(fields.sla_compliant.caption) : null], fields.sla_compliant.isInvalid],
            ["closed_by", [fields.closed_by.visible && fields.closed_by.required ? ew.Validators.required(fields.closed_by.caption) : null, ew.Validators.integer], fields.closed_by.isInvalid]
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
            "sla_compliant": <?= $Page->sla_compliant->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="support_tickets">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->ticket_id->Visible) { // ticket_id ?>
    <div id="r_ticket_id"<?= $Page->ticket_id->rowAttributes() ?>>
        <label id="elh_support_tickets_ticket_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ticket_id->caption() ?><?= $Page->ticket_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ticket_id->cellAttributes() ?>>
<span id="el_support_tickets_ticket_id">
<span<?= $Page->ticket_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->ticket_id->getDisplayValue($Page->ticket_id->EditValue))) ?>"></span>
<input type="hidden" data-table="support_tickets" data-field="x_ticket_id" data-hidden="1" name="x_ticket_id" id="x_ticket_id" value="<?= HtmlEncode($Page->ticket_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
    <div id="r_client_id"<?= $Page->client_id->rowAttributes() ?>>
        <label id="elh_support_tickets_client_id" for="x_client_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->client_id->caption() ?><?= $Page->client_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->client_id->cellAttributes() ?>>
<span id="el_support_tickets_client_id">
<input type="<?= $Page->client_id->getInputTextType() ?>" name="x_client_id" id="x_client_id" data-table="support_tickets" data-field="x_client_id" value="<?= $Page->client_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->client_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->client_id->formatPattern()) ?>"<?= $Page->client_id->editAttributes() ?> aria-describedby="x_client_id_help">
<?= $Page->client_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->client_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
    <div id="r_equipment_id"<?= $Page->equipment_id->rowAttributes() ?>>
        <label id="elh_support_tickets_equipment_id" for="x_equipment_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->equipment_id->caption() ?><?= $Page->equipment_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->equipment_id->cellAttributes() ?>>
<span id="el_support_tickets_equipment_id">
<input type="<?= $Page->equipment_id->getInputTextType() ?>" name="x_equipment_id" id="x_equipment_id" data-table="support_tickets" data-field="x_equipment_id" value="<?= $Page->equipment_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->equipment_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->equipment_id->formatPattern()) ?>"<?= $Page->equipment_id->editAttributes() ?> aria-describedby="x_equipment_id_help">
<?= $Page->equipment_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->equipment_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->subject->Visible) { // subject ?>
    <div id="r_subject"<?= $Page->subject->rowAttributes() ?>>
        <label id="elh_support_tickets_subject" for="x_subject" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subject->caption() ?><?= $Page->subject->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->subject->cellAttributes() ?>>
<span id="el_support_tickets_subject">
<input type="<?= $Page->subject->getInputTextType() ?>" name="x_subject" id="x_subject" data-table="support_tickets" data-field="x_subject" value="<?= $Page->subject->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->subject->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->subject->formatPattern()) ?>"<?= $Page->subject->editAttributes() ?> aria-describedby="x_subject_help">
<?= $Page->subject->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->subject->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_support_tickets_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_support_tickets_description">
<textarea data-table="support_tickets" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
    <div id="r_priority"<?= $Page->priority->rowAttributes() ?>>
        <label id="elh_support_tickets_priority" for="x_priority" class="<?= $Page->LeftColumnClass ?>"><?= $Page->priority->caption() ?><?= $Page->priority->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->priority->cellAttributes() ?>>
<span id="el_support_tickets_priority">
<input type="<?= $Page->priority->getInputTextType() ?>" name="x_priority" id="x_priority" data-table="support_tickets" data-field="x_priority" value="<?= $Page->priority->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->priority->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->priority->formatPattern()) ?>"<?= $Page->priority->editAttributes() ?> aria-describedby="x_priority_help">
<?= $Page->priority->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->priority->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category->Visible) { // category ?>
    <div id="r_category"<?= $Page->category->rowAttributes() ?>>
        <label id="elh_support_tickets_category" for="x_category" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category->caption() ?><?= $Page->category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category->cellAttributes() ?>>
<span id="el_support_tickets_category">
<input type="<?= $Page->category->getInputTextType() ?>" name="x_category" id="x_category" data-table="support_tickets" data-field="x_category" value="<?= $Page->category->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->category->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->category->formatPattern()) ?>"<?= $Page->category->editAttributes() ?> aria-describedby="x_category_help">
<?= $Page->category->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->category->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->submitted_by->Visible) { // submitted_by ?>
    <div id="r_submitted_by"<?= $Page->submitted_by->rowAttributes() ?>>
        <label id="elh_support_tickets_submitted_by" for="x_submitted_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->submitted_by->caption() ?><?= $Page->submitted_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->submitted_by->cellAttributes() ?>>
<span id="el_support_tickets_submitted_by">
<input type="<?= $Page->submitted_by->getInputTextType() ?>" name="x_submitted_by" id="x_submitted_by" data-table="support_tickets" data-field="x_submitted_by" value="<?= $Page->submitted_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->submitted_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->submitted_by->formatPattern()) ?>"<?= $Page->submitted_by->editAttributes() ?> aria-describedby="x_submitted_by_help">
<?= $Page->submitted_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->submitted_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->assigned_to->Visible) { // assigned_to ?>
    <div id="r_assigned_to"<?= $Page->assigned_to->rowAttributes() ?>>
        <label id="elh_support_tickets_assigned_to" for="x_assigned_to" class="<?= $Page->LeftColumnClass ?>"><?= $Page->assigned_to->caption() ?><?= $Page->assigned_to->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->assigned_to->cellAttributes() ?>>
<span id="el_support_tickets_assigned_to">
<input type="<?= $Page->assigned_to->getInputTextType() ?>" name="x_assigned_to" id="x_assigned_to" data-table="support_tickets" data-field="x_assigned_to" value="<?= $Page->assigned_to->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->assigned_to->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->assigned_to->formatPattern()) ?>"<?= $Page->assigned_to->editAttributes() ?> aria-describedby="x_assigned_to_help">
<?= $Page->assigned_to->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->assigned_to->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_support_tickets_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_support_tickets_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="support_tickets" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_at->formatPattern()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsupport_ticketsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fsupport_ticketsedit", "x_created_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_support_tickets_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_support_tickets_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="support_tickets" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->status->formatPattern()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->resolution->Visible) { // resolution ?>
    <div id="r_resolution"<?= $Page->resolution->rowAttributes() ?>>
        <label id="elh_support_tickets_resolution" for="x_resolution" class="<?= $Page->LeftColumnClass ?>"><?= $Page->resolution->caption() ?><?= $Page->resolution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->resolution->cellAttributes() ?>>
<span id="el_support_tickets_resolution">
<textarea data-table="support_tickets" data-field="x_resolution" name="x_resolution" id="x_resolution" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->resolution->getPlaceHolder()) ?>"<?= $Page->resolution->editAttributes() ?> aria-describedby="x_resolution_help"><?= $Page->resolution->EditValue ?></textarea>
<?= $Page->resolution->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->resolution->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closed_at->Visible) { // closed_at ?>
    <div id="r_closed_at"<?= $Page->closed_at->rowAttributes() ?>>
        <label id="elh_support_tickets_closed_at" for="x_closed_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closed_at->caption() ?><?= $Page->closed_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->closed_at->cellAttributes() ?>>
<span id="el_support_tickets_closed_at">
<input type="<?= $Page->closed_at->getInputTextType() ?>" name="x_closed_at" id="x_closed_at" data-table="support_tickets" data-field="x_closed_at" value="<?= $Page->closed_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->closed_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->closed_at->formatPattern()) ?>"<?= $Page->closed_at->editAttributes() ?> aria-describedby="x_closed_at_help">
<?= $Page->closed_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closed_at->getErrorMessage() ?></div>
<?php if (!$Page->closed_at->ReadOnly && !$Page->closed_at->Disabled && !isset($Page->closed_at->EditAttrs["readonly"]) && !isset($Page->closed_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsupport_ticketsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fsupport_ticketsedit", "x_closed_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->response_time_minutes->Visible) { // response_time_minutes ?>
    <div id="r_response_time_minutes"<?= $Page->response_time_minutes->rowAttributes() ?>>
        <label id="elh_support_tickets_response_time_minutes" for="x_response_time_minutes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->response_time_minutes->caption() ?><?= $Page->response_time_minutes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->response_time_minutes->cellAttributes() ?>>
<span id="el_support_tickets_response_time_minutes">
<input type="<?= $Page->response_time_minutes->getInputTextType() ?>" name="x_response_time_minutes" id="x_response_time_minutes" data-table="support_tickets" data-field="x_response_time_minutes" value="<?= $Page->response_time_minutes->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->response_time_minutes->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->response_time_minutes->formatPattern()) ?>"<?= $Page->response_time_minutes->editAttributes() ?> aria-describedby="x_response_time_minutes_help">
<?= $Page->response_time_minutes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->response_time_minutes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->resolution_time_minutes->Visible) { // resolution_time_minutes ?>
    <div id="r_resolution_time_minutes"<?= $Page->resolution_time_minutes->rowAttributes() ?>>
        <label id="elh_support_tickets_resolution_time_minutes" for="x_resolution_time_minutes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->resolution_time_minutes->caption() ?><?= $Page->resolution_time_minutes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->resolution_time_minutes->cellAttributes() ?>>
<span id="el_support_tickets_resolution_time_minutes">
<input type="<?= $Page->resolution_time_minutes->getInputTextType() ?>" name="x_resolution_time_minutes" id="x_resolution_time_minutes" data-table="support_tickets" data-field="x_resolution_time_minutes" value="<?= $Page->resolution_time_minutes->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->resolution_time_minutes->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->resolution_time_minutes->formatPattern()) ?>"<?= $Page->resolution_time_minutes->editAttributes() ?> aria-describedby="x_resolution_time_minutes_help">
<?= $Page->resolution_time_minutes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->resolution_time_minutes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sla_compliant->Visible) { // sla_compliant ?>
    <div id="r_sla_compliant"<?= $Page->sla_compliant->rowAttributes() ?>>
        <label id="elh_support_tickets_sla_compliant" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sla_compliant->caption() ?><?= $Page->sla_compliant->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sla_compliant->cellAttributes() ?>>
<span id="el_support_tickets_sla_compliant">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->sla_compliant->isInvalidClass() ?>" data-table="support_tickets" data-field="x_sla_compliant" data-boolean name="x_sla_compliant" id="x_sla_compliant" value="1"<?= ConvertToBool($Page->sla_compliant->CurrentValue) ? " checked" : "" ?><?= $Page->sla_compliant->editAttributes() ?> aria-describedby="x_sla_compliant_help">
    <div class="invalid-feedback"><?= $Page->sla_compliant->getErrorMessage() ?></div>
</div>
<?= $Page->sla_compliant->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->closed_by->Visible) { // closed_by ?>
    <div id="r_closed_by"<?= $Page->closed_by->rowAttributes() ?>>
        <label id="elh_support_tickets_closed_by" for="x_closed_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->closed_by->caption() ?><?= $Page->closed_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->closed_by->cellAttributes() ?>>
<span id="el_support_tickets_closed_by">
<input type="<?= $Page->closed_by->getInputTextType() ?>" name="x_closed_by" id="x_closed_by" data-table="support_tickets" data-field="x_closed_by" value="<?= $Page->closed_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->closed_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->closed_by->formatPattern()) ?>"<?= $Page->closed_by->editAttributes() ?> aria-describedby="x_closed_by_help">
<?= $Page->closed_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->closed_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fsupport_ticketsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fsupport_ticketsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("support_tickets");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
