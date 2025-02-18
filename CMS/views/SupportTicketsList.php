<?php

namespace PHPMaker2024\CMS;

// Page object
$SupportTicketsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { support_tickets: currentTable } });
var currentPageID = ew.PAGE_ID = "list";
var currentForm;
var <?= $Page->FormName ?>;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("<?= $Page->FormName ?>")
        .setPageId("list")
        .setSubmitWithFetch(<?= $Page->UseAjaxActions ? "true" : "false" ?>)
        .setFormKeyCountName("<?= $Page->FormKeyCountName ?>")
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
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<form name="fsupport_ticketssrch" id="fsupport_ticketssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fsupport_ticketssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { support_tickets: currentTable } });
var currentForm;
var fsupport_ticketssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fsupport_ticketssrch")
        .setPageId("list")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Dynamic selection lists
        .setLists({
        })

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
    currentSearchForm = form;
    loadjs.done(form.id);
});
</script>
<input type="hidden" name="cmd" value="search">
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<div class="ew-extended-search container-fluid ps-2">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fsupport_ticketssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fsupport_ticketssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fsupport_ticketssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fsupport_ticketssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
<?php } ?>
<?php } ?>
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="list<?= ($Page->TotalRecords == 0 && !$Page->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-header-options">
<?php $Page->HeaderOptions?->render("body") ?>
</div>
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
</div>
<?php } ?>
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="off">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="support_tickets">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_support_tickets" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_support_ticketslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = RowType::HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->ticket_id->Visible) { // ticket_id ?>
        <th data-name="ticket_id" class="<?= $Page->ticket_id->headerCellClass() ?>"><div id="elh_support_tickets_ticket_id" class="support_tickets_ticket_id"><?= $Page->renderFieldHeader($Page->ticket_id) ?></div></th>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
        <th data-name="client_id" class="<?= $Page->client_id->headerCellClass() ?>"><div id="elh_support_tickets_client_id" class="support_tickets_client_id"><?= $Page->renderFieldHeader($Page->client_id) ?></div></th>
<?php } ?>
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
        <th data-name="equipment_id" class="<?= $Page->equipment_id->headerCellClass() ?>"><div id="elh_support_tickets_equipment_id" class="support_tickets_equipment_id"><?= $Page->renderFieldHeader($Page->equipment_id) ?></div></th>
<?php } ?>
<?php if ($Page->subject->Visible) { // subject ?>
        <th data-name="subject" class="<?= $Page->subject->headerCellClass() ?>"><div id="elh_support_tickets_subject" class="support_tickets_subject"><?= $Page->renderFieldHeader($Page->subject) ?></div></th>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
        <th data-name="priority" class="<?= $Page->priority->headerCellClass() ?>"><div id="elh_support_tickets_priority" class="support_tickets_priority"><?= $Page->renderFieldHeader($Page->priority) ?></div></th>
<?php } ?>
<?php if ($Page->category->Visible) { // category ?>
        <th data-name="category" class="<?= $Page->category->headerCellClass() ?>"><div id="elh_support_tickets_category" class="support_tickets_category"><?= $Page->renderFieldHeader($Page->category) ?></div></th>
<?php } ?>
<?php if ($Page->submitted_by->Visible) { // submitted_by ?>
        <th data-name="submitted_by" class="<?= $Page->submitted_by->headerCellClass() ?>"><div id="elh_support_tickets_submitted_by" class="support_tickets_submitted_by"><?= $Page->renderFieldHeader($Page->submitted_by) ?></div></th>
<?php } ?>
<?php if ($Page->assigned_to->Visible) { // assigned_to ?>
        <th data-name="assigned_to" class="<?= $Page->assigned_to->headerCellClass() ?>"><div id="elh_support_tickets_assigned_to" class="support_tickets_assigned_to"><?= $Page->renderFieldHeader($Page->assigned_to) ?></div></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th data-name="created_at" class="<?= $Page->created_at->headerCellClass() ?>"><div id="elh_support_tickets_created_at" class="support_tickets_created_at"><?= $Page->renderFieldHeader($Page->created_at) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_support_tickets_status" class="support_tickets_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->closed_at->Visible) { // closed_at ?>
        <th data-name="closed_at" class="<?= $Page->closed_at->headerCellClass() ?>"><div id="elh_support_tickets_closed_at" class="support_tickets_closed_at"><?= $Page->renderFieldHeader($Page->closed_at) ?></div></th>
<?php } ?>
<?php if ($Page->response_time_minutes->Visible) { // response_time_minutes ?>
        <th data-name="response_time_minutes" class="<?= $Page->response_time_minutes->headerCellClass() ?>"><div id="elh_support_tickets_response_time_minutes" class="support_tickets_response_time_minutes"><?= $Page->renderFieldHeader($Page->response_time_minutes) ?></div></th>
<?php } ?>
<?php if ($Page->resolution_time_minutes->Visible) { // resolution_time_minutes ?>
        <th data-name="resolution_time_minutes" class="<?= $Page->resolution_time_minutes->headerCellClass() ?>"><div id="elh_support_tickets_resolution_time_minutes" class="support_tickets_resolution_time_minutes"><?= $Page->renderFieldHeader($Page->resolution_time_minutes) ?></div></th>
<?php } ?>
<?php if ($Page->sla_compliant->Visible) { // sla_compliant ?>
        <th data-name="sla_compliant" class="<?= $Page->sla_compliant->headerCellClass() ?>"><div id="elh_support_tickets_sla_compliant" class="support_tickets_sla_compliant"><?= $Page->renderFieldHeader($Page->sla_compliant) ?></div></th>
<?php } ?>
<?php if ($Page->closed_by->Visible) { // closed_by ?>
        <th data-name="closed_by" class="<?= $Page->closed_by->headerCellClass() ?>"><div id="elh_support_tickets_closed_by" class="support_tickets_closed_by"><?= $Page->renderFieldHeader($Page->closed_by) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Page->getPageNumber() ?>">
<?php
$Page->setupGrid();
$isInlineAddOrCopy = ($Page->isCopy() || $Page->isAdd());
while ($Page->RecordCount < $Page->StopRecord || $Page->RowIndex === '$rowindex$' || $isInlineAddOrCopy && $Page->RowIndex == 0) {
    if (
        $Page->CurrentRow !== false &&
        $Page->RowIndex !== '$rowindex$' &&
        (!$Page->isGridAdd() || $Page->CurrentMode == "copy") &&
        !($isInlineAddOrCopy && $Page->RowIndex == 0)
    ) {
        $Page->fetch();
    }
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->ticket_id->Visible) { // ticket_id ?>
        <td data-name="ticket_id"<?= $Page->ticket_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_ticket_id" class="el_support_tickets_ticket_id">
<span<?= $Page->ticket_id->viewAttributes() ?>>
<?= $Page->ticket_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->client_id->Visible) { // client_id ?>
        <td data-name="client_id"<?= $Page->client_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_client_id" class="el_support_tickets_client_id">
<span<?= $Page->client_id->viewAttributes() ?>>
<?= $Page->client_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->equipment_id->Visible) { // equipment_id ?>
        <td data-name="equipment_id"<?= $Page->equipment_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_equipment_id" class="el_support_tickets_equipment_id">
<span<?= $Page->equipment_id->viewAttributes() ?>>
<?= $Page->equipment_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->subject->Visible) { // subject ?>
        <td data-name="subject"<?= $Page->subject->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_subject" class="el_support_tickets_subject">
<span<?= $Page->subject->viewAttributes() ?>>
<?= $Page->subject->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->priority->Visible) { // priority ?>
        <td data-name="priority"<?= $Page->priority->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_priority" class="el_support_tickets_priority">
<span<?= $Page->priority->viewAttributes() ?>>
<?= $Page->priority->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->category->Visible) { // category ?>
        <td data-name="category"<?= $Page->category->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_category" class="el_support_tickets_category">
<span<?= $Page->category->viewAttributes() ?>>
<?= $Page->category->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->submitted_by->Visible) { // submitted_by ?>
        <td data-name="submitted_by"<?= $Page->submitted_by->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_submitted_by" class="el_support_tickets_submitted_by">
<span<?= $Page->submitted_by->viewAttributes() ?>>
<?= $Page->submitted_by->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->assigned_to->Visible) { // assigned_to ?>
        <td data-name="assigned_to"<?= $Page->assigned_to->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_assigned_to" class="el_support_tickets_assigned_to">
<span<?= $Page->assigned_to->viewAttributes() ?>>
<?= $Page->assigned_to->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_at->Visible) { // created_at ?>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_created_at" class="el_support_tickets_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_status" class="el_support_tickets_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->closed_at->Visible) { // closed_at ?>
        <td data-name="closed_at"<?= $Page->closed_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_closed_at" class="el_support_tickets_closed_at">
<span<?= $Page->closed_at->viewAttributes() ?>>
<?= $Page->closed_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->response_time_minutes->Visible) { // response_time_minutes ?>
        <td data-name="response_time_minutes"<?= $Page->response_time_minutes->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_response_time_minutes" class="el_support_tickets_response_time_minutes">
<span<?= $Page->response_time_minutes->viewAttributes() ?>>
<?= $Page->response_time_minutes->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->resolution_time_minutes->Visible) { // resolution_time_minutes ?>
        <td data-name="resolution_time_minutes"<?= $Page->resolution_time_minutes->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_resolution_time_minutes" class="el_support_tickets_resolution_time_minutes">
<span<?= $Page->resolution_time_minutes->viewAttributes() ?>>
<?= $Page->resolution_time_minutes->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sla_compliant->Visible) { // sla_compliant ?>
        <td data-name="sla_compliant"<?= $Page->sla_compliant->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_sla_compliant" class="el_support_tickets_sla_compliant">
<span<?= $Page->sla_compliant->viewAttributes() ?>>
<i class="fa-regular fa-square<?php if (ConvertToBool($Page->sla_compliant->CurrentValue)) { ?>-check<?php } ?> ew-icon ew-boolean"></i>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->closed_by->Visible) { // closed_by ?>
        <td data-name="closed_by"<?= $Page->closed_by->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_support_tickets_closed_by" class="el_support_tickets_closed_by">
<span<?= $Page->closed_by->viewAttributes() ?>>
<?= $Page->closed_by->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }

    // Reset for template row
    if ($Page->RowIndex === '$rowindex$') {
        $Page->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0) {
        $Page->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction && !$Page->UseAjaxActions) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close result set
$Page->Recordset?->free();
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
<div id="ew-footer-options">
<?php $Page->FooterOptions?->render("body") ?>
</div>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("support_tickets");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
