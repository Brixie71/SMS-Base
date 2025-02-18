<?php

namespace PHPMaker2024\CMS;

// Page object
$ClientDocumentsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fclient_documentsedit" id="fclient_documentsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { client_documents: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fclient_documentsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fclient_documentsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["document_id", [fields.document_id.visible && fields.document_id.required ? ew.Validators.required(fields.document_id.caption) : null], fields.document_id.isInvalid],
            ["client_id", [fields.client_id.visible && fields.client_id.required ? ew.Validators.required(fields.client_id.caption) : null, ew.Validators.integer], fields.client_id.isInvalid],
            ["document_type", [fields.document_type.visible && fields.document_type.required ? ew.Validators.required(fields.document_type.caption) : null], fields.document_type.isInvalid],
            ["_title", [fields._title.visible && fields._title.required ? ew.Validators.required(fields._title.caption) : null], fields._title.isInvalid],
            ["file_path", [fields.file_path.visible && fields.file_path.required ? ew.Validators.required(fields.file_path.caption) : null], fields.file_path.isInvalid],
            ["upload_date", [fields.upload_date.visible && fields.upload_date.required ? ew.Validators.required(fields.upload_date.caption) : null, ew.Validators.datetime(fields.upload_date.clientFormatPattern)], fields.upload_date.isInvalid],
            ["expiry_date", [fields.expiry_date.visible && fields.expiry_date.required ? ew.Validators.required(fields.expiry_date.caption) : null, ew.Validators.datetime(fields.expiry_date.clientFormatPattern)], fields.expiry_date.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["uploaded_by", [fields.uploaded_by.visible && fields.uploaded_by.required ? ew.Validators.required(fields.uploaded_by.caption) : null, ew.Validators.integer], fields.uploaded_by.isInvalid],
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
<input type="hidden" name="t" value="client_documents">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->document_id->Visible) { // document_id ?>
    <div id="r_document_id"<?= $Page->document_id->rowAttributes() ?>>
        <label id="elh_client_documents_document_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->document_id->caption() ?><?= $Page->document_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->document_id->cellAttributes() ?>>
<span id="el_client_documents_document_id">
<span<?= $Page->document_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->document_id->getDisplayValue($Page->document_id->EditValue))) ?>"></span>
<input type="hidden" data-table="client_documents" data-field="x_document_id" data-hidden="1" name="x_document_id" id="x_document_id" value="<?= HtmlEncode($Page->document_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
    <div id="r_client_id"<?= $Page->client_id->rowAttributes() ?>>
        <label id="elh_client_documents_client_id" for="x_client_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->client_id->caption() ?><?= $Page->client_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->client_id->cellAttributes() ?>>
<span id="el_client_documents_client_id">
<input type="<?= $Page->client_id->getInputTextType() ?>" name="x_client_id" id="x_client_id" data-table="client_documents" data-field="x_client_id" value="<?= $Page->client_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->client_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->client_id->formatPattern()) ?>"<?= $Page->client_id->editAttributes() ?> aria-describedby="x_client_id_help">
<?= $Page->client_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->client_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->document_type->Visible) { // document_type ?>
    <div id="r_document_type"<?= $Page->document_type->rowAttributes() ?>>
        <label id="elh_client_documents_document_type" for="x_document_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->document_type->caption() ?><?= $Page->document_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->document_type->cellAttributes() ?>>
<span id="el_client_documents_document_type">
<input type="<?= $Page->document_type->getInputTextType() ?>" name="x_document_type" id="x_document_type" data-table="client_documents" data-field="x_document_type" value="<?= $Page->document_type->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->document_type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->document_type->formatPattern()) ?>"<?= $Page->document_type->editAttributes() ?> aria-describedby="x_document_type_help">
<?= $Page->document_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->document_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_title->Visible) { // title ?>
    <div id="r__title"<?= $Page->_title->rowAttributes() ?>>
        <label id="elh_client_documents__title" for="x__title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_title->caption() ?><?= $Page->_title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_title->cellAttributes() ?>>
<span id="el_client_documents__title">
<input type="<?= $Page->_title->getInputTextType() ?>" name="x__title" id="x__title" data-table="client_documents" data-field="x__title" value="<?= $Page->_title->EditValue ?>" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->_title->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_title->formatPattern()) ?>"<?= $Page->_title->editAttributes() ?> aria-describedby="x__title_help">
<?= $Page->_title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->file_path->Visible) { // file_path ?>
    <div id="r_file_path"<?= $Page->file_path->rowAttributes() ?>>
        <label id="elh_client_documents_file_path" for="x_file_path" class="<?= $Page->LeftColumnClass ?>"><?= $Page->file_path->caption() ?><?= $Page->file_path->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->file_path->cellAttributes() ?>>
<span id="el_client_documents_file_path">
<textarea data-table="client_documents" data-field="x_file_path" name="x_file_path" id="x_file_path" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->file_path->getPlaceHolder()) ?>"<?= $Page->file_path->editAttributes() ?> aria-describedby="x_file_path_help"><?= $Page->file_path->EditValue ?></textarea>
<?= $Page->file_path->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->file_path->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->upload_date->Visible) { // upload_date ?>
    <div id="r_upload_date"<?= $Page->upload_date->rowAttributes() ?>>
        <label id="elh_client_documents_upload_date" for="x_upload_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->upload_date->caption() ?><?= $Page->upload_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->upload_date->cellAttributes() ?>>
<span id="el_client_documents_upload_date">
<input type="<?= $Page->upload_date->getInputTextType() ?>" name="x_upload_date" id="x_upload_date" data-table="client_documents" data-field="x_upload_date" value="<?= $Page->upload_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->upload_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->upload_date->formatPattern()) ?>"<?= $Page->upload_date->editAttributes() ?> aria-describedby="x_upload_date_help">
<?= $Page->upload_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->upload_date->getErrorMessage() ?></div>
<?php if (!$Page->upload_date->ReadOnly && !$Page->upload_date->Disabled && !isset($Page->upload_date->EditAttrs["readonly"]) && !isset($Page->upload_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclient_documentsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fclient_documentsedit", "x_upload_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->expiry_date->Visible) { // expiry_date ?>
    <div id="r_expiry_date"<?= $Page->expiry_date->rowAttributes() ?>>
        <label id="elh_client_documents_expiry_date" for="x_expiry_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->expiry_date->caption() ?><?= $Page->expiry_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->expiry_date->cellAttributes() ?>>
<span id="el_client_documents_expiry_date">
<input type="<?= $Page->expiry_date->getInputTextType() ?>" name="x_expiry_date" id="x_expiry_date" data-table="client_documents" data-field="x_expiry_date" value="<?= $Page->expiry_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->expiry_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->expiry_date->formatPattern()) ?>"<?= $Page->expiry_date->editAttributes() ?> aria-describedby="x_expiry_date_help">
<?= $Page->expiry_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->expiry_date->getErrorMessage() ?></div>
<?php if (!$Page->expiry_date->ReadOnly && !$Page->expiry_date->Disabled && !isset($Page->expiry_date->EditAttrs["readonly"]) && !isset($Page->expiry_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclient_documentsedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fclient_documentsedit", "x_expiry_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_client_documents_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_client_documents_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="client_documents" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->status->formatPattern()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->uploaded_by->Visible) { // uploaded_by ?>
    <div id="r_uploaded_by"<?= $Page->uploaded_by->rowAttributes() ?>>
        <label id="elh_client_documents_uploaded_by" for="x_uploaded_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->uploaded_by->caption() ?><?= $Page->uploaded_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->uploaded_by->cellAttributes() ?>>
<span id="el_client_documents_uploaded_by">
<input type="<?= $Page->uploaded_by->getInputTextType() ?>" name="x_uploaded_by" id="x_uploaded_by" data-table="client_documents" data-field="x_uploaded_by" value="<?= $Page->uploaded_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->uploaded_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->uploaded_by->formatPattern()) ?>"<?= $Page->uploaded_by->editAttributes() ?> aria-describedby="x_uploaded_by_help">
<?= $Page->uploaded_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->uploaded_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <div id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <label id="elh_client_documents_notes" for="x_notes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notes->caption() ?><?= $Page->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notes->cellAttributes() ?>>
<span id="el_client_documents_notes">
<textarea data-table="client_documents" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notes->getPlaceHolder()) ?>"<?= $Page->notes->editAttributes() ?> aria-describedby="x_notes_help"><?= $Page->notes->EditValue ?></textarea>
<?= $Page->notes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fclient_documentsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fclient_documentsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("client_documents");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
