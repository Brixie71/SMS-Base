<?php

namespace PHPMaker2024\AMS;

// Page object
$MaintenanceFindingsView = &$Page;
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
<form name="fmaintenance_findingsview" id="fmaintenance_findingsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="off">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { maintenance_findings: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fmaintenance_findingsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmaintenance_findingsview")
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
<input type="hidden" name="t" value="maintenance_findings">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->finding_id->Visible) { // finding_id ?>
    <tr id="r_finding_id"<?= $Page->finding_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_findings_finding_id"><?= $Page->finding_id->caption() ?></span></td>
        <td data-name="finding_id"<?= $Page->finding_id->cellAttributes() ?>>
<span id="el_maintenance_findings_finding_id">
<span<?= $Page->finding_id->viewAttributes() ?>>
<?= $Page->finding_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->log_id->Visible) { // log_id ?>
    <tr id="r_log_id"<?= $Page->log_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_findings_log_id"><?= $Page->log_id->caption() ?></span></td>
        <td data-name="log_id"<?= $Page->log_id->cellAttributes() ?>>
<span id="el_maintenance_findings_log_id">
<span<?= $Page->log_id->viewAttributes() ?>>
<?= $Page->log_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->finding_type->Visible) { // finding_type ?>
    <tr id="r_finding_type"<?= $Page->finding_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_findings_finding_type"><?= $Page->finding_type->caption() ?></span></td>
        <td data-name="finding_type"<?= $Page->finding_type->cellAttributes() ?>>
<span id="el_maintenance_findings_finding_type">
<span<?= $Page->finding_type->viewAttributes() ?>>
<?= $Page->finding_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_findings_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_maintenance_findings_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->severity->Visible) { // severity ?>
    <tr id="r_severity"<?= $Page->severity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_findings_severity"><?= $Page->severity->caption() ?></span></td>
        <td data-name="severity"<?= $Page->severity->cellAttributes() ?>>
<span id="el_maintenance_findings_severity">
<span<?= $Page->severity->viewAttributes() ?>>
<?= $Page->severity->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->recommendation->Visible) { // recommendation ?>
    <tr id="r_recommendation"<?= $Page->recommendation->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_findings_recommendation"><?= $Page->recommendation->caption() ?></span></td>
        <td data-name="recommendation"<?= $Page->recommendation->cellAttributes() ?>>
<span id="el_maintenance_findings_recommendation">
<span<?= $Page->recommendation->viewAttributes() ?>>
<?= $Page->recommendation->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <tr id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_findings_created_by"><?= $Page->created_by->caption() ?></span></td>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el_maintenance_findings_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_maintenance_findings_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_maintenance_findings_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
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
