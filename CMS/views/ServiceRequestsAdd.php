<?php

namespace PHPMaker2024\CMS;

// Page object
$ServiceRequestsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { service_requests: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fservice_requestsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fservice_requestsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["client_id", [fields.client_id.visible && fields.client_id.required ? ew.Validators.required(fields.client_id.caption) : null, ew.Validators.integer], fields.client_id.isInvalid],
            ["equipment_id", [fields.equipment_id.visible && fields.equipment_id.required ? ew.Validators.required(fields.equipment_id.caption) : null, ew.Validators.integer], fields.equipment_id.isInvalid],
            ["request_type", [fields.request_type.visible && fields.request_type.required ? ew.Validators.required(fields.request_type.caption) : null], fields.request_type.isInvalid],
            ["priority", [fields.priority.visible && fields.priority.required ? ew.Validators.required(fields.priority.caption) : null], fields.priority.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["requested_by", [fields.requested_by.visible && fields.requested_by.required ? ew.Validators.required(fields.requested_by.caption) : null, ew.Validators.integer], fields.requested_by.isInvalid],
            ["requested_date", [fields.requested_date.visible && fields.requested_date.required ? ew.Validators.required(fields.requested_date.caption) : null, ew.Validators.datetime(fields.requested_date.clientFormatPattern)], fields.requested_date.isInvalid],
            ["scheduled_date", [fields.scheduled_date.visible && fields.scheduled_date.required ? ew.Validators.required(fields.scheduled_date.caption) : null, ew.Validators.datetime(fields.scheduled_date.clientFormatPattern)], fields.scheduled_date.isInvalid],
            ["completion_date", [fields.completion_date.visible && fields.completion_date.required ? ew.Validators.required(fields.completion_date.caption) : null, ew.Validators.datetime(fields.completion_date.clientFormatPattern)], fields.completion_date.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["assigned_to", [fields.assigned_to.visible && fields.assigned_to.required ? ew.Validators.required(fields.assigned_to.caption) : null, ew.Validators.integer], fields.assigned_to.isInvalid],
            ["resolution", [fields.resolution.visible && fields.resolution.required ? ew.Validators.required(fields.resolution.caption) : null], fields.resolution.isInvalid],
            ["response_time_minutes", [fields.response_time_minutes.visible && fields.response_time_minutes.required ? ew.Validators.required(fields.response_time_minutes.caption) : null, ew.Validators.integer], fields.response_time_minutes.isInvalid],
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
<form name="fservice_requestsadd" id="fservice_requestsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="service_requests">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->client_id->Visible) { // client_id ?>
    <div id="r_client_id"<?= $Page->client_id->rowAttributes() ?>>
        <label id="elh_service_requests_client_id" for="x_client_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->client_id->caption() ?><?= $Page->client_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->client_id->cellAttributes() ?>>
<span id="el_service_requests_client_id">
<input type="<?= $Page->client_id->getInputTextType() ?>" name="x_client_id" id="x_client_id" data-table="service_requests" data-field="x_client_id" value="<?= $Page->client_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->client_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->client_id->formatPattern()) ?>"<?= $Page->client_id->editAttributes() ?> aria-describedby="x_client_id_help">
<?= $Page->client_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->client_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
    <div id="r_equipment_id"<?= $Page->equipment_id->rowAttributes() ?>>
        <label id="elh_service_requests_equipment_id" for="x_equipment_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->equipment_id->caption() ?><?= $Page->equipment_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->equipment_id->cellAttributes() ?>>
<span id="el_service_requests_equipment_id">
<input type="<?= $Page->equipment_id->getInputTextType() ?>" name="x_equipment_id" id="x_equipment_id" data-table="service_requests" data-field="x_equipment_id" value="<?= $Page->equipment_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->equipment_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->equipment_id->formatPattern()) ?>"<?= $Page->equipment_id->editAttributes() ?> aria-describedby="x_equipment_id_help">
<?= $Page->equipment_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->equipment_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->request_type->Visible) { // request_type ?>
    <div id="r_request_type"<?= $Page->request_type->rowAttributes() ?>>
        <label id="elh_service_requests_request_type" for="x_request_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->request_type->caption() ?><?= $Page->request_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->request_type->cellAttributes() ?>>
<span id="el_service_requests_request_type">
<input type="<?= $Page->request_type->getInputTextType() ?>" name="x_request_type" id="x_request_type" data-table="service_requests" data-field="x_request_type" value="<?= $Page->request_type->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->request_type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->request_type->formatPattern()) ?>"<?= $Page->request_type->editAttributes() ?> aria-describedby="x_request_type_help">
<?= $Page->request_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->request_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
    <div id="r_priority"<?= $Page->priority->rowAttributes() ?>>
        <label id="elh_service_requests_priority" for="x_priority" class="<?= $Page->LeftColumnClass ?>"><?= $Page->priority->caption() ?><?= $Page->priority->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->priority->cellAttributes() ?>>
<span id="el_service_requests_priority">
<input type="<?= $Page->priority->getInputTextType() ?>" name="x_priority" id="x_priority" data-table="service_requests" data-field="x_priority" value="<?= $Page->priority->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->priority->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->priority->formatPattern()) ?>"<?= $Page->priority->editAttributes() ?> aria-describedby="x_priority_help">
<?= $Page->priority->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->priority->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_service_requests_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_service_requests_description">
<textarea data-table="service_requests" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->requested_by->Visible) { // requested_by ?>
    <div id="r_requested_by"<?= $Page->requested_by->rowAttributes() ?>>
        <label id="elh_service_requests_requested_by" for="x_requested_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->requested_by->caption() ?><?= $Page->requested_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->requested_by->cellAttributes() ?>>
<span id="el_service_requests_requested_by">
<input type="<?= $Page->requested_by->getInputTextType() ?>" name="x_requested_by" id="x_requested_by" data-table="service_requests" data-field="x_requested_by" value="<?= $Page->requested_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->requested_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->requested_by->formatPattern()) ?>"<?= $Page->requested_by->editAttributes() ?> aria-describedby="x_requested_by_help">
<?= $Page->requested_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->requested_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->requested_date->Visible) { // requested_date ?>
    <div id="r_requested_date"<?= $Page->requested_date->rowAttributes() ?>>
        <label id="elh_service_requests_requested_date" for="x_requested_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->requested_date->caption() ?><?= $Page->requested_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->requested_date->cellAttributes() ?>>
<span id="el_service_requests_requested_date">
<input type="<?= $Page->requested_date->getInputTextType() ?>" name="x_requested_date" id="x_requested_date" data-table="service_requests" data-field="x_requested_date" value="<?= $Page->requested_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->requested_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->requested_date->formatPattern()) ?>"<?= $Page->requested_date->editAttributes() ?> aria-describedby="x_requested_date_help">
<?= $Page->requested_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->requested_date->getErrorMessage() ?></div>
<?php if (!$Page->requested_date->ReadOnly && !$Page->requested_date->Disabled && !isset($Page->requested_date->EditAttrs["readonly"]) && !isset($Page->requested_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fservice_requestsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fservice_requestsadd", "x_requested_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->scheduled_date->Visible) { // scheduled_date ?>
    <div id="r_scheduled_date"<?= $Page->scheduled_date->rowAttributes() ?>>
        <label id="elh_service_requests_scheduled_date" for="x_scheduled_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->scheduled_date->caption() ?><?= $Page->scheduled_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->scheduled_date->cellAttributes() ?>>
<span id="el_service_requests_scheduled_date">
<input type="<?= $Page->scheduled_date->getInputTextType() ?>" name="x_scheduled_date" id="x_scheduled_date" data-table="service_requests" data-field="x_scheduled_date" value="<?= $Page->scheduled_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->scheduled_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->scheduled_date->formatPattern()) ?>"<?= $Page->scheduled_date->editAttributes() ?> aria-describedby="x_scheduled_date_help">
<?= $Page->scheduled_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->scheduled_date->getErrorMessage() ?></div>
<?php if (!$Page->scheduled_date->ReadOnly && !$Page->scheduled_date->Disabled && !isset($Page->scheduled_date->EditAttrs["readonly"]) && !isset($Page->scheduled_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fservice_requestsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fservice_requestsadd", "x_scheduled_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->completion_date->Visible) { // completion_date ?>
    <div id="r_completion_date"<?= $Page->completion_date->rowAttributes() ?>>
        <label id="elh_service_requests_completion_date" for="x_completion_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->completion_date->caption() ?><?= $Page->completion_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->completion_date->cellAttributes() ?>>
<span id="el_service_requests_completion_date">
<input type="<?= $Page->completion_date->getInputTextType() ?>" name="x_completion_date" id="x_completion_date" data-table="service_requests" data-field="x_completion_date" value="<?= $Page->completion_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->completion_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->completion_date->formatPattern()) ?>"<?= $Page->completion_date->editAttributes() ?> aria-describedby="x_completion_date_help">
<?= $Page->completion_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->completion_date->getErrorMessage() ?></div>
<?php if (!$Page->completion_date->ReadOnly && !$Page->completion_date->Disabled && !isset($Page->completion_date->EditAttrs["readonly"]) && !isset($Page->completion_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fservice_requestsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fservice_requestsadd", "x_completion_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_service_requests_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_service_requests_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="service_requests" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->status->formatPattern()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->assigned_to->Visible) { // assigned_to ?>
    <div id="r_assigned_to"<?= $Page->assigned_to->rowAttributes() ?>>
        <label id="elh_service_requests_assigned_to" for="x_assigned_to" class="<?= $Page->LeftColumnClass ?>"><?= $Page->assigned_to->caption() ?><?= $Page->assigned_to->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->assigned_to->cellAttributes() ?>>
<span id="el_service_requests_assigned_to">
<input type="<?= $Page->assigned_to->getInputTextType() ?>" name="x_assigned_to" id="x_assigned_to" data-table="service_requests" data-field="x_assigned_to" value="<?= $Page->assigned_to->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->assigned_to->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->assigned_to->formatPattern()) ?>"<?= $Page->assigned_to->editAttributes() ?> aria-describedby="x_assigned_to_help">
<?= $Page->assigned_to->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->assigned_to->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->resolution->Visible) { // resolution ?>
    <div id="r_resolution"<?= $Page->resolution->rowAttributes() ?>>
        <label id="elh_service_requests_resolution" for="x_resolution" class="<?= $Page->LeftColumnClass ?>"><?= $Page->resolution->caption() ?><?= $Page->resolution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->resolution->cellAttributes() ?>>
<span id="el_service_requests_resolution">
<textarea data-table="service_requests" data-field="x_resolution" name="x_resolution" id="x_resolution" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->resolution->getPlaceHolder()) ?>"<?= $Page->resolution->editAttributes() ?> aria-describedby="x_resolution_help"><?= $Page->resolution->EditValue ?></textarea>
<?= $Page->resolution->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->resolution->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->response_time_minutes->Visible) { // response_time_minutes ?>
    <div id="r_response_time_minutes"<?= $Page->response_time_minutes->rowAttributes() ?>>
        <label id="elh_service_requests_response_time_minutes" for="x_response_time_minutes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->response_time_minutes->caption() ?><?= $Page->response_time_minutes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->response_time_minutes->cellAttributes() ?>>
<span id="el_service_requests_response_time_minutes">
<input type="<?= $Page->response_time_minutes->getInputTextType() ?>" name="x_response_time_minutes" id="x_response_time_minutes" data-table="service_requests" data-field="x_response_time_minutes" value="<?= $Page->response_time_minutes->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->response_time_minutes->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->response_time_minutes->formatPattern()) ?>"<?= $Page->response_time_minutes->editAttributes() ?> aria-describedby="x_response_time_minutes_help">
<?= $Page->response_time_minutes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->response_time_minutes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <div id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <label id="elh_service_requests_notes" for="x_notes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notes->caption() ?><?= $Page->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notes->cellAttributes() ?>>
<span id="el_service_requests_notes">
<textarea data-table="service_requests" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notes->getPlaceHolder()) ?>"<?= $Page->notes->editAttributes() ?> aria-describedby="x_notes_help"><?= $Page->notes->EditValue ?></textarea>
<?= $Page->notes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fservice_requestsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fservice_requestsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("service_requests");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
