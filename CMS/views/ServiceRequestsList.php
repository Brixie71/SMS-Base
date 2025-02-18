<?php

namespace PHPMaker2024\CMS;

// Page object
$ServiceRequestsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { service_requests: currentTable } });
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
<form name="fservice_requestssrch" id="fservice_requestssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fservice_requestssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { service_requests: currentTable } });
var currentForm;
var fservice_requestssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fservice_requestssrch")
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fservice_requestssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fservice_requestssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fservice_requestssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fservice_requestssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="service_requests">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_service_requests" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_service_requestslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->request_id->Visible) { // request_id ?>
        <th data-name="request_id" class="<?= $Page->request_id->headerCellClass() ?>"><div id="elh_service_requests_request_id" class="service_requests_request_id"><?= $Page->renderFieldHeader($Page->request_id) ?></div></th>
<?php } ?>
<?php if ($Page->client_id->Visible) { // client_id ?>
        <th data-name="client_id" class="<?= $Page->client_id->headerCellClass() ?>"><div id="elh_service_requests_client_id" class="service_requests_client_id"><?= $Page->renderFieldHeader($Page->client_id) ?></div></th>
<?php } ?>
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
        <th data-name="equipment_id" class="<?= $Page->equipment_id->headerCellClass() ?>"><div id="elh_service_requests_equipment_id" class="service_requests_equipment_id"><?= $Page->renderFieldHeader($Page->equipment_id) ?></div></th>
<?php } ?>
<?php if ($Page->request_type->Visible) { // request_type ?>
        <th data-name="request_type" class="<?= $Page->request_type->headerCellClass() ?>"><div id="elh_service_requests_request_type" class="service_requests_request_type"><?= $Page->renderFieldHeader($Page->request_type) ?></div></th>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
        <th data-name="priority" class="<?= $Page->priority->headerCellClass() ?>"><div id="elh_service_requests_priority" class="service_requests_priority"><?= $Page->renderFieldHeader($Page->priority) ?></div></th>
<?php } ?>
<?php if ($Page->requested_by->Visible) { // requested_by ?>
        <th data-name="requested_by" class="<?= $Page->requested_by->headerCellClass() ?>"><div id="elh_service_requests_requested_by" class="service_requests_requested_by"><?= $Page->renderFieldHeader($Page->requested_by) ?></div></th>
<?php } ?>
<?php if ($Page->requested_date->Visible) { // requested_date ?>
        <th data-name="requested_date" class="<?= $Page->requested_date->headerCellClass() ?>"><div id="elh_service_requests_requested_date" class="service_requests_requested_date"><?= $Page->renderFieldHeader($Page->requested_date) ?></div></th>
<?php } ?>
<?php if ($Page->scheduled_date->Visible) { // scheduled_date ?>
        <th data-name="scheduled_date" class="<?= $Page->scheduled_date->headerCellClass() ?>"><div id="elh_service_requests_scheduled_date" class="service_requests_scheduled_date"><?= $Page->renderFieldHeader($Page->scheduled_date) ?></div></th>
<?php } ?>
<?php if ($Page->completion_date->Visible) { // completion_date ?>
        <th data-name="completion_date" class="<?= $Page->completion_date->headerCellClass() ?>"><div id="elh_service_requests_completion_date" class="service_requests_completion_date"><?= $Page->renderFieldHeader($Page->completion_date) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_service_requests_status" class="service_requests_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->assigned_to->Visible) { // assigned_to ?>
        <th data-name="assigned_to" class="<?= $Page->assigned_to->headerCellClass() ?>"><div id="elh_service_requests_assigned_to" class="service_requests_assigned_to"><?= $Page->renderFieldHeader($Page->assigned_to) ?></div></th>
<?php } ?>
<?php if ($Page->response_time_minutes->Visible) { // response_time_minutes ?>
        <th data-name="response_time_minutes" class="<?= $Page->response_time_minutes->headerCellClass() ?>"><div id="elh_service_requests_response_time_minutes" class="service_requests_response_time_minutes"><?= $Page->renderFieldHeader($Page->response_time_minutes) ?></div></th>
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
    <?php if ($Page->request_id->Visible) { // request_id ?>
        <td data-name="request_id"<?= $Page->request_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_service_requests_request_id" class="el_service_requests_request_id">
<span<?= $Page->request_id->viewAttributes() ?>>
<?= $Page->request_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->client_id->Visible) { // client_id ?>
        <td data-name="client_id"<?= $Page->client_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_service_requests_client_id" class="el_service_requests_client_id">
<span<?= $Page->client_id->viewAttributes() ?>>
<?= $Page->client_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->equipment_id->Visible) { // equipment_id ?>
        <td data-name="equipment_id"<?= $Page->equipment_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_service_requests_equipment_id" class="el_service_requests_equipment_id">
<span<?= $Page->equipment_id->viewAttributes() ?>>
<?= $Page->equipment_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->request_type->Visible) { // request_type ?>
        <td data-name="request_type"<?= $Page->request_type->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_service_requests_request_type" class="el_service_requests_request_type">
<span<?= $Page->request_type->viewAttributes() ?>>
<?= $Page->request_type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->priority->Visible) { // priority ?>
        <td data-name="priority"<?= $Page->priority->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_service_requests_priority" class="el_service_requests_priority">
<span<?= $Page->priority->viewAttributes() ?>>
<?= $Page->priority->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->requested_by->Visible) { // requested_by ?>
        <td data-name="requested_by"<?= $Page->requested_by->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_service_requests_requested_by" class="el_service_requests_requested_by">
<span<?= $Page->requested_by->viewAttributes() ?>>
<?= $Page->requested_by->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->requested_date->Visible) { // requested_date ?>
        <td data-name="requested_date"<?= $Page->requested_date->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_service_requests_requested_date" class="el_service_requests_requested_date">
<span<?= $Page->requested_date->viewAttributes() ?>>
<?= $Page->requested_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->scheduled_date->Visible) { // scheduled_date ?>
        <td data-name="scheduled_date"<?= $Page->scheduled_date->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_service_requests_scheduled_date" class="el_service_requests_scheduled_date">
<span<?= $Page->scheduled_date->viewAttributes() ?>>
<?= $Page->scheduled_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->completion_date->Visible) { // completion_date ?>
        <td data-name="completion_date"<?= $Page->completion_date->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_service_requests_completion_date" class="el_service_requests_completion_date">
<span<?= $Page->completion_date->viewAttributes() ?>>
<?= $Page->completion_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_service_requests_status" class="el_service_requests_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->assigned_to->Visible) { // assigned_to ?>
        <td data-name="assigned_to"<?= $Page->assigned_to->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_service_requests_assigned_to" class="el_service_requests_assigned_to">
<span<?= $Page->assigned_to->viewAttributes() ?>>
<?= $Page->assigned_to->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->response_time_minutes->Visible) { // response_time_minutes ?>
        <td data-name="response_time_minutes"<?= $Page->response_time_minutes->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_service_requests_response_time_minutes" class="el_service_requests_response_time_minutes">
<span<?= $Page->response_time_minutes->viewAttributes() ?>>
<?= $Page->response_time_minutes->getViewValue() ?></span>
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
    ew.addEventHandlers("service_requests");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
