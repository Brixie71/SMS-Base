<?php

namespace PHPMaker2024\CMS;

// Page object
$SupportTicketsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { support_tickets: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fsupport_ticketsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsupport_ticketsdelete")
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
<form name="fsupport_ticketsdelete" id="fsupport_ticketsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="support_tickets">
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
<?php if ($Page->ticket_id->Visible) { // ticket_id ?>
        <th class="<?= $Page->ticket_id->headerCellClass() ?>"><span id="elh_support_tickets_ticket_id" class="support_tickets_ticket_id"><?= $Page->ticket_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
        <th class="<?= $Page->client_id->headerCellClass() ?>"><span id="elh_support_tickets_client_id" class="support_tickets_client_id"><?= $Page->client_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
        <th class="<?= $Page->equipment_id->headerCellClass() ?>"><span id="elh_support_tickets_equipment_id" class="support_tickets_equipment_id"><?= $Page->equipment_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->subject->Visible) { // subject ?>
        <th class="<?= $Page->subject->headerCellClass() ?>"><span id="elh_support_tickets_subject" class="support_tickets_subject"><?= $Page->subject->caption() ?></span></th>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
        <th class="<?= $Page->priority->headerCellClass() ?>"><span id="elh_support_tickets_priority" class="support_tickets_priority"><?= $Page->priority->caption() ?></span></th>
<?php } ?>
<?php if ($Page->category->Visible) { // category ?>
        <th class="<?= $Page->category->headerCellClass() ?>"><span id="elh_support_tickets_category" class="support_tickets_category"><?= $Page->category->caption() ?></span></th>
<?php } ?>
<?php if ($Page->submitted_by->Visible) { // submitted_by ?>
        <th class="<?= $Page->submitted_by->headerCellClass() ?>"><span id="elh_support_tickets_submitted_by" class="support_tickets_submitted_by"><?= $Page->submitted_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->assigned_to->Visible) { // assigned_to ?>
        <th class="<?= $Page->assigned_to->headerCellClass() ?>"><span id="elh_support_tickets_assigned_to" class="support_tickets_assigned_to"><?= $Page->assigned_to->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_support_tickets_created_at" class="support_tickets_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_support_tickets_status" class="support_tickets_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->closed_at->Visible) { // closed_at ?>
        <th class="<?= $Page->closed_at->headerCellClass() ?>"><span id="elh_support_tickets_closed_at" class="support_tickets_closed_at"><?= $Page->closed_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->response_time_minutes->Visible) { // response_time_minutes ?>
        <th class="<?= $Page->response_time_minutes->headerCellClass() ?>"><span id="elh_support_tickets_response_time_minutes" class="support_tickets_response_time_minutes"><?= $Page->response_time_minutes->caption() ?></span></th>
<?php } ?>
<?php if ($Page->resolution_time_minutes->Visible) { // resolution_time_minutes ?>
        <th class="<?= $Page->resolution_time_minutes->headerCellClass() ?>"><span id="elh_support_tickets_resolution_time_minutes" class="support_tickets_resolution_time_minutes"><?= $Page->resolution_time_minutes->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sla_compliant->Visible) { // sla_compliant ?>
        <th class="<?= $Page->sla_compliant->headerCellClass() ?>"><span id="elh_support_tickets_sla_compliant" class="support_tickets_sla_compliant"><?= $Page->sla_compliant->caption() ?></span></th>
<?php } ?>
<?php if ($Page->closed_by->Visible) { // closed_by ?>
        <th class="<?= $Page->closed_by->headerCellClass() ?>"><span id="elh_support_tickets_closed_by" class="support_tickets_closed_by"><?= $Page->closed_by->caption() ?></span></th>
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
<?php if ($Page->ticket_id->Visible) { // ticket_id ?>
        <td<?= $Page->ticket_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->ticket_id->viewAttributes() ?>>
<?= $Page->ticket_id->getViewValue() ?></span>
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
<?php if ($Page->subject->Visible) { // subject ?>
        <td<?= $Page->subject->cellAttributes() ?>>
<span id="">
<span<?= $Page->subject->viewAttributes() ?>>
<?= $Page->subject->getViewValue() ?></span>
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
<?php if ($Page->category->Visible) { // category ?>
        <td<?= $Page->category->cellAttributes() ?>>
<span id="">
<span<?= $Page->category->viewAttributes() ?>>
<?= $Page->category->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->submitted_by->Visible) { // submitted_by ?>
        <td<?= $Page->submitted_by->cellAttributes() ?>>
<span id="">
<span<?= $Page->submitted_by->viewAttributes() ?>>
<?= $Page->submitted_by->getViewValue() ?></span>
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
<?php if ($Page->created_at->Visible) { // created_at ?>
        <td<?= $Page->created_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
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
<?php if ($Page->closed_at->Visible) { // closed_at ?>
        <td<?= $Page->closed_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->closed_at->viewAttributes() ?>>
<?= $Page->closed_at->getViewValue() ?></span>
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
<?php if ($Page->resolution_time_minutes->Visible) { // resolution_time_minutes ?>
        <td<?= $Page->resolution_time_minutes->cellAttributes() ?>>
<span id="">
<span<?= $Page->resolution_time_minutes->viewAttributes() ?>>
<?= $Page->resolution_time_minutes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sla_compliant->Visible) { // sla_compliant ?>
        <td<?= $Page->sla_compliant->cellAttributes() ?>>
<span id="">
<span<?= $Page->sla_compliant->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->sla_compliant->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->closed_by->Visible) { // closed_by ?>
        <td<?= $Page->closed_by->cellAttributes() ?>>
<span id="">
<span<?= $Page->closed_by->viewAttributes() ?>>
<?= $Page->closed_by->getViewValue() ?></span>
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
