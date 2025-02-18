<?php

namespace PHPMaker2024\CMS;

// Page object
$ClientContactsEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fclient_contactsedit" id="fclient_contactsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { client_contacts: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fclient_contactsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fclient_contactsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["contact_id", [fields.contact_id.visible && fields.contact_id.required ? ew.Validators.required(fields.contact_id.caption) : null], fields.contact_id.isInvalid],
            ["client_id", [fields.client_id.visible && fields.client_id.required ? ew.Validators.required(fields.client_id.caption) : null, ew.Validators.integer], fields.client_id.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["position", [fields.position.visible && fields.position.required ? ew.Validators.required(fields.position.caption) : null], fields.position.isInvalid],
            ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
            ["phone", [fields.phone.visible && fields.phone.required ? ew.Validators.required(fields.phone.caption) : null], fields.phone.isInvalid],
            ["mobile", [fields.mobile.visible && fields.mobile.required ? ew.Validators.required(fields.mobile.caption) : null], fields.mobile.isInvalid],
            ["is_primary", [fields.is_primary.visible && fields.is_primary.required ? ew.Validators.required(fields.is_primary.caption) : null], fields.is_primary.isInvalid],
            ["is_technical", [fields.is_technical.visible && fields.is_technical.required ? ew.Validators.required(fields.is_technical.caption) : null], fields.is_technical.isInvalid],
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
            "is_primary": <?= $Page->is_primary->toClientList($Page) ?>,
            "is_technical": <?= $Page->is_technical->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="client_contacts">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->contact_id->Visible) { // contact_id ?>
    <div id="r_contact_id"<?= $Page->contact_id->rowAttributes() ?>>
        <label id="elh_client_contacts_contact_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_id->caption() ?><?= $Page->contact_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contact_id->cellAttributes() ?>>
<span id="el_client_contacts_contact_id">
<span<?= $Page->contact_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->contact_id->getDisplayValue($Page->contact_id->EditValue))) ?>"></span>
<input type="hidden" data-table="client_contacts" data-field="x_contact_id" data-hidden="1" name="x_contact_id" id="x_contact_id" value="<?= HtmlEncode($Page->contact_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
    <div id="r_client_id"<?= $Page->client_id->rowAttributes() ?>>
        <label id="elh_client_contacts_client_id" for="x_client_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->client_id->caption() ?><?= $Page->client_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->client_id->cellAttributes() ?>>
<span id="el_client_contacts_client_id">
<input type="<?= $Page->client_id->getInputTextType() ?>" name="x_client_id" id="x_client_id" data-table="client_contacts" data-field="x_client_id" value="<?= $Page->client_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->client_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->client_id->formatPattern()) ?>"<?= $Page->client_id->editAttributes() ?> aria-describedby="x_client_id_help">
<?= $Page->client_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->client_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_client_contacts_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_client_contacts_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="client_contacts" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->position->Visible) { // position ?>
    <div id="r_position"<?= $Page->position->rowAttributes() ?>>
        <label id="elh_client_contacts_position" for="x_position" class="<?= $Page->LeftColumnClass ?>"><?= $Page->position->caption() ?><?= $Page->position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->position->cellAttributes() ?>>
<span id="el_client_contacts_position">
<input type="<?= $Page->position->getInputTextType() ?>" name="x_position" id="x_position" data-table="client_contacts" data-field="x_position" value="<?= $Page->position->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->position->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->position->formatPattern()) ?>"<?= $Page->position->editAttributes() ?> aria-describedby="x_position_help">
<?= $Page->position->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->position->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label id="elh_client_contacts__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span id="el_client_contacts__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="client_contacts" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_email->formatPattern()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <div id="r_phone"<?= $Page->phone->rowAttributes() ?>>
        <label id="elh_client_contacts_phone" for="x_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone->caption() ?><?= $Page->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->phone->cellAttributes() ?>>
<span id="el_client_contacts_phone">
<input type="<?= $Page->phone->getInputTextType() ?>" name="x_phone" id="x_phone" data-table="client_contacts" data-field="x_phone" value="<?= $Page->phone->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->phone->formatPattern()) ?>"<?= $Page->phone->editAttributes() ?> aria-describedby="x_phone_help">
<?= $Page->phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->mobile->Visible) { // mobile ?>
    <div id="r_mobile"<?= $Page->mobile->rowAttributes() ?>>
        <label id="elh_client_contacts_mobile" for="x_mobile" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mobile->caption() ?><?= $Page->mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->mobile->cellAttributes() ?>>
<span id="el_client_contacts_mobile">
<input type="<?= $Page->mobile->getInputTextType() ?>" name="x_mobile" id="x_mobile" data-table="client_contacts" data-field="x_mobile" value="<?= $Page->mobile->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->mobile->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->mobile->formatPattern()) ?>"<?= $Page->mobile->editAttributes() ?> aria-describedby="x_mobile_help">
<?= $Page->mobile->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mobile->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->is_primary->Visible) { // is_primary ?>
    <div id="r_is_primary"<?= $Page->is_primary->rowAttributes() ?>>
        <label id="elh_client_contacts_is_primary" class="<?= $Page->LeftColumnClass ?>"><?= $Page->is_primary->caption() ?><?= $Page->is_primary->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->is_primary->cellAttributes() ?>>
<span id="el_client_contacts_is_primary">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->is_primary->isInvalidClass() ?>" data-table="client_contacts" data-field="x_is_primary" data-boolean name="x_is_primary" id="x_is_primary" value="1"<?= ConvertToBool($Page->is_primary->CurrentValue) ? " checked" : "" ?><?= $Page->is_primary->editAttributes() ?> aria-describedby="x_is_primary_help">
    <div class="invalid-feedback"><?= $Page->is_primary->getErrorMessage() ?></div>
</div>
<?= $Page->is_primary->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->is_technical->Visible) { // is_technical ?>
    <div id="r_is_technical"<?= $Page->is_technical->rowAttributes() ?>>
        <label id="elh_client_contacts_is_technical" class="<?= $Page->LeftColumnClass ?>"><?= $Page->is_technical->caption() ?><?= $Page->is_technical->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->is_technical->cellAttributes() ?>>
<span id="el_client_contacts_is_technical">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->is_technical->isInvalidClass() ?>" data-table="client_contacts" data-field="x_is_technical" data-boolean name="x_is_technical" id="x_is_technical" value="1"<?= ConvertToBool($Page->is_technical->CurrentValue) ? " checked" : "" ?><?= $Page->is_technical->editAttributes() ?> aria-describedby="x_is_technical_help">
    <div class="invalid-feedback"><?= $Page->is_technical->getErrorMessage() ?></div>
</div>
<?= $Page->is_technical->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <div id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <label id="elh_client_contacts_notes" for="x_notes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notes->caption() ?><?= $Page->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notes->cellAttributes() ?>>
<span id="el_client_contacts_notes">
<textarea data-table="client_contacts" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notes->getPlaceHolder()) ?>"<?= $Page->notes->editAttributes() ?> aria-describedby="x_notes_help"><?= $Page->notes->EditValue ?></textarea>
<?= $Page->notes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fclient_contactsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fclient_contactsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("client_contacts");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
