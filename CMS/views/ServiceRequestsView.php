<?php

namespace PHPMaker2024\CMS;

// Page object
$ServiceRequestsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<form name="fservice_requestsview" id="fservice_requestsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { service_requests: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fservice_requestsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fservice_requestsview")
        .setPageId("view")
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
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="service_requests">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->request_id->Visible) { // request_id ?>
    <tr id="r_request_id"<?= $Page->request_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_request_id"><?= $Page->request_id->caption() ?></span></td>
        <td data-name="request_id"<?= $Page->request_id->cellAttributes() ?>>
<span id="el_service_requests_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
    <tr id="r_client_id"<?= $Page->client_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_client_id"><?= $Page->client_id->caption() ?></span></td>
        <td data-name="client_id"<?= $Page->client_id->cellAttributes() ?>>
<span id="el_service_requests_client_id">
<span<?= $Page->client_id->viewAttributes() ?>>
<?= $Page->client_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
    <tr id="r_equipment_id"<?= $Page->equipment_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_equipment_id"><?= $Page->equipment_id->caption() ?></span></td>
        <td data-name="equipment_id"<?= $Page->equipment_id->cellAttributes() ?>>
<span id="el_service_requests_equipment_id">
<span<?= $Page->equipment_id->viewAttributes() ?>>
<?= $Page->equipment_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->request_type->Visible) { // request_type ?>
    <tr id="r_request_type"<?= $Page->request_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_request_type"><?= $Page->request_type->caption() ?></span></td>
        <td data-name="request_type"<?= $Page->request_type->cellAttributes() ?>>
<span id="el_service_requests_request_type">
<span<?= $Page->request_type->viewAttributes() ?>>
<?= $Page->request_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
    <tr id="r_priority"<?= $Page->priority->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_priority"><?= $Page->priority->caption() ?></span></td>
        <td data-name="priority"<?= $Page->priority->cellAttributes() ?>>
<span id="el_service_requests_priority">
<span<?= $Page->priority->viewAttributes() ?>>
<?= $Page->priority->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_service_requests_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->requested_by->Visible) { // requested_by ?>
    <tr id="r_requested_by"<?= $Page->requested_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_requested_by"><?= $Page->requested_by->caption() ?></span></td>
        <td data-name="requested_by"<?= $Page->requested_by->cellAttributes() ?>>
<span id="el_service_requests_requested_by">
<span<?= $Page->requested_by->viewAttributes() ?>>
<?= $Page->requested_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->requested_date->Visible) { // requested_date ?>
    <tr id="r_requested_date"<?= $Page->requested_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_requested_date"><?= $Page->requested_date->caption() ?></span></td>
        <td data-name="requested_date"<?= $Page->requested_date->cellAttributes() ?>>
<span id="el_service_requests_requested_date">
<span<?= $Page->requested_date->viewAttributes() ?>>
<?= $Page->requested_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->scheduled_date->Visible) { // scheduled_date ?>
    <tr id="r_scheduled_date"<?= $Page->scheduled_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_scheduled_date"><?= $Page->scheduled_date->caption() ?></span></td>
        <td data-name="scheduled_date"<?= $Page->scheduled_date->cellAttributes() ?>>
<span id="el_service_requests_scheduled_date">
<span<?= $Page->scheduled_date->viewAttributes() ?>>
<?= $Page->scheduled_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->completion_date->Visible) { // completion_date ?>
    <tr id="r_completion_date"<?= $Page->completion_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_completion_date"><?= $Page->completion_date->caption() ?></span></td>
        <td data-name="completion_date"<?= $Page->completion_date->cellAttributes() ?>>
<span id="el_service_requests_completion_date">
<span<?= $Page->completion_date->viewAttributes() ?>>
<?= $Page->completion_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_service_requests_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->assigned_to->Visible) { // assigned_to ?>
    <tr id="r_assigned_to"<?= $Page->assigned_to->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_assigned_to"><?= $Page->assigned_to->caption() ?></span></td>
        <td data-name="assigned_to"<?= $Page->assigned_to->cellAttributes() ?>>
<span id="el_service_requests_assigned_to">
<span<?= $Page->assigned_to->viewAttributes() ?>>
<?= $Page->assigned_to->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->resolution->Visible) { // resolution ?>
    <tr id="r_resolution"<?= $Page->resolution->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_resolution"><?= $Page->resolution->caption() ?></span></td>
        <td data-name="resolution"<?= $Page->resolution->cellAttributes() ?>>
<span id="el_service_requests_resolution">
<span<?= $Page->resolution->viewAttributes() ?>>
<?= $Page->resolution->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->response_time_minutes->Visible) { // response_time_minutes ?>
    <tr id="r_response_time_minutes"<?= $Page->response_time_minutes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_response_time_minutes"><?= $Page->response_time_minutes->caption() ?></span></td>
        <td data-name="response_time_minutes"<?= $Page->response_time_minutes->cellAttributes() ?>>
<span id="el_service_requests_response_time_minutes">
<span<?= $Page->response_time_minutes->viewAttributes() ?>>
<?= $Page->response_time_minutes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <tr id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_service_requests_notes"><?= $Page->notes->caption() ?></span></td>
        <td data-name="notes"<?= $Page->notes->cellAttributes() ?>>
<span id="el_service_requests_notes">
<span<?= $Page->notes->viewAttributes() ?>>
<?= $Page->notes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
