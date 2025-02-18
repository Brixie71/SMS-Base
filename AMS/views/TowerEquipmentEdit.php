<?php

namespace PHPMaker2024\AMS;

// Page object
$TowerEquipmentEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="ftower_equipmentedit" id="ftower_equipmentedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tower_equipment: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var ftower_equipmentedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ftower_equipmentedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["equipment_id", [fields.equipment_id.visible && fields.equipment_id.required ? ew.Validators.required(fields.equipment_id.caption) : null], fields.equipment_id.isInvalid],
            ["tower_id", [fields.tower_id.visible && fields.tower_id.required ? ew.Validators.required(fields.tower_id.caption) : null, ew.Validators.integer], fields.tower_id.isInvalid],
            ["model_id", [fields.model_id.visible && fields.model_id.required ? ew.Validators.required(fields.model_id.caption) : null, ew.Validators.integer], fields.model_id.isInvalid],
            ["serial_number", [fields.serial_number.visible && fields.serial_number.required ? ew.Validators.required(fields.serial_number.caption) : null], fields.serial_number.isInvalid],
            ["installation_date", [fields.installation_date.visible && fields.installation_date.required ? ew.Validators.required(fields.installation_date.caption) : null, ew.Validators.datetime(fields.installation_date.clientFormatPattern)], fields.installation_date.isInvalid],
            ["warranty_expiry", [fields.warranty_expiry.visible && fields.warranty_expiry.required ? ew.Validators.required(fields.warranty_expiry.caption) : null, ew.Validators.datetime(fields.warranty_expiry.clientFormatPattern)], fields.warranty_expiry.isInvalid],
            ["status_id", [fields.status_id.visible && fields.status_id.required ? ew.Validators.required(fields.status_id.caption) : null, ew.Validators.integer], fields.status_id.isInvalid],
            ["last_maintenance", [fields.last_maintenance.visible && fields.last_maintenance.required ? ew.Validators.required(fields.last_maintenance.caption) : null, ew.Validators.datetime(fields.last_maintenance.clientFormatPattern)], fields.last_maintenance.isInvalid],
            ["next_maintenance", [fields.next_maintenance.visible && fields.next_maintenance.required ? ew.Validators.required(fields.next_maintenance.caption) : null, ew.Validators.datetime(fields.next_maintenance.clientFormatPattern)], fields.next_maintenance.isInvalid],
            ["client_id", [fields.client_id.visible && fields.client_id.required ? ew.Validators.required(fields.client_id.caption) : null, ew.Validators.integer], fields.client_id.isInvalid],
            ["installed_by", [fields.installed_by.visible && fields.installed_by.required ? ew.Validators.required(fields.installed_by.caption) : null, ew.Validators.integer], fields.installed_by.isInvalid],
            ["created_by", [fields.created_by.visible && fields.created_by.required ? ew.Validators.required(fields.created_by.caption) : null, ew.Validators.integer], fields.created_by.isInvalid],
            ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid],
            ["updated_by", [fields.updated_by.visible && fields.updated_by.required ? ew.Validators.required(fields.updated_by.caption) : null, ew.Validators.integer], fields.updated_by.isInvalid],
            ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(fields.updated_at.clientFormatPattern)], fields.updated_at.isInvalid],
            ["is_active", [fields.is_active.visible && fields.is_active.required ? ew.Validators.required(fields.is_active.caption) : null], fields.is_active.isInvalid],
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tower_equipment">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
    <div id="r_equipment_id"<?= $Page->equipment_id->rowAttributes() ?>>
        <label id="elh_tower_equipment_equipment_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->equipment_id->caption() ?><?= $Page->equipment_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->equipment_id->cellAttributes() ?>>
<span id="el_tower_equipment_equipment_id">
<span<?= $Page->equipment_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->equipment_id->getDisplayValue($Page->equipment_id->EditValue))) ?>"></span>
<input type="hidden" data-table="tower_equipment" data-field="x_equipment_id" data-hidden="1" name="x_equipment_id" id="x_equipment_id" value="<?= HtmlEncode($Page->equipment_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tower_id->Visible) { // tower_id ?>
    <div id="r_tower_id"<?= $Page->tower_id->rowAttributes() ?>>
        <label id="elh_tower_equipment_tower_id" for="x_tower_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tower_id->caption() ?><?= $Page->tower_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tower_id->cellAttributes() ?>>
<span id="el_tower_equipment_tower_id">
<input type="<?= $Page->tower_id->getInputTextType() ?>" name="x_tower_id" id="x_tower_id" data-table="tower_equipment" data-field="x_tower_id" value="<?= $Page->tower_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tower_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tower_id->formatPattern()) ?>"<?= $Page->tower_id->editAttributes() ?> aria-describedby="x_tower_id_help">
<?= $Page->tower_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tower_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->model_id->Visible) { // model_id ?>
    <div id="r_model_id"<?= $Page->model_id->rowAttributes() ?>>
        <label id="elh_tower_equipment_model_id" for="x_model_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->model_id->caption() ?><?= $Page->model_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->model_id->cellAttributes() ?>>
<span id="el_tower_equipment_model_id">
<input type="<?= $Page->model_id->getInputTextType() ?>" name="x_model_id" id="x_model_id" data-table="tower_equipment" data-field="x_model_id" value="<?= $Page->model_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->model_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->model_id->formatPattern()) ?>"<?= $Page->model_id->editAttributes() ?> aria-describedby="x_model_id_help">
<?= $Page->model_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->model_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->serial_number->Visible) { // serial_number ?>
    <div id="r_serial_number"<?= $Page->serial_number->rowAttributes() ?>>
        <label id="elh_tower_equipment_serial_number" for="x_serial_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->serial_number->caption() ?><?= $Page->serial_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->serial_number->cellAttributes() ?>>
<span id="el_tower_equipment_serial_number">
<input type="<?= $Page->serial_number->getInputTextType() ?>" name="x_serial_number" id="x_serial_number" data-table="tower_equipment" data-field="x_serial_number" value="<?= $Page->serial_number->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->serial_number->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->serial_number->formatPattern()) ?>"<?= $Page->serial_number->editAttributes() ?> aria-describedby="x_serial_number_help">
<?= $Page->serial_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->serial_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->installation_date->Visible) { // installation_date ?>
    <div id="r_installation_date"<?= $Page->installation_date->rowAttributes() ?>>
        <label id="elh_tower_equipment_installation_date" for="x_installation_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->installation_date->caption() ?><?= $Page->installation_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->installation_date->cellAttributes() ?>>
<span id="el_tower_equipment_installation_date">
<input type="<?= $Page->installation_date->getInputTextType() ?>" name="x_installation_date" id="x_installation_date" data-table="tower_equipment" data-field="x_installation_date" value="<?= $Page->installation_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->installation_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->installation_date->formatPattern()) ?>"<?= $Page->installation_date->editAttributes() ?> aria-describedby="x_installation_date_help">
<?= $Page->installation_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->installation_date->getErrorMessage() ?></div>
<?php if (!$Page->installation_date->ReadOnly && !$Page->installation_date->Disabled && !isset($Page->installation_date->EditAttrs["readonly"]) && !isset($Page->installation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftower_equipmentedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftower_equipmentedit", "x_installation_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->warranty_expiry->Visible) { // warranty_expiry ?>
    <div id="r_warranty_expiry"<?= $Page->warranty_expiry->rowAttributes() ?>>
        <label id="elh_tower_equipment_warranty_expiry" for="x_warranty_expiry" class="<?= $Page->LeftColumnClass ?>"><?= $Page->warranty_expiry->caption() ?><?= $Page->warranty_expiry->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->warranty_expiry->cellAttributes() ?>>
<span id="el_tower_equipment_warranty_expiry">
<input type="<?= $Page->warranty_expiry->getInputTextType() ?>" name="x_warranty_expiry" id="x_warranty_expiry" data-table="tower_equipment" data-field="x_warranty_expiry" value="<?= $Page->warranty_expiry->EditValue ?>" placeholder="<?= HtmlEncode($Page->warranty_expiry->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->warranty_expiry->formatPattern()) ?>"<?= $Page->warranty_expiry->editAttributes() ?> aria-describedby="x_warranty_expiry_help">
<?= $Page->warranty_expiry->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->warranty_expiry->getErrorMessage() ?></div>
<?php if (!$Page->warranty_expiry->ReadOnly && !$Page->warranty_expiry->Disabled && !isset($Page->warranty_expiry->EditAttrs["readonly"]) && !isset($Page->warranty_expiry->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftower_equipmentedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftower_equipmentedit", "x_warranty_expiry", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
    <div id="r_status_id"<?= $Page->status_id->rowAttributes() ?>>
        <label id="elh_tower_equipment_status_id" for="x_status_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_id->caption() ?><?= $Page->status_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status_id->cellAttributes() ?>>
<span id="el_tower_equipment_status_id">
<input type="<?= $Page->status_id->getInputTextType() ?>" name="x_status_id" id="x_status_id" data-table="tower_equipment" data-field="x_status_id" value="<?= $Page->status_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->status_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->status_id->formatPattern()) ?>"<?= $Page->status_id->editAttributes() ?> aria-describedby="x_status_id_help">
<?= $Page->status_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->last_maintenance->Visible) { // last_maintenance ?>
    <div id="r_last_maintenance"<?= $Page->last_maintenance->rowAttributes() ?>>
        <label id="elh_tower_equipment_last_maintenance" for="x_last_maintenance" class="<?= $Page->LeftColumnClass ?>"><?= $Page->last_maintenance->caption() ?><?= $Page->last_maintenance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->last_maintenance->cellAttributes() ?>>
<span id="el_tower_equipment_last_maintenance">
<input type="<?= $Page->last_maintenance->getInputTextType() ?>" name="x_last_maintenance" id="x_last_maintenance" data-table="tower_equipment" data-field="x_last_maintenance" value="<?= $Page->last_maintenance->EditValue ?>" placeholder="<?= HtmlEncode($Page->last_maintenance->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->last_maintenance->formatPattern()) ?>"<?= $Page->last_maintenance->editAttributes() ?> aria-describedby="x_last_maintenance_help">
<?= $Page->last_maintenance->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->last_maintenance->getErrorMessage() ?></div>
<?php if (!$Page->last_maintenance->ReadOnly && !$Page->last_maintenance->Disabled && !isset($Page->last_maintenance->EditAttrs["readonly"]) && !isset($Page->last_maintenance->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftower_equipmentedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftower_equipmentedit", "x_last_maintenance", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->next_maintenance->Visible) { // next_maintenance ?>
    <div id="r_next_maintenance"<?= $Page->next_maintenance->rowAttributes() ?>>
        <label id="elh_tower_equipment_next_maintenance" for="x_next_maintenance" class="<?= $Page->LeftColumnClass ?>"><?= $Page->next_maintenance->caption() ?><?= $Page->next_maintenance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->next_maintenance->cellAttributes() ?>>
<span id="el_tower_equipment_next_maintenance">
<input type="<?= $Page->next_maintenance->getInputTextType() ?>" name="x_next_maintenance" id="x_next_maintenance" data-table="tower_equipment" data-field="x_next_maintenance" value="<?= $Page->next_maintenance->EditValue ?>" placeholder="<?= HtmlEncode($Page->next_maintenance->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->next_maintenance->formatPattern()) ?>"<?= $Page->next_maintenance->editAttributes() ?> aria-describedby="x_next_maintenance_help">
<?= $Page->next_maintenance->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->next_maintenance->getErrorMessage() ?></div>
<?php if (!$Page->next_maintenance->ReadOnly && !$Page->next_maintenance->Disabled && !isset($Page->next_maintenance->EditAttrs["readonly"]) && !isset($Page->next_maintenance->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftower_equipmentedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftower_equipmentedit", "x_next_maintenance", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
    <div id="r_client_id"<?= $Page->client_id->rowAttributes() ?>>
        <label id="elh_tower_equipment_client_id" for="x_client_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->client_id->caption() ?><?= $Page->client_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->client_id->cellAttributes() ?>>
<span id="el_tower_equipment_client_id">
<input type="<?= $Page->client_id->getInputTextType() ?>" name="x_client_id" id="x_client_id" data-table="tower_equipment" data-field="x_client_id" value="<?= $Page->client_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->client_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->client_id->formatPattern()) ?>"<?= $Page->client_id->editAttributes() ?> aria-describedby="x_client_id_help">
<?= $Page->client_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->client_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->installed_by->Visible) { // installed_by ?>
    <div id="r_installed_by"<?= $Page->installed_by->rowAttributes() ?>>
        <label id="elh_tower_equipment_installed_by" for="x_installed_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->installed_by->caption() ?><?= $Page->installed_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->installed_by->cellAttributes() ?>>
<span id="el_tower_equipment_installed_by">
<input type="<?= $Page->installed_by->getInputTextType() ?>" name="x_installed_by" id="x_installed_by" data-table="tower_equipment" data-field="x_installed_by" value="<?= $Page->installed_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->installed_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->installed_by->formatPattern()) ?>"<?= $Page->installed_by->editAttributes() ?> aria-describedby="x_installed_by_help">
<?= $Page->installed_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->installed_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_tower_equipment_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_tower_equipment_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="tower_equipment" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_tower_equipment_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_tower_equipment_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="tower_equipment" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_at->formatPattern()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftower_equipmentedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftower_equipmentedit", "x_created_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
    <div id="r_updated_by"<?= $Page->updated_by->rowAttributes() ?>>
        <label id="elh_tower_equipment_updated_by" for="x_updated_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_by->caption() ?><?= $Page->updated_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_by->cellAttributes() ?>>
<span id="el_tower_equipment_updated_by">
<input type="<?= $Page->updated_by->getInputTextType() ?>" name="x_updated_by" id="x_updated_by" data-table="tower_equipment" data-field="x_updated_by" value="<?= $Page->updated_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->updated_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->updated_by->formatPattern()) ?>"<?= $Page->updated_by->editAttributes() ?> aria-describedby="x_updated_by_help">
<?= $Page->updated_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_tower_equipment_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_tower_equipment_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="tower_equipment" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->updated_at->formatPattern()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftower_equipmentedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftower_equipmentedit", "x_updated_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->is_active->Visible) { // is_active ?>
    <div id="r_is_active"<?= $Page->is_active->rowAttributes() ?>>
        <label id="elh_tower_equipment_is_active" class="<?= $Page->LeftColumnClass ?>"><?= $Page->is_active->caption() ?><?= $Page->is_active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->is_active->cellAttributes() ?>>
<span id="el_tower_equipment_is_active">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->is_active->isInvalidClass() ?>" data-table="tower_equipment" data-field="x_is_active" data-boolean name="x_is_active" id="x_is_active" value="1"<?= ConvertToBool($Page->is_active->CurrentValue) ? " checked" : "" ?><?= $Page->is_active->editAttributes() ?> aria-describedby="x_is_active_help">
    <div class="invalid-feedback"><?= $Page->is_active->getErrorMessage() ?></div>
</div>
<?= $Page->is_active->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <div id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <label id="elh_tower_equipment_notes" for="x_notes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notes->caption() ?><?= $Page->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notes->cellAttributes() ?>>
<span id="el_tower_equipment_notes">
<textarea data-table="tower_equipment" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notes->getPlaceHolder()) ?>"<?= $Page->notes->editAttributes() ?> aria-describedby="x_notes_help"><?= $Page->notes->EditValue ?></textarea>
<?= $Page->notes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="ftower_equipmentedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="ftower_equipmentedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("tower_equipment");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
