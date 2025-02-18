<?php

namespace PHPMaker2024\CMS;

// Page object
$ClientsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { clients: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fclientsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fclientsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["client_code", [fields.client_code.visible && fields.client_code.required ? ew.Validators.required(fields.client_code.caption) : null], fields.client_code.isInvalid],
            ["company_name", [fields.company_name.visible && fields.company_name.required ? ew.Validators.required(fields.company_name.caption) : null], fields.company_name.isInvalid],
            ["type_id", [fields.type_id.visible && fields.type_id.required ? ew.Validators.required(fields.type_id.caption) : null, ew.Validators.integer], fields.type_id.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["account_manager_id", [fields.account_manager_id.visible && fields.account_manager_id.required ? ew.Validators.required(fields.account_manager_id.caption) : null, ew.Validators.integer], fields.account_manager_id.isInvalid],
            ["registration_date", [fields.registration_date.visible && fields.registration_date.required ? ew.Validators.required(fields.registration_date.caption) : null, ew.Validators.datetime(fields.registration_date.clientFormatPattern)], fields.registration_date.isInvalid],
            ["website", [fields.website.visible && fields.website.required ? ew.Validators.required(fields.website.caption) : null], fields.website.isInvalid],
            ["notes", [fields.notes.visible && fields.notes.required ? ew.Validators.required(fields.notes.caption) : null], fields.notes.isInvalid],
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fclientsadd" id="fclientsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="clients">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->client_code->Visible) { // client_code ?>
    <div id="r_client_code"<?= $Page->client_code->rowAttributes() ?>>
        <label id="elh_clients_client_code" for="x_client_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->client_code->caption() ?><?= $Page->client_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->client_code->cellAttributes() ?>>
<span id="el_clients_client_code">
<input type="<?= $Page->client_code->getInputTextType() ?>" name="x_client_code" id="x_client_code" data-table="clients" data-field="x_client_code" value="<?= $Page->client_code->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->client_code->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->client_code->formatPattern()) ?>"<?= $Page->client_code->editAttributes() ?> aria-describedby="x_client_code_help">
<?= $Page->client_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->client_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->company_name->Visible) { // company_name ?>
    <div id="r_company_name"<?= $Page->company_name->rowAttributes() ?>>
        <label id="elh_clients_company_name" for="x_company_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->company_name->caption() ?><?= $Page->company_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->company_name->cellAttributes() ?>>
<span id="el_clients_company_name">
<input type="<?= $Page->company_name->getInputTextType() ?>" name="x_company_name" id="x_company_name" data-table="clients" data-field="x_company_name" value="<?= $Page->company_name->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->company_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->company_name->formatPattern()) ?>"<?= $Page->company_name->editAttributes() ?> aria-describedby="x_company_name_help">
<?= $Page->company_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->company_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->type_id->Visible) { // type_id ?>
    <div id="r_type_id"<?= $Page->type_id->rowAttributes() ?>>
        <label id="elh_clients_type_id" for="x_type_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type_id->caption() ?><?= $Page->type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->type_id->cellAttributes() ?>>
<span id="el_clients_type_id">
<input type="<?= $Page->type_id->getInputTextType() ?>" name="x_type_id" id="x_type_id" data-table="clients" data-field="x_type_id" value="<?= $Page->type_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->type_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->type_id->formatPattern()) ?>"<?= $Page->type_id->editAttributes() ?> aria-describedby="x_type_id_help">
<?= $Page->type_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->type_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_clients_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_clients_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="clients" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->status->formatPattern()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->account_manager_id->Visible) { // account_manager_id ?>
    <div id="r_account_manager_id"<?= $Page->account_manager_id->rowAttributes() ?>>
        <label id="elh_clients_account_manager_id" for="x_account_manager_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->account_manager_id->caption() ?><?= $Page->account_manager_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->account_manager_id->cellAttributes() ?>>
<span id="el_clients_account_manager_id">
<input type="<?= $Page->account_manager_id->getInputTextType() ?>" name="x_account_manager_id" id="x_account_manager_id" data-table="clients" data-field="x_account_manager_id" value="<?= $Page->account_manager_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->account_manager_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->account_manager_id->formatPattern()) ?>"<?= $Page->account_manager_id->editAttributes() ?> aria-describedby="x_account_manager_id_help">
<?= $Page->account_manager_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->account_manager_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->registration_date->Visible) { // registration_date ?>
    <div id="r_registration_date"<?= $Page->registration_date->rowAttributes() ?>>
        <label id="elh_clients_registration_date" for="x_registration_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->registration_date->caption() ?><?= $Page->registration_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->registration_date->cellAttributes() ?>>
<span id="el_clients_registration_date">
<input type="<?= $Page->registration_date->getInputTextType() ?>" name="x_registration_date" id="x_registration_date" data-table="clients" data-field="x_registration_date" value="<?= $Page->registration_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->registration_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->registration_date->formatPattern()) ?>"<?= $Page->registration_date->editAttributes() ?> aria-describedby="x_registration_date_help">
<?= $Page->registration_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->registration_date->getErrorMessage() ?></div>
<?php if (!$Page->registration_date->ReadOnly && !$Page->registration_date->Disabled && !isset($Page->registration_date->EditAttrs["readonly"]) && !isset($Page->registration_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclientsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fclientsadd", "x_registration_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->website->Visible) { // website ?>
    <div id="r_website"<?= $Page->website->rowAttributes() ?>>
        <label id="elh_clients_website" for="x_website" class="<?= $Page->LeftColumnClass ?>"><?= $Page->website->caption() ?><?= $Page->website->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->website->cellAttributes() ?>>
<span id="el_clients_website">
<input type="<?= $Page->website->getInputTextType() ?>" name="x_website" id="x_website" data-table="clients" data-field="x_website" value="<?= $Page->website->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->website->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->website->formatPattern()) ?>"<?= $Page->website->editAttributes() ?> aria-describedby="x_website_help">
<?= $Page->website->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->website->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <div id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <label id="elh_clients_notes" for="x_notes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notes->caption() ?><?= $Page->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notes->cellAttributes() ?>>
<span id="el_clients_notes">
<textarea data-table="clients" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notes->getPlaceHolder()) ?>"<?= $Page->notes->editAttributes() ?> aria-describedby="x_notes_help"><?= $Page->notes->EditValue ?></textarea>
<?= $Page->notes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_clients_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_clients_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="clients" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_clients_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_clients_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="clients" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_at->formatPattern()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclientsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fclientsadd", "x_created_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fclientsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fclientsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("clients");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
