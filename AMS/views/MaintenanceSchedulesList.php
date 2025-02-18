<?php

namespace PHPMaker2024\AMS;

// Page object
$MaintenanceSchedulesList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_schedules: currentTable } });
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
<form name="fmaintenance_schedulessrch" id="fmaintenance_schedulessrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="off">
<div id="fmaintenance_schedulessrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_schedules: currentTable } });
var currentForm;
var fmaintenance_schedulessrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fmaintenance_schedulessrch")
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fmaintenance_schedulessrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fmaintenance_schedulessrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fmaintenance_schedulessrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fmaintenance_schedulessrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="maintenance_schedules">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_maintenance_schedules" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_maintenance_scheduleslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
<?php if ($Page->schedule_id->Visible) { // schedule_id ?>
        <th data-name="schedule_id" class="<?= $Page->schedule_id->headerCellClass() ?>"><div id="elh_maintenance_schedules_schedule_id" class="maintenance_schedules_schedule_id"><?= $Page->renderFieldHeader($Page->schedule_id) ?></div></th>
<?php } ?>
<?php if ($Page->equipment_id->Visible) { // equipment_id ?>
        <th data-name="equipment_id" class="<?= $Page->equipment_id->headerCellClass() ?>"><div id="elh_maintenance_schedules_equipment_id" class="maintenance_schedules_equipment_id"><?= $Page->renderFieldHeader($Page->equipment_id) ?></div></th>
<?php } ?>
<?php if ($Page->maintenance_type_id->Visible) { // maintenance_type_id ?>
        <th data-name="maintenance_type_id" class="<?= $Page->maintenance_type_id->headerCellClass() ?>"><div id="elh_maintenance_schedules_maintenance_type_id" class="maintenance_schedules_maintenance_type_id"><?= $Page->renderFieldHeader($Page->maintenance_type_id) ?></div></th>
<?php } ?>
<?php if ($Page->team_id->Visible) { // team_id ?>
        <th data-name="team_id" class="<?= $Page->team_id->headerCellClass() ?>"><div id="elh_maintenance_schedules_team_id" class="maintenance_schedules_team_id"><?= $Page->renderFieldHeader($Page->team_id) ?></div></th>
<?php } ?>
<?php if ($Page->scheduled_date->Visible) { // scheduled_date ?>
        <th data-name="scheduled_date" class="<?= $Page->scheduled_date->headerCellClass() ?>"><div id="elh_maintenance_schedules_scheduled_date" class="maintenance_schedules_scheduled_date"><?= $Page->renderFieldHeader($Page->scheduled_date) ?></div></th>
<?php } ?>
<?php if ($Page->status_id->Visible) { // status_id ?>
        <th data-name="status_id" class="<?= $Page->status_id->headerCellClass() ?>"><div id="elh_maintenance_schedules_status_id" class="maintenance_schedules_status_id"><?= $Page->renderFieldHeader($Page->status_id) ?></div></th>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
        <th data-name="priority" class="<?= $Page->priority->headerCellClass() ?>"><div id="elh_maintenance_schedules_priority" class="maintenance_schedules_priority"><?= $Page->renderFieldHeader($Page->priority) ?></div></th>
<?php } ?>
<?php if ($Page->estimated_duration->Visible) { // estimated_duration ?>
        <th data-name="estimated_duration" class="<?= $Page->estimated_duration->headerCellClass() ?>"><div id="elh_maintenance_schedules_estimated_duration" class="maintenance_schedules_estimated_duration"><?= $Page->renderFieldHeader($Page->estimated_duration) ?></div></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th data-name="created_by" class="<?= $Page->created_by->headerCellClass() ?>"><div id="elh_maintenance_schedules_created_by" class="maintenance_schedules_created_by"><?= $Page->renderFieldHeader($Page->created_by) ?></div></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th data-name="created_at" class="<?= $Page->created_at->headerCellClass() ?>"><div id="elh_maintenance_schedules_created_at" class="maintenance_schedules_created_at"><?= $Page->renderFieldHeader($Page->created_at) ?></div></th>
<?php } ?>
<?php if ($Page->updated_by->Visible) { // updated_by ?>
        <th data-name="updated_by" class="<?= $Page->updated_by->headerCellClass() ?>"><div id="elh_maintenance_schedules_updated_by" class="maintenance_schedules_updated_by"><?= $Page->renderFieldHeader($Page->updated_by) ?></div></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th data-name="updated_at" class="<?= $Page->updated_at->headerCellClass() ?>"><div id="elh_maintenance_schedules_updated_at" class="maintenance_schedules_updated_at"><?= $Page->renderFieldHeader($Page->updated_at) ?></div></th>
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
    <?php if ($Page->schedule_id->Visible) { // schedule_id ?>
        <td data-name="schedule_id"<?= $Page->schedule_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_maintenance_schedules_schedule_id" class="el_maintenance_schedules_schedule_id">
<span<?= $Page->schedule_id->viewAttributes() ?>>
<?= $Page->schedule_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->equipment_id->Visible) { // equipment_id ?>
        <td data-name="equipment_id"<?= $Page->equipment_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_maintenance_schedules_equipment_id" class="el_maintenance_schedules_equipment_id">
<span<?= $Page->equipment_id->viewAttributes() ?>>
<?= $Page->equipment_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->maintenance_type_id->Visible) { // maintenance_type_id ?>
        <td data-name="maintenance_type_id"<?= $Page->maintenance_type_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_maintenance_schedules_maintenance_type_id" class="el_maintenance_schedules_maintenance_type_id">
<span<?= $Page->maintenance_type_id->viewAttributes() ?>>
<?= $Page->maintenance_type_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->team_id->Visible) { // team_id ?>
        <td data-name="team_id"<?= $Page->team_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_maintenance_schedules_team_id" class="el_maintenance_schedules_team_id">
<span<?= $Page->team_id->viewAttributes() ?>>
<?= $Page->team_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->scheduled_date->Visible) { // scheduled_date ?>
        <td data-name="scheduled_date"<?= $Page->scheduled_date->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_maintenance_schedules_scheduled_date" class="el_maintenance_schedules_scheduled_date">
<span<?= $Page->scheduled_date->viewAttributes() ?>>
<?= $Page->scheduled_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status_id->Visible) { // status_id ?>
        <td data-name="status_id"<?= $Page->status_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_maintenance_schedules_status_id" class="el_maintenance_schedules_status_id">
<span<?= $Page->status_id->viewAttributes() ?>>
<?= $Page->status_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->priority->Visible) { // priority ?>
        <td data-name="priority"<?= $Page->priority->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_maintenance_schedules_priority" class="el_maintenance_schedules_priority">
<span<?= $Page->priority->viewAttributes() ?>>
<?= $Page->priority->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->estimated_duration->Visible) { // estimated_duration ?>
        <td data-name="estimated_duration"<?= $Page->estimated_duration->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_maintenance_schedules_estimated_duration" class="el_maintenance_schedules_estimated_duration">
<span<?= $Page->estimated_duration->viewAttributes() ?>>
<?= $Page->estimated_duration->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_by->Visible) { // created_by ?>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_maintenance_schedules_created_by" class="el_maintenance_schedules_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_at->Visible) { // created_at ?>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_maintenance_schedules_created_at" class="el_maintenance_schedules_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->updated_by->Visible) { // updated_by ?>
        <td data-name="updated_by"<?= $Page->updated_by->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_maintenance_schedules_updated_by" class="el_maintenance_schedules_updated_by">
<span<?= $Page->updated_by->viewAttributes() ?>>
<?= $Page->updated_by->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_maintenance_schedules_updated_at" class="el_maintenance_schedules_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
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
    ew.addEventHandlers("maintenance_schedules");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
