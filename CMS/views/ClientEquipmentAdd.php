<?php

namespace PHPMaker2024\CMS;

// Page object
$ClientEquipmentAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { client_equipment: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fclient_equipmentadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fclient_equipmentadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["client_id", [fields.client_id.visible && fields.client_id.required ? ew.Validators.required(fields.client_id.caption) : null, ew.Validators.integer], fields.client_id.isInvalid],
            ["contract_id", [fields.contract_id.visible && fields.contract_id.required ? ew.Validators.required(fields.contract_id.caption) : null, ew.Validators.integer], fields.contract_id.isInvalid],
            ["tower_equipment_id", [fields.tower_equipment_id.visible && fields.tower_equipment_id.required ? ew.Validators.required(fields.tower_equipment_id.caption) : null, ew.Validators.integer], fields.tower_equipment_id.isInvalid],
            ["installation_date", [fields.installation_date.visible && fields.installation_date.required ? ew.Validators.required(fields.installation_date.caption) : null, ew.Validators.datetime(fields.installation_date.clientFormatPattern)], fields.installation_date.isInvalid],
            ["removal_date", [fields.removal_date.visible && fields.removal_date.required ? ew.Validators.required(fields.removal_date.caption) : null, ew.Validators.datetime(fields.removal_date.clientFormatPattern)], fields.removal_date.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["maintenance_schedule", [fields.maintenance_schedule.visible && fields.maintenance_schedule.required ? ew.Validators.required(fields.maintenance_schedule.caption) : null], fields.maintenance_schedule.isInvalid],
            ["last_maintenance_date", [fields.last_maintenance_date.visible && fields.last_maintenance_date.required ? ew.Validators.required(fields.last_maintenance_date.caption) : null, ew.Validators.datetime(fields.last_maintenance_date.clientFormatPattern)], fields.last_maintenance_date.isInvalid],
            ["next_maintenance_date", [fields.next_maintenance_date.visible && fields.next_maintenance_date.required ? ew.Validators.required(fields.next_maintenance_date.caption) : null, ew.Validators.datetime(fields.next_maintenance_date.clientFormatPattern)], fields.next_maintenance_date.isInvalid],
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
<form name="fclient_equipmentadd" id="fclient_equipmentadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="client_equipment">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->client_id->Visible) { // client_id ?>
    <div id="r_client_id"<?= $Page->client_id->rowAttributes() ?>>
        <label id="elh_client_equipment_client_id" for="x_client_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->client_id->caption() ?><?= $Page->client_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->client_id->cellAttributes() ?>>
<span id="el_client_equipment_client_id">
<input type="<?= $Page->client_id->getInputTextType() ?>" name="x_client_id" id="x_client_id" data-table="client_equipment" data-field="x_client_id" value="<?= $Page->client_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->client_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->client_id->formatPattern()) ?>"<?= $Page->client_id->editAttributes() ?> aria-describedby="x_client_id_help">
<?= $Page->client_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->client_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contract_id->Visible) { // contract_id ?>
    <div id="r_contract_id"<?= $Page->contract_id->rowAttributes() ?>>
        <label id="elh_client_equipment_contract_id" for="x_contract_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contract_id->caption() ?><?= $Page->contract_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contract_id->cellAttributes() ?>>
<span id="el_client_equipment_contract_id">
<input type="<?= $Page->contract_id->getInputTextType() ?>" name="x_contract_id" id="x_contract_id" data-table="client_equipment" data-field="x_contract_id" value="<?= $Page->contract_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->contract_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contract_id->formatPattern()) ?>"<?= $Page->contract_id->editAttributes() ?> aria-describedby="x_contract_id_help">
<?= $Page->contract_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contract_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tower_equipment_id->Visible) { // tower_equipment_id ?>
    <div id="r_tower_equipment_id"<?= $Page->tower_equipment_id->rowAttributes() ?>>
        <label id="elh_client_equipment_tower_equipment_id" for="x_tower_equipment_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tower_equipment_id->caption() ?><?= $Page->tower_equipment_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tower_equipment_id->cellAttributes() ?>>
<span id="el_client_equipment_tower_equipment_id">
<input type="<?= $Page->tower_equipment_id->getInputTextType() ?>" name="x_tower_equipment_id" id="x_tower_equipment_id" data-table="client_equipment" data-field="x_tower_equipment_id" value="<?= $Page->tower_equipment_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tower_equipment_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tower_equipment_id->formatPattern()) ?>"<?= $Page->tower_equipment_id->editAttributes() ?> aria-describedby="x_tower_equipment_id_help">
<?= $Page->tower_equipment_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tower_equipment_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->installation_date->Visible) { // installation_date ?>
    <div id="r_installation_date"<?= $Page->installation_date->rowAttributes() ?>>
        <label id="elh_client_equipment_installation_date" for="x_installation_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->installation_date->caption() ?><?= $Page->installation_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->installation_date->cellAttributes() ?>>
<span id="el_client_equipment_installation_date">
<input type="<?= $Page->installation_date->getInputTextType() ?>" name="x_installation_date" id="x_installation_date" data-table="client_equipment" data-field="x_installation_date" value="<?= $Page->installation_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->installation_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->installation_date->formatPattern()) ?>"<?= $Page->installation_date->editAttributes() ?> aria-describedby="x_installation_date_help">
<?= $Page->installation_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->installation_date->getErrorMessage() ?></div>
<?php if (!$Page->installation_date->ReadOnly && !$Page->installation_date->Disabled && !isset($Page->installation_date->EditAttrs["readonly"]) && !isset($Page->installation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclient_equipmentadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fclient_equipmentadd", "x_installation_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->removal_date->Visible) { // removal_date ?>
    <div id="r_removal_date"<?= $Page->removal_date->rowAttributes() ?>>
        <label id="elh_client_equipment_removal_date" for="x_removal_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->removal_date->caption() ?><?= $Page->removal_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->removal_date->cellAttributes() ?>>
<span id="el_client_equipment_removal_date">
<input type="<?= $Page->removal_date->getInputTextType() ?>" name="x_removal_date" id="x_removal_date" data-table="client_equipment" data-field="x_removal_date" value="<?= $Page->removal_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->removal_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->removal_date->formatPattern()) ?>"<?= $Page->removal_date->editAttributes() ?> aria-describedby="x_removal_date_help">
<?= $Page->removal_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->removal_date->getErrorMessage() ?></div>
<?php if (!$Page->removal_date->ReadOnly && !$Page->removal_date->Disabled && !isset($Page->removal_date->EditAttrs["readonly"]) && !isset($Page->removal_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclient_equipmentadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fclient_equipmentadd", "x_removal_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_client_equipment_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_client_equipment_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="client_equipment" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->status->formatPattern()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maintenance_schedule->Visible) { // maintenance_schedule ?>
    <div id="r_maintenance_schedule"<?= $Page->maintenance_schedule->rowAttributes() ?>>
        <label id="elh_client_equipment_maintenance_schedule" for="x_maintenance_schedule" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maintenance_schedule->caption() ?><?= $Page->maintenance_schedule->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->maintenance_schedule->cellAttributes() ?>>
<span id="el_client_equipment_maintenance_schedule">
<input type="<?= $Page->maintenance_schedule->getInputTextType() ?>" name="x_maintenance_schedule" id="x_maintenance_schedule" data-table="client_equipment" data-field="x_maintenance_schedule" value="<?= $Page->maintenance_schedule->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->maintenance_schedule->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->maintenance_schedule->formatPattern()) ?>"<?= $Page->maintenance_schedule->editAttributes() ?> aria-describedby="x_maintenance_schedule_help">
<?= $Page->maintenance_schedule->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maintenance_schedule->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->last_maintenance_date->Visible) { // last_maintenance_date ?>
    <div id="r_last_maintenance_date"<?= $Page->last_maintenance_date->rowAttributes() ?>>
        <label id="elh_client_equipment_last_maintenance_date" for="x_last_maintenance_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->last_maintenance_date->caption() ?><?= $Page->last_maintenance_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->last_maintenance_date->cellAttributes() ?>>
<span id="el_client_equipment_last_maintenance_date">
<input type="<?= $Page->last_maintenance_date->getInputTextType() ?>" name="x_last_maintenance_date" id="x_last_maintenance_date" data-table="client_equipment" data-field="x_last_maintenance_date" value="<?= $Page->last_maintenance_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->last_maintenance_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->last_maintenance_date->formatPattern()) ?>"<?= $Page->last_maintenance_date->editAttributes() ?> aria-describedby="x_last_maintenance_date_help">
<?= $Page->last_maintenance_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->last_maintenance_date->getErrorMessage() ?></div>
<?php if (!$Page->last_maintenance_date->ReadOnly && !$Page->last_maintenance_date->Disabled && !isset($Page->last_maintenance_date->EditAttrs["readonly"]) && !isset($Page->last_maintenance_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclient_equipmentadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fclient_equipmentadd", "x_last_maintenance_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->next_maintenance_date->Visible) { // next_maintenance_date ?>
    <div id="r_next_maintenance_date"<?= $Page->next_maintenance_date->rowAttributes() ?>>
        <label id="elh_client_equipment_next_maintenance_date" for="x_next_maintenance_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->next_maintenance_date->caption() ?><?= $Page->next_maintenance_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->next_maintenance_date->cellAttributes() ?>>
<span id="el_client_equipment_next_maintenance_date">
<input type="<?= $Page->next_maintenance_date->getInputTextType() ?>" name="x_next_maintenance_date" id="x_next_maintenance_date" data-table="client_equipment" data-field="x_next_maintenance_date" value="<?= $Page->next_maintenance_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->next_maintenance_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->next_maintenance_date->formatPattern()) ?>"<?= $Page->next_maintenance_date->editAttributes() ?> aria-describedby="x_next_maintenance_date_help">
<?= $Page->next_maintenance_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->next_maintenance_date->getErrorMessage() ?></div>
<?php if (!$Page->next_maintenance_date->ReadOnly && !$Page->next_maintenance_date->Disabled && !isset($Page->next_maintenance_date->EditAttrs["readonly"]) && !isset($Page->next_maintenance_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclient_equipmentadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fclient_equipmentadd", "x_next_maintenance_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <div id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <label id="elh_client_equipment_notes" for="x_notes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notes->caption() ?><?= $Page->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notes->cellAttributes() ?>>
<span id="el_client_equipment_notes">
<textarea data-table="client_equipment" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notes->getPlaceHolder()) ?>"<?= $Page->notes->editAttributes() ?> aria-describedby="x_notes_help"><?= $Page->notes->EditValue ?></textarea>
<?= $Page->notes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fclient_equipmentadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fclient_equipmentadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("client_equipment");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
