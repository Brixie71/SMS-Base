<?php

namespace PHPMaker2024\CMS;

// Page object
$SupportTicketsView = &$Page;
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
<form name="fsupport_ticketsview" id="fsupport_ticketsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { support_tickets: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fsupport_ticketsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsupport_ticketsview")
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
<input type="hidden" name="t" value="support_tickets">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->ticket_id->Visible) { // ticket_id ?>
    <tr id="r_ticket_id"<?= $Page->ticket_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_ticket_id"><?= $Page->ticket_id->caption() ?></span></td>
        <td data-name="ticket_id"<?= $Page->ticket_id->cellAttributes() ?>>
<span id="el_support_tickets_ticket_id">
<span<?= $Page->ticket_id->viewAttributes() ?>>
<?= $Page->ticket_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
    <tr id="r_client_id"<?= $Page->client_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_client_id"><?= $Page->client_id->caption() ?></span></td>
        <td data-name="client_id"<?= $Page->client_id->cellAttributes() ?>>
<span id="el_support_tickets_client_id">
<span<?= $Page->client_id->viewAttributes() ?>>
<?= $Page->client_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
    <tr id="r_equipment_id"<?= $Page->equipment_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_equipment_id"><?= $Page->equipment_id->caption() ?></span></td>
        <td data-name="equipment_id"<?= $Page->equipment_id->cellAttributes() ?>>
<span id="el_support_tickets_equipment_id">
<span<?= $Page->equipment_id->viewAttributes() ?>>
<?= $Page->equipment_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->subject->Visible) { // subject ?>
    <tr id="r_subject"<?= $Page->subject->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_subject"><?= $Page->subject->caption() ?></span></td>
        <td data-name="subject"<?= $Page->subject->cellAttributes() ?>>
<span id="el_support_tickets_subject">
<span<?= $Page->subject->viewAttributes() ?>>
<?= $Page->subject->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_support_tickets_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
    <tr id="r_priority"<?= $Page->priority->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_priority"><?= $Page->priority->caption() ?></span></td>
        <td data-name="priority"<?= $Page->priority->cellAttributes() ?>>
<span id="el_support_tickets_priority">
<span<?= $Page->priority->viewAttributes() ?>>
<?= $Page->priority->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->category->Visible) { // category ?>
    <tr id="r_category"<?= $Page->category->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_category"><?= $Page->category->caption() ?></span></td>
        <td data-name="category"<?= $Page->category->cellAttributes() ?>>
<span id="el_support_tickets_category">
<span<?= $Page->category->viewAttributes() ?>>
<?= $Page->category->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->submitted_by->Visible) { // submitted_by ?>
    <tr id="r_submitted_by"<?= $Page->submitted_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_submitted_by"><?= $Page->submitted_by->caption() ?></span></td>
        <td data-name="submitted_by"<?= $Page->submitted_by->cellAttributes() ?>>
<span id="el_support_tickets_submitted_by">
<span<?= $Page->submitted_by->viewAttributes() ?>>
<?= $Page->submitted_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->assigned_to->Visible) { // assigned_to ?>
    <tr id="r_assigned_to"<?= $Page->assigned_to->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_assigned_to"><?= $Page->assigned_to->caption() ?></span></td>
        <td data-name="assigned_to"<?= $Page->assigned_to->cellAttributes() ?>>
<span id="el_support_tickets_assigned_to">
<span<?= $Page->assigned_to->viewAttributes() ?>>
<?= $Page->assigned_to->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_support_tickets_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_support_tickets_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->resolution->Visible) { // resolution ?>
    <tr id="r_resolution"<?= $Page->resolution->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_resolution"><?= $Page->resolution->caption() ?></span></td>
        <td data-name="resolution"<?= $Page->resolution->cellAttributes() ?>>
<span id="el_support_tickets_resolution">
<span<?= $Page->resolution->viewAttributes() ?>>
<?= $Page->resolution->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->closed_at->Visible) { // closed_at ?>
    <tr id="r_closed_at"<?= $Page->closed_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_closed_at"><?= $Page->closed_at->caption() ?></span></td>
        <td data-name="closed_at"<?= $Page->closed_at->cellAttributes() ?>>
<span id="el_support_tickets_closed_at">
<span<?= $Page->closed_at->viewAttributes() ?>>
<?= $Page->closed_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->response_time_minutes->Visible) { // response_time_minutes ?>
    <tr id="r_response_time_minutes"<?= $Page->response_time_minutes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_response_time_minutes"><?= $Page->response_time_minutes->caption() ?></span></td>
        <td data-name="response_time_minutes"<?= $Page->response_time_minutes->cellAttributes() ?>>
<span id="el_support_tickets_response_time_minutes">
<span<?= $Page->response_time_minutes->viewAttributes() ?>>
<?= $Page->response_time_minutes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->resolution_time_minutes->Visible) { // resolution_time_minutes ?>
    <tr id="r_resolution_time_minutes"<?= $Page->resolution_time_minutes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_resolution_time_minutes"><?= $Page->resolution_time_minutes->caption() ?></span></td>
        <td data-name="resolution_time_minutes"<?= $Page->resolution_time_minutes->cellAttributes() ?>>
<span id="el_support_tickets_resolution_time_minutes">
<span<?= $Page->resolution_time_minutes->viewAttributes() ?>>
<?= $Page->resolution_time_minutes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sla_compliant->Visible) { // sla_compliant ?>
    <tr id="r_sla_compliant"<?= $Page->sla_compliant->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_sla_compliant"><?= $Page->sla_compliant->caption() ?></span></td>
        <td data-name="sla_compliant"<?= $Page->sla_compliant->cellAttributes() ?>>
<span id="el_support_tickets_sla_compliant">
<span<?= $Page->sla_compliant->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->sla_compliant->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->closed_by->Visible) { // closed_by ?>
    <tr id="r_closed_by"<?= $Page->closed_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_support_tickets_closed_by"><?= $Page->closed_by->caption() ?></span></td>
        <td data-name="closed_by"<?= $Page->closed_by->cellAttributes() ?>>
<span id="el_support_tickets_closed_by">
<span<?= $Page->closed_by->viewAttributes() ?>>
<?= $Page->closed_by->getViewValue() ?></span>
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
