<?php

namespace PHPMaker2024\AMS;

// Page object
$TowersDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { towers: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var ftowersdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ftowersdelete")
        .setPageId("delete")
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
<form name="ftowersdelete" id="ftowersdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="towers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->tower_id->Visible) { // tower_id ?>
        <th class="<?= $Page->tower_id->headerCellClass() ?>"><span id="elh_towers_tower_id" class="towers_tower_id"><?= $Page->tower_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_towers_name" class="towers_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->code->Visible) { // code ?>
        <th class="<?= $Page->code->headerCellClass() ?>"><span id="elh_towers_code" class="towers_code"><?= $Page->code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type_id->Visible) { // type_id ?>
        <th class="<?= $Page->type_id->headerCellClass() ?>"><span id="elh_towers_type_id" class="towers_type_id"><?= $Page->type_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
        <th class="<?= $Page->status_id->headerCellClass() ?>"><span id="elh_towers_status_id" class="towers_status_id"><?= $Page->status_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
        <th class="<?= $Page->height->headerCellClass() ?>"><span id="elh_towers_height" class="towers_height"><?= $Page->height->caption() ?></span></th>
<?php } ?>
<?php if ($Page->latitude->Visible) { // latitude ?>
        <th class="<?= $Page->latitude->headerCellClass() ?>"><span id="elh_towers_latitude" class="towers_latitude"><?= $Page->latitude->caption() ?></span></th>
<?php } ?>
<?php if ($Page->longitude->Visible) { // longitude ?>
        <th class="<?= $Page->longitude->headerCellClass() ?>"><span id="elh_towers_longitude" class="towers_longitude"><?= $Page->longitude->caption() ?></span></th>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
        <th class="<?= $Page->city->headerCellClass() ?>"><span id="elh_towers_city" class="towers_city"><?= $Page->city->caption() ?></span></th>
<?php } ?>
<?php if ($Page->region->Visible) { // region ?>
        <th class="<?= $Page->region->headerCellClass() ?>"><span id="elh_towers_region" class="towers_region"><?= $Page->region->caption() ?></span></th>
<?php } ?>
<?php if ($Page->installation_date->Visible) { // installation_date ?>
        <th class="<?= $Page->installation_date->headerCellClass() ?>"><span id="elh_towers_installation_date" class="towers_installation_date"><?= $Page->installation_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->last_maintenance->Visible) { // last_maintenance ?>
        <th class="<?= $Page->last_maintenance->headerCellClass() ?>"><span id="elh_towers_last_maintenance" class="towers_last_maintenance"><?= $Page->last_maintenance->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_towers_created_by" class="towers_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_towers_created_at" class="towers_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
        <th class="<?= $Page->updated_by->headerCellClass() ?>"><span id="elh_towers_updated_by" class="towers_updated_by"><?= $Page->updated_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_towers_updated_at" class="towers_updated_at"><?= $Page->updated_at->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while ($Page->fetch()) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = RowType::VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->CurrentRow);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->tower_id->Visible) { // tower_id ?>
        <td<?= $Page->tower_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->tower_id->viewAttributes() ?>>
<?= $Page->tower_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <td<?= $Page->name->cellAttributes() ?>>
<span id="">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->code->Visible) { // code ?>
        <td<?= $Page->code->cellAttributes() ?>>
<span id="">
<span<?= $Page->code->viewAttributes() ?>>
<?= $Page->code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->type_id->Visible) { // type_id ?>
        <td<?= $Page->type_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->type_id->viewAttributes() ?>>
<?= $Page->type_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
        <td<?= $Page->status_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->status_id->viewAttributes() ?>>
<?= $Page->status_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->height->Visible) { // height ?>
        <td<?= $Page->height->cellAttributes() ?>>
<span id="">
<span<?= $Page->height->viewAttributes() ?>>
<?= $Page->height->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->latitude->Visible) { // latitude ?>
        <td<?= $Page->latitude->cellAttributes() ?>>
<span id="">
<span<?= $Page->latitude->viewAttributes() ?>>
<?= $Page->latitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->longitude->Visible) { // longitude ?>
        <td<?= $Page->longitude->cellAttributes() ?>>
<span id="">
<span<?= $Page->longitude->viewAttributes() ?>>
<?= $Page->longitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
        <td<?= $Page->city->cellAttributes() ?>>
<span id="">
<span<?= $Page->city->viewAttributes() ?>>
<?= $Page->city->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->region->Visible) { // region ?>
        <td<?= $Page->region->cellAttributes() ?>>
<span id="">
<span<?= $Page->region->viewAttributes() ?>>
<?= $Page->region->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->installation_date->Visible) { // installation_date ?>
        <td<?= $Page->installation_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->installation_date->viewAttributes() ?>>
<?= $Page->installation_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->last_maintenance->Visible) { // last_maintenance ?>
        <td<?= $Page->last_maintenance->cellAttributes() ?>>
<span id="">
<span<?= $Page->last_maintenance->viewAttributes() ?>>
<?= $Page->last_maintenance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <td<?= $Page->created_by->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <td<?= $Page->created_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
        <td<?= $Page->updated_by->cellAttributes() ?>>
<span id="">
<span<?= $Page->updated_by->viewAttributes() ?>>
<?= $Page->updated_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td<?= $Page->updated_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
}
$Page->Recordset?->free();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
