<?php

namespace PHPMaker2024\AMS;

// Page object
$TowersEdit = &$Page;
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="ftowersedit" id="ftowersedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { towers: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var ftowersedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ftowersedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["tower_id", [fields.tower_id.visible && fields.tower_id.required ? ew.Validators.required(fields.tower_id.caption) : null], fields.tower_id.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["code", [fields.code.visible && fields.code.required ? ew.Validators.required(fields.code.caption) : null], fields.code.isInvalid],
            ["type_id", [fields.type_id.visible && fields.type_id.required ? ew.Validators.required(fields.type_id.caption) : null, ew.Validators.integer], fields.type_id.isInvalid],
            ["status_id", [fields.status_id.visible && fields.status_id.required ? ew.Validators.required(fields.status_id.caption) : null, ew.Validators.integer], fields.status_id.isInvalid],
            ["height", [fields.height.visible && fields.height.required ? ew.Validators.required(fields.height.caption) : null, ew.Validators.float], fields.height.isInvalid],
            ["latitude", [fields.latitude.visible && fields.latitude.required ? ew.Validators.required(fields.latitude.caption) : null, ew.Validators.float], fields.latitude.isInvalid],
            ["longitude", [fields.longitude.visible && fields.longitude.required ? ew.Validators.required(fields.longitude.caption) : null, ew.Validators.float], fields.longitude.isInvalid],
            ["address", [fields.address.visible && fields.address.required ? ew.Validators.required(fields.address.caption) : null], fields.address.isInvalid],
            ["city", [fields.city.visible && fields.city.required ? ew.Validators.required(fields.city.caption) : null], fields.city.isInvalid],
            ["region", [fields.region.visible && fields.region.required ? ew.Validators.required(fields.region.caption) : null], fields.region.isInvalid],
            ["installation_date", [fields.installation_date.visible && fields.installation_date.required ? ew.Validators.required(fields.installation_date.caption) : null, ew.Validators.datetime(fields.installation_date.clientFormatPattern)], fields.installation_date.isInvalid],
            ["last_maintenance", [fields.last_maintenance.visible && fields.last_maintenance.required ? ew.Validators.required(fields.last_maintenance.caption) : null, ew.Validators.datetime(fields.last_maintenance.clientFormatPattern)], fields.last_maintenance.isInvalid],
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
<input type="hidden" name="t" value="towers">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->tower_id->Visible) { // tower_id ?>
    <div id="r_tower_id"<?= $Page->tower_id->rowAttributes() ?>>
        <label id="elh_towers_tower_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tower_id->caption() ?><?= $Page->tower_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tower_id->cellAttributes() ?>>
<span id="el_towers_tower_id">
<span<?= $Page->tower_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->tower_id->getDisplayValue($Page->tower_id->EditValue))) ?>"></span>
<input type="hidden" data-table="towers" data-field="x_tower_id" data-hidden="1" name="x_tower_id" id="x_tower_id" value="<?= HtmlEncode($Page->tower_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_towers_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_towers_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="towers" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->code->Visible) { // code ?>
    <div id="r_code"<?= $Page->code->rowAttributes() ?>>
        <label id="elh_towers_code" for="x_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->code->caption() ?><?= $Page->code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->code->cellAttributes() ?>>
<span id="el_towers_code">
<input type="<?= $Page->code->getInputTextType() ?>" name="x_code" id="x_code" data-table="towers" data-field="x_code" value="<?= $Page->code->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->code->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->code->formatPattern()) ?>"<?= $Page->code->editAttributes() ?> aria-describedby="x_code_help">
<?= $Page->code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->type_id->Visible) { // type_id ?>
    <div id="r_type_id"<?= $Page->type_id->rowAttributes() ?>>
        <label id="elh_towers_type_id" for="x_type_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type_id->caption() ?><?= $Page->type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->type_id->cellAttributes() ?>>
<span id="el_towers_type_id">
<input type="<?= $Page->type_id->getInputTextType() ?>" name="x_type_id" id="x_type_id" data-table="towers" data-field="x_type_id" value="<?= $Page->type_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->type_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->type_id->formatPattern()) ?>"<?= $Page->type_id->editAttributes() ?> aria-describedby="x_type_id_help">
<?= $Page->type_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->type_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
    <div id="r_status_id"<?= $Page->status_id->rowAttributes() ?>>
        <label id="elh_towers_status_id" for="x_status_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status_id->caption() ?><?= $Page->status_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status_id->cellAttributes() ?>>
<span id="el_towers_status_id">
<input type="<?= $Page->status_id->getInputTextType() ?>" name="x_status_id" id="x_status_id" data-table="towers" data-field="x_status_id" value="<?= $Page->status_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->status_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->status_id->formatPattern()) ?>"<?= $Page->status_id->editAttributes() ?> aria-describedby="x_status_id_help">
<?= $Page->status_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
    <div id="r_height"<?= $Page->height->rowAttributes() ?>>
        <label id="elh_towers_height" for="x_height" class="<?= $Page->LeftColumnClass ?>"><?= $Page->height->caption() ?><?= $Page->height->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->height->cellAttributes() ?>>
<span id="el_towers_height">
<input type="<?= $Page->height->getInputTextType() ?>" name="x_height" id="x_height" data-table="towers" data-field="x_height" value="<?= $Page->height->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->height->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->height->formatPattern()) ?>"<?= $Page->height->editAttributes() ?> aria-describedby="x_height_help">
<?= $Page->height->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->height->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->latitude->Visible) { // latitude ?>
    <div id="r_latitude"<?= $Page->latitude->rowAttributes() ?>>
        <label id="elh_towers_latitude" for="x_latitude" class="<?= $Page->LeftColumnClass ?>"><?= $Page->latitude->caption() ?><?= $Page->latitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->latitude->cellAttributes() ?>>
<span id="el_towers_latitude">
<input type="<?= $Page->latitude->getInputTextType() ?>" name="x_latitude" id="x_latitude" data-table="towers" data-field="x_latitude" value="<?= $Page->latitude->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->latitude->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->latitude->formatPattern()) ?>"<?= $Page->latitude->editAttributes() ?> aria-describedby="x_latitude_help">
<?= $Page->latitude->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->latitude->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->longitude->Visible) { // longitude ?>
    <div id="r_longitude"<?= $Page->longitude->rowAttributes() ?>>
        <label id="elh_towers_longitude" for="x_longitude" class="<?= $Page->LeftColumnClass ?>"><?= $Page->longitude->caption() ?><?= $Page->longitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->longitude->cellAttributes() ?>>
<span id="el_towers_longitude">
<input type="<?= $Page->longitude->getInputTextType() ?>" name="x_longitude" id="x_longitude" data-table="towers" data-field="x_longitude" value="<?= $Page->longitude->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->longitude->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->longitude->formatPattern()) ?>"<?= $Page->longitude->editAttributes() ?> aria-describedby="x_longitude_help">
<?= $Page->longitude->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->longitude->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <div id="r_address"<?= $Page->address->rowAttributes() ?>>
        <label id="elh_towers_address" for="x_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address->caption() ?><?= $Page->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address->cellAttributes() ?>>
<span id="el_towers_address">
<textarea data-table="towers" data-field="x_address" name="x_address" id="x_address" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->address->getPlaceHolder()) ?>"<?= $Page->address->editAttributes() ?> aria-describedby="x_address_help"><?= $Page->address->EditValue ?></textarea>
<?= $Page->address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
    <div id="r_city"<?= $Page->city->rowAttributes() ?>>
        <label id="elh_towers_city" for="x_city" class="<?= $Page->LeftColumnClass ?>"><?= $Page->city->caption() ?><?= $Page->city->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->city->cellAttributes() ?>>
<span id="el_towers_city">
<input type="<?= $Page->city->getInputTextType() ?>" name="x_city" id="x_city" data-table="towers" data-field="x_city" value="<?= $Page->city->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->city->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->city->formatPattern()) ?>"<?= $Page->city->editAttributes() ?> aria-describedby="x_city_help">
<?= $Page->city->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->city->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->region->Visible) { // region ?>
    <div id="r_region"<?= $Page->region->rowAttributes() ?>>
        <label id="elh_towers_region" for="x_region" class="<?= $Page->LeftColumnClass ?>"><?= $Page->region->caption() ?><?= $Page->region->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->region->cellAttributes() ?>>
<span id="el_towers_region">
<input type="<?= $Page->region->getInputTextType() ?>" name="x_region" id="x_region" data-table="towers" data-field="x_region" value="<?= $Page->region->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->region->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->region->formatPattern()) ?>"<?= $Page->region->editAttributes() ?> aria-describedby="x_region_help">
<?= $Page->region->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->region->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->installation_date->Visible) { // installation_date ?>
    <div id="r_installation_date"<?= $Page->installation_date->rowAttributes() ?>>
        <label id="elh_towers_installation_date" for="x_installation_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->installation_date->caption() ?><?= $Page->installation_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->installation_date->cellAttributes() ?>>
<span id="el_towers_installation_date">
<input type="<?= $Page->installation_date->getInputTextType() ?>" name="x_installation_date" id="x_installation_date" data-table="towers" data-field="x_installation_date" value="<?= $Page->installation_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->installation_date->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->installation_date->formatPattern()) ?>"<?= $Page->installation_date->editAttributes() ?> aria-describedby="x_installation_date_help">
<?= $Page->installation_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->installation_date->getErrorMessage() ?></div>
<?php if (!$Page->installation_date->ReadOnly && !$Page->installation_date->Disabled && !isset($Page->installation_date->EditAttrs["readonly"]) && !isset($Page->installation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftowersedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftowersedit", "x_installation_date", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->last_maintenance->Visible) { // last_maintenance ?>
    <div id="r_last_maintenance"<?= $Page->last_maintenance->rowAttributes() ?>>
        <label id="elh_towers_last_maintenance" for="x_last_maintenance" class="<?= $Page->LeftColumnClass ?>"><?= $Page->last_maintenance->caption() ?><?= $Page->last_maintenance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->last_maintenance->cellAttributes() ?>>
<span id="el_towers_last_maintenance">
<input type="<?= $Page->last_maintenance->getInputTextType() ?>" name="x_last_maintenance" id="x_last_maintenance" data-table="towers" data-field="x_last_maintenance" value="<?= $Page->last_maintenance->EditValue ?>" placeholder="<?= HtmlEncode($Page->last_maintenance->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->last_maintenance->formatPattern()) ?>"<?= $Page->last_maintenance->editAttributes() ?> aria-describedby="x_last_maintenance_help">
<?= $Page->last_maintenance->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->last_maintenance->getErrorMessage() ?></div>
<?php if (!$Page->last_maintenance->ReadOnly && !$Page->last_maintenance->Disabled && !isset($Page->last_maintenance->EditAttrs["readonly"]) && !isset($Page->last_maintenance->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftowersedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftowersedit", "x_last_maintenance", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_towers_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_towers_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="towers" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_towers_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_towers_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="towers" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_at->formatPattern()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftowersedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftowersedit", "x_created_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
    <div id="r_updated_by"<?= $Page->updated_by->rowAttributes() ?>>
        <label id="elh_towers_updated_by" for="x_updated_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_by->caption() ?><?= $Page->updated_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_by->cellAttributes() ?>>
<span id="el_towers_updated_by">
<input type="<?= $Page->updated_by->getInputTextType() ?>" name="x_updated_by" id="x_updated_by" data-table="towers" data-field="x_updated_by" value="<?= $Page->updated_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->updated_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->updated_by->formatPattern()) ?>"<?= $Page->updated_by->editAttributes() ?> aria-describedby="x_updated_by_help">
<?= $Page->updated_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_towers_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_towers_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="towers" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->updated_at->formatPattern()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftowersedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftowersedit", "x_updated_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <div id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <label id="elh_towers_notes" for="x_notes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notes->caption() ?><?= $Page->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notes->cellAttributes() ?>>
<span id="el_towers_notes">
<textarea data-table="towers" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notes->getPlaceHolder()) ?>"<?= $Page->notes->editAttributes() ?> aria-describedby="x_notes_help"><?= $Page->notes->EditValue ?></textarea>
<?= $Page->notes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="ftowersedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="ftowersedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("towers");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
