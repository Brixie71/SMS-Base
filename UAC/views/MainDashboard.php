<?php

namespace PHPMaker2024\UAC;

// Page object
$MainDashboard = &$Page;
?>
<?php
$Page->showMessage();
?>
<?php include(dirname(__DIR__, 1) . "/app/pages/main-dashboard.php"); ?>

<?= GetDebugMessage() ?>
