<?php

namespace PHPMaker2024\CMS;

// Page object
$ServiceTypesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { service_types: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fservice_typesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fservice_typesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["sla_hours", [fields.sla_hours.visible && fields.sla_hours.required ? ew.Validators.required(fields.sla_hours.caption) : null, ew.Validators.integer], fields.sla_hours.isInvalid],
            ["severity_level", [fields.severity_level.visible && fields.severity_level.required ? ew.Validators.required(fields.severity_level.caption) : null], fields.severity_level.isInvalid],
            ["maintenance_frequency", [fields.maintenance_frequency.visible && fields.maintenance_frequency.required ? ew.Validators.required(fields.maintenance_frequency.caption) : null, ew.Validators.integer], fields.maintenance_frequency.isInvalid],
            ["is_active", [fields.is_active.visible && fields.is_active.required ? ew.Validators.required(fields.is_active.caption) : null], fields.is_active.isInvalid]
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
            "is_active": <?= $Page->is_active->toClientList($Page) ?>,
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
<form name="fservice_typesadd" id="fservice_typesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="service_types">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_service_types_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_service_types_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="service_types" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_service_types_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_service_types_description">
<textarea data-table="service_types" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sla_hours->Visible) { // sla_hours ?>
    <div id="r_sla_hours"<?= $Page->sla_hours->rowAttributes() ?>>
        <label id="elh_service_types_sla_hours" for="x_sla_hours" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sla_hours->caption() ?><?= $Page->sla_hours->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sla_hours->cellAttributes() ?>>
<span id="el_service_types_sla_hours">
<input type="<?= $Page->sla_hours->getInputTextType() ?>" name="x_sla_hours" id="x_sla_hours" data-table="service_types" data-field="x_sla_hours" value="<?= $Page->sla_hours->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sla_hours->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->sla_hours->formatPattern()) ?>"<?= $Page->sla_hours->editAttributes() ?> aria-describedby="x_sla_hours_help">
<?= $Page->sla_hours->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sla_hours->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->severity_level->Visible) { // severity_level ?>
    <div id="r_severity_level"<?= $Page->severity_level->rowAttributes() ?>>
        <label id="elh_service_types_severity_level" for="x_severity_level" class="<?= $Page->LeftColumnClass ?>"><?= $Page->severity_level->caption() ?><?= $Page->severity_level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->severity_level->cellAttributes() ?>>
<span id="el_service_types_severity_level">
<input type="<?= $Page->severity_level->getInputTextType() ?>" name="x_severity_level" id="x_severity_level" data-table="service_types" data-field="x_severity_level" value="<?= $Page->severity_level->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->severity_level->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->severity_level->formatPattern()) ?>"<?= $Page->severity_level->editAttributes() ?> aria-describedby="x_severity_level_help">
<?= $Page->severity_level->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->severity_level->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maintenance_frequency->Visible) { // maintenance_frequency ?>
    <div id="r_maintenance_frequency"<?= $Page->maintenance_frequency->rowAttributes() ?>>
        <label id="elh_service_types_maintenance_frequency" for="x_maintenance_frequency" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maintenance_frequency->caption() ?><?= $Page->maintenance_frequency->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->maintenance_frequency->cellAttributes() ?>>
<span id="el_service_types_maintenance_frequency">
<input type="<?= $Page->maintenance_frequency->getInputTextType() ?>" name="x_maintenance_frequency" id="x_maintenance_frequency" data-table="service_types" data-field="x_maintenance_frequency" value="<?= $Page->maintenance_frequency->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->maintenance_frequency->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->maintenance_frequency->formatPattern()) ?>"<?= $Page->maintenance_frequency->editAttributes() ?> aria-describedby="x_maintenance_frequency_help">
<?= $Page->maintenance_frequency->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maintenance_frequency->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->is_active->Visible) { // is_active ?>
    <div id="r_is_active"<?= $Page->is_active->rowAttributes() ?>>
        <label id="elh_service_types_is_active" class="<?= $Page->LeftColumnClass ?>"><?= $Page->is_active->caption() ?><?= $Page->is_active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->is_active->cellAttributes() ?>>
<span id="el_service_types_is_active">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->is_active->isInvalidClass() ?>" data-table="service_types" data-field="x_is_active" data-boolean name="x_is_active" id="x_is_active" value="1"<?= ConvertToBool($Page->is_active->CurrentValue) ? " checked" : "" ?><?= $Page->is_active->editAttributes() ?> aria-describedby="x_is_active_help">
    <div class="invalid-feedback"><?= $Page->is_active->getErrorMessage() ?></div>
</div>
<?= $Page->is_active->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fservice_typesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fservice_typesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("service_types");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
