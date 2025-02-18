<?php

namespace PHPMaker2024\CMS;

// Page object
$ServiceRequestsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { service_requests: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fservice_requestsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fservice_requestsdelete")
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
<form name="fservice_requestsdelete" id="fservice_requestsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="service_requests">
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
<?php if ($Page->request_id->Visible) { // request_id ?>
        <th class="<?= $Page->request_id->headerCellClass() ?>"><span id="elh_service_requests_request_id" class="service_requests_request_id"><?= $Page->request_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
        <th class="<?= $Page->client_id->headerCellClass() ?>"><span id="elh_service_requests_client_id" class="service_requests_client_id"><?= $Page->client_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
        <th class="<?= $Page->equipment_id->headerCellClass() ?>"><span id="elh_service_requests_equipment_id" class="service_requests_equipment_id"><?= $Page->equipment_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->request_type->Visible) { // request_type ?>
        <th class="<?= $Page->request_type->headerCellClass() ?>"><span id="elh_service_requests_request_type" class="service_requests_request_type"><?= $Page->request_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
        <th class="<?= $Page->priority->headerCellClass() ?>"><span id="elh_service_requests_priority" class="service_requests_priority"><?= $Page->priority->caption() ?></span></th>
<?php } ?>
<?php if ($Page->requested_by->Visible) { // requested_by ?>
        <th class="<?= $Page->requested_by->headerCellClass() ?>"><span id="elh_service_requests_requested_by" class="service_requests_requested_by"><?= $Page->requested_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->requested_date->Visible) { // requested_date ?>
        <th class="<?= $Page->requested_date->headerCellClass() ?>"><span id="elh_service_requests_requested_date" class="service_requests_requested_date"><?= $Page->requested_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->scheduled_date->Visible) { // scheduled_date ?>
        <th class="<?= $Page->scheduled_date->headerCellClass() ?>"><span id="elh_service_requests_scheduled_date" class="service_requests_scheduled_date"><?= $Page->scheduled_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->completion_date->Visible) { // completion_date ?>
        <th class="<?= $Page->completion_date->headerCellClass() ?>"><span id="elh_service_requests_completion_date" class="service_requests_completion_date"><?= $Page->completion_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_service_requests_status" class="service_requests_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->assigned_to->Visible) { // assigned_to ?>
        <th class="<?= $Page->assigned_to->headerCellClass() ?>"><span id="elh_service_requests_assigned_to" class="service_requests_assigned_to"><?= $Page->assigned_to->caption() ?></span></th>
<?php } ?>
<?php if ($Page->response_time_minutes->Visible) { // response_time_minutes ?>
        <th class="<?= $Page->response_time_minutes->headerCellClass() ?>"><span id="elh_service_requests_response_time_minutes" class="service_requests_response_time_minutes"><?= $Page->response_time_minutes->caption() ?></span></th>
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
<?php if ($Page->request_id->Visible) { // request_id ?>
        <td<?= $Page->request_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
        <td<?= $Page->client_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->client_id->viewAttributes() ?>>
<?= $Page->client_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
        <td<?= $Page->equipment_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->equipment_id->viewAttributes() ?>>
<?= $Page->equipment_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->request_type->Visible) { // request_type ?>
        <td<?= $Page->request_type->cellAttributes() ?>>
<span id="">
<span<?= $Page->request_type->viewAttributes() ?>>
<?= $Page->request_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
        <td<?= $Page->priority->cellAttributes() ?>>
<span id="">
<span<?= $Page->priority->viewAttributes() ?>>
<?= $Page->priority->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->requested_by->Visible) { // requested_by ?>
        <td<?= $Page->requested_by->cellAttributes() ?>>
<span id="">
<span<?= $Page->requested_by->viewAttributes() ?>>
<?= $Page->requested_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->requested_date->Visible) { // requested_date ?>
        <td<?= $Page->requested_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->requested_date->viewAttributes() ?>>
<?= $Page->requested_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->scheduled_date->Visible) { // scheduled_date ?>
        <td<?= $Page->scheduled_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->scheduled_date->viewAttributes() ?>>
<?= $Page->scheduled_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->completion_date->Visible) { // completion_date ?>
        <td<?= $Page->completion_date->cellAttributes() ?>>
<span id="">
<span<?= $Page->completion_date->viewAttributes() ?>>
<?= $Page->completion_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->assigned_to->Visible) { // assigned_to ?>
        <td<?= $Page->assigned_to->cellAttributes() ?>>
<span id="">
<span<?= $Page->assigned_to->viewAttributes() ?>>
<?= $Page->assigned_to->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->response_time_minutes->Visible) { // response_time_minutes ?>
        <td<?= $Page->response_time_minutes->cellAttributes() ?>>
<span id="">
<span<?= $Page->response_time_minutes->viewAttributes() ?>>
<?= $Page->response_time_minutes->getViewValue() ?></span>
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
